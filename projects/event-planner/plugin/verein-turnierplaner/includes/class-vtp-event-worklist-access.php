<?php
if (!defined('ABSPATH')) exit;

class VTP_Event_Worklist_Access {
 const COOKIE_HOURS=8;
 private static $grant_admin_cap=false;

 public static function init(){
  self::ensure_schema();
  add_action('admin_enqueue_scripts',[__CLASS__,'admin_assets'],30);
  add_action('admin_post_vtp_save_worklist_pin',[__CLASS__,'save_pin']);
  add_action('wp_ajax_vtp_reveal_worklist_pin',[__CLASS__,'ajax_reveal_pin']);
  add_action('admin_post_nopriv_vtp_worklist_pin_login',[__CLASS__,'pin_login']);
  add_action('admin_post_vtp_worklist_pin_login',[__CLASS__,'pin_login']);
  add_action('template_redirect',[__CLASS__,'protect_query_pages'],8);
  add_filter('pre_do_shortcode_tag',[__CLASS__,'protect_shortcodes'],10,4);
  add_filter('user_has_cap',[__CLASS__,'temporary_admin_cap'],10,4);
 }

 private static function table(){ return VTP_DB::table('event_worklist_access'); }

 private static function ensure_schema(){
  global $wpdb;
  $table=self::table();
  if($wpdb->get_var($wpdb->prepare('SHOW TABLES LIKE %s',$table))===$table) return;
  require_once ABSPATH.'wp-admin/includes/upgrade.php';
  $c=$wpdb->get_charset_collate();
  dbDelta("CREATE TABLE $table (
   event_id BIGINT UNSIGNED NOT NULL,
   pin_hash VARCHAR(255) NOT NULL,
   updated_at DATETIME NOT NULL,
   PRIMARY KEY (event_id)
  ) $c;");
 }


 private static function encrypted_pin_option($event_id){
  return 'vtp_worklist_pin_encrypted_'.absint($event_id);
 }

 private static function encrypt_pin($event_id,$pin){
  if(!function_exists('openssl_encrypt') || !function_exists('random_bytes')) return false;
  try {
   $iv=random_bytes(12);
   $tag='';
   $key=hash('sha256',wp_salt('auth').'|vtp-worklist-pin|'.absint($event_id),true);
   $ciphertext=openssl_encrypt((string)$pin,'aes-256-gcm',$key,OPENSSL_RAW_DATA,$iv,$tag);
   if($ciphertext===false) return false;
   return base64_encode($iv.$tag.$ciphertext);
  } catch(Throwable $e){ return false; }
 }

 private static function decrypt_pin($event_id){
  if(!function_exists('openssl_decrypt')) return '';
  $encoded=get_option(self::encrypted_pin_option($event_id),'');
  if(!is_string($encoded) || $encoded==='') return '';
  $data=base64_decode($encoded,true);
  if($data===false || strlen($data)<29) return '';
  $iv=substr($data,0,12);
  $tag=substr($data,12,16);
  $ciphertext=substr($data,28);
  $key=hash('sha256',wp_salt('auth').'|vtp-worklist-pin|'.absint($event_id),true);
  $pin=openssl_decrypt($ciphertext,'aes-256-gcm',$key,OPENSSL_RAW_DATA,$iv,$tag);
  if(!is_string($pin) || !preg_match('/^\d{4,8}$/',$pin)) return '';
  // Do not reveal a stale value if the hash has been independently changed.
  return wp_check_password($pin,self::pin_hash($event_id)) ? $pin : '';
 }

 public static function ajax_reveal_pin(){
  if(!current_user_can('manage_options')) wp_send_json_error(['message'=>'Nicht berechtigt.'],403);
  $event_id=absint($_POST['event_id']??0);
  if(!$event_id || !check_ajax_referer('vtp_reveal_worklist_pin_'.$event_id,'nonce',false)){
   wp_send_json_error(['message'=>'Ungültige Anfrage.'],403);
  }
  nocache_headers();
  $pin=self::decrypt_pin($event_id);
  if($pin==='') wp_send_json_error(['message'=>'Die bisherige PIN kann nicht angezeigt werden. Bitte einmalig einen neuen PIN setzen.'],404);
  wp_send_json_success(['pin'=>$pin]);
 }

 public static function initialize_pin($event_id,$pin){
  $event_id=absint($event_id);
  if(!$event_id || !current_user_can('manage_options') || !preg_match('/^\\d{8}$/',(string)$pin)) return false;
  global $wpdb;
  self::ensure_schema();
  // An existing PIN must never be overwritten by automatic initialization.
  if(self::pin_is_set($event_id)) return true;
  $sealed=self::encrypt_pin($event_id,$pin);
  if($sealed===false) return false;
  $result=$wpdb->query($wpdb->prepare(
   'INSERT IGNORE INTO '.self::table().' (event_id,pin_hash,updated_at) VALUES (%d,%s,%s)',
   $event_id,wp_hash_password((string)$pin),current_time('mysql')
  ));
  if($result!==1) return self::pin_is_set($event_id);
  update_option(self::encrypted_pin_option($event_id),$sealed,false);
  return true;
 }

