<?php
if (!defined('ABSPATH')) exit;

class VTP_Event_Create_UI {
 const SPONSOR_SCHEMA_VERSION = '1';

 public static function init(){
  add_action('admin_menu',[__CLASS__,'replace_events_page'],99);
  add_action('admin_enqueue_scripts',[__CLASS__,'assets']);

  remove_action('admin_post_vtp_save_event',[VTP_Plugin::instance(),'save_event']);
  add_action('admin_post_vtp_save_event',[__CLASS__,'save_event']);

  self::ensure_sponsor_schema();
 }

 public static function replace_events_page(){
  $hook=get_plugin_page_hookname('vtp-events','vtp-dashboard');
  if(!$hook) return;
  remove_action($hook,[VTP_Plugin::instance(),'events_page']);
  add_action($hook,[__CLASS__,'render_page']);
 }

 public static function assets($hook){
  if(($_GET['page']??'')!=='vtp-events') return;
  wp_enqueue_media();
  wp_enqueue_style('vtp-event-create',VTP_URL.'assets/event-create.css',['vtp-admin'],VTP_VERSION);
  wp_enqueue_script('vtp-event-create',VTP_URL.'assets/event-create.js',['jquery'],VTP_VERSION,true);
 }

 private static function sponsor_table(){
  return VTP_DB::table('event_sponsors');
 }

 private static function ensure_sponsor_schema(){
  if(get_option('vtp_event_sponsor_schema_version')===self::SPONSOR_SCHEMA_VERSION) return;

  global $wpdb;
  require_once ABSPATH.'wp-admin/includes/upgrade.php';
  $c=$wpdb->get_charset_collate();
  $table=self::sponsor_table();

  dbDelta("CREATE TABLE $table (
   id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   event_id BIGINT UNSIGNED NOT NULL,
   name VARCHAR(191) NOT NULL,
   logo_attachment_id BIGINT UNSIGNED NULL,
   homepage_url VARCHAR(255) NULL,
   sort_order INT NOT NULL DEFAULT 0,
   created_at DATETIME NOT NULL,
   updated_at DATETIME NOT NULL,
   PRIMARY KEY (id),
   KEY event_id (event_id),
   KEY sort_order (sort_order)
  ) $c;");

  self::migrate_legacy_sponsors();
  update_option('vtp_event_sponsor_schema_version',self::SPONSOR_SCHEMA_VERSION,false);
 }

 private static function migrate_legacy_sponsors(){
  global $wpdb;
  $events=VTP_DB::table('events');
  $table=self::sponsor_table();
  $rows=$wpdb->get_results("SELECT id,sponsors FROM $events WHERE sponsors IS NOT NULL AND sponsors<>''");
  $now=current_time('mysql');

  foreach($rows?:[] as $event){
   $existing=(int)$wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table WHERE event_id=%d",$event->id));
   if($existing>0) continue;

   $order=0;
   foreach(preg_split('/\r\n|\r|\n/',(string)$event->sponsors) as $line){
    $parts=array_map('trim',explode('|',$line));
    $name=sanitize_text_field($parts[0]??'');
    $logo_url=esc_url_raw($parts[1]??'');
    $homepage=esc_url_raw($parts[2]??'');
    if($name==='' && $logo_url==='' && $homepage==='') continue;
    $attachment_id=$logo_url ? absint(attachment_url_to_postid($logo_url)) : 0;
    $wpdb->insert($table,[
     'event_id'=>absint($event->id),
     'name'=>$name,
     'logo_attachment_id'=>$attachment_id ?: null,
     'homepage_url'=>$homepage,
     'sort_order'=>$order++,
     'created_at'=>$now,
     'updated_at'=>$now,
    ]);
   }
  }
 }

 public static function render_page(){
  $edit=absint($_GET['edit_event']??0);
  $view=sanitize_key($_GET['view']??($edit?'active':'active'));

  if($edit || in_array($view,['active','archive'],true)){
   VTP_Plugin::instance()->events_page();
   return;
  }

  if($view==='templates'){
   self::render_templates_placeholder();
   return;
  }

  self::render_new_event();
 }

