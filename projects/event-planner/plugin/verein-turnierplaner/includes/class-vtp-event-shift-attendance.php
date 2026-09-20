<?php
if (!defined('ABSPATH')) exit;

class VTP_Event_Shift_Attendance {
 const SCHEMA_VERSION='1';
 private static $context_event_id=0;

 public static function init(){
  self::ensure_schema();
  add_action('template_redirect',[__CLASS__,'capture_query_context'],7);
  add_filter('pre_do_shortcode_tag',[__CLASS__,'capture_shortcode_context'],25,4);
  add_action('wp_footer',[__CLASS__,'render_panel'],7);
  add_action('admin_post_vtp_worklist_shift_attendance',[__CLASS__,'save_status']);
  add_action('admin_post_nopriv_vtp_worklist_shift_attendance',[__CLASS__,'save_status']);
 }

 private static function ensure_schema(){
  global $wpdb;
  $table=VTP_DB::table('shift_signups');
  $cols=$wpdb->get_col("DESC $table",0);
  if(!$cols) return;
  $version=(string)get_option('vtp_shift_attendance_schema');
  $has_status=in_array('attendance_status',$cols,true);
  $has_updated=in_array('attendance_updated_at',$cols,true);
  if($version===self::SCHEMA_VERSION && $has_status && $has_updated) return;
  if(!$has_status) $wpdb->query("ALTER TABLE $table ADD attendance_status VARCHAR(30) NOT NULL DEFAULT 'registered' AFTER comment");
  $cols=$wpdb->get_col("DESC $table",0);
  if($cols && !in_array('attendance_updated_at',$cols,true)) $wpdb->query("ALTER TABLE $table ADD attendance_updated_at DATETIME NULL AFTER attendance_status");
  update_option('vtp_shift_attendance_schema',self::SCHEMA_VERSION,false);
 }

 public static function capture_query_context(){
  $event_id=absint(get_query_var('vtp_helpers'));
  if($event_id && trim((string)($_GET['gruppe']??''))==='') self::$context_event_id=$event_id;
 }

 public static function capture_shortcode_context($output,$tag,$attr,$m){
  if($tag!=='verein_helferplan' || trim((string)($_GET['gruppe']??''))!=='') return $output;
  $event_id=absint($attr['id']??0);
  if($event_id) self::$context_event_id=$event_id;
  return $output;
 }

 private static function authorize($event_id){
  $event_id=absint($event_id);
  if(!$event_id || !VTP_Event_Worklist_Access::has_admin_access($event_id)) wp_die('Nicht erlaubt.');
  return $event_id;
 }

 public static function save_status(){
  self::ensure_schema();
  $event_id=self::authorize($_POST['event_id']??0);
  $signup_id=absint($_POST['signup_id']??0);
  $status=sanitize_key(wp_unslash($_POST['attendance_status']??''));
  if(!in_array($status,['registered','no_show'],true)) wp_die('Ungültiger Anwesenheitsstatus.');
  check_admin_referer('vtp_worklist_shift_attendance_'.$event_id.'_'.$signup_id);

  global $wpdb;
  $signups=VTP_DB::table('shift_signups');
  $shifts=VTP_DB::table('shifts');
  $exists=(int)$wpdb->get_var($wpdb->prepare(
   "SELECT COUNT(*) FROM $signups g INNER JOIN $shifts s ON s.id=g.shift_id WHERE g.id=%d AND s.event_id=%d",
   $signup_id,$event_id
  ));
  if(!$exists) wp_die('Schichtanmeldung nicht gefunden.');

  $ok=$wpdb->update($signups,[
   'attendance_status'=>$status,
   'attendance_updated_at'=>current_time('mysql'),
  ],['id'=>$signup_id]);
  if($ok===false) wp_die('Anwesenheitsstatus konnte nicht gespeichert werden.');

  $url=VTP_Event_Public_Worklists::teamwork_url($event_id);
  wp_safe_redirect(add_query_arg('attendance_saved',$status==='no_show'?'no_show':'reset',$url));
  exit;
 }

