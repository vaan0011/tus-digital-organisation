<?php
if (!defined('ABSPATH')) exit;

class VTP_Event_Public_Worklists {
 const SCHEMA_VERSION='1';

 public static function init(){
  self::ensure_schema();

  add_filter('query_vars',[__CLASS__,'query_vars']);
  add_action('template_redirect',[__CLASS__,'template_redirect'],9);
  add_shortcode('verein_aufgabenliste',[__CLASS__,'tasks_shortcode']);
  // Override the legacy helper shortcode with the combined shifts/bring view.
  add_shortcode('verein_helferplan',[__CLASS__,'teamwork_shortcode']);

  $public=VTP_Public::instance();
  remove_action('admin_post_nopriv_vtp_helper_signup',[$public,'helper_signup']);
  remove_action('admin_post_vtp_helper_signup',[$public,'helper_signup']);
  add_action('admin_post_nopriv_vtp_helper_signup',[__CLASS__,'shift_signup']);
  add_action('admin_post_vtp_helper_signup',[__CLASS__,'shift_signup']);
  add_action('admin_post_nopriv_vtp_bring_signup',[__CLASS__,'bring_signup']);
  add_action('admin_post_vtp_bring_signup',[__CLASS__,'bring_signup']);
  add_action('admin_post_nopriv_vtp_task_feedback',[__CLASS__,'task_feedback']);
  add_action('admin_post_vtp_task_feedback',[__CLASS__,'task_feedback']);
 }

 private static function task_feedback_table(){ return VTP_DB::table('event_task_feedback'); }
 private static function bring_signup_table(){ return VTP_DB::table('event_bring_signups'); }

 private static function ensure_schema(){
  global $wpdb;
  $task_table=self::task_feedback_table();
  $bring_table=self::bring_signup_table();
  $version=(string)get_option('vtp_event_public_worklists_schema');
  $task_exists=$wpdb->get_var($wpdb->prepare('SHOW TABLES LIKE %s',$task_table))===$task_table;
  $bring_exists=$wpdb->get_var($wpdb->prepare('SHOW TABLES LIKE %s',$bring_table))===$bring_table;
  if($version===self::SCHEMA_VERSION && $task_exists && $bring_exists) return;

  require_once ABSPATH.'wp-admin/includes/upgrade.php';
  $c=$wpdb->get_charset_collate();
  dbDelta("CREATE TABLE $task_table (
   id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   event_id BIGINT UNSIGNED NOT NULL,
   task_id BIGINT UNSIGNED NOT NULL,
   responder_name VARCHAR(191) NOT NULL,
   feedback_status VARCHAR(30) NOT NULL DEFAULT 'acknowledged',
   note TEXT NULL,
   created_at DATETIME NOT NULL,
   updated_at DATETIME NOT NULL,
   PRIMARY KEY (id),
   UNIQUE KEY task_id (task_id),
   KEY event_id (event_id)
  ) $c;");
  dbDelta("CREATE TABLE $bring_table (
   id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   event_id BIGINT UNSIGNED NOT NULL,
   catering_item_id BIGINT UNSIGNED NOT NULL,
   name VARCHAR(191) NOT NULL,
   contact VARCHAR(191) NULL,
   quantity DECIMAL(10,2) NOT NULL DEFAULT 1.00,
   created_at DATETIME NOT NULL,
   PRIMARY KEY (id),
   KEY event_id (event_id),
   KEY catering_item_id (catering_item_id)
  ) $c;");
  update_option('vtp_event_public_worklists_schema',self::SCHEMA_VERSION,false);
 }

 public static function query_vars($vars){
  $vars[]='vtp_tasks';
  return $vars;
 }

 private static function enqueue_assets(){
  wp_enqueue_style('vtp-public',VTP_URL.'assets/public.css',['dashicons'],VTP_VERSION);
  wp_enqueue_style('vtp-event-public-worklists',VTP_URL.'assets/event-public-worklists.css',['vtp-public'],VTP_VERSION);
 }

