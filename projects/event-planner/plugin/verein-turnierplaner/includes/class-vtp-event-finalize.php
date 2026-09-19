<?php
if (!defined('ABSPATH')) exit;

class VTP_Event_Finalize {
 const SCHEMA_VERSION='1';

 public static function init(){
  self::ensure_schema();
  add_action('admin_enqueue_scripts',[__CLASS__,'assets']);
  add_action('admin_post_vtp_save_event_template',[__CLASS__,'save_template']);
 }

 private static function table(){ return VTP_DB::table('event_templates'); }

 private static function ensure_schema(){
  global $wpdb;
  require_once ABSPATH.'wp-admin/includes/upgrade.php';
  $c=$wpdb->get_charset_collate();
  $table=self::table();

  dbDelta("CREATE TABLE $table (
   id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   name VARCHAR(191) NOT NULL,
   source_event_id BIGINT UNSIGNED NULL,
   template_data LONGTEXT NOT NULL,
   created_at DATETIME NOT NULL,
   updated_at DATETIME NOT NULL,
   PRIMARY KEY (id),
   UNIQUE KEY source_event_id (source_event_id),
   KEY name (name)
  ) $c;");
  update_option('vtp_event_template_schema',self::SCHEMA_VERSION,false);
 }

 public static function assets($hook){
  if(($_GET['page']??'')!=='vtp-events') return;

  wp_enqueue_style('vtp-event-finalize',VTP_URL.'assets/event-finalize.css',['vtp-event-edit'],VTP_VERSION);
  wp_enqueue_script('vtp-event-finalize',VTP_URL.'assets/event-finalize.js',['vtp-event-edit'],VTP_VERSION,true);

  $event_id=absint($_GET['edit_event']??0);
  $view=sanitize_key($_GET['view']??'');
  $data=['mode'=>'none'];

  if($event_id){
   global $wpdb;
   $event=$wpdb->get_row($wpdb->prepare(
    'SELECT id,name FROM '.VTP_DB::table('events').' WHERE id=%d',
    $event_id
   ));
   if($event){
    $data=[
     'mode'=>'edit',
     'eventId'=>$event_id,
     'eventName'=>(string)$event->name,
     'actionUrl'=>admin_url('admin-post.php'),
     'nonce'=>wp_create_nonce('vtp_save_event_template_'.$event_id),
     'templateSaved'=>!empty($_GET['template_saved']),
    ];
   }
  } elseif($view==='templates'){
   $data=[
    'mode'=>'library',
    'templates'=>self::template_library(),
   ];
  }

  wp_localize_script('vtp-event-finalize','VTPEventFinalize',$data);
 }

 private static function valid_date($date){
  if(!preg_match('/^\d{4}-\d{2}-\d{2}$/',(string)$date)) return false;
  [$y,$m,$d]=array_map('intval',explode('-',(string)$date));
  return checkdate($m,$d,$y);
 }

 private static function offset_days($date,$base){
  if(!self::valid_date($date) || !self::valid_date($base)) return null;
  $a=strtotime($base.' 00:00:00');
  $b=strtotime($date.' 00:00:00');
  return (int)round(($b-$a)/DAY_IN_SECONDS);
 }

