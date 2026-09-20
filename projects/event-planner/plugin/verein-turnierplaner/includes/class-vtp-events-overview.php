<?php
if (!defined('ABSPATH')) exit;

class VTP_Events_Overview {
 public static function init(){
  add_action('admin_menu',[__CLASS__,'replace_events_page'],100);
  add_action('admin_enqueue_scripts',[__CLASS__,'assets']);
 }

 public static function replace_events_page(){
  $hook=get_plugin_page_hookname('vtp-events','vtp-dashboard');
  if(!$hook) return;
  remove_action($hook,[VTP_Event_Create_UI::class,'render_page']);
  add_action($hook,[__CLASS__,'render_page']);
 }

 public static function assets($hook){
  if(($_GET['page']??'')!=='vtp-events') return;
  wp_enqueue_style('vtp-events-overview',VTP_URL.'assets/events-overview.css',['vtp-event-create'],VTP_VERSION);
 }

 public static function render_page(){
  $edit=absint($_GET['edit_event']??0);
  $view=sanitize_key($_GET['view']??($edit?'active':'active'));

  if($edit){
   VTP_Event_Create_UI::render_page();
   return;
  }

  if($view==='active'){
   self::render_overview();
   return;
  }

  if($view==='archive'){
   self::render_archive();
   return;
  }

  VTP_Event_Create_UI::render_page();
 }

 private static function render_nav($active=''){
  $items=[
   ['key'=>'new','label'=>'neues Event','url'=>admin_url('admin.php?page=vtp-events&view=new'),'external'=>false],
   ['key'=>'calendar','label'=>'Veranstaltungskalender','url'=>VTP_Public::calendar_url(),'external'=>true],
   ['key'=>'templates','label'=>'Vorlagen','url'=>admin_url('admin.php?page=vtp-events&view=templates'),'external'=>false],
   ['key'=>'archive','label'=>'Archiv','url'=>admin_url('admin.php?page=vtp-events&view=archive'),'external'=>false],
  ];
  echo '<nav class="vtp-event-create-nav" aria-label="Event-Bereiche">';
  foreach($items as $item){
   $target=$item['external']?' target="_blank" rel="noopener noreferrer"':'';
   $active_class=$active===$item['key']?' is-active':'';
   echo '<a class="button vtp-event-nav-button'.esc_attr($active_class).'"'.$target.' href="'.esc_url($item['url']).'">'.esc_html($item['label']).'</a>';
  }
  echo '</nav>';
 }

 private static function load_events(){
  global $wpdb;
  $events=VTP_DB::table('events');
  $today=current_time('Y-m-d');

  // Event-Grunddaten bewusst separat laden. Ein Fehler in einer operativen
  // Nebenabfrage darf niemals die Eventkarte selbst verschwinden lassen.
  $sql=$wpdb->prepare(
   "SELECT * FROM $events
    WHERE COALESCE(status,'')<>'archiviert'
      AND (
       start_date IS NULL
       OR start_date=''
       OR start_date='0000-00-00'
       OR COALESCE(NULLIF(NULLIF(end_date,''),'0000-00-00'),start_date) >= %s
      )
    ORDER BY
      CASE WHEN start_date IS NULL OR start_date='' OR start_date='0000-00-00' THEN 1 ELSE 0 END,
      start_date ASC,
      name ASC",
   $today
  );

  $rows=$wpdb->get_results($sql) ?: [];
  foreach($rows as $event){
   self::add_operational_counts($event);
  }
  return $rows;
 }

 private static function load_archived_events(){
  global $wpdb;
  $events=VTP_DB::table('events');
  return $wpdb->get_results(
   "SELECT * FROM $events
    WHERE status='archiviert'
    ORDER BY
      CASE WHEN start_date IS NULL OR start_date='' OR start_date='0000-00-00' THEN 1 ELSE 0 END,
      COALESCE(NULLIF(NULLIF(end_date,''),'0000-00-00'),start_date) DESC,
      start_date DESC,
      name ASC"
  ) ?: [];
 }

 private static function add_operational_counts($event){
  global $wpdb;
  $event_id=absint($event->id??0);

  $event->program_count=0;
  $event->helper_need_count=0;
  $event->shift_count=0;
  $event->tournament_count=0;
  if(!$event_id) return;

  $event->program_count=(int)$wpdb->get_var($wpdb->prepare(
   'SELECT COUNT(*) FROM '.VTP_DB::table('event_items').' WHERE event_id=%d',
   $event_id
  ));
  $event->helper_need_count=(int)$wpdb->get_var($wpdb->prepare(
   'SELECT COUNT(*) FROM '.VTP_DB::table('helper_needs').' WHERE event_id=%d',
   $event_id
  ));
  $event->shift_count=(int)$wpdb->get_var($wpdb->prepare(
   'SELECT COUNT(*) FROM '.VTP_DB::table('shifts').' WHERE event_id=%d',
   $event_id
  ));
  $event->tournament_count=(int)$wpdb->get_var($wpdb->prepare(
   "SELECT COUNT(*) FROM ".VTP_DB::table('tournaments')." WHERE event_id=%d AND COALESCE(status,'')<>'archiviert'",
   $event_id
  ));
 }

 private static function is_operationally_active($event){
  return (
   absint($event->program_count??0)>0
   || absint($event->helper_need_count??0)>0
   || absint($event->shift_count??0)>0
   || absint($event->tournament_count??0)>0
  );
 }

