<?php
if (!defined('ABSPATH')) exit;

class VTP_Event_Shift_Operations {
 const SOURCE_TYPE = 'event_day_operation';
 const SCHEMA_VERSION = '3';

 public static function init(){
  self::ensure_schema();

  // Vor VTP_Event_Shifts::assets (Standard-Priorität 10) synchronisieren,
  // damit automatisch erzeugte Schichten sofort im modernen Helferblock erscheinen.
  add_action('admin_enqueue_scripts',[__CLASS__,'prepare_event_edit'],5);

  // Der eigentliche Ablauf-Save beendet den Request per Redirect/exit.
  // Deshalb merken wir uns das Event vorher und synchronisieren sicher im Shutdown
  // nach erfolgreichem DB-Commit des Ablaufplans.
  add_action('admin_post_vtp_save_event_items',[__CLASS__,'schedule_sync_after_event_save'],1);
 }

 public static function ensure_schema(){
  global $wpdb;
  $table=VTP_DB::table('shifts');
  $cols=$wpdb->get_col("DESC $table",0);
  if(!$cols) return false;

  // Nie nur einer gespeicherten Versionsoption vertrauen: entscheidend ist das reale Schema.
  if(!in_array('source_type',$cols,true)){
   $wpdb->query("ALTER TABLE $table ADD source_type VARCHAR(40) NULL AFTER assigned_group");
  }
  $cols=$wpdb->get_col("DESC $table",0);
  if(!in_array('source_ref',$cols,true)){
   $after=in_array('source_type',$cols,true)?'source_type':'assigned_group';
   $wpdb->query("ALTER TABLE $table ADD source_ref BIGINT UNSIGNED NULL AFTER $after");
  }

  $cols=$wpdb->get_col("DESC $table",0);
  if(!in_array('source_type',$cols,true) || !in_array('source_ref',$cols,true)) return false;

  $indexes=$wpdb->get_results("SHOW INDEX FROM $table");
  $has_source_ref=false;
  foreach($indexes?:[] as $index){
   if(($index->Key_name??'')==='source_ref'){
    $has_source_ref=true;
    break;
   }
  }
  if(!$has_source_ref){
   $wpdb->query("ALTER TABLE $table ADD KEY source_ref (source_ref)");
  }

  update_option('vtp_event_shift_operations_schema',self::SCHEMA_VERSION,false);
  return true;
 }

 public static function schedule_sync_after_event_save(){
  $event_id=absint($_POST['event_id']??0);
  if(!$event_id || !current_user_can('manage_options')) return;

  register_shutdown_function(function() use ($event_id){
   VTP_Event_Shift_Operations::sync_for_event($event_id);
  });
 }

 public static function prepare_event_edit($hook){
  if(($_GET['page']??'')!=='vtp-events') return;
  $event_id=absint($_GET['edit_event']??0);
  if(!$event_id) return;

  self::sync_for_event($event_id);

  // Entfernt nur die drei veralteten Legacy-Blöcke aus dem modernen Event-Edit-Screen.
  // Tabellen und alte Handler bleiben vorerst aus Rückwärtskompatibilität erhalten.
  wp_enqueue_script(
   'vtp-event-shift-operations',
   VTP_URL.'assets/event-shift-operations.js',
   [],
   VTP_VERSION,
   true
  );
 }

 public static function sync_for_event($event_id){
  $event_id=absint($event_id);
  if(!$event_id || !self::ensure_schema()) return false;
  return self::sync_operation_shifts($event_id);
 }

