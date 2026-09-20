<?php
if (!defined('ABSPATH')) exit;

class VTP_Event_Template_Workflow {
 public static function init(){
  add_action('admin_enqueue_scripts',[__CLASS__,'assets'],30);
  add_action('admin_post_vtp_update_event_template',[__CLASS__,'update_template']);
  add_action('admin_post_vtp_delete_event_template',[__CLASS__,'delete_template']);
  add_action('admin_post_vtp_apply_event_template',[__CLASS__,'apply_template_action']);
 }

 private static function table(){ return VTP_DB::table('event_templates'); }

 private static function valid_date($date){
  if(!preg_match('/^(\d{4})-(\d{2})-(\d{2})$/',(string)$date,$m)) return false;
  return checkdate((int)$m[2],(int)$m[3],(int)$m[1]);
 }

 private static function valid_time($time){
  return $time==='' || (bool)preg_match('/^(?:[01]\d|2[0-3]):[0-5]\d$/',(string)$time);
 }

 private static function date_with_offset($base,$offset){
  if(!self::valid_date($base)) return '';
  $date=DateTimeImmutable::createFromFormat('!Y-m-d',$base);
  if(!$date) return '';
  $offset=(int)$offset;
  if($offset!==0) $date=$date->modify(($offset>0?'+':'').$offset.' days');
  return $date->format('Y-m-d');
 }

 private static function row($id){
  global $wpdb;
  $id=absint($id);
  if(!$id) return null;
  return $wpdb->get_row($wpdb->prepare(
   'SELECT id,name,source_event_id,template_data,created_at,updated_at FROM '.self::table().' WHERE id=%d',
   $id
  ));
 }

 private static function payload($row){
  if(!$row) return [];
  $data=json_decode((string)$row->template_data,true);
  if(!is_array($data)) $data=[];
  foreach(['days','tasks','shifts','catering'] as $key){
   if(!isset($data[$key]) || !is_array($data[$key])) $data[$key]=[];
  }
  if(empty($data['event_name'])) $data['event_name']=(string)$row->name;
  return $data;
 }

 private static function library(){
  global $wpdb;
  $rows=$wpdb->get_results('SELECT id,name,template_data,updated_at FROM '.self::table().' ORDER BY name,id');
  $items=[];
  foreach($rows?:[] as $row){
   $data=self::payload($row);
   $event_offsets=[];
   foreach($data['days'] as $day){
    if(($day['type']??'event')==='event') $event_offsets[]=(int)($day['offset_days']??0);
   }
   $items[]=[
    'id'=>absint($row->id),
    'name'=>(string)$row->name,
    'days'=>count($data['days']),
    'tasks'=>count($data['tasks']),
    'shifts'=>count($data['shifts']),
    'catering'=>count($data['catering']),
    'eventMaxOffset'=>$event_offsets?max($event_offsets):0,
    'updated'=>mysql2date('d.m.Y H:i',(string)$row->updated_at),
    'editUrl'=>add_query_arg(['page'=>'vtp-events','view'=>'templates','edit_template'=>absint($row->id)],admin_url('admin.php')),
    'useUrl'=>add_query_arg(['page'=>'vtp-events','view'=>'new','template_id'=>absint($row->id)],admin_url('admin.php')),
    'deleteNonce'=>wp_create_nonce('vtp_delete_event_template_'.absint($row->id)),
   ];
  }
  return $items;
 }

 private static function editor_data($id){
  $row=self::row($id);
  if(!$row) return null;
  $data=self::payload($row);
  return [
   'id'=>absint($row->id),
   'name'=>(string)$row->name,
   'updated'=>mysql2date('d.m.Y H:i',(string)$row->updated_at),
   'days'=>array_values($data['days']),
   'tasks'=>array_values($data['tasks']),
   'shifts'=>array_values($data['shifts']),
   'catering'=>array_values($data['catering']),
   'updateNonce'=>wp_create_nonce('vtp_update_event_template_'.absint($row->id)),
   'deleteNonce'=>wp_create_nonce('vtp_delete_event_template_'.absint($row->id)),
   'useUrl'=>add_query_arg(['page'=>'vtp-events','view'=>'new','template_id'=>absint($row->id)],admin_url('admin.php')),
  ];
 }

