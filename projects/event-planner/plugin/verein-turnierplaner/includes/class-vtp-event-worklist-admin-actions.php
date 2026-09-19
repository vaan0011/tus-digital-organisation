<?php
if (!defined('ABSPATH')) exit;

class VTP_Event_Worklist_Admin_Actions {
 private static $context=null;

 public static function init(){
  add_action('template_redirect',[__CLASS__,'capture_query_context'],7);
  add_filter('pre_do_shortcode_tag',[__CLASS__,'capture_shortcode_context'],20,4);
  add_action('wp_footer',[__CLASS__,'render_panel'],5);

  foreach([
   'vtp_worklist_admin_task_add'=>'add_task',
   'vtp_worklist_admin_task_delete'=>'delete_task',
   'vtp_worklist_admin_task_reset'=>'reset_task_feedback',
   'vtp_worklist_admin_shift_signup_delete'=>'delete_shift_signup',
   'vtp_worklist_admin_bring_signup_delete'=>'delete_bring_signup',
  ] as $action=>$method){
   add_action('admin_post_'.$action,[__CLASS__,$method]);
   add_action('admin_post_nopriv_'.$action,[__CLASS__,$method]);
  }
 }

 public static function capture_query_context(){
  $task_event=absint(get_query_var('vtp_tasks'));
  $team_event=absint(get_query_var('vtp_helpers'));
  if($task_event && trim((string)($_GET['person']??''))==='') self::$context=['event_id'=>$task_event,'target'=>'tasks'];
  elseif($team_event && trim((string)($_GET['gruppe']??''))==='') self::$context=['event_id'=>$team_event,'target'=>'teamwork'];
 }

 public static function capture_shortcode_context($output,$tag,$attr,$m){
  if($tag==='verein_aufgabenliste' && trim((string)($_GET['person']??''))===''){
   $event_id=absint($attr['id']??0);
   if($event_id) self::$context=['event_id'=>$event_id,'target'=>'tasks'];
  } elseif($tag==='verein_helferplan' && trim((string)($_GET['gruppe']??''))===''){
   $event_id=absint($attr['id']??0);
   if($event_id) self::$context=['event_id'=>$event_id,'target'=>'teamwork'];
  }
  return $output;
 }

 private static function authorize($event_id){
  $event_id=absint($event_id);
  if(!$event_id || !VTP_Event_Worklist_Access::has_admin_access($event_id)) wp_die('Nicht erlaubt.');
  return $event_id;
 }

 private static function redirect($event_id,$target,$message){
  $url=$target==='tasks' ? VTP_Event_Public_Worklists::tasks_url($event_id) : VTP_Event_Public_Worklists::teamwork_url($event_id);
  wp_safe_redirect(add_query_arg('admin_saved',$message,$url));
  exit;
 }

 public static function add_task(){
  $event_id=self::authorize($_POST['event_id']??0);
  check_admin_referer('vtp_worklist_admin_task_add_'.$event_id);

  $title=sanitize_text_field(wp_unslash($_POST['task_title']??''));
  if($title==='') wp_die('Bitte eine Aufgabe angeben.');
  $category=sanitize_text_field(wp_unslash($_POST['task_category']??''));
  $responsible=sanitize_text_field(wp_unslash($_POST['task_responsible']??''));
  $due=sanitize_text_field(wp_unslash($_POST['task_due_date']??''));
  if($due!=='' && !VTP_Plugin::is_valid_event_date($due)) wp_die('Ungültiges Fälligkeitsdatum.');

  global $wpdb;
  $table=VTP_DB::table('event_tasks');
  $sort=(int)$wpdb->get_var($wpdb->prepare('SELECT COALESCE(MAX(sort_order),-1)+1 FROM '.$table.' WHERE event_id=%d',$event_id));
  $now=current_time('mysql');
  $ok=$wpdb->insert($table,[
   'event_id'=>$event_id,
   'title'=>$title,
   'category'=>$category?:null,
   'due_date'=>$due?:null,
   'responsible'=>$responsible?:null,
   'status'=>'open',
   'source'=>'manual',
   'sort_order'=>$sort,
   'created_at'=>$now,
   'updated_at'=>$now,
  ]);
  if($ok===false) wp_die('Aufgabe konnte nicht angelegt werden.');
  self::redirect($event_id,'tasks','task_added');
 }

 public static function delete_task(){
  $event_id=self::authorize($_POST['event_id']??0);
  $task_id=absint($_POST['task_id']??0);
  check_admin_referer('vtp_worklist_admin_task_delete_'.$event_id.'_'.$task_id);

  global $wpdb;
  $tasks=VTP_DB::table('event_tasks');
  $feedback=VTP_DB::table('event_task_feedback');
  $exists=(int)$wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $tasks WHERE id=%d AND event_id=%d",$task_id,$event_id));
  if(!$exists) wp_die('Aufgabe nicht gefunden.');
  $wpdb->delete($feedback,['task_id'=>$task_id,'event_id'=>$event_id]);
  $wpdb->delete($tasks,['id'=>$task_id,'event_id'=>$event_id]);
  self::redirect($event_id,'tasks','task_deleted');
 }

