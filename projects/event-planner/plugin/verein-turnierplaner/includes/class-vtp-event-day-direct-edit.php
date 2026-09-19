<?php
if (!defined('ABSPATH')) exit;

class VTP_Event_Day_Direct_Edit {
 public static function init(){
  add_action('admin_enqueue_scripts',[__CLASS__,'assets'],100);
 }

 public static function assets(){
  if(($_GET['page']??'')!=='vtp-events') return;
  if(!absint($_GET['edit_event']??0)) return;

  wp_enqueue_script(
   'vtp-event-day-direct-edit',
   VTP_URL.'assets/event-day-direct-edit.js',
   ['vtp-event-day-plan','vtp-event-edit'],
   VTP_VERSION,
   true
  );
 }
}