 public static function assets($hook){
  if(($_GET['page']??'')!=='vtp-events') return;

  $view=sanitize_key($_GET['view']??'');
  $event_id=absint($_GET['edit_event']??0);
  if($event_id) return;

  $data=[
   'mode'=>'none',
   'actionUrl'=>admin_url('admin-post.php'),
   'templates'=>[],
  ];

  if($view==='new'){
   $data['mode']='new';
   $data['templates']=self::library();
   $data['selectedTemplateId']=absint($_GET['template_id']??0);
   $data['applyNonce']=wp_create_nonce('vtp_apply_event_template');
  } elseif($view==='templates'){
   $edit_id=absint($_GET['edit_template']??0);
   if($edit_id){
    $editor=self::editor_data($edit_id);
    if($editor){
     $data['mode']='editor';
     $data['template']=$editor;
     $data['updated']=!empty($_GET['template_updated']);
    } else {
     $data['mode']='library';
     $data['templates']=self::library();
    }
   } else {
    $data['mode']='library';
    $data['templates']=self::library();
    $data['deleted']=!empty($_GET['template_deleted']);
   }
  }

  if($data['mode']==='none') return;
  wp_enqueue_style('vtp-event-template-workflow',VTP_URL.'assets/event-template-workflow.css',['vtp-event-finalize'],VTP_VERSION);
  wp_enqueue_script('vtp-event-template-workflow',VTP_URL.'assets/event-template-workflow.js',['vtp-event-finalize'],VTP_VERSION,true);
  wp_localize_script('vtp-event-template-workflow','VTPEventTemplateWorkflow',$data);
 }

