<?php
if (!defined('ABSPATH')) exit;

class VTP_Event_Day_Planner {
 const SCHEMA_VERSION='1';

 public static function init(){
  self::ensure_schema();

  remove_action('admin_post_vtp_save_event_items',[VTP_Plugin::instance(),'save_event_items']);
  add_action('admin_post_vtp_save_event_items',[__CLASS__,'save_event_items']);
  add_action('admin_post_vtp_delete_event',[__CLASS__,'delete_event_days'],1);
  add_action('admin_enqueue_scripts',[__CLASS__,'assets']);
 }

 private static function table(){ return VTP_DB::table('event_days'); }

 private static function ensure_schema(){
  if(get_option('vtp_event_day_schema_version')===self::SCHEMA_VERSION) return;

  global $wpdb;
  require_once ABSPATH.'wp-admin/includes/upgrade.php';
  $c=$wpdb->get_charset_collate();
  $days=self::table();

  dbDelta("CREATE TABLE $days (
   id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   event_id BIGINT UNSIGNED NOT NULL,
   event_date DATE NOT NULL,
   day_type VARCHAR(20) NOT NULL DEFAULT 'event',
   sort_order INT NOT NULL DEFAULT 0,
   created_at DATETIME NOT NULL,
   updated_at DATETIME NOT NULL,
   PRIMARY KEY (id),
   KEY event_id (event_id),
   KEY event_date (event_date),
   KEY event_type_order (event_id,day_type,sort_order)
  ) $c;");

  $items=VTP_DB::table('event_items');
  $cols=$wpdb->get_col("DESC $items",0);
  if($cols && !in_array('event_day_id',$cols,true)){
   $wpdb->query("ALTER TABLE $items ADD event_day_id BIGINT UNSIGNED NULL AFTER event_id");
   $wpdb->query("ALTER TABLE $items ADD KEY event_day_id (event_day_id)");
  }

  self::migrate_existing_days();
  update_option('vtp_event_day_schema_version',self::SCHEMA_VERSION,false);
 }

 private static function migrate_existing_days(){
  global $wpdb;
  $events=VTP_DB::table('events');
  $items=VTP_DB::table('event_items');
  $days=self::table();
  $event_rows=$wpdb->get_results("SELECT id,start_date,end_date FROM $events ORDER BY id");
  $now=current_time('mysql');

  foreach($event_rows?:[] as $event){
   $eid=absint($event->id);
   $existing=(int)$wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $days WHERE event_id=%d",$eid));
   if($existing>0) continue;

   $dates=[];
   if(VTP_Plugin::is_valid_event_date((string)$event->start_date)){
    $start=strtotime($event->start_date.' 00:00:00');
    $end=VTP_Plugin::is_valid_event_date((string)$event->end_date)?strtotime($event->end_date.' 00:00:00'):$start;
    if($end<$start) $end=$start;
    $guard=0;
    for($cursor=$start;$cursor<=$end && $guard<366;$cursor=strtotime('+1 day',$cursor),$guard++){
     $dates[date('Y-m-d',$cursor)]=true;
    }
   }

   $saved=get_option('vtp_event_days_'.$eid,[]);
   if(is_array($saved)){
    foreach($saved as $date){
     if(VTP_Plugin::is_valid_event_date((string)$date)) $dates[(string)$date]=true;
    }
   }

   $item_dates=$wpdb->get_col($wpdb->prepare(
    "SELECT DISTINCT item_date FROM $items WHERE event_id=%d AND item_date IS NOT NULL AND item_date<>''",
    $eid
   ));
   foreach($item_dates?:[] as $date){
    if(VTP_Plugin::is_valid_event_date((string)$date)) $dates[(string)$date]=true;
   }

   $date_list=array_keys($dates);
   sort($date_list);
   foreach($date_list as $order=>$date){
    $wpdb->insert($days,[
     'event_id'=>$eid,
     'event_date'=>$date,
     'day_type'=>'event',
     'sort_order'=>$order,
     'created_at'=>$now,
     'updated_at'=>$now,
    ]);
    $day_id=absint($wpdb->insert_id);
    if($day_id){
     $wpdb->query($wpdb->prepare(
      "UPDATE $items SET event_day_id=%d WHERE event_id=%d AND item_date=%s AND (event_day_id IS NULL OR event_day_id=0)",
      $day_id,$eid,$date
     ));
    }
   }
  }
 }