 public static function pin_is_set($event_id){
  global $wpdb;
  self::ensure_schema();
  return (bool)$wpdb->get_var($wpdb->prepare('SELECT pin_hash FROM '.self::table().' WHERE event_id=%d',absint($event_id)));
 }

 private static function pin_hash($event_id){
  global $wpdb;
  self::ensure_schema();
  return (string)$wpdb->get_var($wpdb->prepare('SELECT pin_hash FROM '.self::table().' WHERE event_id=%d',absint($event_id)));
 }

 public static function admin_assets($hook){
  if(($_GET['page']??'')!=='vtp-events') return;
  $event_id=absint($_GET['edit_event']??0);
  if(!$event_id) return;
  if(!wp_script_is('vtp-event-public-worklists-admin','enqueued')) return;
  wp_localize_script('vtp-event-public-worklists-admin','VTPWorklistAccess',[
   'eventId'=>$event_id,
   'configured'=>self::pin_is_set($event_id),
   'actionUrl'=>admin_url('admin-post.php'),
   'nonce'=>wp_create_nonce('vtp_save_worklist_pin_'.$event_id),
   'saved'=>!empty($_GET['worklist_pin_saved']),
   'ajaxUrl'=>admin_url('admin-ajax.php'),
   'revealNonce'=>wp_create_nonce('vtp_reveal_worklist_pin_'.$event_id),
  ]);
 }

 public static function save_pin(){
  $event_id=absint($_POST['event_id']??0);
  if(!$event_id || !current_user_can('manage_options')) wp_die('Nicht erlaubt.');
  check_admin_referer('vtp_save_worklist_pin_'.$event_id);

  $pin=preg_replace('/\D+/','',wp_unslash($_POST['worklist_pin']??''));
  if(!preg_match('/^\d{4,8}$/',$pin)) wp_die('Der PIN muss aus 4 bis 8 Ziffern bestehen.');

  global $wpdb;
  self::ensure_schema();
  $table=self::table();
  $sealed=self::encrypt_pin($event_id,$pin);
  if($sealed===false) wp_die('Sichere PIN-Speicherung ist auf diesem Server nicht verfügbar.');
  $data=['pin_hash'=>wp_hash_password($pin),'updated_at'=>current_time('mysql')];
  $exists=(int)$wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table WHERE event_id=%d",$event_id));
  $ok=$exists ? $wpdb->update($table,$data,['event_id'=>$event_id]) : $wpdb->insert($table,array_merge(['event_id'=>$event_id],$data));
  if($ok===false) wp_die('PIN konnte nicht gespeichert werden.');
  update_option(self::encrypted_pin_option($event_id),$sealed,false);

  $url=add_query_arg(['page'=>'vtp-events','edit_event'=>$event_id,'worklist_pin_saved'=>1],admin_url('admin.php'));
  wp_safe_redirect($url);
  exit;
 }

 private static function cookie_name($event_id){ return 'vtp_worklist_admin_'.absint($event_id); }

 private static function cookie_value($event_id,$expires,$hash){
  $sig=hash_hmac('sha256',absint($event_id).'|'.absint($expires).'|'.$hash,wp_salt('auth'));
  return absint($expires).'.'.$sig;
 }

 private static function set_access_cookie($event_id,$hash){
  $expires=time()+(self::COOKIE_HOURS*HOUR_IN_SECONDS);
  $value=self::cookie_value($event_id,$expires,$hash);
  setcookie(self::cookie_name($event_id),$value,[
   'expires'=>$expires,
   'path'=>COOKIEPATH?:'/',
   'domain'=>COOKIE_DOMAIN?:'',
   'secure'=>is_ssl(),
   'httponly'=>true,
   'samesite'=>'Lax',
  ]);
  $_COOKIE[self::cookie_name($event_id)]=$value;
 }

 private static function cookie_is_valid($event_id,$hash){
  $raw=(string)($_COOKIE[self::cookie_name($event_id)]??'');
  if(!preg_match('/^(\d+)\.([a-f0-9]{64})$/',$raw,$m)) return false;
  $expires=absint($m[1]);
  if($expires<time()) return false;
  return hash_equals(self::cookie_value($event_id,$expires,$hash),$raw);
 }

 public static function has_admin_access($event_id){
  $hash=self::pin_hash($event_id);
  return $hash!=='' && self::cookie_is_valid($event_id,$hash);
 }

 private static function is_filtered($target){
  if($target==='tasks') return trim((string)($_GET['person']??''))!=='';
  return trim((string)($_GET['gruppe']??''))!=='';
 }

 private static function target_url($event_id,$target){
  return $target==='tasks' ? VTP_Event_Public_Worklists::tasks_url($event_id) : VTP_Event_Public_Worklists::teamwork_url($event_id);
 }