 private static function posted_snapshot($name){
  $days=[];
  $types=(array)($_POST['template_day_type']??[]);
  $offsets=(array)($_POST['template_day_offset']??[]);
  $times=(array)($_POST['template_day_time']??[]);
  $event_day_count=0;
  foreach($types as $i=>$raw_type){
   $type=sanitize_key(wp_unslash($raw_type));
   if(!in_array($type,['event','setup','teardown'],true)) $type='event';
   $offset=intval($offsets[$i]??0);
   $time=sanitize_text_field(wp_unslash($times[$i]??''));
   if(!self::valid_time($time)) $time='';
   if($type==='event'){
    $event_day_count++;
    $time='';
   }
   $days[]=['type'=>$type,'offset_days'=>$offset,'time'=>$time,'sort_order'=>$i];
  }
  if($event_day_count===0) return new WP_Error('template_days','Eine Vorlage benötigt mindestens einen Veranstaltungstag.');

  $tasks=[];
  $titles=(array)($_POST['template_task_title']??[]);
  $categories=(array)($_POST['template_task_category']??[]);
  $due_offsets=(array)($_POST['template_task_due_offset']??[]);
  $responsible=(array)($_POST['template_task_responsible']??[]);
  foreach($titles as $i=>$raw_title){
   $title=sanitize_text_field(wp_unslash($raw_title));
   if($title==='') continue;
   $due_raw=sanitize_text_field(wp_unslash($due_offsets[$i]??''));
   $tasks[]=[
    'title'=>$title,
    'category'=>sanitize_text_field(wp_unslash($categories[$i]??'')),
    'due_offset_days'=>$due_raw===''?null:intval($due_raw),
    'responsible'=>sanitize_text_field(wp_unslash($responsible[$i]??'')),
    'sort_order'=>$i,
   ];
  }

  $shifts=[];
  $areas=(array)($_POST['template_shift_area']??[]);
  $shift_offsets=(array)($_POST['template_shift_offset']??[]);
  $starts=(array)($_POST['template_shift_start']??[]);
  $ends=(array)($_POST['template_shift_end']??[]);
  $slots=(array)($_POST['template_shift_slots']??[]);
  $groups=(array)($_POST['template_shift_group']??[]);
  foreach($areas as $i=>$raw_area){
   $area=sanitize_text_field(wp_unslash($raw_area));
   if($area==='') continue;
   $start=sanitize_text_field(wp_unslash($starts[$i]??''));
   $end=sanitize_text_field(wp_unslash($ends[$i]??''));
   if(!self::valid_time($start) || !self::valid_time($end) || $start==='' || $end==='' || $start===$end){
    return new WP_Error('template_shift_time','Bitte für jede Helferschicht gültige, unterschiedliche Start- und Endzeiten angeben.');
   }
   $shifts[]=[
    'area'=>$area,
    'offset_days'=>intval($shift_offsets[$i]??0),
    'start'=>$start,
    'end'=>$end,
    'slots'=>max(1,absint($slots[$i]??1)),
    'group'=>sanitize_text_field(wp_unslash($groups[$i]??'')),
   ];
  }

  $catering=[];
  $cats=(array)($_POST['template_catering_category']??[]);
  $items=(array)($_POST['template_catering_item']??[]);
  $quantities=(array)($_POST['template_catering_quantity']??[]);
  $units=(array)($_POST['template_catering_unit']??[]);
  $cat_groups=(array)($_POST['template_catering_group']??[]);
  $notes=(array)($_POST['template_catering_note']??[]);
  foreach($items as $i=>$raw_item){
   $item=sanitize_text_field(wp_unslash($raw_item));
   if($item==='') continue;
   $category=sanitize_key(wp_unslash($cats[$i]??'drink'));
   if(!in_array($category,['drink','food','bring'],true)) $category='drink';
   $quantity_raw=str_replace(',','.',sanitize_text_field(wp_unslash($quantities[$i]??'1')));
   $quantity=is_numeric($quantity_raw)?(float)$quantity_raw:0;
   $unit=sanitize_text_field(wp_unslash($units[$i]??''));
   if($quantity<=0 || $unit==='') return new WP_Error('template_catering','Bewirtungseinträge benötigen eine Menge größer 0 und eine Einheit.');
   $catering[]=[
    'category'=>$category,
    'item'=>$item,
    'quantity'=>$quantity,
    'unit'=>$unit,
    'assigned_group'=>$category==='bring'?sanitize_text_field(wp_unslash($cat_groups[$i]??'')):'',
    'note'=>sanitize_text_field(wp_unslash($notes[$i]??'')),
    'sort_order'=>$i,
   ];
  }

  return [
   'schema'=>1,
   'event_name'=>$name,
   'days'=>$days,
   'tasks'=>$tasks,
   'shifts'=>$shifts,
   'catering'=>$catering,
  ];
 }