 private static function ensure_initial_event_days($event){
  global $wpdb;
  $eid=absint($event->id??0);
  if(!$eid) return;

  $days=self::table();
  $existing=(int)$wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $days WHERE event_id=%d",$eid));
  if($existing>0) return;

  $start_date=(string)($event->start_date??'');
  if(!VTP_Plugin::is_valid_event_date($start_date)) return;

  $end_date=(string)($event->end_date??'');
  if(!VTP_Plugin::is_valid_event_date($end_date)) $end_date=$start_date;

  $start=strtotime($start_date.' 00:00:00');
  $end=strtotime($end_date.' 00:00:00');
  if($end<$start) $end=$start;

  $now=current_time('mysql');
  $legacy=[];
  $order=0;
  $guard=0;

  $wpdb->query('START TRANSACTION');
  for($cursor=$start;$cursor<=$end && $guard<366;$cursor=strtotime('+1 day',$cursor),$guard++){
   $date=date('Y-m-d',$cursor);
   $ok=$wpdb->insert($days,[
    'event_id'=>$eid,
    'event_date'=>$date,
    'day_type'=>'event',
    'sort_order'=>$order++,
    'created_at'=>$now,
    'updated_at'=>$now,
   ]);
   if($ok===false){
    $wpdb->query('ROLLBACK');
    return;
   }
   $legacy[]=$date;
  }
  $wpdb->query('COMMIT');

  update_option('vtp_event_days_'.$eid,$legacy,false);
 }

 public static function assets($hook){
  if(($_GET['page']??'')!=='vtp-events') return;
  $event_id=absint($_GET['edit_event']??0);
  if(!$event_id) return;

  global $wpdb;
  $event=$wpdb->get_row($wpdb->prepare(
   'SELECT id,name,start_date,end_date FROM '.VTP_DB::table('events').' WHERE id=%d',
   $event_id
  ));
  if(!$event) return;

  self::ensure_initial_event_days($event);

  $days=$wpdb->get_results($wpdb->prepare(
   'SELECT id,event_date,day_type,sort_order FROM '.self::table().' WHERE event_id=%d ORDER BY sort_order,id',
   $event_id
  ));
  $items=$wpdb->get_results($wpdb->prepare(
   'SELECT id,event_day_id,item_date,start_time,end_time,item_type,title,visibility,sort_order,tournament_id FROM '.VTP_DB::table('event_items').' WHERE event_id=%d ORDER BY sort_order,id',
   $event_id
  ));
  $tournaments=$wpdb->get_results($wpdb->prepare(
   "SELECT id,name,start_date,start_time,event_type FROM ".VTP_DB::table('tournaments')." WHERE (event_id=%d OR parent_event=%s) AND COALESCE(status,'')<>'archiviert' ORDER BY start_date,start_time,name",
   $event_id,$event->name
  ));

  $day_data=[];
  foreach($days?:[] as $day){
   $day_data[]=[
    'id'=>absint($day->id),
    'date'=>(string)$day->event_date,
    'type'=>in_array($day->day_type,['event','setup','teardown'],true)?$day->day_type:'event',
    'sortOrder'=>(int)$day->sort_order,
   ];
  }

  $item_data=[];
  foreach($items?:[] as $item){
   $item_data[]=[
    'id'=>absint($item->id),
    'dayId'=>absint($item->event_day_id),
    'date'=>(string)$item->item_date,
    'start'=>(string)$item->start_time,
    'end'=>(string)$item->end_time,
    'type'=>(string)$item->item_type,
    'title'=>(string)$item->title,
    'visibility'=>(string)($item->visibility?:'public'),
    'sortOrder'=>(int)$item->sort_order,
    'tournamentId'=>absint($item->tournament_id),
   ];
  }

  $linked=[];
  foreach($tournaments?:[] as $tournament){
   $linked[]=[
    'date'=>(string)$tournament->start_date,
    'time'=>(string)$tournament->start_time,
    'title'=>(string)$tournament->name,
   ];
  }

  wp_enqueue_style('vtp-event-day-plan',VTP_URL.'assets/event-day-plan.css',['vtp-event-edit'],VTP_VERSION);
  wp_enqueue_script('vtp-event-day-plan',VTP_URL.'assets/event-day-plan.js',['vtp-event-edit'],VTP_VERSION,true);
  wp_localize_script('vtp-event-day-plan','VTPEventDayPlan',[
   'eventId'=>$event_id,
   'startDate'=>(string)$event->start_date,
   'endDate'=>(string)$event->end_date,
   'days'=>$day_data,
   'items'=>$item_data,
   'linkedTournaments'=>$linked,
  ]);
 }

