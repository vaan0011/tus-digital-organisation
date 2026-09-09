<?php
if (!defined('ABSPATH')) exit;

class VTP_Dashboard_History {
 private static function has_event_type_column(){
  global $wpdb;
  $table=VTP_DB::table('events');
  return (bool)$wpdb->get_var("SHOW COLUMNS FROM $table LIKE 'event_type'");
 }

 private static function format_date($start,$end=null){
  if(!$start) return 'Datum offen';
  $out=date_i18n('d.m.Y',strtotime($start));
  if($end && $end!==$start) $out.=' – '.date_i18n('d.m.Y',strtotime($end));
  return $out;
 }

 private static function year_link($year,$type='all'){
  return add_query_arg([
   'page'=>'vtp-dashboard',
   'history_year'=>$year,
   'history_type'=>$type,
  ],admin_url('admin.php'));
 }

 public static function render(){
  global $wpdb;

  $events_table=VTP_DB::table('events');
  $tournaments_table=VTP_DB::table('tournaments');
  $shifts_table=VTP_DB::table('shifts');
  $has_event_type=self::has_event_type_column();

  $event_filter=$has_event_type?" AND COALESCE(event_type,'event')='event'":'';
  $camp_filter=$has_event_type?" AND event_type='camp'":' AND 1=0';

  $event_count=(int)$wpdb->get_var("SELECT COUNT(*) FROM $events_table WHERE status='archiviert'$event_filter");
  $camp_count=(int)$wpdb->get_var("SELECT COUNT(*) FROM $events_table WHERE status='archiviert'$camp_filter");
  $tournament_count=(int)$wpdb->get_var("SELECT COUNT(*) FROM $tournaments_table WHERE status='archiviert'");
  $shift_count=(int)$wpdb->get_var("SELECT COUNT(*) FROM $shifts_table s INNER JOIN $events_table e ON e.id=s.event_id WHERE e.status='archiviert'");

  if($has_event_type){
   $event_year_rows=$wpdb->get_results("SELECT YEAR(start_date) AS y, COALESCE(event_type,'event') AS dashboard_type, COUNT(*) AS amount FROM $events_table WHERE status='archiviert' AND start_date IS NOT NULL AND start_date<>'' GROUP BY YEAR(start_date), dashboard_type ORDER BY y DESC");
  } else {
   $event_year_rows=$wpdb->get_results("SELECT YEAR(start_date) AS y, 'event' AS dashboard_type, COUNT(*) AS amount FROM $events_table WHERE status='archiviert' AND start_date IS NOT NULL AND start_date<>'' GROUP BY YEAR(start_date) ORDER BY y DESC");
  }
  $tournament_year_rows=$wpdb->get_results("SELECT YEAR(start_date) AS y, COUNT(*) AS amount FROM $tournaments_table WHERE status='archiviert' AND start_date IS NOT NULL AND start_date<>'' GROUP BY YEAR(start_date) ORDER BY y DESC");

  $years=[];
  foreach($event_year_rows?:[] as $row){
   $year=(int)$row->y;
   if(!$year) continue;
   if(!isset($years[$year])) $years[$year]=['event'=>0,'camp'=>0,'tournament'=>0];
   $type=$row->dashboard_type==='camp'?'camp':'event';
   $years[$year][$type]+=(int)$row->amount;
  }
  foreach($tournament_year_rows?:[] as $row){
   $year=(int)$row->y;
   if(!$year) continue;
   if(!isset($years[$year])) $years[$year]=['event'=>0,'camp'=>0,'tournament'=>0];
   $years[$year]['tournament']+=(int)$row->amount;
  }
  krsort($years);

  $selected_year=absint($_GET['history_year']??0);
  if(!$selected_year && $years) $selected_year=(int)array_key_first($years);
  if($selected_year && !isset($years[$selected_year])) $selected_year=$years?(int)array_key_first($years):0;
  $selected_type=sanitize_key($_GET['history_type']??'all');
  if(!in_array($selected_type,['all','event','camp','tournament'],true)) $selected_type='all';

  $details=[];
  if($selected_year){
   if($selected_type==='all' || $selected_type==='event' || $selected_type==='camp'){
    $type_where='';
    if($selected_type==='event') $type_where=$event_filter;
    elseif($selected_type==='camp') $type_where=$camp_filter;
    $event_type_select=$has_event_type?",COALESCE(event_type,'event') AS dashboard_type":",'event' AS dashboard_type";
    $event_details=$wpdb->get_results($wpdb->prepare("SELECT id,name,start_date,end_date,location $event_type_select FROM $events_table WHERE status='archiviert' AND YEAR(start_date)=%d$type_where ORDER BY start_date DESC,name ASC",$selected_year));
    foreach($event_details?:[] as $row) $details[]=$row;
   }
   if($selected_type==='all' || $selected_type==='tournament'){
    $tournament_details=$wpdb->get_results($wpdb->prepare("SELECT id,name,start_date,NULL AS end_date,location,'tournament' AS dashboard_type FROM $tournaments_table WHERE status='archiviert' AND YEAR(start_date)=%d ORDER BY start_date DESC,name ASC",$selected_year));
    foreach($tournament_details?:[] as $row) $details[]=$row;
   }
   usort($details,function($a,$b){
    $ad=$a->start_date?:'0000-00-00'; $bd=$b->start_date?:'0000-00-00';
    return $ad===$bd?strcasecmp((string)$a->name,(string)$b->name):strcmp($bd,$ad);
   });
  }

  $max_total=1;
  foreach($years as $counts) $max_total=max($max_total,array_sum($counts));

  echo '<section class="vtp-dashboard-history">';
  echo '<div class="vtp-dashboard-history-heading"><h2>TuS Eventhistorie</h2><p class="description">Archiv für Events, Turniere, Fußballcamps und Helferschichten</p></div>';

  echo '<div class="vtp-dashboard-kpis vtp-dashboard-history-kpis">';
  foreach([[$event_count,'Events'],[$tournament_count,'Turniere'],[$camp_count,'Camps'],[$shift_count,'Schichten']] as $kpi){
   echo '<div class="vtp-dashboard-kpi"><strong>'.esc_html($kpi[0]).'</strong><span>'.esc_html($kpi[1]).'</span></div>';
  }
  echo '</div>';

  echo '<div class="vtp-dashboard-content vtp-dashboard-history-content">';
  echo '<section class="vtp-card vtp-dashboard-panel"><h2>Übersicht</h2>';
  if(!$years){
   echo '<p class="vtp-dashboard-empty">Noch keine archivierten Veranstaltungen für eine Jahresauswertung vorhanden.</p>';
  } else {
   echo '<div class="vtp-history-years">';
   foreach($years as $year=>$counts){
    $total=array_sum($counts);
    $width=max(6,round(($total/$max_total)*100));
    $active=$year===$selected_year?' is-active':'';
    echo '<a class="vtp-history-year'.$active.'" href="'.esc_url(self::year_link($year,'all')).'">';
    echo '<span class="vtp-history-year-label"><strong>'.esc_html($year).'</strong><small>'.esc_html($total).' Veranstaltungen</small></span>';
    echo '<span class="vtp-history-bar-track"><span class="vtp-history-bar" style="width:'.esc_attr($width).'%"></span></span>';
    echo '<span class="vtp-history-year-counts"><span>Events '.esc_html($counts['event']).'</span><span>Turniere '.esc_html($counts['tournament']).'</span><span>Camps '.esc_html($counts['camp']).'</span></span>';
    echo '</a>';
   }
   echo '</div>';
  }
  echo '</section>';

  echo '<section class="vtp-card vtp-dashboard-panel"><div class="vtp-history-details-head"><h2>Details'.($selected_year?' '.esc_html($selected_year):'').'</h2>';
  if($selected_year){
   echo '<div class="vtp-history-filters">';
   foreach(['all'=>'Alle','event'=>'Events','tournament'=>'Turniere','camp'=>'Camps'] as $key=>$label){
    echo '<a class="'.($selected_type===$key?'is-active':'').'" href="'.esc_url(self::year_link($selected_year,$key)).'">'.esc_html($label).'</a>';
   }
   echo '</div>';
  }
  echo '</div>';

  if(!$selected_year){
   echo '<p class="vtp-dashboard-empty">Wähle links ein Jahr aus.</p>';
  } elseif(!$details){
   echo '<p class="vtp-dashboard-empty">Für diese Auswahl sind keine archivierten Einträge vorhanden.</p>';
  } else {
   echo '<div class="vtp-dashboard-list">';
   foreach(array_slice($details,0,12) as $row){
    $type=$row->dashboard_type==='camp'?'Camp':($row->dashboard_type==='tournament'?'Turnier':'Event');
    $url=$row->dashboard_type==='tournament'?add_query_arg(['page'=>'vtp','edit'=>$row->id,'archive'=>1],admin_url('admin.php')):add_query_arg(['page'=>'vtp-events','edit_event'=>$row->id,'archive'=>1],admin_url('admin.php'));
    echo '<a class="vtp-dashboard-list-item" href="'.esc_url($url).'"><span class="vtp-dashboard-type">'.esc_html($type).'</span><span class="vtp-dashboard-main"><strong>'.esc_html($row->name).'</strong><small>'.esc_html(self::format_date($row->start_date,$row->end_date)).($row->location?' · '.esc_html($row->location):'').'</small></span><span aria-hidden="true">›</span></a>';
   }
   echo '</div>';
  }
  echo '</section></div></section>';
 }
}