 public static function pin_login(){
  $event_id=absint($_POST['event_id']??0);
  $target=sanitize_key(wp_unslash($_POST['target']??''));
  if(!$event_id || !in_array($target,['tasks','teamwork'],true)) wp_die('Ungültige Anfrage.');
  check_admin_referer('vtp_worklist_pin_login_'.$event_id);

  $hash=self::pin_hash($event_id);
  $pin=preg_replace('/\D+/','',wp_unslash($_POST['pin']??''));
  $url=self::target_url($event_id,$target);
  if($hash==='' || !wp_check_password($pin,$hash)){
   wp_safe_redirect(add_query_arg('pin_error','1',$url));
   exit;
  }
  self::set_access_cookie($event_id,$hash);
  wp_safe_redirect($url);
  exit;
 }

 private static function gate($event_id,$target){
  $event=self::event($event_id);
  if(!$event) return '<p>Event nicht gefunden.</p>';
  $configured=self::pin_is_set($event_id);
  ob_start(); ?>
  <main class="vtp-public vtp-worklist-public">
   <section class="vtp-hero"><div class="vtp-hero-inner"><img class="vtp-logo" src="<?php echo esc_url(VTP_URL.'assets/tus-mingolsheim-logo.png'); ?>" alt="TuS Mingolsheim"><div><div class="vtp-kicker">Geschützte Adminübersicht</div><h1><?php echo esc_html($event->name); ?></h1><p><?php echo $target==='tasks'?'Aufgabenliste':'Schichten / Mitbringen'; ?></p></div></div></section>
   <section class="vtp-section vtp-worklist-pin-gate">
    <h2>Admin-PIN erforderlich</h2>
    <?php if(!$configured): ?>
     <p>Für diese Übersicht wurde noch kein Admin-PIN eingerichtet. Bitte den PIN zuerst im Event-Backend setzen.</p>
    <?php else: ?>
     <?php if(!empty($_GET['pin_error'])): ?><p class="vtp-worklist-pin-error"><strong>PIN nicht korrekt.</strong></p><?php endif; ?>
     <p>Diese Gesamtübersicht enthält interne Rückmeldungen. Bitte den Event-Admin-PIN eingeben.</p>
     <form class="vtp-worklist-pin-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
      <input type="hidden" name="action" value="vtp_worklist_pin_login">
      <input type="hidden" name="event_id" value="<?php echo esc_attr($event_id); ?>">
      <input type="hidden" name="target" value="<?php echo esc_attr($target); ?>">
      <?php wp_nonce_field('vtp_worklist_pin_login_'.$event_id); ?>
      <label><span>Admin-PIN</span><input type="password" name="pin" inputmode="numeric" pattern="[0-9]{4,8}" autocomplete="one-time-code" required></label>
      <button type="submit">Übersicht öffnen</button>
     </form>
    <?php endif; ?>
   </section>
  </main>
  <?php return ob_get_clean();
 }

 private static function event($event_id){
  global $wpdb;
  return $wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('events').' WHERE id=%d',absint($event_id)));
 }

 private static function render_as_admin($event_id,$target){
  if(current_user_can('manage_options')) return $target==='tasks' ? VTP_Event_Public_Worklists::render_tasks($event_id) : VTP_Event_Public_Worklists::render_teamwork($event_id);
  self::$grant_admin_cap=true;
  $html=$target==='tasks' ? VTP_Event_Public_Worklists::render_tasks($event_id) : VTP_Event_Public_Worklists::render_teamwork($event_id);
  self::$grant_admin_cap=false;
  return $html;
 }

 public static function temporary_admin_cap($allcaps,$caps,$args,$user){
  if(self::$grant_admin_cap) $allcaps['manage_options']=true;
  return $allcaps;
 }

 public static function protect_query_pages(){
  $task_event=absint(get_query_var('vtp_tasks'));
  $team_event=absint(get_query_var('vtp_helpers'));
  $event_id=$task_event?:$team_event;
  if(!$event_id) return;
  $target=$task_event?'tasks':'teamwork';
  if(self::is_filtered($target)) return;

  status_header(200);
  nocache_headers();
  wp_enqueue_style('vtp-public',VTP_URL.'assets/public.css',['dashicons'],VTP_VERSION);
  wp_enqueue_style('vtp-event-public-worklists',VTP_URL.'assets/event-public-worklists.css',['vtp-public'],VTP_VERSION);
  get_header();
  echo self::has_admin_access($event_id) ? self::render_as_admin($event_id,$target) : self::gate($event_id,$target);
  get_footer();
  exit;
 }

 public static function protect_shortcodes($output,$tag,$attr,$m){
  if(!in_array($tag,['verein_aufgabenliste','verein_helferplan'],true)) return $output;
  $target=$tag==='verein_aufgabenliste'?'tasks':'teamwork';
  if(self::is_filtered($target)) return $output;
  $event_id=absint($attr['id']??0);
  if(!$event_id) return $output;
  wp_enqueue_style('vtp-public',VTP_URL.'assets/public.css',['dashicons'],VTP_VERSION);
  wp_enqueue_style('vtp-event-public-worklists',VTP_URL.'assets/event-public-worklists.css',['vtp-public'],VTP_VERSION);
  return self::has_admin_access($event_id) ? self::render_as_admin($event_id,$target) : self::gate($event_id,$target);
 }
}