 public static function save_event_items(){
  if(!current_user_can('manage_options') || !check_admin_referer('vtp_save_event_items')) wp_die('Nicht erlaubt.');

  global $wpdb;
  $eid=absint($_POST['event_id']??0);
  if(!$eid) wp_die('Event fehlt.');

  $day_table=self::table();
  $item_table=VTP_DB::table('event_items');
  $day_ids=(array)($_POST['event_day_id']??[]);
  $day_refs=(array)($_POST['event_day_ref']??[]);
  $day_dates=(array)($_POST['event_day']??[]);
  $day_types=(array)($_POST['event_day_type']??[]);
  $existing_ids=array_map('absint',$wpdb->get_col($wpdb->prepare("SELECT id FROM $day_table WHERE event_id=%d",$eid))?:[]);
  $kept_ids=[];
  $ref_map=[];
  $date_fallback=[];
  $legacy_dates=[];
  $now=current_time('mysql');

  $wpdb->query('START TRANSACTION');

  foreach($day_dates as $index=>$raw_date){
   $date=sanitize_text_field(wp_unslash($raw_date));
   if(!VTP_Plugin::is_valid_event_date($date)) continue;

   $type=sanitize_key(wp_unslash($day_types[$index]??'event'));
   if(!in_array($type,['event','setup','teardown'],true)) $type='event';
   $ref=sanitize_text_field(wp_unslash($day_refs[$index]??('day-'.$index)));
   $day_id=absint($day_ids[$index]??0);

   $valid_existing=$day_id && in_array($day_id,$existing_ids,true);
   if($valid_existing){
    $ok=$wpdb->update($day_table,[
     'event_date'=>$date,
     'day_type'=>$type,
     'sort_order'=>$index,
     'updated_at'=>$now,
    ],['id'=>$day_id,'event_id'=>$eid]);
    if($ok===false){ $wpdb->query('ROLLBACK'); wp_die('Event-Tag konnte nicht gespeichert werden.'); }
   } else {
    $ok=$wpdb->insert($day_table,[
     'event_id'=>$eid,
     'event_date'=>$date,
     'day_type'=>$type,
     'sort_order'=>$index,
     'created_at'=>$now,
     'updated_at'=>$now,
    ]);
    if($ok===false){ $wpdb->query('ROLLBACK'); wp_die('Event-Tag konnte nicht angelegt werden.'); }
    $day_id=absint($wpdb->insert_id);
   }

   $kept_ids[]=$day_id;
   $ref_map[$ref]=$day_id;
   if(!isset($date_fallback[$date]) || $type==='event') $date_fallback[$date]=$day_id;
   $legacy_dates[$date]=true;
  }

  foreach($existing_ids as $old_id){
   if(!in_array($old_id,$kept_ids,true)) $wpdb->delete($day_table,['id'=>$old_id,'event_id'=>$eid]);
  }

  $legacy=array_keys($legacy_dates);
  sort($legacy);
  update_option('vtp_event_days_'.$eid,$legacy,false);

  $wpdb->delete($item_table,['event_id'=>$eid]);

  $titles=(array)($_POST['title']??[]);
  $refs=(array)($_POST['item_day_ref']??[]);
  $dates=(array)($_POST['item_date']??[]);
  $starts=(array)($_POST['start_time']??[]);
  $ends=(array)($_POST['end_time']??[]);
  $types=(array)($_POST['item_type']??[]);
  $visibilities=(array)($_POST['visibility']??[]);
  $sort_by_day=[];

  foreach($titles as $index=>$raw_title){
   $title=sanitize_text_field(wp_unslash($raw_title));
   if($title==='') continue;

   $ref=sanitize_text_field(wp_unslash($refs[$index]??''));
   $posted_date=sanitize_text_field(wp_unslash($dates[$index]??''));
   $day_id=absint($ref_map[$ref]??0);
   if(!$day_id && VTP_Plugin::is_valid_event_date($posted_date)) $day_id=absint($date_fallback[$posted_date]??0);
   if(!$day_id) continue;

   $day_date=(string)$wpdb->get_var($wpdb->prepare("SELECT event_date FROM $day_table WHERE id=%d AND event_id=%d",$day_id,$eid));
   if(!VTP_Plugin::is_valid_event_date($day_date)) continue;

   $item_type=sanitize_text_field(wp_unslash($types[$index]??'Programmpunkt'));
   if(!in_array($item_type,['Aufbau','Abbau','Programmpunkt','Musik','Spiel'],true)) $item_type='Programmpunkt';
   $visibility=sanitize_key(wp_unslash($visibilities[$index]??'public'));
   if(!in_array($visibility,['public','private','ticket','members'],true)) $visibility='public';
   $start=sanitize_text_field(wp_unslash($starts[$index]??''));
   $end=sanitize_text_field(wp_unslash($ends[$index]??''));
   $sort_by_day[$day_id]=($sort_by_day[$day_id]??0)+1;

   $ok=$wpdb->insert($item_table,[
    'event_id'=>$eid,
    'event_day_id'=>$day_id,
    'item_date'=>$day_date,
    'start_time'=>$start,
    'end_time'=>$end,
    'item_type'=>$item_type,
    'title'=>$title,
    'visibility'=>$visibility,
    'tournament_id'=>null,
    'sort_order'=>$sort_by_day[$day_id]-1,
   ]);
   if($ok===false){ $wpdb->query('ROLLBACK'); wp_die('Programmpunkt konnte nicht gespeichert werden.'); }
  }

  $wpdb->query('COMMIT');
  wp_safe_redirect(add_query_arg(['page'=>'vtp-events','edit_event'=>$eid,'saved'=>1],admin_url('admin.php')));
  exit;
 }

 public static function delete_event_days(){
  if(!current_user_can('manage_options')) return;
  $nonce=sanitize_text_field(wp_unslash($_REQUEST['_wpnonce']??''));
  if(!$nonce || !wp_verify_nonce($nonce,'vtp_delete_event')) return;
  $eid=absint($_POST['event_id']??0);
  if(!$eid) return;
  global $wpdb;
  $wpdb->delete(self::table(),['event_id'=>$eid]);
 }
}
