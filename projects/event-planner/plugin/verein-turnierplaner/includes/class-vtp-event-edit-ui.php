<?php
if (!defined('ABSPATH')) exit;

class VTP_Event_Edit_UI {
 public static function init(){
  add_action('admin_enqueue_scripts',[__CLASS__,'assets']);
 }

 public static function assets($hook){
  if(($_GET['page']??'')!=='vtp-events') return;
  $event_id=absint($_GET['edit_event']??0);
  if(!$event_id) return;

  global $wpdb;
  $event=$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('events').' WHERE id=%d',$event_id));
  if(!$event) return;

  wp_enqueue_style('vtp-event-edit',VTP_URL.'assets/event-edit.css',['vtp-admin','vtp-event-create'],VTP_VERSION);
  wp_enqueue_script('vtp-event-edit',VTP_URL.'assets/event-edit.js',['vtp-event-create'],VTP_VERSION,true);

  $items_table=VTP_DB::table('event_items');
  $days_table=VTP_DB::table('event_days');
  $shifts_table=VTP_DB::table('shifts');
  $signups_table=VTP_DB::table('shift_signups');
  $tournaments_table=VTP_DB::table('tournaments');
  $sponsors_table=VTP_DB::table('event_sponsors');

  $program_count=(int)$wpdb->get_var($wpdb->prepare(
   "SELECT COUNT(*)
    FROM $items_table i
    LEFT JOIN $days_table d ON d.id=i.event_day_id
    WHERE i.event_id=%d
      AND COALESCE(i.item_type,'') NOT IN ('Aufbau','Abbau')
      AND (d.id IS NULL OR d.day_type='event')",
   $event_id
  ));
  $public_program_count=(int)$wpdb->get_var($wpdb->prepare(
   "SELECT COUNT(*)
    FROM $items_table i
    LEFT JOIN $days_table d ON d.id=i.event_day_id
    WHERE i.event_id=%d
      AND COALESCE(i.visibility,'public')='public'
      AND COALESCE(i.item_type,'') NOT IN ('Aufbau','Abbau')
      AND (d.id IS NULL OR d.day_type='event')",
   $event_id
  ));

  $shift_rows=$wpdb->get_results($wpdb->prepare(
   "SELECT s.id,s.slots_needed,COUNT(g.id) signups
    FROM $shifts_table s
    LEFT JOIN $signups_table g ON g.shift_id=s.id
    WHERE s.event_id=%d
    GROUP BY s.id,s.slots_needed
    ORDER BY s.shift_date,s.start_time,s.id",
   $event_id
  ));

  $shift_count=count($shift_rows?:[]);
  $full_shift_count=0;
  $slots_needed=0;
  $slots_filled=0;
  foreach($shift_rows?:[] as $shift){
   $needed=max(0,absint($shift->slots_needed));
   $filled=max(0,absint($shift->signups));
   $slots_needed += $needed;
   $slots_filled += min($filled,$needed ?: $filled);
   if($needed>0 && $filled >= $needed) $full_shift_count++;
  }

  $linked_tournaments=$wpdb->get_results($wpdb->prepare(
   "SELECT id,name,start_date,start_time,event_type
    FROM $tournaments_table
    WHERE (event_id=%d OR parent_event=%s)
      AND COALESCE(status,'')<>'archiviert'
    ORDER BY start_date,start_time,name",
   $event_id,
   $event->name
  ));

  $sponsor_rows=$wpdb->get_results($wpdb->prepare(
   "SELECT name,logo_attachment_id,homepage_url
    FROM $sponsors_table
    WHERE event_id=%d
    ORDER BY sort_order,id",
   $event_id
  ));

  $day_count=(int)$wpdb->get_var($wpdb->prepare(
   "SELECT COUNT(*) FROM $days_table WHERE event_id=%d AND day_type='event'",
   $event_id
  ));

  if($day_count===0 && VTP_Plugin::is_valid_event_date((string)$event->start_date)){
   $start=strtotime($event->start_date.' 00:00:00');
   $end=VTP_Plugin::is_valid_event_date((string)$event->end_date)?strtotime($event->end_date.' 00:00:00'):$start;
   if($end<$start) $end=$start;
   $day_count=(int)floor(($end-$start)/DAY_IN_SECONDS)+1;
  }
  if($day_count===0) $day_count=1;

  $date_label='Datum offen';
  if(VTP_Plugin::is_valid_event_date((string)$event->start_date)){
   $date_label=date_i18n('d.m.Y',strtotime($event->start_date));
   if(VTP_Plugin::is_valid_event_date((string)$event->end_date) && $event->end_date!==$event->start_date){
    $date_label.=' – '.date_i18n('d.m.Y',strtotime($event->end_date));
   }
  }

  $linked=[];
  foreach($linked_tournaments?:[] as $t){
   $linked[]=[
    'name'=>(string)$t->name,
    'date'=>$t->start_date ? date_i18n('d.m.Y',strtotime($t->start_date)) : '',
    'time'=>$t->start_time ? substr((string)$t->start_time,0,5) : '',
   ];
  }

  $sponsors=[];
  foreach($sponsor_rows?:[] as $sponsor){
   $logo_id=absint($sponsor->logo_attachment_id);
   $label='';
   if($logo_id){
    $label=(string)get_the_title($logo_id);
    if($label===''){
     $file=get_attached_file($logo_id);
     if($file) $label=basename($file);
    }
   }
   $sponsors[]=[
    'name'=>(string)$sponsor->name,
    'logoId'=>$logo_id,
    'logoLabel'=>$label ?: ($logo_id ? 'Logo ausgewählt' : 'Logo auswählen'),
    'url'=>(string)$sponsor->homepage_url,
   ];
  }

  wp_localize_script('vtp-event-edit','VTPEventEdit',[
   'event'=>[
    'id'=>$event_id,
    'name'=>(string)$event->name,
    'dateLabel'=>$date_label,
    'location'=>(string)($event->location?:'Ort offen'),
    'publicUrl'=>VTP_Public::event_url($event),
    'tasksUrl'=>VTP_Event_Public_Worklists::tasks_url($event),
    'teamworkUrl'=>VTP_Event_Public_Worklists::teamwork_url($event),
   ],
   'navigation'=>[
    'new'=>admin_url('admin.php?page=vtp-events&view=new'),
    'overview'=>admin_url('admin.php?page=vtp-events&view=active'),
    'templates'=>admin_url('admin.php?page=vtp-events&view=templates'),
    'archive'=>admin_url('admin.php?page=vtp-events&view=archive'),
   ],
   'linkedTournaments'=>$linked,
   'sponsors'=>$sponsors,
   'progress'=>[
    'days'=>$day_count,
    'programCount'=>$program_count,
    'programPublished'=>($public_program_count>0 && absint($event->public_page_id)>0),
    'tasksDone'=>0,
    'tasksTotal'=>0,
    'tasksAvailable'=>false,
    'shiftsFull'=>$full_shift_count,
    'shiftsTotal'=>$shift_count,
    'helpersFilled'=>$slots_filled,
    'helpersNeeded'=>$slots_needed,
   ],
  ]);
 }
}
