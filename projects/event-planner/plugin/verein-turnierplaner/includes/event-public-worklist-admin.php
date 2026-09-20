<?php
if (!defined('ABSPATH')) exit;

add_action('admin_enqueue_scripts',function($hook){
 if(($_GET['page']??'')!=='vtp-events' || !absint($_GET['edit_event']??0)) return;
 wp_enqueue_style('vtp-event-public-worklists-admin',VTP_URL.'assets/event-public-worklists-admin.css',['vtp-event-edit'],VTP_VERSION);
 wp_enqueue_script('vtp-event-public-worklists-admin',VTP_URL.'assets/event-public-worklists-admin.js',['vtp-event-edit'],VTP_VERSION,true);
});
