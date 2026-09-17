<?php
if (!defined('ABSPATH')) exit;

class VTP_Event_Program_Section {
 public static function init(){
  add_action('admin_enqueue_scripts',[__CLASS__,'assets']);
 }

 public static function assets($hook){
  if(($_GET['page']??'')!=='vtp-events') return;
  if(!absint($_GET['edit_event']??0)) return;

  wp_enqueue_style(
   'vtp-event-program-section',
   VTP_URL.'assets/event-program-section.css',
   ['vtp-event-edit','vtp-event-day-plan'],
   VTP_VERSION
  );
  wp_enqueue_script(
   'vtp-event-program-section',
   VTP_URL.'assets/event-program-section.js',
   ['vtp-event-edit','vtp-event-day-plan'],
   VTP_VERSION,
   true
  );
 }
}
