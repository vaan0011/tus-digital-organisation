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

  if($edit || $view!=='active'){
   VTP_Event_Create_UI::render_page();
   return;
  }

  self::render_overview();
 }

 private static function render_nav(){
  $items=[
   'new'=>['neues Event','admin.php?page=vtp-events&view=new'],
   'active'=>['aktive Events','admin.php?page=vtp-events&view=active'],
   'templates'=>['Vorlagen','admin.php?page=vtp-events&view=templates'],
   'archive'=>['Archiv','admin.php?page=vtp-events&view=archive'],
  ];
  echo '<nav class="vtp-event-create-nav" aria-label="Event-Bereiche">';
  foreach($items as $key=>$item){
   $classes='button vtp-event-nav-button'.($key==='active'?' is-active':'');
   echo '<a class="'.esc_attr($classes).'" href="'.esc_url(admin_url($item[1])).'">'.esc_html($item[0]).'</a>';
  }
  echo '</nav>';
 }

 private static function load_events(){
  global $wpdb;
  $events=VTP_DB::table('events');
  $items=VTP_DB::table('event_items');
  $needs=VTP_DB::table('helper_needs');
  $shifts=VTP_DB::table('shifts');
  $tournaments=VTP_DB::table('tournaments');
  $today=current_time('Y-m-d');

  $sql=$wpdb->prepare(
   "SELECT e.*,
    (SELECT COUNT(*) FROM $items i WHERE i.event_id=e.id) AS program_count,
    (SELECT COUNT(*) FROM $needs h WHERE h.event_id=e.id) AS helper_need_count,
    (SELECT COUNT(*) FROM $shifts s WHERE s.event_id=e.id) AS shift_count,
    (SELECT COUNT(*) FROM $tournaments t WHERE t.event_id=e.id AND t.status<>'archiviert') AS tournament_count
    FROM $events e
    WHERE e.status<>'archiviert'
      AND (
       e.start_date IS NULL
       OR e.start_date='0000-00-00'
       OR COALESCE(NULLIF(e.end_date,'0000-00-00'),e.start_date) >= %s
      )
    ORDER BY
      CASE WHEN e.start_date IS NULL OR e.start_date='0000-00-00' THEN 1 ELSE 0 END,
      e.start_date ASC,
      e.name ASC",
   $today
  );

  return $wpdb->get_results($sql) ?: [];
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
}
