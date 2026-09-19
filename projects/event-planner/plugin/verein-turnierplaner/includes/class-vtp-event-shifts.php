<?php
if (!defined('ABSPATH')) exit;

class VTP_Event_Shifts {
 public static function init(){
  add_action('admin_enqueue_scripts',[__CLASS__,'assets']);
  add_action('admin_post_vtp_save_event_shifts',[__CLASS__,'save']);
 }

 public static function assets($hook){
  if(($_GET['page']??'')!=='vtp-events') return;
  $event_id=absint($_GET['edit_event']??0);
  if(!$event_id) return;

  global $wpdb;
  $event=$wpdb->get_row($wpdb->prepare(
   'SELECT id,start_date,end_date FROM '.VTP_DB::table('events').' WHERE id=%d',
   $event_id
  ));
  if(!$event) return;

  $rows=$wpdb->get_results($wpdb->prepare(
   "SELECT s.id,s.area_name,s.shift_date,s.start_time,s.end_time,s.slots_needed,s.assigned_group,COUNT(g.id) signups
    FROM ".VTP_DB::table('shifts')." s
    LEFT JOIN ".VTP_DB::table('shift_signups')." g ON g.shift_id=s.id
    WHERE s.event_id=%d
    GROUP BY s.id,s.area_name,s.shift_date,s.start_time,s.end_time,s.slots_needed,s.assigned_group
    ORDER BY s.shift_date,s.start_time,s.end_time,s.area_name,s.id",
   $event_id
  ));

  $shifts=[];
  foreach($rows?:[] as $row){
   $shifts[]=[
    'id'=>absint($row->id),
    'area'=>(string)$row->area_name,
    'date'=>(string)$row->shift_date,
    'start'=>substr((string)$row->start_time,0,5),
    'end'=>substr((string)$row->end_time,0,5),
    'slots'=>max(1,absint($row->slots_needed)),
    'group'=>(string)$row->assigned_group,
    'signups'=>max(0,absint($row->signups)),
   ];
  }

  // Pro Eventtag den realen Programmzeitraum als Default für die Schichtserie ermitteln.
  // Aufbau/Abbau sind keine Programmpunkte und fließen deshalb bewusst nicht ein.
  $items=VTP_DB::table('event_items');
  $days=VTP_DB::table('event_days');
  $program_rows=$wpdb->get_results($wpdb->prepare(
   "SELECT i.item_date,i.start_time,i.end_time
    FROM $items i
    LEFT JOIN $days d ON d.id=i.event_day_id
    WHERE i.event_id=%d
      AND i.item_date IS NOT NULL
      AND i.item_date<>''
      AND COALESCE(i.item_type,'') NOT IN ('Aufbau','Abbau')
      AND (d.id IS NULL OR d.day_type='event')
    ORDER BY i.item_date,i.start_time,i.sort_order,i.id",
   $event_id
  ));

  $window_minutes=[];
  foreach($program_rows?:[] as $item){
   $date=(string)$item->item_date;
   $start=substr((string)$item->start_time,0,5);
   $end=substr((string)$item->end_time,0,5);
   if(!VTP_Plugin::is_valid_event_date($date) || !self::valid_time($start)) continue;

   $start_minutes=self::time_minutes($start);
   if(!isset($window_minutes[$date])){
    $window_minutes[$date]=['start'=>$start_minutes,'end'=>null];
   } else {
    $window_minutes[$date]['start']=min($window_minutes[$date]['start'],$start_minutes);
   }

   if(self::valid_time($end)){
    $end_minutes=self::time_minutes($end);
    if($end_minutes<$start_minutes) $end_minutes+=DAY_IN_SECONDS/60;
    if($end_minutes>$start_minutes){
     if($window_minutes[$date]['end']===null || $end_minutes>$window_minutes[$date]['end']){
      $window_minutes[$date]['end']=$end_minutes;
     }
    }
   }
  }

  $program_windows=[];
  foreach($window_minutes as $date=>$window){
   if($window['end']===null) continue;
   $start_minutes=(int)$window['start'];
   $end_minutes=(int)$window['end'];
   $program_windows[$date]=[
    'start'=>sprintf('%02d:%02d',intdiv($start_minutes,60)%24,$start_minutes%60),
    'end'=>sprintf('%02d:%02d',intdiv($end_minutes,60)%24,$end_minutes%60),
    'endNextDay'=>$end_minutes>=1440,
   ];
  }

  wp_enqueue_style('vtp-event-shifts',VTP_URL.'assets/event-shifts.css',['vtp-event-tasks'],VTP_VERSION);
  wp_enqueue_script('vtp-event-shifts',VTP_URL.'assets/event-shifts.js',['vtp-event-tasks'],VTP_VERSION,true);
  wp_localize_script('vtp-event-shifts','VTPEventShifts',[
   'eventId'=>$event_id,
   'eventStart'=>(string)$event->start_date,
   'eventEnd'=>(string)($event->end_date?:$event->start_date),
   'actionUrl'=>admin_url('admin-post.php'),
   'nonce'=>wp_create_nonce('vtp_save_event_shifts_'.$event_id),
   'shifts'=>$shifts,
   'programWindows'=>$program_windows,
  ]);
 }