 public static function reset_task_feedback(){
  $event_id=self::authorize($_POST['event_id']??0);
  $task_id=absint($_POST['task_id']??0);
  check_admin_referer('vtp_worklist_admin_task_reset_'.$event_id.'_'.$task_id);

  global $wpdb;
  $tasks=VTP_DB::table('event_tasks');
  $feedback=VTP_DB::table('event_task_feedback');
  $row=$wpdb->get_row($wpdb->prepare("SELECT feedback_status FROM $feedback WHERE task_id=%d AND event_id=%d",$task_id,$event_id));
  if(!$row) wp_die('Keine Rückmeldung gefunden.');
  $wpdb->delete($feedback,['task_id'=>$task_id,'event_id'=>$event_id]);
  if((string)$row->feedback_status==='done'){
   $wpdb->update($tasks,['status'=>'open','updated_at'=>current_time('mysql')],['id'=>$task_id,'event_id'=>$event_id]);
  }
  self::redirect($event_id,'tasks','task_reset');
 }

 public static function delete_shift_signup(){
  $event_id=self::authorize($_POST['event_id']??0);
  $signup_id=absint($_POST['signup_id']??0);
  check_admin_referer('vtp_worklist_admin_shift_signup_delete_'.$event_id.'_'.$signup_id);

  global $wpdb;
  $signups=VTP_DB::table('shift_signups');
  $shifts=VTP_DB::table('shifts');
  $row=$wpdb->get_row($wpdb->prepare(
   "SELECT g.id FROM $signups g INNER JOIN $shifts s ON s.id=g.shift_id WHERE g.id=%d AND s.event_id=%d",
   $signup_id,$event_id
  ));
  if(!$row) wp_die('Schichtanmeldung nicht gefunden.');
  $wpdb->delete($signups,['id'=>$signup_id]);
  self::redirect($event_id,'teamwork','shift_signup_deleted');
 }

 public static function delete_bring_signup(){
  $event_id=self::authorize($_POST['event_id']??0);
  $signup_id=absint($_POST['signup_id']??0);
  check_admin_referer('vtp_worklist_admin_bring_signup_delete_'.$event_id.'_'.$signup_id);

  global $wpdb;
  $signups=VTP_DB::table('event_bring_signups');
  $catering=VTP_DB::table('event_catering_items');
  $row=$wpdb->get_row($wpdb->prepare(
   "SELECT b.id FROM $signups b INNER JOIN $catering c ON c.id=b.catering_item_id WHERE b.id=%d AND b.event_id=%d AND c.event_id=%d AND c.category='bring'",
   $signup_id,$event_id,$event_id
  ));
  if(!$row) wp_die('Mitbringen-Rückmeldung nicht gefunden.');
  $wpdb->delete($signups,['id'=>$signup_id,'event_id'=>$event_id]);
  self::redirect($event_id,'teamwork','bring_signup_deleted');
 }

 public static function render_panel(){
  if(!self::$context) return;
  $event_id=absint(self::$context['event_id']??0);
  $target=(string)(self::$context['target']??'');
  if(!$event_id || !VTP_Event_Worklist_Access::has_admin_access($event_id)) return;

  $html=$target==='tasks' ? self::tasks_panel($event_id) : self::teamwork_panel($event_id);
  if($html==='') return;
  echo '<div id="vtp-worklist-admin-management" style="display:none">'.$html.'</div>';
  echo '<script>(function(){var p=document.getElementById("vtp-worklist-admin-management"),m=document.querySelector("main.vtp-worklist-public");if(!p||!m)return;p.style.display="block";m.appendChild(p);})();</script>';
 }

 private static function flash(){
  $key=sanitize_key(wp_unslash($_GET['admin_saved']??''));
  $map=[
   'task_added'=>'Aufgabe wurde angelegt.',
   'task_deleted'=>'Aufgabe wurde gelöscht.',
   'task_reset'=>'Rückmeldung wurde zurückgesetzt. Die Aufgabe ist wieder offen.',
   'shift_signup_deleted'=>'Schichtanmeldung wurde gelöscht. Der Platz ist wieder frei.',
   'bring_signup_deleted'=>'Mitbringen-Rückmeldung wurde gelöscht. Der Bedarf wurde wieder geöffnet.',
  ];
  return $map[$key]??'';
 }