 private static function render_nav($active){
  $items=[
   'new'=>['neues Event','admin.php?page=vtp-events&view=new'],
   'active'=>['aktive Events','admin.php?page=vtp-events&view=active'],
   'templates'=>['Vorlagen','admin.php?page=vtp-events&view=templates'],
   'archive'=>['Archiv','admin.php?page=vtp-events&view=archive'],
  ];
  echo '<nav class="vtp-event-create-nav" aria-label="Event-Bereiche">';
  foreach($items as $key=>$item){
   $classes='button vtp-event-nav-button'.($active===$key?' is-active':'');
   echo '<a class="'.esc_attr($classes).'" href="'.esc_url(admin_url($item[1])).'">'.esc_html($item[0]).'</a>';
  }
  echo '</nav>';
 }

 private static function render_templates_placeholder(){
  echo '<div class="wrap vtp vtp-modern vtp-event-create-page">';
  echo '<h1>Events: Vorlagen</h1><p class="description vtp-event-create-subtitle">Wiederkehrende Veranstaltungen sollen künftig aus vorbereiteten Vorlagen angelegt werden.</p>';
  self::render_nav('templates');
  echo '<div class="vtp-card vtp-wide"><h2>Vorlagen</h2><p class="vtp-event-empty">Noch keine Event-Vorlagen vorhanden. Die persistente Template-Logik wird in einem eigenen Ausbauschritt umgesetzt.</p></div>';
  echo '</div>';
 }

 private static function render_new_event(){
  echo '<div class="wrap vtp vtp-modern vtp-event-create-page">';
  echo '<h1>Events: Neue TuS Veranstaltungen anlegen</h1>';
  echo '<p class="description vtp-event-create-subtitle">Veranstaltungen können aus Vorlagen oder komplett neu angelegt werden</p>';
  self::render_nav('new');

  echo '<form class="vtp-event-create-form" method="post" action="'.esc_url(admin_url('admin-post.php')).'">';
  wp_nonce_field('vtp_save_event');
  echo '<input type="hidden" name="action" value="vtp_save_event"><input type="hidden" name="id" value="0">';

  echo '<section class="vtp-card vtp-event-create-card">';
  echo '<div class="vtp-event-create-head"><h2>Neues Event anlegen</h2><label class="vtp-template-picker"><span>Veranstaltung aus Vorlage anlegen:</span><select disabled aria-label="Veranstaltung aus Vorlage anlegen"><option>– keine Vorlagen vorhanden –</option></select></label></div>';

  echo '<div class="vtp-event-data-box"><h3>Veranstaltungsdaten</h3><div class="vtp-event-data-grid">';
  echo '<div class="vtp-event-data-column">';
  self::field('Veranstaltungsname','name','','text',true);
  self::field('Startdatum','start_date','','date');
  self::field('Enddatum','end_date','','date');
  self::field('Veranstaltungsort','location','','text');
  echo '</div>';
  echo '<div class="vtp-event-data-column">';
  echo '<label class="vtp-event-field"><span>Veranstaltungsbeschreibung</span><textarea name="description" rows="6"></textarea></label>';
  self::field('zusätzlicher Link zur Veranstaltung','content_url','','url');
  echo '<label class="vtp-event-calendar"><span>Veranstaltung im öffentlichen Kalender anzeigen?</span><span class="vtp-checkbox-line"><input type="checkbox" name="calendar_visible" value="1" checked> <span>im öffentlichen Veranstaltungskalender anzeigen</span></span></label>';
  echo '</div></div></div>';
  echo '</section>';

  echo '<section class="vtp-card vtp-event-sponsors-card"><div class="vtp-event-sponsor-box">';
  echo '<h2>Sponsorenübersicht</h2>';
  echo '<button type="button" class="button vtp-add-sponsor" data-action="add-sponsor"><span class="dashicons dashicons-plus-alt2" aria-hidden="true"></span> Neuen Sponsor hinzufügen</button>';
  echo '<div class="vtp-sponsor-list" data-sponsor-list>';
  self::render_sponsor_row(0);
  echo '</div>';
  echo '<template id="vtp-sponsor-row-template">'; self::render_sponsor_row('__INDEX__'); echo '</template>';
  echo '</div>';
  echo '<p class="submit"><button type="submit" class="button button-primary vtp-event-submit">Event anlegen</button></p>';
  echo '</section>';

  echo '</form></div>';
 }

