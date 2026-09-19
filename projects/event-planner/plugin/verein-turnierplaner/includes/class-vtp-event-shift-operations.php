<?php
if (!defined('ABSPATH')) exit;

class VTP_Event_Shift_Operations {
 public static function init(){
  add_action('admin_enqueue_scripts',[__CLASS__,'assets']);
 }

 public static function assets($hook){
  if(($_GET['page']??'')!=='vtp-events') return;
  if(!absint($_GET['edit_event']??0)) return;

  wp_enqueue_script(
   'vtp-event-shift-operations',
   VTP_URL.'assets/event-shift-operations.js',
   ['vtp-event-shifts'],
   VTP_VERSION,
   true
  );
 }
}