 private static function format_date_range($event){
  $start=(string)($event->start_date??'');
  $end=(string)($event->end_date??'');
  if($start==='' || $start==='0000-00-00') return 'Datum noch offen';

  $start_label=date_i18n('d.m.Y',strtotime($start));
  if($end!=='' && $end!=='0000-00-00' && $end!==$start){
   return $start_label.' – '.date_i18n('d.m.Y',strtotime($end));
  }
  return $start_label;
 }

 private static function render_event_card($event,$state){
  $edit_url=admin_url('admin.php?page=vtp-events&edit_event='.absint($event->id));
  $program_count=absint($event->program_count??0);
  $location=trim((string)($event->location??''));

  echo '<article class="vtp-event-overview-item is-'.esc_attr($state).'">';
  echo '<h3>'.esc_html($event->name).'</h3>';
  echo '<p class="vtp-event-overview-date">'.esc_html(self::format_date_range($event)).'</p>';
  echo '<p class="vtp-event-overview-location">'.esc_html($location!==''?$location:'Ort noch offen').'</p>';
  echo '<div class="vtp-event-overview-actions">';
  echo '<a class="button vtp-event-outline-button" href="'.esc_url($edit_url).'">Öffnen</a>';
  if($program_count>0){
   echo '<a class="button vtp-event-outline-button" target="_blank" rel="noopener noreferrer" href="'.esc_url(VTP_Public::event_url($event)).'">Programm</a>';
  }
  echo '</div></article>';
 }

 private static function render_archived_event_card($event){
  $event_id=absint($event->id);
  $location=trim((string)($event->location??''));

  echo '<article class="vtp-event-overview-item is-archived">';
  echo '<div class="vtp-event-overview-card-head"><h3>'.esc_html($event->name).'</h3><span class="vtp-event-archive-badge">Archiviert</span></div>';
  echo '<p class="vtp-event-overview-date">'.esc_html(self::format_date_range($event)).'</p>';
  echo '<p class="vtp-event-overview-location">'.esc_html($location!==''?$location:'Ort noch offen').'</p>';
  echo '<div class="vtp-event-overview-actions">';

  echo '<form method="post" action="'.esc_url(admin_url('admin-post.php')).'">';
  wp_nonce_field('vtp_restore_event');
  echo '<input type="hidden" name="action" value="vtp_restore_event">';
  echo '<input type="hidden" name="event_id" value="'.esc_attr($event_id).'">';
  echo '<button type="submit" class="button button-primary vtp-event-restore-button">Event wiederherstellen</button>';
  echo '</form>';

  echo '<form method="post" action="'.esc_url(admin_url('admin-post.php')).'" onsubmit="return confirm(&quot;Event wirklich endgültig löschen? Diese Aktion kann nicht rückgängig gemacht werden.&quot;);">';
  wp_nonce_field('vtp_delete_event');
  echo '<input type="hidden" name="action" value="vtp_delete_event">';
  echo '<input type="hidden" name="event_id" value="'.esc_attr($event_id).'">';
  echo '<button type="submit" class="button vtp-event-danger-button">Event dauerhaft löschen</button>';
  echo '</form>';

  echo '</div></article>';
 }

 private static function render_column($title,$events,$state){
  echo '<section class="vtp-event-overview-column">';
  echo '<h2>'.esc_html($title).'</h2>';
  echo '<div class="vtp-event-overview-list">';
  if(!$events){
   $message=$state==='active'?'Aktuell befindet sich keine Veranstaltung in der operativen Planung.':'Aktuell sind keine weiteren Veranstaltungen vorgemerkt.';
   echo '<div class="vtp-event-overview-empty">'.esc_html($message).'</div>';
  } else {
   foreach($events as $event) self::render_event_card($event,$state);
  }
  echo '</div></section>';
 }

 private static function render_overview(){
  $rows=self::load_events();
  $active=[];
  $planned=[];
  foreach($rows as $event){
   if(self::is_operationally_active($event)) $active[]=$event;
   else $planned[]=$event;
  }

  echo '<div class="wrap vtp vtp-modern vtp-event-create-page vtp-events-overview-page">';
  echo '<h1>Events: TuS Veranstaltungen</h1>';
  echo '<p class="description vtp-event-create-subtitle">Übersicht aller anstehenden TuS Veranstaltungen</p>';
  self::render_nav();
  echo '<div class="vtp-card vtp-events-overview-shell">';
  echo '<div class="vtp-events-overview-grid">';
  self::render_column('Aktive Veranstaltungen',$active,'active');
  self::render_column('Geplante Veranstaltungen',$planned,'planned');
  echo '</div></div></div>';
 }

 private static function render_archive(){
  $events=self::load_archived_events();

  echo '<div class="wrap vtp vtp-modern vtp-event-create-page vtp-events-overview-page vtp-events-archive-page">';
  echo '<h1>Events: TuS Veranstaltungen</h1>';
  echo '<p class="description vtp-event-create-subtitle">Archivierte Veranstaltungen verwalten oder wiederherstellen</p>';
  self::render_nav('archive');
  echo '<section class="vtp-card vtp-events-overview-shell vtp-events-archive-shell">';
  echo '<div class="vtp-event-overview-column">';
  echo '<h2>Archivierte Veranstaltungen</h2>';
  echo '<p class="description vtp-events-archive-description">Archivierte Events bleiben mit ihrer Planung erhalten und können wiederhergestellt oder dauerhaft gelöscht werden.</p>';
  echo '<div class="vtp-event-overview-list vtp-events-archive-list">';
  if(!$events){
   echo '<div class="vtp-event-overview-empty">Noch keine archivierten Events vorhanden.</div>';
  } else {
   foreach($events as $event) self::render_archived_event_card($event);
  }
  echo '</div></div></section></div>';
 }
}