 public static function render_panel(){
  self::ensure_schema();
  $event_id=absint(self::$context_event_id);
  if(!$event_id || !VTP_Event_Worklist_Access::has_admin_access($event_id)) return;

  global $wpdb;
  $signups=VTP_DB::table('shift_signups');
  $shifts=VTP_DB::table('shifts');
  $rows=$wpdb->get_results($wpdb->prepare(
   "SELECT g.id signup_id,g.name,g.contact,COALESCE(g.attendance_status,'registered') attendance_status,g.attendance_updated_at,
           s.area_name,s.shift_date,s.start_time,s.end_time,s.assigned_group
    FROM $signups g INNER JOIN $shifts s ON s.id=g.shift_id
    WHERE s.event_id=%d
    ORDER BY s.assigned_group,s.shift_date,s.start_time,s.area_name,g.created_at,g.id",
   $event_id
  ));

  $flash=sanitize_key(wp_unslash($_GET['attendance_saved']??''));
  ?>
  <style>
   .vtp-worklist-attendance .vtp-attendance-status{display:inline-flex;align-items:center;min-height:28px;padding:0 9px;border-radius:999px;font-size:12px;font-weight:800;background:#f2f4f7;color:#475467;margin-top:7px}
   .vtp-worklist-attendance .vtp-attendance-status.is-no-show{background:#fff0f0;color:#8a1c1c;border:1px solid #f2b8b8}
   .vtp-worklist-attendance .vtp-worklist-admin-row.is-no-show{border-left:5px solid #dc3232}
   .vtp-worklist-attendance .vtp-attendance-no-show{border-color:#b42318!important;color:#b42318!important;background:#fff!important}
   .vtp-worklist-attendance .vtp-attendance-no-show:hover{background:#fff0f0!important}
  </style>
  <div id="vtp-shift-attendance-management" style="display:none">
   <section class="vtp-section vtp-worklist-admin-management vtp-worklist-attendance">
    <div class="vtp-worklist-admin-head"><div><span class="vtp-worklist-admin-badge">Admin</span><h2>Anwesenheit Helferschichten</h2><p>No-Shows markieren, ohne die ursprüngliche Anmeldung zu löschen. Echte Absagen werden weiterhin über „Anmeldung löschen“ entfernt.</p></div></div>
    <?php if($flash==='no_show'): ?><p class="vtp-worklist-admin-success"><strong>Person wurde als „Nicht erschienen“ markiert.</strong></p><?php elseif($flash==='reset'): ?><p class="vtp-worklist-admin-success"><strong>No-Show-Markierung wurde zurückgesetzt.</strong></p><?php endif; ?>
    <div class="vtp-worklist-admin-list">
     <?php if(!$rows): ?><p>Keine Schichtanmeldungen vorhanden.</p><?php endif; ?>
     <?php foreach($rows?:[] as $row): $no_show=((string)$row->attendance_status==='no_show'); ?>
      <div class="vtp-worklist-admin-row <?php echo $no_show?'is-no-show':''; ?>">
       <div>
        <strong><?php echo esc_html($row->name); ?></strong>
        <div class="vtp-worklist-admin-meta"><?php echo esc_html($row->assigned_group?:'Nicht zugeordnet'); ?> · <?php echo esc_html($row->area_name); ?> · <?php echo esc_html(date_i18n('d.m.Y',strtotime($row->shift_date)).' '.substr($row->start_time,0,5).'–'.substr($row->end_time,0,5).' Uhr'); ?><?php if($row->contact): ?> · <?php echo esc_html($row->contact); ?><?php endif; ?></div>
        <span class="vtp-attendance-status <?php echo $no_show?'is-no-show':''; ?>"><?php echo $no_show?'Nicht erschienen':'Angemeldet'; ?></span>
       </div>
       <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
        <input type="hidden" name="action" value="vtp_worklist_shift_attendance">
        <input type="hidden" name="event_id" value="<?php echo esc_attr($event_id); ?>">
        <input type="hidden" name="signup_id" value="<?php echo esc_attr($row->signup_id); ?>">
        <input type="hidden" name="attendance_status" value="<?php echo $no_show?'registered':'no_show'; ?>">
        <?php wp_nonce_field('vtp_worklist_shift_attendance_'.$event_id.'_'.absint($row->signup_id)); ?>
        <?php if($no_show): ?>
         <button type="submit" class="vtp-worklist-admin-secondary">Markierung zurücksetzen</button>
        <?php else: ?>
         <button type="submit" class="vtp-worklist-admin-secondary vtp-attendance-no-show" onclick="return confirm('Diese Person wirklich als nicht erschienen markieren? Die Anmeldung bleibt zur Dokumentation erhalten.')">Nicht erschienen</button>
        <?php endif; ?>
       </form>
      </div>
     <?php endforeach; ?>
    </div>
   </section>
  </div>
  <script>(function(){var p=document.getElementById('vtp-shift-attendance-management'),m=document.querySelector('main.vtp-worklist-public');if(!p||!m)return;p.style.display='block';m.appendChild(p);})();</script>
  <?php
 }
}
