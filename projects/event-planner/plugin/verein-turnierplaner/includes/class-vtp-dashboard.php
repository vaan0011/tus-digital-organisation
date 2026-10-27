<?php
if (!defined('ABSPATH')) exit;

class VTP_Dashboard {
 public static function init(){
  add_action('admin_menu',[__CLASS__,'replace_dashboard'],99);
  add_action('admin_enqueue_scripts',[__CLASS__,'assets']);
 }

 public static function assets($hook){
  if($hook==='toplevel_page_vtp-dashboard'){
   wp_enqueue_style('vtp-dashboard',VTP_URL.'assets/dashboard.css',['vtp-admin'],VTP_VERSION);
  }
 }

 public static function replace_dashboard(){
  remove_action('toplevel_page_vtp-dashboard',[VTP_Plugin::instance(),'dashboard_page']);
  add_action('toplevel_page_vtp-dashboard',[__CLASS__,'render']);
 }

 private static function format_date($start,$end=null){
  if(!$start) return 'Datum offen';
  $out=date_i18n('d.m.Y',strtotime($start));
  if($end && $end!==$start) $out.=' – '.date_i18n('d.m.Y',strtotime($end));
  return $out;
 }

 private static function has_event_type_column(){
  global $wpdb;
  $table=VTP_DB::table('events');
  return (bool)$wpdb->get_var("SHOW COLUMNS FROM $table LIKE 'event_type'");
 }