 private static function sync_operation_shifts($event_id){
  global $wpdb;
  $days=VTP_DB::table('event_days');
  $shifts=VTP_DB::table('shifts');
  $signups=VTP_DB::table('shift_signups');

  $day_cols=$wpdb->get_col("DESC $days",0);
  if(!$day_cols || !in_array('day_time',$day_cols,true)) return false;

  $operation_days=$wpdb->get_results($wpdb->prepare(
   "SELECT id,event_date,day_type,day_time
    FROM $days
    WHERE event_id=%d AND day_type IN ('setup','teardown')
    ORDER BY event_date,
      CASE day_type WHEN 'setup' THEN 0 ELSE 2 END,
      sort_order,id",
   $event_id
  ));

  $auto_rows=$wpdb->get_results($wpdb->prepare(
   "SELECT id,source_ref,end_time,slots_needed,assigned_group
    FROM $shifts
    WHERE event_id=%d AND source_type=%s",
   $event_id,
   self::SOURCE_TYPE
  ));
  $by_source=[];
  foreach($auto_rows?:[] as $row){
   $by_source[absint($row->source_ref)]=$row;
  }

  $active_refs=[];
  foreach($operation_days?:[] as $day){
   $day_id=absint($day->id);
   $date=(string)$day->event_date;
   $start=substr((string)$day->day_time,0,5);
   if(!$day_id || !self::valid_date($date) || !self::valid_time($start)) continue;

   $active_refs[]=$day_id;
   $label=$day->day_type==='setup'?'Aufbau':'Abbau';
   $row=$by_source[$day_id]??null;

   // Bereits früher manuell übernommene passende Aufbau-/Abbau-Schichten
   // übernehmen statt eine Dublette anzulegen.
   if(!$row){
    $row=$wpdb->get_row($wpdb->prepare(
     "SELECT id,source_ref,end_time,slots_needed,assigned_group
      FROM $shifts
      WHERE event_id=%d
        AND area_name=%s
        AND shift_date=%s
        AND start_time=%s
        AND (source_type IS NULL OR source_type='')
      ORDER BY id
      LIMIT 1",
     $event_id,$label,$date,$start
    ));
    if($row){
     $wpdb->update($shifts,[
      'source_type'=>self::SOURCE_TYPE,
      'source_ref'=>$day_id,
     ],['id'=>absint($row->id),'event_id'=>$event_id]);
    }
   }

   $default_end=self::add_minutes($start,120);
   if($row){
    $end=substr((string)$row->end_time,0,5);
    if(!self::valid_time($end) || $end===$start) $end=$default_end;
    $wpdb->update($shifts,[
     'area_name'=>$label,
     'shift_date'=>$date,
     'start_time'=>$start,
     'end_time'=>$end,
     'source_type'=>self::SOURCE_TYPE,
     'source_ref'=>$day_id,
    ],['id'=>absint($row->id),'event_id'=>$event_id]);
   } else {
    $ok=$wpdb->insert($shifts,[
     'event_id'=>$event_id,
     'area_name'=>$label,
     'shift_date'=>$date,
     'start_time'=>$start,
     'end_time'=>$default_end,
     'slots_needed'=>2,
     'assigned_group'=>null,
     'source_type'=>self::SOURCE_TYPE,
     'source_ref'=>$day_id,
    ]);
    if($ok===false) return false;
   }
  }

  // Wurde Aufbau/Abbau im Ablaufplan wieder entfernt, löschen wir eine automatisch
  // erzeugte Schicht nur dann still, wenn noch niemand darauf angemeldet ist.
  foreach($auto_rows?:[] as $row){
   $ref=absint($row->source_ref);
   if($ref && in_array($ref,$active_refs,true)) continue;
   $shift_id=absint($row->id);
   $signup_count=(int)$wpdb->get_var($wpdb->prepare(
    "SELECT COUNT(*) FROM $signups WHERE shift_id=%d",
    $shift_id
   ));
   if($signup_count===0){
    $wpdb->delete($shifts,['id'=>$shift_id,'event_id'=>$event_id]);
   } else {
    $wpdb->update($shifts,[
     'source_type'=>null,
     'source_ref'=>null,
    ],['id'=>$shift_id,'event_id'=>$event_id]);
   }
  }

  return true;
 }

 private static function valid_date($date){
  if(!preg_match('/^\d{4}-\d{2}-\d{2}$/',(string)$date)) return false;
  [$y,$m,$d]=array_map('intval',explode('-',(string)$date));
  return checkdate($m,$d,$y);
 }

 private static function valid_time($time){
  return (bool)preg_match('/^(?:[01]\d|2[0-3]):[0-5]\d$/',(string)$time);
 }

 private static function add_minutes($time,$minutes){
  [$h,$m]=array_map('intval',explode(':',(string)$time));
  $total=(($h*60+$m)+(int)$minutes)%1440;
  return sprintf('%02d:%02d',intdiv($total,60),$total%60);
 }
}