 public static function update_template(){
  $id=absint($_POST['template_id']??0);
  if(!$id || !current_user_can('manage_options')) wp_die('Nicht erlaubt.');
  check_admin_referer('vtp_update_event_template_'.$id);
  $row=self::row($id);
  if(!$row) wp_die('Vorlage nicht gefunden.');

  $name=sanitize_text_field(wp_unslash($_POST['template_name']??''));
  if($name==='') wp_die('Bitte einen Vorlagennamen angeben.');
  $snapshot=self::posted_snapshot($name);
  if(is_wp_error($snapshot)) wp_die(esc_html($snapshot->get_error_message()));

  $payload=wp_json_encode($snapshot,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
  if(!$payload) wp_die('Vorlage konnte nicht gespeichert werden.');

  global $wpdb;
  $ok=$wpdb->update(self::table(),[
   'name'=>$name,
   'template_data'=>$payload,
   'updated_at'=>current_time('mysql'),
  ],['id'=>$id]);
  if($ok===false) wp_die('Vorlage konnte nicht aktualisiert werden.');

  wp_safe_redirect(add_query_arg([
   'page'=>'vtp-events',
   'view'=>'templates',
   'edit_template'=>$id,
   'template_updated'=>1,
  ],admin_url('admin.php')));
  exit;
 }

 public static function delete_template(){
  $id=absint($_POST['template_id']??0);
  if(!$id || !current_user_can('manage_options')) wp_die('Nicht erlaubt.');
  check_admin_referer('vtp_delete_event_template_'.$id);
  global $wpdb;
  $wpdb->delete(self::table(),['id'=>$id]);
  wp_safe_redirect(add_query_arg([
   'page'=>'vtp-events',
   'view'=>'templates',
   'template_deleted'=>1,
  ],admin_url('admin.php')));
  exit;
 }

 public static function apply_template($template_id,$event_id,$start_date){
  $template_id=absint($template_id);
  $event_id=absint($event_id);
  if(!$template_id || !$event_id || !self::valid_date($start_date)) return new WP_Error('template_apply','Vorlage, Event oder Startdatum ist ungültig.');

  $row=self::row($template_id);
  if(!$row) return new WP_Error('template_missing','Vorlage wurde nicht gefunden.');
  $data=self::payload($row);

  global $wpdb;
  $event_exists=(int)$wpdb->get_var($wpdb->prepare('SELECT COUNT(*) FROM '.VTP_DB::table('events').' WHERE id=%d',$event_id));
  if(!$event_exists) return new WP_Error('event_missing','Event wurde nicht gefunden.');

  $days_table=VTP_DB::table('event_days');
  $tasks_table=VTP_DB::table('event_tasks');
  $shifts_table=VTP_DB::table('shifts');
  $signups_table=VTP_DB::table('shift_signups');
  $catering_table=VTP_DB::table('event_catering_items');
  $now=current_time('mysql');

  $wpdb->query('START TRANSACTION');
  $existing_shift_ids=array_map('absint',$wpdb->get_col($wpdb->prepare("SELECT id FROM $shifts_table WHERE event_id=%d",$event_id))?:[]);
  if($existing_shift_ids){
   $wpdb->query('DELETE FROM '.$signups_table.' WHERE shift_id IN ('.implode(',',$existing_shift_ids).')');
  }
  foreach([$days_table,$tasks_table,$shifts_table,$catering_table] as $table){
   $wpdb->delete($table,['event_id'=>$event_id]);
  }

  $legacy_dates=[];
  $event_offsets=[];
  $days=(array)($data['days']??[]);
  if(!$days) $days=[['type'=>'event','offset_days'=>0,'time'=>'','sort_order'=>0]];
  foreach($days as $i=>$day){
   $type=in_array(($day['type']??'event'),['event','setup','teardown'],true)?$day['type']:'event';
   $offset=intval($day['offset_days']??0);
   $date=self::date_with_offset($start_date,$offset);
   if(!$date) continue;
   $time=in_array($type,['setup','teardown'],true)?substr((string)($day['time']??''),0,5):'';
   if(!self::valid_time($time)) $time='';
   $ok=$wpdb->insert($days_table,[
    'event_id'=>$event_id,
    'event_date'=>$date,
    'day_type'=>$type,
    'day_time'=>$time,
    'sort_order'=>$i,
    'created_at'=>$now,
    'updated_at'=>$now,
   ]);
   if($ok===false){ $wpdb->query('ROLLBACK'); return new WP_Error('template_days','Event-Tage konnten nicht aus der Vorlage erzeugt werden.'); }
   $legacy_dates[$date]=true;
   if($type==='event') $event_offsets[]=$offset;
  }

  foreach((array)($data['tasks']??[]) as $i=>$task){
   $title=sanitize_text_field((string)($task['title']??''));
   if($title==='') continue;
   $due_offset=$task['due_offset_days']??null;
   $due=$due_offset===null?'':self::date_with_offset($start_date,intval($due_offset));
   $ok=$wpdb->insert($tasks_table,[
    'event_id'=>$event_id,
    'title'=>$title,
    'category'=>sanitize_text_field((string)($task['category']??''))?:null,
    'due_date'=>$due?:null,
    'responsible'=>sanitize_text_field((string)($task['responsible']??''))?:null,
    'status'=>'open',
    'source'=>'template',
    'sort_order'=>$i,
    'created_at'=>$now,
    'updated_at'=>$now,
   ]);
   if($ok===false){ $wpdb->query('ROLLBACK'); return new WP_Error('template_tasks','Aufgaben konnten nicht aus der Vorlage erzeugt werden.'); }
  }

  $shift_cols=$wpdb->get_col("DESC $shifts_table",0)?:[];
  foreach((array)($data['shifts']??[]) as $shift){
   $area=sanitize_text_field((string)($shift['area']??''));
   $date=self::date_with_offset($start_date,intval($shift['offset_days']??0));
   $start=substr((string)($shift['start']??''),0,5);
   $end=substr((string)($shift['end']??''),0,5);
   if($area==='' || !$date || !self::valid_time($start) || !self::valid_time($end) || $start==='' || $end==='' || $start===$end) continue;
   $insert=[
    'event_id'=>$event_id,
    'area_name'=>$area,
    'shift_date'=>$date,
    'start_time'=>$start,
    'end_time'=>$end,
    'slots_needed'=>max(1,absint($shift['slots']??1)),
    'assigned_group'=>sanitize_text_field((string)($shift['group']??''))?:null,
   ];
   if(in_array('source_type',$shift_cols,true)) $insert['source_type']='template';
   if(in_array('source_ref',$shift_cols,true)) $insert['source_ref']=null;
   $ok=$wpdb->insert($shifts_table,$insert);
   if($ok===false){ $wpdb->query('ROLLBACK'); return new WP_Error('template_shifts','Helferschichten konnten nicht aus der Vorlage erzeugt werden.'); }
  }

  foreach((array)($data['catering']??[]) as $i=>$item){
   $category=in_array(($item['category']??'drink'),['drink','food','bring'],true)?$item['category']:'drink';
   $name=sanitize_text_field((string)($item['item']??''));
   $quantity=(float)($item['quantity']??0);
   $unit=sanitize_text_field((string)($item['unit']??''));
   if($name==='' || $quantity<=0 || $unit==='') continue;
   $ok=$wpdb->insert($catering_table,[
    'event_id'=>$event_id,
    'category'=>$category,
    'item_name'=>$name,
    'quantity'=>$quantity,
    'unit'=>$unit,
    'assigned_group'=>$category==='bring'?(sanitize_text_field((string)($item['assigned_group']??''))?:null):null,
    'note'=>sanitize_text_field((string)($item['note']??''))?:null,
    'sort_order'=>$i,
   ]);
   if($ok===false){ $wpdb->query('ROLLBACK'); return new WP_Error('template_catering','Bewirtung konnte nicht aus der Vorlage erzeugt werden.'); }
  }

  $end_offset=$event_offsets?max($event_offsets):0;
  $end_date=self::date_with_offset($start_date,$end_offset)?:$start_date;
  $ok=$wpdb->update(VTP_DB::table('events'),[
   'end_date'=>$end_date,
   'updated_at'=>$now,
  ],['id'=>$event_id]);
  if($ok===false){ $wpdb->query('ROLLBACK'); return new WP_Error('template_event','Event-Zeitraum konnte nicht aus der Vorlage erzeugt werden.'); }

  $legacy=array_keys($legacy_dates);
  sort($legacy);
  update_option('vtp_event_days_'.$event_id,$legacy,false);
  $wpdb->query('COMMIT');

  if(class_exists('VTP_Event_Shift_Operations')) VTP_Event_Shift_Operations::sync_for_event($event_id);
  return true;
 }

 public static function apply_template_action(){
  if(!current_user_can('manage_options')) wp_send_json_error(['message'=>'Nicht erlaubt.'],403);
  check_admin_referer('vtp_apply_event_template');
  $template_id=absint($_POST['template_id']??0);
  $event_id=absint($_POST['event_id']??0);
  $start_date=sanitize_text_field(wp_unslash($_POST['start_date']??''));
  $result=self::apply_template($template_id,$event_id,$start_date);
  if(is_wp_error($result)) wp_send_json_error(['message'=>$result->get_error_message()],400);

  wp_send_json_success([
   'redirect'=>add_query_arg([
    'page'=>'vtp-events',
    'edit_event'=>$event_id,
    'saved'=>1,
    'template_applied'=>1,
   ],admin_url('admin.php')),
  ]);
 }
}