 private static function valid_time($time){
  if(!preg_match('/^(?:[01]\d|2[0-3]):[0-5]\d$/',(string)$time)) return false;
  return true;
 }

 private static function time_minutes($time){
  [$h,$m]=array_map('intval',explode(':',(string)$time));
  return $h*60+$m;
 }

 public static function save(){
  $event_id=absint($_POST['event_id']??0);
  if(!$event_id || !current_user_can('manage_options')) wp_die('Nicht erlaubt.');
  check_admin_referer('vtp_save_event_shifts_'.$event_id);

  global $wpdb;
  $events=VTP_DB::table('events');
  $table=VTP_DB::table('shifts');
  $signups=VTP_DB::table('shift_signups');
  $exists=(int)$wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $events WHERE id=%d",$event_id));
  if(!$exists) wp_die('Event nicht gefunden.');

  $existing=array_map('absint',$wpdb->get_col($wpdb->prepare("SELECT id FROM $table WHERE event_id=%d",$event_id))?:[]);
  $ids=(array)($_POST['shift_id']??[]);
  $areas=(array)($_POST['shift_area']??[]);
  $dates=(array)($_POST['shift_date']??[]);
  $starts=(array)($_POST['shift_start']??[]);
  $ends=(array)($_POST['shift_end']??[]);
  $slots=(array)($_POST['shift_slots']??[]);
  $groups=(array)($_POST['shift_group']??[]);
  $validated=[];

  foreach($areas as $i=>$raw_area){
   $id=absint($ids[$i]??0);
   $area=sanitize_text_field(wp_unslash($raw_area));
   $date=sanitize_text_field(wp_unslash($dates[$i]??''));
   $start=sanitize_text_field(wp_unslash($starts[$i]??''));
   $end=sanitize_text_field(wp_unslash($ends[$i]??''));
   $needed=max(1,absint($slots[$i]??1));
   $group=sanitize_text_field(wp_unslash($groups[$i]??''));

   $completely_empty=($id===0 && $area==='' && $date==='' && $start==='' && $end==='');
   if($completely_empty) continue;

   if($id && !in_array($id,$existing,true)) wp_die('Ungültige Helferschicht.');
   if($area==='') wp_die('Bitte für jede Helferschicht einen Bereich oder eine Aufgabe angeben.');
   if(!VTP_Plugin::is_valid_event_date($date)) wp_die('Bitte für jede Helferschicht ein gültiges Datum angeben.');
   if(!self::valid_time($start) || !self::valid_time($end)) wp_die('Bitte für jede Helferschicht gültige Start- und Endzeiten angeben.');
   // Eine kleinere Endzeit bedeutet bewusst: Ende am Folgetag, z. B. 22:00–02:00.
   // Gleiche Start-/Endzeit bleibt ungültig, damit nicht versehentlich eine 24h-Schicht entsteht.
   if(self::time_minutes($end)===self::time_minutes($start)) wp_die('Start- und Endzeit einer Helferschicht dürfen nicht identisch sein.');

   $validated[]=[
    'id'=>$id,
    'area_name'=>$area,
    'shift_date'=>$date,
    'start_time'=>$start,
    'end_time'=>$end,
    'slots_needed'=>$needed,
    'assigned_group'=>$group?:null,
   ];
  }

  $kept=[];
  foreach($validated as $row){
   $id=$row['id'];
   $data=$row;
   unset($data['id']);
   if($id){
    $wpdb->update($table,$data,['id'=>$id,'event_id'=>$event_id]);
    $kept[]=$id;
   } else {
    $data['event_id']=$event_id;
    $wpdb->insert($table,$data);
    if($wpdb->insert_id) $kept[]=absint($wpdb->insert_id);
   }
  }

  $remove=array_values(array_diff($existing,$kept));
  if($remove){
   $safe=implode(',',array_map('absint',$remove));
   $wpdb->query("DELETE FROM $signups WHERE shift_id IN ($safe)");
   $wpdb->query("DELETE FROM $table WHERE event_id=".absint($event_id)." AND id IN ($safe)");
  }

  $url=add_query_arg(['page'=>'vtp-events','edit_event'=>$event_id,'shifts_saved'=>1],admin_url('admin.php'));
  wp_safe_redirect($url.'#vtp-event-shifts');
  exit;
 }
}
