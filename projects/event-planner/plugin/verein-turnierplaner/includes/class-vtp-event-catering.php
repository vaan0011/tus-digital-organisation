<?php
if (!defined('ABSPATH')) exit;

class VTP_Event_Catering {
 const SCHEMA_VERSION='2';

 public static function init(){
  self::ensure_schema();
  add_action('admin_enqueue_scripts',[__CLASS__,'assets']);
  add_action('admin_post_vtp_save_event_catering',[__CLASS__,'save']);
 }

 private static function ensure_schema(){
  global $wpdb;
  $table=VTP_DB::table('event_catering_items');
  $version=(string)get_option('vtp_event_catering_schema');
  if($version===self::SCHEMA_VERSION){
   $cols=$wpdb->get_col("DESC $table",0);
   if($cols && in_array('assigned_group',$cols,true)) return;
  }

  require_once ABSPATH.'wp-admin/includes/upgrade.php';
  $c=$wpdb->get_charset_collate();
  dbDelta("CREATE TABLE $table (
   id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   event_id BIGINT UNSIGNED NOT NULL,
   category VARCHAR(20) NOT NULL,
   item_name VARCHAR(191) NOT NULL,
   quantity DECIMAL(10,2) NOT NULL DEFAULT 1.00,
   unit VARCHAR(40) NOT NULL,
   assigned_group VARCHAR(191) NULL,
   note VARCHAR(191) NULL,
   sort_order INT NOT NULL DEFAULT 0,
   PRIMARY KEY (id),
   KEY event_id (event_id),
   KEY category (category)
  ) $c;");
  update_option('vtp_event_catering_schema',self::SCHEMA_VERSION,false);
 }

 public static function assets($hook){
  if(($_GET['page']??'')!=='vtp-events') return;
  $event_id=absint($_GET['edit_event']??0);
  if(!$event_id) return;

  global $wpdb;
  $event_exists=(int)$wpdb->get_var($wpdb->prepare(
   'SELECT COUNT(*) FROM '.VTP_DB::table('events').' WHERE id=%d',$event_id
  ));
  if(!$event_exists) return;

  self::ensure_schema();
  $rows=$wpdb->get_results($wpdb->prepare(
   "SELECT id,category,item_name,quantity,unit,assigned_group,note,sort_order
    FROM ".VTP_DB::table('event_catering_items')."
    WHERE event_id=%d
    ORDER BY CASE category WHEN 'drink' THEN 0 WHEN 'food' THEN 1 ELSE 2 END,sort_order,id",
   $event_id
  ));

  $items=[];
  foreach($rows?:[] as $row){
   $quantity=rtrim(rtrim(number_format((float)$row->quantity,2,'.',''),'0'),'.');
   $category=in_array((string)$row->category,['drink','food','bring'],true)?(string)$row->category:'drink';
   $items[]=[
    'id'=>absint($row->id),
    'category'=>$category,
    'name'=>(string)$row->item_name,
    'quantity'=>$quantity,
    'unit'=>(string)$row->unit,
    'assignedGroup'=>(string)$row->assigned_group,
    'note'=>(string)$row->note,
   ];
  }

  wp_enqueue_style('vtp-event-catering',VTP_URL.'assets/event-catering.css',['vtp-event-shifts'],VTP_VERSION);
  wp_enqueue_script('vtp-event-catering',VTP_URL.'assets/event-catering.js',['vtp-event-shifts'],VTP_VERSION,true);
  wp_localize_script('vtp-event-catering','VTPEventCatering',[
   'eventId'=>$event_id,
   'actionUrl'=>admin_url('admin-post.php'),
   'nonce'=>wp_create_nonce('vtp_save_event_catering_'.$event_id),
   'items'=>$items,
  ]);
 }

 public static function save(){
  $event_id=absint($_POST['event_id']??0);
  if(!$event_id || !current_user_can('manage_options')) wp_die('Nicht erlaubt.');
  check_admin_referer('vtp_save_event_catering_'.$event_id);

  global $wpdb;
  self::ensure_schema();
  $events=VTP_DB::table('events');
  $table=VTP_DB::table('event_catering_items');
  $exists=(int)$wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $events WHERE id=%d",$event_id));
  if(!$exists) wp_die('Event nicht gefunden.');

  $categories=(array)($_POST['catering_category']??[]);
  $names=(array)($_POST['catering_item']??[]);
  $quantities=(array)($_POST['catering_quantity']??[]);
  $units=(array)($_POST['catering_unit']??[]);
  $groups=(array)($_POST['catering_assigned_group']??[]);
  $notes=(array)($_POST['catering_note']??[]);
  $validated=[];
  $sort=['drink'=>0,'food'=>0,'bring'=>0];

  foreach($names as $i=>$raw_name){
   $category=sanitize_key(wp_unslash($categories[$i]??''));
   $name=sanitize_text_field(wp_unslash($raw_name));
   $raw_quantity=str_replace(',','.',sanitize_text_field(wp_unslash($quantities[$i]??'')));
   $unit=sanitize_text_field(wp_unslash($units[$i]??''));
   $group=sanitize_text_field(wp_unslash($groups[$i]??''));
   $note=sanitize_text_field(wp_unslash($notes[$i]??''));

   if($name==='' && $raw_quantity==='' && $unit==='' && $group==='' && $note==='') continue;
   if(!in_array($category,['drink','food','bring'],true)) wp_die('Ungültige Bewirtungskategorie.');
   if($name==='') wp_die('Bitte für jeden Bewirtungseintrag einen Artikel angeben.');
   if(!is_numeric($raw_quantity) || (float)$raw_quantity<=0) wp_die('Bitte für jeden Bewirtungseintrag eine Menge größer 0 angeben.');
   if($unit==='') wp_die('Bitte für jeden Bewirtungseintrag eine Einheit angeben.');

   $validated[]=[
    'event_id'=>$event_id,
    'category'=>$category,
    'item_name'=>$name,
    'quantity'=>round((float)$raw_quantity,2),
    'unit'=>$unit,
    'assigned_group'=>$category==='bring' && $group!==''?$group:null,
    'note'=>$note?:null,
    'sort_order'=>$sort[$category]++,
   ];
  }

  $wpdb->delete($table,['event_id'=>$event_id]);
  foreach($validated as $row) $wpdb->insert($table,$row);

  $url=add_query_arg(['page'=>'vtp-events','edit_event'=>$event_id,'catering_saved'=>1],admin_url('admin.php'));
  wp_safe_redirect($url.'#vtp-event-catering');
  exit;
 }
}