 private static function build_snapshot($event){
  global $wpdb;
  $event_id=absint($event->id);
  $base=(string)$event->start_date;
  if(!self::valid_date($base)) return new WP_Error('template_date','Für eine Vorlage benötigt das Event ein gültiges Startdatum.');

  $days=[];
  $day_rows=$wpdb->get_results($wpdb->prepare(
   "SELECT event_date,day_type,day_time,sort_order
    FROM ".VTP_DB::table('event_days')."
    WHERE event_id=%d
    ORDER BY event_date,
      CASE day_type WHEN 'setup' THEN 0 WHEN 'event' THEN 1 ELSE 2 END,
      sort_order,id",
   $event_id
  ));
  foreach($day_rows?:[] as $row){
   if(!self::valid_date((string)$row->event_date)) continue;
   $type=in_array($row->day_type,['event','setup','teardown'],true)?(string)$row->day_type:'event';
   $days[]=[
    'type'=>$type,
    'offset_days'=>self::offset_days((string)$row->event_date,$base),
    'time'=>in_array($type,['setup','teardown'],true)?substr((string)$row->day_time,0,5):'',
    'sort_order'=>(int)$row->sort_order,
   ];
  }

  $tasks=[];
  $task_table=VTP_DB::table('event_tasks');
  if($wpdb->get_var($wpdb->prepare('SHOW TABLES LIKE %s',$task_table))===$task_table){
   $task_rows=$wpdb->get_results($wpdb->prepare(
    "SELECT title,category,due_date,responsible,sort_order
     FROM $task_table
     WHERE event_id=%d
     ORDER BY sort_order,id",
    $event_id
   ));
   foreach($task_rows?:[] as $row){
    $tasks[]=[
     'title'=>(string)$row->title,
     'category'=>(string)$row->category,
     'due_offset_days'=>self::valid_date((string)$row->due_date)?self::offset_days((string)$row->due_date,$base):null,
     'responsible'=>(string)$row->responsible,
     'sort_order'=>(int)$row->sort_order,
    ];
   }
  }

  $shifts=[];
  $shift_table=VTP_DB::table('shifts');
  $shift_cols=$wpdb->get_col("DESC $shift_table",0)?:[];
  $source_filter=in_array('source_type',$shift_cols,true)?"AND (source_type IS NULL OR source_type='' OR source_type<>'event_day_operation')":'';
  $shift_rows=$wpdb->get_results($wpdb->prepare(
   "SELECT area_name,shift_date,start_time,end_time,slots_needed,assigned_group
    FROM $shift_table
    WHERE event_id=%d $source_filter
    ORDER BY shift_date,start_time,area_name,id",
   $event_id
  ));
  foreach($shift_rows?:[] as $row){
   if(!self::valid_date((string)$row->shift_date)) continue;
   $shifts[]=[
    'area'=>(string)$row->area_name,
    'offset_days'=>self::offset_days((string)$row->shift_date,$base),
    'start'=>substr((string)$row->start_time,0,5),
    'end'=>substr((string)$row->end_time,0,5),
    'slots'=>max(1,absint($row->slots_needed)),
    'group'=>(string)$row->assigned_group,
   ];
  }

  $catering=[];
  $catering_table=VTP_DB::table('event_catering_items');
  if($wpdb->get_var($wpdb->prepare('SHOW TABLES LIKE %s',$catering_table))===$catering_table){
   $catering_rows=$wpdb->get_results($wpdb->prepare(
    "SELECT category,item_name,quantity,unit,note,sort_order
     FROM $catering_table
     WHERE event_id=%d
     ORDER BY CASE category WHEN 'drink' THEN 0 ELSE 1 END,sort_order,id",
    $event_id
   ));
   foreach($catering_rows?:[] as $row){
    $catering[]=[
     'category'=>$row->category==='food'?'food':'drink',
     'item'=>(string)$row->item_name,
     'quantity'=>(float)$row->quantity,
     'unit'=>(string)$row->unit,
     'note'=>(string)$row->note,
     'sort_order'=>(int)$row->sort_order,
    ];
   }
  }

  return [
   'schema'=>1,
   'event_name'=>(string)$event->name,
   'days'=>$days,
   'tasks'=>$tasks,
   'shifts'=>$shifts,
   'catering'=>$catering,
  ];
 }

 public static function save_template(){
  $event_id=absint($_POST['event_id']??0);
  if(!$event_id || !current_user_can('manage_options')) wp_die('Nicht erlaubt.');
  check_admin_referer('vtp_save_event_template_'.$event_id);

  global $wpdb;
  self::ensure_schema();
  $event=$wpdb->get_row($wpdb->prepare(
   'SELECT id,name,start_date FROM '.VTP_DB::table('events').' WHERE id=%d',
   $event_id
  ));
  if(!$event) wp_die('Event nicht gefunden.');

  $snapshot=self::build_snapshot($event);
  if(is_wp_error($snapshot)) wp_die(esc_html($snapshot->get_error_message()));

  $payload=wp_json_encode($snapshot,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
  if(!$payload) wp_die('Vorlage konnte nicht erzeugt werden.');

  $table=self::table();
  $now=current_time('mysql');
  $existing=absint($wpdb->get_var($wpdb->prepare(
   "SELECT id FROM $table WHERE source_event_id=%d",
   $event_id
  )));
  $data=[
   'name'=>(string)$event->name,
   'source_event_id'=>$event_id,
   'template_data'=>$payload,
   'updated_at'=>$now,
  ];

  if($existing){
   $ok=$wpdb->update($table,$data,['id'=>$existing]);
  } else {
   $data['created_at']=$now;
   $ok=$wpdb->insert($table,$data);
  }
  if($ok===false) wp_die('Vorlage konnte nicht gespeichert werden.');

  $url=add_query_arg([
   'page'=>'vtp-events',
   'edit_event'=>$event_id,
   'template_saved'=>1,
  ],admin_url('admin.php'));
  wp_safe_redirect($url.'#vtp-event-finalize');
  exit;
 }

 private static function template_library(){
  global $wpdb;
  self::ensure_schema();
  $rows=$wpdb->get_results(
   'SELECT id,name,template_data,updated_at FROM '.self::table().' ORDER BY name,id'
  );
  $items=[];
  foreach($rows?:[] as $row){
   $data=json_decode((string)$row->template_data,true);
   if(!is_array($data)) $data=[];
   $items[]=[
    'id'=>absint($row->id),
    'name'=>(string)$row->name,
    'days'=>count((array)($data['days']??[])),
    'tasks'=>count((array)($data['tasks']??[])),
    'shifts'=>count((array)($data['shifts']??[])),
    'catering'=>count((array)($data['catering']??[])),
    'updated'=>mysql2date('d.m.Y H:i',(string)$row->updated_at),
   ];
  }
  return $items;
 }
}
