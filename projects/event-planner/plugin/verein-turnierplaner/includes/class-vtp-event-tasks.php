<?php
if (!defined('ABSPATH')) exit;

class VTP_Event_Tasks {
 const SCHEMA_VERSION='1.0';

 public static function init(){
  self::maybe_schema();
  add_action('admin_enqueue_scripts',[__CLASS__,'assets']);
  add_action('admin_post_vtp_save_event_tasks',[__CLASS__,'save']);
 }

 private static function maybe_schema(){
  if(get_option('vtp_event_tasks_schema_version')===self::SCHEMA_VERSION) return;
  global $wpdb;
  require_once ABSPATH.'wp-admin/includes/upgrade.php';
  $c=$wpdb->get_charset_collate();
  dbDelta("CREATE TABLE ".VTP_DB::table('event_tasks')." (
   id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   event_id BIGINT UNSIGNED NOT NULL,
   title VARCHAR(191) NOT NULL,
   category VARCHAR(120) NULL,
   due_date DATE NULL,
   responsible VARCHAR(191) NULL,
   status VARCHAR(30) NOT NULL DEFAULT 'open',
   source VARCHAR(30) NOT NULL DEFAULT 'manual',
   sort_order INT NOT NULL DEFAULT 0,
   created_at DATETIME NOT NULL,
   updated_at DATETIME NOT NULL,
   PRIMARY KEY (id),
   KEY event_id (event_id),
   KEY due_date (due_date),
   KEY status (status)
  ) $c;");
  update_option('vtp_event_tasks_schema_version',self::SCHEMA_VERSION);
 }

 public static function assets($hook){
  if(($_GET['page']??'')!=='vtp-events') return;
  $event_id=absint($_GET['edit_event']??0);
  if(!$event_id) return;

  global $wpdb;
  $event=$wpdb->get_row($wpdb->prepare('SELECT id,start_date FROM '.VTP_DB::table('events').' WHERE id=%d',$event_id));
  if(!$event) return;

  $rows=$wpdb->get_results($wpdb->prepare(
   "SELECT id,title,category,due_date,responsible,status,source,sort_order
    FROM ".VTP_DB::table('event_tasks')."
    WHERE event_id=%d
    ORDER BY CASE WHEN status='done' THEN 1 ELSE 0 END,
             CASE WHEN due_date IS NULL THEN 1 ELSE 0 END,
             due_date,sort_order,id",
   $event_id
  ));

  $tasks=[];
  $done=0;
  foreach($rows?:[] as $row){
   $is_done=((string)$row->status==='done');
   if($is_done) $done++;
   $tasks[]=[
    'id'=>absint($row->id),
    'title'=>(string)$row->title,
    'category'=>(string)$row->category,
    'dueDate'=>(string)$row->due_date,
    'responsible'=>(string)$row->responsible,
    'done'=>$is_done,
    'source'=>(string)($row->source?:'manual'),
   ];
  }

  wp_enqueue_style('vtp-event-tasks',VTP_URL.'assets/event-tasks.css',['vtp-event-edit'],VTP_VERSION);
  wp_enqueue_script('vtp-event-tasks',VTP_URL.'assets/event-tasks.js',['vtp-event-edit'],VTP_VERSION,true);
  wp_localize_script('vtp-event-tasks','VTPEventTasks',[
   'eventId'=>$event_id,
   'eventStart'=>(string)$event->start_date,
   'actionUrl'=>admin_url('admin-post.php'),
   'nonce'=>wp_create_nonce('vtp_save_event_tasks_'.$event_id),
   'tasks'=>$tasks,
   'total'=>count($tasks),
   'done'=>$done,
  ]);
 }

 public static function save(){
  $event_id=absint($_POST['event_id']??0);
  if(!$event_id || !current_user_can('manage_options')) wp_die('Nicht erlaubt.');
  check_admin_referer('vtp_save_event_tasks_'.$event_id);

  global $wpdb;
  $events=VTP_DB::table('events');
  $table=VTP_DB::table('event_tasks');
  $exists=(int)$wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $events WHERE id=%d",$event_id));
  if(!$exists) wp_die('Event nicht gefunden.');

  $existing=array_map('absint',$wpdb->get_col($wpdb->prepare("SELECT id FROM $table WHERE event_id=%d",$event_id))?:[]);
  $ids=(array)($_POST['task_id']??[]);
  $titles=(array)($_POST['task_title']??[]);
  $categories=(array)($_POST['task_category']??[]);
  $due_dates=(array)($_POST['task_due_date']??[]);
  $responsible=(array)($_POST['task_responsible']??[]);
  $done=(array)($_POST['task_done']??[]);
  $sources=(array)($_POST['task_source']??[]);
  $kept=[];
  $now=current_time('mysql');

  foreach($titles as $i=>$raw_title){
   $title=sanitize_text_field(wp_unslash($raw_title));
   if($title==='') continue;

   $id=absint($ids[$i]??0);
   $category=sanitize_text_field(wp_unslash($categories[$i]??''));
   $due=sanitize_text_field(wp_unslash($due_dates[$i]??''));
   if($due!=='' && !VTP_Plugin::is_valid_event_date($due)) $due='';
   $owner=sanitize_text_field(wp_unslash($responsible[$i]??''));
   $status=!empty($done[$i])?'done':'open';
   $source=sanitize_key(wp_unslash($sources[$i]??'manual'));
   if(!in_array($source,['manual','template'],true)) $source='manual';

   $data=[
    'event_id'=>$event_id,
    'title'=>$title,
    'category'=>$category?:null,
    'due_date'=>$due?:null,
    'responsible'=>$owner?:null,
    'status'=>$status,
    'source'=>$source,
    'sort_order'=>intval($i),
    'updated_at'=>$now,
   ];

   if($id && in_array($id,$existing,true)){
    $wpdb->update($table,$data,['id'=>$id,'event_id'=>$event_id]);
    $kept[]=$id;
   } else {
    $data['created_at']=$now;
    $wpdb->insert($table,$data);
    if($wpdb->insert_id) $kept[]=absint($wpdb->insert_id);
   }
  }

  $remove=array_values(array_diff($existing,$kept));
  if($remove){
   $safe=implode(',',array_map('absint',$remove));
   $wpdb->query("DELETE FROM $table WHERE event_id=".absint($event_id)." AND id IN ($safe)");
  }

  $url=add_query_arg(['page'=>'vtp-events','edit_event'=>$event_id,'tasks_saved'=>1],admin_url('admin.php'));
  wp_safe_redirect($url.'#vtp-event-tasks');
  exit;
 }
}