 private static function tasks_panel($event_id){
  global $wpdb;
  $tasks=VTP_DB::table('event_tasks');
  $feedback=VTP_DB::table('event_task_feedback');
  $rows=$wpdb->get_results($wpdb->prepare(
   "SELECT t.id,t.title,t.category,t.due_date,t.responsible,t.status,f.feedback_status,f.responder_name,f.note feedback_note
    FROM $tasks t LEFT JOIN $feedback f ON f.task_id=t.id
    WHERE t.event_id=%d
    ORDER BY CASE WHEN t.status='done' THEN 1 ELSE 0 END,CASE WHEN t.due_date IS NULL THEN 1 ELSE 0 END,t.due_date,t.sort_order,t.id",
   $event_id
  ));

  ob_start(); ?>
  <section class="vtp-section vtp-worklist-admin-management">
   <div class="vtp-worklist-admin-head"><div><span class="vtp-worklist-admin-badge">Admin</span><h2>Aufgaben verwalten</h2><p>Neue Aufgaben anlegen, Rückmeldungen bei Absagen zurücksetzen oder fehlerhafte Aufgaben löschen.</p></div></div>
   <?php if(self::flash()): ?><p class="vtp-worklist-admin-success"><strong><?php echo esc_html(self::flash()); ?></strong></p><?php endif; ?>
   <form class="vtp-worklist-admin-add-task" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
    <input type="hidden" name="action" value="vtp_worklist_admin_task_add"><input type="hidden" name="event_id" value="<?php echo esc_attr($event_id); ?>">
    <?php wp_nonce_field('vtp_worklist_admin_task_add_'.$event_id); ?>
    <label><span>Aufgabe</span><input name="task_title" required></label>
    <label><span>Verantwortlich</span><input name="task_responsible" placeholder="z. B. Max Mustermann"></label>
    <label><span>Kategorie</span><input name="task_category" placeholder="optional"></label>
    <label><span>Fällig</span><input type="date" name="task_due_date"></label>
    <button type="submit">Aufgabe hinzufügen</button>
   </form>
   <div class="vtp-worklist-admin-list">
    <?php if(!$rows): ?><p>Aktuell sind keine Aufgaben vorhanden.</p><?php endif; ?>
    <?php foreach($rows?:[] as $row): ?>
     <div class="vtp-worklist-admin-row">
      <div><strong><?php echo esc_html($row->title); ?></strong><div class="vtp-worklist-admin-meta"><?php echo esc_html($row->responsible?:'Nicht zugeordnet'); ?><?php if($row->due_date): ?> · <?php echo esc_html(date_i18n('d.m.Y',strtotime($row->due_date))); ?><?php endif; ?> · <?php echo (string)$row->status==='done'?'Erledigt':'Offen'; ?></div><?php if($row->feedback_status): ?><div class="vtp-worklist-admin-response">Rückmeldung: <?php echo esc_html($row->responder_name); ?> · <?php echo (string)$row->feedback_status==='done'?'Erledigt':'Übernommen'; ?><?php if($row->feedback_note): ?> · <?php echo esc_html($row->feedback_note); ?><?php endif; ?></div><?php endif; ?></div>
      <div class="vtp-worklist-admin-actions">
       <?php if($row->feedback_status): ?><form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>"><input type="hidden" name="action" value="vtp_worklist_admin_task_reset"><input type="hidden" name="event_id" value="<?php echo esc_attr($event_id); ?>"><input type="hidden" name="task_id" value="<?php echo esc_attr($row->id); ?>"><?php wp_nonce_field('vtp_worklist_admin_task_reset_'.$event_id.'_'.absint($row->id)); ?><button type="submit" class="vtp-worklist-admin-secondary" onclick="return confirm('Rückmeldung wirklich zurücksetzen?')">Rückmeldung zurücksetzen</button></form><?php endif; ?>
       <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>"><input type="hidden" name="action" value="vtp_worklist_admin_task_delete"><input type="hidden" name="event_id" value="<?php echo esc_attr($event_id); ?>"><input type="hidden" name="task_id" value="<?php echo esc_attr($row->id); ?>"><?php wp_nonce_field('vtp_worklist_admin_task_delete_'.$event_id.'_'.absint($row->id)); ?><button type="submit" class="vtp-worklist-admin-danger" onclick="return confirm('Aufgabe wirklich dauerhaft löschen?')">Aufgabe löschen</button></form>
      </div>
     </div>
    <?php endforeach; ?>
   </div>
  </section>
  <?php return ob_get_clean();
 }