 public static function render(){
  global $wpdb;
  $today=current_time('Y-m-d');
  $has_event_type=self::has_event_type_column();
  $events_table=VTP_DB::table('events');
  $tournaments_table=VTP_DB::table('tournaments');
  $shifts_table=VTP_DB::table('shifts');
  $signups_table=VTP_DB::table('shift_signups');
  $items_table=VTP_DB::table('event_items');
  $needs_table=VTP_DB::table('helper_needs');

  $event_filter=$has_event_type?" AND COALESCE(event_type,'event')='event'":'';
  $camp_filter=$has_event_type?" AND event_type='camp'":' AND 1=0';
  $ecount=(int)$wpdb->get_var("SELECT COUNT(*) FROM $events_table WHERE status<>'archiviert'$event_filter");
  $ccount=(int)$wpdb->get_var("SELECT COUNT(*) FROM $events_table WHERE status<>'archiviert'$camp_filter");
  $tcount=(int)$wpdb->get_var("SELECT COUNT(*) FROM $tournaments_table WHERE status<>'archiviert'");
  $scount=(int)$wpdb->get_var("SELECT COUNT(*) FROM $shifts_table s INNER JOIN $events_table e ON e.id=s.event_id WHERE e.status<>'archiviert'");

  $event_type_select=$has_event_type?",COALESCE(event_type,'event') AS dashboard_type":",'event' AS dashboard_type";
  // Keep all unarchived records visible; date only controls the board phase.
  $event_rows=$wpdb->get_results("SELECT id,name,start_date,end_date,location $event_type_select FROM $events_table WHERE status<>'archiviert' ORDER BY start_date ASC,name ASC");
  $tournament_rows=$wpdb->get_results("SELECT id,name,start_date,start_date AS end_date,location,'tournament' AS dashboard_type FROM $tournaments_table WHERE status<>'archiviert' ORDER BY start_date ASC,name ASC");
  $all_rows=array_merge($event_rows?:[],$tournament_rows?:[]);
  $board=VTP_Event_Lifecycle::group($all_rows,$today);

  $tasks=[];
  $past=$wpdb->get_results($wpdb->prepare("SELECT id,name,start_date,end_date $event_type_select FROM $events_table WHERE status<>'archiviert' AND COALESCE(NULLIF(end_date,''),start_date)<%s ORDER BY COALESCE(NULLIF(end_date,''),start_date) ASC LIMIT 8",$today));
  foreach($past?:[] as $ev){
   $tasks[]=['label'=>$ev->name.': abschließen / archivieren','url'=>add_query_arg(['page'=>'vtp-events','edit_event'=>$ev->id],admin_url('admin.php')),'kind'=>'event'];
  }

  foreach(array_merge($board['upcoming'],$board['running']) as $ev){
   if($ev->dashboard_type==='tournament') continue;
   $items=(int)$wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $items_table WHERE event_id=%d",$ev->id));
   if($items===0) $tasks[]=['label'=>$ev->name.': Programm fehlt','url'=>add_query_arg(['page'=>'vtp-events','edit_event'=>$ev->id],admin_url('admin.php')),'kind'=>'event'];
   $needs=(int)$wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $needs_table WHERE event_id=%d",$ev->id));
   $shifts=(int)$wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $shifts_table WHERE event_id=%d",$ev->id));
   if($needs>0 && $shifts===0) $tasks[]=['label'=>$ev->name.': Helferschichten erzeugen','url'=>add_query_arg(['page'=>'vtp-events','edit_event'=>$ev->id],admin_url('admin.php')),'kind'=>'helpers'];
   if($shifts>0){
    $needed=(int)$wpdb->get_var($wpdb->prepare("SELECT COALESCE(SUM(slots_needed),0) FROM $shifts_table WHERE event_id=%d",$ev->id));
    $filled=(int)$wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $signups_table g INNER JOIN $shifts_table s ON s.id=g.shift_id WHERE s.event_id=%d",$ev->id));
    $open=max(0,$needed-$filled);
    if($open>0) $tasks[]=['label'=>$ev->name.': '.$open.' Helferplatz'.($open===1?'':'e').' offen','url'=>add_query_arg(['page'=>'vtp-helpers','edit_event'=>$ev->id],admin_url('admin.php')),'kind'=>'helpers'];
   }
  }

  foreach($tournament_rows?:[] as $t){
   if(VTP_Event_Lifecycle::phase($t->start_date,$t->start_date,$today)==='completed') continue;
   $teams=(int)$wpdb->get_var($wpdb->prepare('SELECT COUNT(*) FROM '.VTP_DB::table('teams').' WHERE tournament_id=%d',$t->id));
   $matches=(int)$wpdb->get_var($wpdb->prepare('SELECT COUNT(*) FROM '.VTP_DB::table('matches').' WHERE tournament_id=%d',$t->id));
   if($teams===0) $tasks[]=['label'=>$t->name.': Teams fehlen','url'=>add_query_arg(['page'=>'vtp','edit'=>$t->id],admin_url('admin.php')),'kind'=>'tournament'];
   elseif($matches===0) $tasks[]=['label'=>$t->name.': Spielplan fehlt','url'=>add_query_arg(['page'=>'vtp','edit'=>$t->id],admin_url('admin.php')),'kind'=>'tournament'];
  }
  $tasks=array_slice($tasks,0,12);

  echo '<div class="wrap vtp vtp-modern vtp-dashboard-v1">';
  echo '<h1>TuS Eventplaner</h1><p class="description vtp-dashboard-subtitle">Zentrale Übersicht für Events, Turniere, Fußballcamps und Helferschichten</p>';
  echo '<div class="vtp-dashboard-actions">';
  echo '<a class="button" href="'.esc_url(admin_url('admin.php?page=vtp-events&view=new')).'">neues Event</a>';
  echo '<a class="button" href="'.esc_url(admin_url('admin.php?page=vtp&view=new')).'">neues Turnier</a>';
  echo '<a class="button" href="'.esc_url(admin_url('admin.php?page=vtp-events&view=new&event_type=camp')).'">neues Camp</a>';
  echo '<a class="button" href="'.esc_url(admin_url('admin.php?page=vtp-helpers')).'">Helferübersicht</a>';
  echo '</div>';

  echo '<div class="vtp-dashboard-kpis">';
  foreach([[$ecount,'Events'],[$tcount,'Turniere'],[$ccount,'Camps'],[$scount,'Schichten']] as $kpi){
   echo '<div class="vtp-dashboard-kpi"><strong>'.esc_html($kpi[0]).'</strong><span>'.esc_html($kpi[1]).'</span></div>';
  }
  echo '</div>';

  echo '<section class="vtp-card vtp-dashboard-board"><h2>Übersicht</h2><div class="vtp-dashboard-board-grid">';
  foreach(['upcoming'=>'Anstehend','running'=>'Am Laufen','completed'=>'Durchgeführt'] as $phase=>$label){
   echo '<section class="vtp-dashboard-board-column"><h3>'.esc_html($label).' <span>'.count($board[$phase]).'</span></h3>';
   if(!$board[$phase]) echo '<p class="vtp-dashboard-empty">Keine Veranstaltungen</p>';
   else {
    echo '<div class="vtp-dashboard-list">';
    foreach($board[$phase] as $row){
     $type=$row->dashboard_type==='camp'?'Camp':($row->dashboard_type==='tournament'?'Turnier':'Event');
     $url=$row->dashboard_type==='tournament'?add_query_arg(['page'=>'vtp','edit'=>$row->id],admin_url('admin.php')):add_query_arg(['page'=>'vtp-events','edit_event'=>$row->id],admin_url('admin.php'));
     $end=property_exists($row,'end_date')?$row->end_date:null;
     echo '<a class="vtp-dashboard-list-item" href="'.esc_url($url).'"><span class="vtp-dashboard-type">'.esc_html($type).'</span><span class="vtp-dashboard-main"><strong>'.esc_html($row->name).'</strong><small>'.esc_html(self::format_date($row->start_date,$end)).'</small>';
     if($phase==='completed') echo '<small>Abschluss / Archivierung offen</small>';
     echo '</span><span aria-hidden="true">›</span></a>';
    }
    echo '</div>';
   }
   echo '</section>';
  }
  echo '</div></section>';
  echo '<div class="vtp-dashboard-content">';

  echo '<section class="vtp-card vtp-dashboard-panel"><h2>Offene Aufgaben</h2>';
  if(!$tasks){ echo '<p class="vtp-dashboard-empty">Aktuell sind keine automatisch erkannten Aufgaben offen.</p>'; }
  else {
   echo '<div class="vtp-dashboard-list vtp-dashboard-task-list">';
   foreach($tasks as $task){ echo '<a class="vtp-dashboard-list-item" href="'.esc_url($task['url']).'"><span class="vtp-dashboard-task-dot" aria-hidden="true"></span><span class="vtp-dashboard-main"><strong>'.esc_html($task['label']).'</strong></span><span aria-hidden="true">›</span></a>'; }
   echo '</div>';
  }
  echo '<p class="description vtp-dashboard-note">Manuelle Organisationsaufgaben und Aufgaben aus Vorlagen folgen im nächsten Ausbauschritt.</p>';
  echo '</section></div>';

  VTP_Dashboard_History::render();
  echo '</div>';
 }
}