 private static function field($label,$name,$value='',$type='text',$required=false){
  echo '<label class="vtp-event-field"><span>'.esc_html($label).'</span><input type="'.esc_attr($type).'" name="'.esc_attr($name).'" value="'.esc_attr($value).'" '.($required?'required':'').'></label>';
 }

 private static function render_sponsor_row($index){
  $suffix=is_numeric($index)?(string)$index:'__INDEX__';
  echo '<div class="vtp-sponsor-row" data-sponsor-row>';
  echo '<label><span>Name</span><input type="text" name="sponsor_name[]" autocomplete="organization"></label>';
  echo '<label class="vtp-sponsor-logo-field"><span>Logo</span><input type="hidden" name="sponsor_logo_id[]" value="" data-logo-id><button type="button" class="button vtp-sponsor-media-button" aria-label="Sponsorlogo auswählen"><span class="dashicons dashicons-upload" aria-hidden="true"></span><span data-logo-label>Logo auswählen</span></button></label>';
  echo '<label><span>Link zur Homepage</span><input type="url" name="sponsor_url[]" placeholder="https://"></label>';
  echo '<div class="vtp-sponsor-actions"><button type="button" class="button-link-delete vtp-remove-sponsor" aria-label="Sponsor entfernen" title="Sponsor entfernen"><span class="dashicons dashicons-trash" aria-hidden="true"></span></button></div>';
  echo '</div>';
 }

 private static function verify(){
  if(!current_user_can('manage_options') || !check_admin_referer('vtp_save_event')) wp_die('Nicht erlaubt.');
 }

 private static function collect_sponsors(){
  $items=[];
  if(isset($_POST['sponsor_name']) && is_array($_POST['sponsor_name'])){
   $names=(array)$_POST['sponsor_name'];
   $logos=(array)($_POST['sponsor_logo_id']??[]);
   $urls=(array)($_POST['sponsor_url']??[]);
   foreach($names as $i=>$raw_name){
    $name=sanitize_text_field(wp_unslash($raw_name));
    $logo_id=absint($logos[$i]??0);
    $url=esc_url_raw(wp_unslash($urls[$i]??''));
    if($name==='' && !$logo_id && $url==='') continue;
    $items[]=['name'=>$name,'logo_attachment_id'=>$logo_id,'homepage_url'=>$url];
   }
   return $items;
  }

  foreach(preg_split('/\r\n|\r|\n/',sanitize_textarea_field(wp_unslash($_POST['sponsors']??''))) as $line){
   $parts=array_map('trim',explode('|',$line));
   $name=sanitize_text_field($parts[0]??'');
   $logo_url=esc_url_raw($parts[1]??'');
   $url=esc_url_raw($parts[2]??'');
   if($name==='' && $logo_url==='' && $url==='') continue;
   $items[]=['name'=>$name,'logo_attachment_id'=>$logo_url?absint(attachment_url_to_postid($logo_url)):0,'homepage_url'=>$url];
  }
  return $items;
 }

 private static function legacy_sponsor_value($sponsors){
  $lines=[];
  foreach($sponsors as $sponsor){
   $logo_url=$sponsor['logo_attachment_id'] ? wp_get_attachment_url($sponsor['logo_attachment_id']) : '';
   $lines[]=implode('|',[
    str_replace(["\r","\n",'|'],' ',(string)$sponsor['name']),
    esc_url_raw($logo_url?:''),
    esc_url_raw($sponsor['homepage_url']??''),
   ]);
  }
  return implode("\n",$lines);
 }