 private static function teamwork_panel($event_id){
  global $wpdb;
  $shift_signups=VTP_DB::table('shift_signups');
  $shifts=VTP_DB::table('shifts');
  $bring_signups=VTP_DB::table('event_bring_signups');
  $catering=VTP_DB::table('event_catering_items');

  $shift_rows=$wpdb->get_results($wpdb->prepare(
   "SELECT g.id signup_id,g.name,g.contact,s.area_name,s.shift_date,s.start_time,s.end_time,s.assigned_group
    FROM $shift_signups g INNER JOIN $shifts s ON s.id=g.shift_id
    WHERE s.event_id=%d
    ORDER BY s.assigned_group,s.shift_date,s.start_time,s.area_name,g.created_at,g.id",
   $event_id
  ));
  $bring_rows=$wpdb->get_results($wpdb->prepare(
   "SELECT b.id signup_id,b.name,b.contact,b.quantity,c.item_name,c.unit,c.assigned_group
    FROM $bring_signups b INNER JOIN $catering c ON c.id=b.catering_item_id
    WHERE b.event_id=%d AND c.event_id=%d AND c.category='bring'
    ORDER BY c.assigned_group,c.sort_order,c.id,b.created_at,b.id",
   $event_id,$event_id
  ));

  ob_start(); ?>
  <section class="vtp-section vtp-worklist-admin-management">
   <div class="vtp-worklist-admin-head"><div><span class="vtp-worklist-admin-badge">Admin</span><h2>Anmeldungen verwalten</h2><p>Absagen entfernen. Gelöschte Schichtplätze und Mitbringmengen stehen unmittelbar wieder zur Verfügung.</p></div></div>
   <?php if(self::flash()): ?><p class="vtp-worklist-admin-success"><strong><?php echo esc_html(self::flash()); ?></strong></p><?php endif; ?>
   <h3>Schichtanmeldungen</h3>
   <div class="vtp-worklist-admin-list">
    <?php if(!$shift_rows): ?><p>Keine Schichtanmeldungen vorhanden.</p><?php endif; ?>
    <?php foreach($shift_rows?:[] as $row): ?>
     <div class="vtp-worklist-admin-row"><div><strong><?php echo esc_html($row->name); ?></strong><div class="vtp-worklist-admin-meta"><?php echo esc_html($row->assigned_group?:'Nicht zugeordnet'); ?> · <?php echo esc_html($row->area_name); ?> · <?php echo esc_html(date_i18n('d.m.Y',strtotime($row->shift_date)).' '.substr($row->start_time,0,5).'–'.substr($row->end_time,0,5).' Uhr'); ?><?php if($row->contact): ?> · <?php echo esc_html($row->contact); ?><?php endif; ?></div></div><form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>"><input type="hidden" name="action" value="vtp_worklist_admin_shift_signup_delete"><input type="hidden" name="event_id" value="<?php echo esc_attr($event_id); ?>"><input type="hidden" name="signup_id" value="<?php echo esc_attr($row->signup_id); ?>"><?php wp_nonce_field('vtp_worklist_admin_shift_signup_delete_'.$event_id.'_'.absint($row->signup_id)); ?><button type="submit" class="vtp-worklist-admin-danger" onclick="return confirm('Schichtanmeldung wirklich löschen? Der Platz wird wieder freigegeben.')">Anmeldung löschen</button></form></div>
    <?php endforeach; ?>
   </div>
   <h3>Mitbringen-Rückmeldungen</h3>
   <div class="vtp-worklist-admin-list">
    <?php if(!$bring_rows): ?><p>Keine Mitbringen-Rückmeldungen vorhanden.</p><?php endif; ?>
    <?php foreach($bring_rows?:[] as $row): ?>
     <div class="vtp-worklist-admin-row"><div><strong><?php echo esc_html($row->name); ?></strong><div class="vtp-worklist-admin-meta"><?php echo esc_html($row->assigned_group?:'Nicht zugeordnet'); ?> · <?php echo esc_html($row->item_name); ?> · <?php echo esc_html(rtrim(rtrim(number_format((float)$row->quantity,2,',','.'),'0'),',').' '.$row->unit); ?><?php if($row->contact): ?> · <?php echo esc_html($row->contact); ?><?php endif; ?></div></div><form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>"><input type="hidden" name="action" value="vtp_worklist_admin_bring_signup_delete"><input type="hidden" name="event_id" value="<?php echo esc_attr($event_id); ?>"><input type="hidden" name="signup_id" value="<?php echo esc_attr($row->signup_id); ?>"><?php wp_nonce_field('vtp_worklist_admin_bring_signup_delete_'.$event_id.'_'.absint($row->signup_id)); ?><button type="submit" class="vtp-worklist-admin-danger" onclick="return confirm('Mitbringen-Rückmeldung wirklich löschen? Die Menge wird wieder als offen angezeigt.')">Rückmeldung löschen</button></form></div>
    <?php endforeach; ?>
   </div>
  </section>
  <?php return ob_get_clean();
 }
}