 public static function tasks_url($event,$person=''){
  $event_id=absint(is_object($event)?($event->id??0):$event);
  $url=home_url('/?vtp_tasks='.$event_id);
  if($person!=='') $url=add_query_arg('person',$person,$url);
  return $url;
 }

 public static function teamwork_url($event,$group=''){
  if(!is_object($event)){
   global $wpdb;
   $event=$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('events').' WHERE id=%d',absint($event)));
  }
  if(!$event) return home_url('/');
  $url=VTP_Public::helpers_url($event);
  if($group!=='') $url=add_query_arg('gruppe',$group,$url);
  return $url;
 }

 public static function template_redirect(){
  $task_event=absint(get_query_var('vtp_tasks'));
  $team_event=absint(get_query_var('vtp_helpers'));
  if(!$task_event && !$team_event) return;

  status_header(200);
  nocache_headers();
  self::enqueue_assets();
  get_header();
  echo $task_event ? self::render_tasks($task_event) : self::render_teamwork($team_event);
  get_footer();
  exit;
 }

 public static function tasks_shortcode($atts){
  $atts=shortcode_atts(['id'=>0],$atts);
  self::enqueue_assets();
  return self::render_tasks(absint($atts['id']));
 }

 public static function teamwork_shortcode($atts){
  $atts=shortcode_atts(['id'=>0],$atts);
  self::enqueue_assets();
  return self::render_teamwork(absint($atts['id']));
 }

 private static function event($event_id){
  global $wpdb;
  return $wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('events').' WHERE id=%d',absint($event_id)));
 }

 private static function format_quantity($quantity){
  return rtrim(rtrim(number_format((float)$quantity,2,',','.'),'0'),',');
 }

 public static function render_tasks($event_id){
  self::ensure_schema();
  global $wpdb;
  $event=self::event($event_id);
  if(!$event) return '<p>Event nicht gefunden.</p>';

  $person=sanitize_text_field(wp_unslash($_GET['person']??''));
  $tasks=VTP_DB::table('event_tasks');
  $feedback=self::task_feedback_table();
  $where='t.event_id=%d';
  $args=[absint($event_id)];
  if($person!==''){
   $where.=' AND t.responsible=%s';
   $args[]=$person;
  }
  $sql="SELECT t.id,t.title,t.category,t.due_date,t.responsible,t.status,
              f.responder_name,f.feedback_status,f.note feedback_note,f.updated_at feedback_updated
       FROM $tasks t
       LEFT JOIN $feedback f ON f.task_id=t.id
       WHERE $where
       ORDER BY CASE WHEN t.responsible IS NULL OR t.responsible='' THEN 1 ELSE 0 END,
                t.responsible,
                CASE WHEN t.status='done' THEN 1 ELSE 0 END,
                CASE WHEN t.due_date IS NULL THEN 1 ELSE 0 END,
                t.due_date,t.sort_order,t.id";
  $rows=$wpdb->get_results($wpdb->prepare($sql,$args));
  $groups=[];
  foreach($rows?:[] as $row){
   $key=trim((string)$row->responsible);
   if($key==='') $key='Noch nicht zugeordnet';
   $groups[$key][]=$row;
  }

  ob_start(); ?>
  <main class="vtp-public vtp-worklist-public">
   <section class="vtp-hero"><div class="vtp-hero-inner"><img class="vtp-logo" src="<?php echo esc_url(VTP_URL.'assets/tus-mingolsheim-logo.png'); ?>" alt="TuS Mingolsheim"><div><div class="vtp-kicker">Aufgabenliste<?php echo $person!==''?' · '.esc_html($person):''; ?></div><h1><?php echo esc_html($event->name); ?></h1><p>Alle organisatorischen Aufgaben und Rückmeldungen auf einen Blick.</p></div></div></section>
   <?php if(!empty($_GET['danke'])): ?><section class="vtp-section"><p><strong>Danke! Deine Rückmeldung wurde gespeichert.</strong></p></section><?php endif; ?>
   <section class="vtp-section">
    <h2><?php echo $person!==''?'Aufgaben für '.esc_html($person):'Aufgaben nach Verantwortlichen'; ?></h2>
    <?php if(!$groups): ?><p>Aktuell sind keine Aufgaben hinterlegt.</p><?php endif; ?>
    <?php foreach($groups as $responsible=>$items): ?>
     <section class="vtp-worklist-group">
      <div class="vtp-worklist-group-head"><h3><?php echo esc_html($responsible); ?></h3>
       <?php if(current_user_can('manage_options') && $person===''): ?><a class="vtp-worklist-share" href="<?php echo esc_url(self::tasks_url($event,$responsible)); ?>">Link für <?php echo esc_html($responsible); ?></a><?php endif; ?>
      </div>
      <?php foreach($items as $task):
       $done=((string)$task->status==='done' || (string)$task->feedback_status==='done');
       $ack=((string)$task->feedback_status==='acknowledged');
       $state=$done?'Erledigt':($ack?'Übernommen':'Offen');
      ?>
       <article class="vtp-worklist-item <?php echo $done?'is-done':''; ?>">
        <div class="vtp-worklist-item-main">
         <strong><?php echo esc_html($task->title); ?></strong>
         <div class="vtp-worklist-meta">
          <?php if($task->category): ?><span><?php echo esc_html($task->category); ?></span><?php endif; ?>
          <?php if($task->due_date): ?><span>Fällig: <?php echo esc_html(date_i18n('d.m.Y',strtotime($task->due_date))); ?></span><?php endif; ?>
          <span class="vtp-worklist-state"><?php echo esc_html($state); ?></span>
         </div>
        </div>
        <?php if(!$done): ?>
         <form class="vtp-worklist-feedback-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
          <input type="hidden" name="action" value="vtp_task_feedback">
          <input type="hidden" name="event_id" value="<?php echo esc_attr($event_id); ?>">
          <input type="hidden" name="task_id" value="<?php echo esc_attr($task->id); ?>">
          <?php if($person!==''): ?><input type="hidden" name="person" value="<?php echo esc_attr($person); ?>"><?php endif; ?>
          <?php wp_nonce_field('vtp_task_feedback_'.absint($task->id)); ?>
          <input type="text" name="responder_name" value="<?php echo esc_attr($task->responsible?:''); ?>" placeholder="Dein Name" required>
          <input type="text" name="feedback_note" placeholder="Rückmeldung / Hinweis (optional)">
          <div class="vtp-worklist-feedback-actions">
           <button type="submit" name="feedback_status" value="acknowledged">Übernommen</button>
           <button type="submit" name="feedback_status" value="done">Erledigt</button>
          </div>
         </form>
        <?php endif; ?>
        <?php if(current_user_can('manage_options') && $task->feedback_status): ?>
         <div class="vtp-worklist-admin-feedback"><strong>Rückmeldung:</strong> <?php echo esc_html($task->responder_name); ?> · <?php echo esc_html($state); ?><?php if($task->feedback_note): ?><br><?php echo esc_html($task->feedback_note); ?><?php endif; ?></div>
        <?php endif; ?>
       </article>
      <?php endforeach; ?>
     </section>
    <?php endforeach; ?>
   </section>
  </main>
  <?php return ob_get_clean();
 }

 public static function render_teamwork($event_id){
  self::ensure_schema();
  global $wpdb;
  $event=self::event($event_id);
  if(!$event) return '<p>Event nicht gefunden.</p>';

  $group_filter=sanitize_text_field(wp_unslash($_GET['gruppe']??''));
  $shifts_table=VTP_DB::table('shifts');
  $shift_signups=VTP_DB::table('shift_signups');
  $catering=VTP_DB::table('event_catering_items');
  $bring_signups=self::bring_signup_table();

  if($group_filter!==''){
   $shifts=$wpdb->get_results($wpdb->prepare(
    "SELECT s.*,COUNT(g.id) signups FROM $shifts_table s
     LEFT JOIN $shift_signups g ON g.shift_id=s.id
     WHERE s.event_id=%d AND s.assigned_group=%s
     GROUP BY s.id ORDER BY s.shift_date,s.start_time,s.area_name",
    $event_id,$group_filter
   ));
   $bring=$wpdb->get_results($wpdb->prepare(
    "SELECT c.*,COALESCE(SUM(b.quantity),0) pledged FROM $catering c
     LEFT JOIN $bring_signups b ON b.catering_item_id=c.id
     WHERE c.event_id=%d AND c.category='bring' AND c.assigned_group=%s
     GROUP BY c.id ORDER BY c.sort_order,c.id",
    $event_id,$group_filter
   ));
  } else {
   $shifts=$wpdb->get_results($wpdb->prepare(
    "SELECT s.*,COUNT(g.id) signups FROM $shifts_table s
     LEFT JOIN $shift_signups g ON g.shift_id=s.id
     WHERE s.event_id=%d
     GROUP BY s.id ORDER BY CASE WHEN s.assigned_group IS NULL OR s.assigned_group='' THEN 1 ELSE 0 END,s.assigned_group,s.shift_date,s.start_time,s.area_name",
    $event_id
   ));
   $bring=$wpdb->get_results($wpdb->prepare(
    "SELECT c.*,COALESCE(SUM(b.quantity),0) pledged FROM $catering c
     LEFT JOIN $bring_signups b ON b.catering_item_id=c.id
     WHERE c.event_id=%d AND c.category='bring'
     GROUP BY c.id ORDER BY CASE WHEN c.assigned_group IS NULL OR c.assigned_group='' THEN 1 ELSE 0 END,c.assigned_group,c.sort_order,c.id",
    $event_id
   ));
  }

  $groups=[];
  foreach($shifts?:[] as $shift){
   $key=trim((string)$shift->assigned_group);
   if($key==='') $key='Nicht zugeordnet';
   if(!isset($groups[$key])) $groups[$key]=['shifts'=>[],'bring'=>[]];
   $groups[$key]['shifts'][]=$shift;
  }
  foreach($bring?:[] as $item){
   $key=trim((string)$item->assigned_group);
   if($key==='') $key='Nicht zugeordnet';
   if(!isset($groups[$key])) $groups[$key]=['shifts'=>[],'bring'=>[]];
   $groups[$key]['bring'][]=$item;
  }
  if($group_filter!=='' && !$groups) $groups[$group_filter]=['shifts'=>[],'bring'=>[]];

  $admin=current_user_can('manage_options');
  ob_start(); ?>
  <main class="vtp-public vtp-worklist-public">
   <section class="vtp-hero"><div class="vtp-hero-inner"><img class="vtp-logo" src="<?php echo esc_url(VTP_URL.'assets/tus-mingolsheim-logo.png'); ?>" alt="TuS Mingolsheim"><div><div class="vtp-kicker">Schichten / Mitbringen<?php echo $group_filter!==''?' · '.esc_html($group_filter):''; ?></div><h1><?php echo esc_html($event->name); ?></h1><p>Trage dich für eine Helferschicht ein oder übernimm einen Teil der Mitbringliste.</p></div></div></section>
   <?php if(!empty($_GET['danke'])): ?><section class="vtp-section"><p><strong>Danke! Deine Rückmeldung wurde gespeichert.</strong></p></section><?php endif; ?>
   <section class="vtp-section">
    <h2><?php echo $group_filter!==''?'Plan für '.esc_html($group_filter):'Gesamtübersicht nach Mannschaft / Gruppe'; ?></h2>
    <?php if(!$groups): ?><p>Aktuell sind keine Schichten oder Mitbring-Einträge hinterlegt.</p><?php endif; ?>
    <?php foreach($groups as $group=>$items): ?>
     <section class="vtp-worklist-group">
      <div class="vtp-worklist-group-head"><h3><?php echo esc_html($group); ?></h3>
       <?php if($admin && $group_filter==='' && $group!=='Nicht zugeordnet'): ?><a class="vtp-worklist-share" href="<?php echo esc_url(self::teamwork_url($event,$group)); ?>">Link für <?php echo esc_html($group); ?></a><?php endif; ?>
      </div>

      <?php if($items['shifts']): ?><h4>Helferschichten</h4><?php endif; ?>
      <?php foreach($items['shifts'] as $shift):
       $needed=max(1,absint($shift->slots_needed));
       $filled=absint($shift->signups);
       $full=$filled>=$needed;
      ?>
       <article class="vtp-worklist-item <?php echo $full?'is-done':''; ?>">
        <div class="vtp-worklist-item-main">
         <strong><?php echo esc_html($shift->area_name); ?></strong>
         <div class="vtp-worklist-meta"><span><?php echo esc_html(date_i18n('d.m.Y',strtotime($shift->shift_date))); ?></span><span><?php echo esc_html(substr($shift->start_time,0,5).' – '.substr($shift->end_time,0,5).' Uhr'); ?></span><span class="vtp-worklist-state"><?php echo esc_html($filled.' / '.$needed.' belegt'); ?></span></div>
        </div>
        <?php if(!$full): ?>
         <form class="vtp-worklist-feedback-form vtp-worklist-signup" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
          <input type="hidden" name="action" value="vtp_helper_signup"><input type="hidden" name="event_id" value="<?php echo esc_attr($event_id); ?>"><input type="hidden" name="shift_id" value="<?php echo esc_attr($shift->id); ?>">
          <?php if($group_filter!==''): ?><input type="hidden" name="gruppe" value="<?php echo esc_attr($group_filter); ?>"><?php endif; ?>
          <?php wp_nonce_field('vtp_shift_signup_'.absint($shift->id)); ?>
          <input name="name" placeholder="Dein Name" required><input name="contact" placeholder="Telefon / E-Mail (optional)"><button type="submit">Eintragen</button>
         </form>
        <?php endif; ?>
        <?php if($admin): $responses=$wpdb->get_results($wpdb->prepare("SELECT name,contact,created_at FROM $shift_signups WHERE shift_id=%d ORDER BY created_at,id",$shift->id)); if($responses): ?>
         <div class="vtp-worklist-admin-feedback"><strong>Rückmeldungen:</strong><?php foreach($responses as $response): ?><br><?php echo esc_html($response->name); ?><?php echo $response->contact?' · '.esc_html($response->contact):''; ?><?php endforeach; ?></div>
        <?php endif; endif; ?>
       </article>
      <?php endforeach; ?>

      <?php if($items['bring']): ?><h4>Mitbringen</h4><?php endif; ?>
      <?php foreach($items['bring'] as $item):
       $need=(float)$item->quantity;
       $pledged=(float)$item->pledged;
       $remaining=max(0,$need-$pledged);
       $full=$remaining<=0.00001;
      ?>
       <article class="vtp-worklist-item <?php echo $full?'is-done':''; ?>">
        <div class="vtp-worklist-item-main">
         <strong><?php echo esc_html($item->item_name); ?></strong>
         <div class="vtp-worklist-meta"><span>Bedarf: <?php echo esc_html(self::format_quantity($need).' '.$item->unit); ?></span><span>Übernommen: <?php echo esc_html(self::format_quantity($pledged).' '.$item->unit); ?></span><span class="vtp-worklist-state"><?php echo $full?'Erledigt':esc_html('Noch '.self::format_quantity($remaining).' '.$item->unit); ?></span></div>
         <?php if($item->note): ?><p class="vtp-worklist-note"><?php echo esc_html($item->note); ?></p><?php endif; ?>
        </div>
        <?php if(!$full): ?>
         <form class="vtp-worklist-feedback-form vtp-worklist-signup" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
          <input type="hidden" name="action" value="vtp_bring_signup"><input type="hidden" name="event_id" value="<?php echo esc_attr($event_id); ?>"><input type="hidden" name="catering_item_id" value="<?php echo esc_attr($item->id); ?>">
          <?php if($group_filter!==''): ?><input type="hidden" name="gruppe" value="<?php echo esc_attr($group_filter); ?>"><?php endif; ?>
          <?php wp_nonce_field('vtp_bring_signup_'.absint($item->id)); ?>
          <input name="name" placeholder="Dein Name" required><input type="number" name="quantity" min="0.01" step="0.01" max="<?php echo esc_attr($remaining); ?>" value="<?php echo esc_attr(min(1,$remaining)); ?>" required><span class="vtp-worklist-unit"><?php echo esc_html($item->unit); ?></span><input name="contact" placeholder="Telefon / E-Mail (optional)"><button type="submit">Übernehmen</button>
         </form>
        <?php endif; ?>
        <?php if($admin): $responses=$wpdb->get_results($wpdb->prepare("SELECT name,contact,quantity,created_at FROM $bring_signups WHERE catering_item_id=%d ORDER BY created_at,id",$item->id)); if($responses): ?>
         <div class="vtp-worklist-admin-feedback"><strong>Rückmeldungen:</strong><?php foreach($responses as $response): ?><br><?php echo esc_html($response->name.' · '.self::format_quantity($response->quantity).' '.$item->unit); ?><?php echo $response->contact?' · '.esc_html($response->contact):''; ?><?php endforeach; ?></div>
        <?php endif; endif; ?>
       </article>
      <?php endforeach; ?>
     </section>
    <?php endforeach; ?>
   </section>
  </main>
  <?php return ob_get_clean();
 }

 public static function task_feedback(){
  self::ensure_schema();
  $event_id=absint($_POST['event_id']??0);
  $task_id=absint($_POST['task_id']??0);
  if(!$event_id || !$task_id) wp_die('Ungültige Aufgabe.');
  check_admin_referer('vtp_task_feedback_'.$task_id);

  global $wpdb;
  $tasks=VTP_DB::table('event_tasks');
  $task=$wpdb->get_row($wpdb->prepare("SELECT * FROM $tasks WHERE id=%d AND event_id=%d",$task_id,$event_id));
  if(!$task) wp_die('Aufgabe nicht gefunden.');

  $status=sanitize_key(wp_unslash($_POST['feedback_status']??''));
  if(!in_array($status,['acknowledged','done'],true)) wp_die('Ungültiger Status.');
  $name=sanitize_text_field(wp_unslash($_POST['responder_name']??''));
  if($name==='') wp_die('Bitte einen Namen angeben.');
  $note=sanitize_textarea_field(wp_unslash($_POST['feedback_note']??''));
  $table=self::task_feedback_table();
  $now=current_time('mysql');
  $existing=absint($wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE task_id=%d",$task_id)));
  $data=['event_id'=>$event_id,'task_id'=>$task_id,'responder_name'=>$name,'feedback_status'=>$status,'note'=>$note?:null,'updated_at'=>$now];
  $wpdb->query('START TRANSACTION');
  if($existing) $result=$wpdb->update($table,$data,['id'=>$existing]);
  else { $data['created_at']=$now; $result=$wpdb->insert($table,$data); }
  if($result===false){ $wpdb->query('ROLLBACK'); wp_die('Die Rückmeldung konnte nicht gespeichert werden.'); }
  if($status==='done'){
   $result=$wpdb->update($tasks,['status'=>'done','updated_at'=>$now],['id'=>$task_id,'event_id'=>$event_id]);
   if($result===false){ $wpdb->query('ROLLBACK'); wp_die('Die Rückmeldung konnte nicht vollständig gespeichert werden.'); }
  }
  $wpdb->query('COMMIT');

  $event=self::event($event_id);
  $person=sanitize_text_field(wp_unslash($_POST['person']??''));
  $url=self::tasks_url($event,$person);
  wp_safe_redirect(add_query_arg('danke','aufgabe',$url));
  exit;
 }

 public static function shift_signup(){
  $event_id=absint($_POST['event_id']??0);
  $shift_id=absint($_POST['shift_id']??0);
  if(!$event_id || !$shift_id) wp_die('Ungültige Schicht.');
  check_admin_referer('vtp_shift_signup_'.$shift_id);

  global $wpdb;
  $shifts=VTP_DB::table('shifts');
  $signups=VTP_DB::table('shift_signups');
  $wpdb->query('START TRANSACTION');
  $shift=$wpdb->get_row($wpdb->prepare(
   "SELECT * FROM $shifts WHERE id=%d FOR UPDATE",
   $shift_id
  ));
  if(!$shift || absint($shift->event_id)!==$event_id){ $wpdb->query('ROLLBACK'); wp_die('Schicht nicht gefunden.'); }
  $signup_count=(int)$wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $signups WHERE shift_id=%d",$shift_id));
  if($signup_count>=max(1,absint($shift->slots_needed))){ $wpdb->query('ROLLBACK'); wp_die('Diese Schicht ist leider bereits voll.'); }

  $name=sanitize_text_field(wp_unslash($_POST['name']??''));
  if($name===''){ $wpdb->query('ROLLBACK'); wp_die('Bitte einen Namen angeben.'); }
  $contact=sanitize_text_field(wp_unslash($_POST['contact']??''));
  $result=$wpdb->insert($signups,['shift_id'=>$shift_id,'name'=>$name,'contact'=>$contact?:null,'created_at'=>current_time('mysql')]);
  if($result===false){ $wpdb->query('ROLLBACK'); wp_die('Die Anmeldung konnte nicht gespeichert werden.'); }
  $wpdb->query('COMMIT');

  $event=self::event($event_id);
  $group=sanitize_text_field(wp_unslash($_POST['gruppe']??''));
  $url=self::teamwork_url($event,$group);
  wp_safe_redirect(add_query_arg('danke','schicht',$url));
  exit;
 }

 public static function bring_signup(){
  self::ensure_schema();
  $event_id=absint($_POST['event_id']??0);
  $item_id=absint($_POST['catering_item_id']??0);
  if(!$event_id || !$item_id) wp_die('Ungültiger Mitbring-Eintrag.');
  check_admin_referer('vtp_bring_signup_'.$item_id);

  global $wpdb;
  $catering=VTP_DB::table('event_catering_items');
  $table=self::bring_signup_table();
  $wpdb->query('START TRANSACTION');
  $item=$wpdb->get_row($wpdb->prepare("SELECT * FROM $catering WHERE id=%d AND event_id=%d AND category='bring' FOR UPDATE",$item_id,$event_id));
  if(!$item){ $wpdb->query('ROLLBACK'); wp_die('Mitbring-Eintrag nicht gefunden.'); }

  $pledged=(float)$wpdb->get_var($wpdb->prepare("SELECT COALESCE(SUM(quantity),0) FROM $table WHERE catering_item_id=%d",$item_id));
  $remaining=max(0,(float)$item->quantity-$pledged);
  $raw_quantity=str_replace(',','.',sanitize_text_field(wp_unslash($_POST['quantity']??'')));
  if(!is_numeric($raw_quantity) || (float)$raw_quantity<=0){ $wpdb->query('ROLLBACK'); wp_die('Bitte eine gültige Menge angeben.'); }
  $quantity=round((float)$raw_quantity,2);
  if($quantity>$remaining+0.00001){ $wpdb->query('ROLLBACK'); wp_die('Die angegebene Menge ist größer als der noch offene Bedarf.'); }

  $name=sanitize_text_field(wp_unslash($_POST['name']??''));
  if($name===''){ $wpdb->query('ROLLBACK'); wp_die('Bitte einen Namen angeben.'); }
  $contact=sanitize_text_field(wp_unslash($_POST['contact']??''));
  $result=$wpdb->insert($table,['event_id'=>$event_id,'catering_item_id'=>$item_id,'name'=>$name,'contact'=>$contact?:null,'quantity'=>$quantity,'created_at'=>current_time('mysql')]);
  if($result===false){ $wpdb->query('ROLLBACK'); wp_die('Die Zusage konnte nicht gespeichert werden.'); }
  $wpdb->query('COMMIT');

  $event=self::event($event_id);
  $group=sanitize_text_field(wp_unslash($_POST['gruppe']??''));
  $url=self::teamwork_url($event,$group);
  wp_safe_redirect(add_query_arg('danke','mitbringen',$url));
  exit;
 }
}