 private static function save_sponsors($event_id,$sponsors){
  global $wpdb;
  $table=self::sponsor_table();
  $wpdb->delete($table,['event_id'=>$event_id]);
  $now=current_time('mysql');
  foreach($sponsors as $order=>$sponsor){
   $ok=$wpdb->insert($table,[
    'event_id'=>$event_id,
    'name'=>$sponsor['name'],
    'logo_attachment_id'=>$sponsor['logo_attachment_id']?:null,
    'homepage_url'=>$sponsor['homepage_url'],
    'sort_order'=>$order,
    'created_at'=>$now,
    'updated_at'=>$now,
   ]);
   if($ok===false) return false;
  }
  return true;
 }

 private static function unique_event_slug($name,$event_id=0){
  global $wpdb;
  $table=VTP_DB::table('events');
  $base=sanitize_title($name);
  if($base==='') $base='event';
  $base=substr($base,0,180);
  $slug=$base;
  $suffix=2;
  $event_id=absint($event_id);

  while(true){
   if($event_id){
    $existing=(int)$wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE slug=%s AND id<>%d LIMIT 1",$slug,$event_id));
   } else {
    $existing=(int)$wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE slug=%s LIMIT 1",$slug));
   }
   if(!$existing) return $slug;
   $slug=$base.'-'.$suffix++;
  }
 }

 public static function save_event(){
  self::verify();
  global $wpdb;

  $id=absint($_POST['id']??0);
  $name=sanitize_text_field(wp_unslash($_POST['name']??''));
  if($name==='') wp_die('Bitte einen Veranstaltungsnamen angeben.');

  $sponsors=self::collect_sponsors();
  $now=current_time('mysql');
  $data=[
   'name'=>$name,
   'slug'=>self::unique_event_slug($name,$id),
   'description'=>sanitize_textarea_field(wp_unslash($_POST['description']??'')),
   'location'=>sanitize_text_field(wp_unslash($_POST['location']??'')),
   'sponsors'=>self::legacy_sponsor_value($sponsors),
   'calendar_visible'=>!empty($_POST['calendar_visible'])?1:0,
   'content_url'=>esc_url_raw(wp_unslash($_POST['content_url']??'')),
   'start_date'=>sanitize_text_field(wp_unslash($_POST['start_date']??'')),
   'end_date'=>sanitize_text_field(wp_unslash($_POST['end_date']??'')),
   'updated_at'=>$now,
  ];

  $wpdb->query('START TRANSACTION');
  if($id){
   $ok=$wpdb->update(VTP_DB::table('events'),$data,['id'=>$id]);
   if($ok===false){ $wpdb->query('ROLLBACK'); wp_die('Event konnte nicht gespeichert werden.'); }
  } else {
   $data['created_at']=$now;
   $data['status']='aktiv';
   $ok=$wpdb->insert(VTP_DB::table('events'),$data);
   if($ok===false){ $wpdb->query('ROLLBACK'); wp_die('Event konnte nicht angelegt werden.'); }
   $id=absint($wpdb->insert_id);
  }

  if(!self::save_sponsors($id,$sponsors)){
   $wpdb->query('ROLLBACK');
   wp_die('Die Sponsoren konnten nicht dauerhaft gespeichert werden.');
  }
  $wpdb->query('COMMIT');

  self::ensure_event_pages($id);
  wp_safe_redirect(add_query_arg(['page'=>'vtp-events','edit_event'=>$id,'saved'=>1],admin_url('admin.php')));
  exit;
 }

 private static function ensure_event_pages($id){
  global $wpdb;
  $e=$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('events').' WHERE id=%d',$id));
  if(!$e) return;
  foreach([
   'public_page_id'=>[$e->name,'[verein_event id="'.$id.'"]'],
   'helper_page_id'=>['Helfer Anmeldung: '.$e->name,'[verein_helferplan id="'.$id.'"]'],
  ] as $field=>$cfg){
   $pid=absint($e->$field);
   $post=['post_title'=>$cfg[0],'post_name'=>sanitize_title($cfg[0]),'post_content'=>$cfg[1],'post_status'=>'publish','post_type'=>'page'];
   if($pid && get_post($pid)){
    $post['ID']=$pid;
    wp_update_post($post);
   } else {
    $pid=wp_insert_post($post);
    if($pid && !is_wp_error($pid)) $wpdb->update(VTP_DB::table('events'),[$field=>$pid],['id'=>$id]);
   }
  }
 }
}
