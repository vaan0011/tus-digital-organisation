<?php
if (!defined('ABSPATH')) exit;

class VTP_Event_Linked_Tournaments {
 public static function init(){
  add_action('admin_enqueue_scripts',[__CLASS__,'assets']);
 }

 public static function assets($hook){
  if(($_GET['page']??'')!=='vtp-events') return;
  $event_id=absint($_GET['edit_event']??0);
  if(!$event_id) return;

  global $wpdb;
  $event=$wpdb->get_row($wpdb->prepare(
   'SELECT id,name FROM '.VTP_DB::table('events').' WHERE id=%d',
   $event_id
  ));
  if(!$event) return;

  $rows=$wpdb->get_results($wpdb->prepare(
   "SELECT id,name,start_date,start_time,event_type
    FROM ".VTP_DB::table('tournaments')."
    WHERE (event_id=%d OR parent_event=%s)
      AND COALESCE(status,'')<>'archiviert'
    ORDER BY start_date,start_time,name",
   $event_id,
   $event->name
  ));

  $types=[
   'jugendturnier'=>'Jugendturnier',
   'hallenturnier'=>'Hallenturnier',
   'elfmeterschiessen'=>'11m-Schießen',
   'neunmeterschiessen'=>'9m-Schießen',
   'einlagenspiel'=>'Einlagenspiel',
   'ah_turnier'=>'AH-Turnier',
   'blitzturnier'=>'Blitzturnier',
   'turnier'=>'Turnier',
  ];

  $items=[];
  foreach($rows?:[] as $row){
   $type_key=(string)($row->event_type??'turnier');
   $items[]=[
    'id'=>absint($row->id),
    'name'=>(string)$row->name,
    'type'=>$types[$type_key]??'Turnier',
    'date'=>$row->start_date ? date_i18n('d.m.Y',strtotime($row->start_date)) : '',
    'time'=>$row->start_time ? substr((string)$row->start_time,0,5) : '',
    'url'=>admin_url('admin.php?page=vtp&edit='.absint($row->id)),
   ];
  }

  wp_enqueue_style(
   'vtp-event-linked-tournaments',
   VTP_URL.'assets/event-linked-tournaments.css',
   ['vtp-event-edit'],
   VTP_VERSION
  );
  wp_enqueue_script(
   'vtp-event-linked-tournaments',
   VTP_URL.'assets/event-linked-tournaments.js',
   ['vtp-event-edit'],
   VTP_VERSION,
   true
  );
  wp_localize_script('vtp-event-linked-tournaments','VTPEventLinkedTournaments',[
   'manageUrl'=>admin_url('admin.php?page=vtp&view=active'),
   'items'=>$items,
  ]);
 }
}
