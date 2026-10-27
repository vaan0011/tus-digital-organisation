<?php
if (!defined('ABSPATH')) exit;

/**
 * Annual read-only view of explicitly confirmed volunteer shifts.
 * Uses Event Planner source tables. This is not a member-identity ledger.
 */
class VTP_Helper_Annual_Overview {
 public static function init(){
  add_action('admin_enqueue_scripts',[__CLASS__,'assets']);
 }

 public static function assets(){
  if(($_GET['page']??'')!=='vtp-helpers') return;
  wp_enqueue_style('vtp-helper-annual',VTP_URL.'assets/helper-annual.css',['vtp-admin'],VTP_VERSION);
 }

 private static function minutes($start,$end){
  $start=substr((string)$start,0,5);
  $end=substr((string)$end,0,5);
  if(!preg_match('/^(?:[01]\d|2[0-3]):[0-5]\d$/',$start) || !preg_match('/^(?:[01]\d|2[0-3]):[0-5]\d$/',$end)) return 0;
  [$sh,$sm]=array_map('intval',explode(':',$start));
  [$eh,$em]=array_map('intval',explode(':',$end));
  $from=$sh*60+$sm;
  $to=$eh*60+$em;
  if($to<$from) $to+=1440; // overnight shift
  return $to>$from ? $to-$from : 0;
 }

 public static function render(){
  if(!current_user_can('manage_options')) wp_die('Nicht erlaubt.');
  global $wpdb;
  $current=(int)current_time('Y');
  $year=absint($_GET['helper_year']??$current);
  if($year<2000 || $year>$current+1) $year=$current;
  $shifts=VTP_DB::table('shifts');
  $signups=VTP_DB::table('shift_signups');
  $events=VTP_DB::table('events');
  $has_status=(bool)$wpdb->get_var("SHOW COLUMNS FROM $signups LIKE 'attendance_status'");
  $status_select=$has_status?"COALESCE(g.attendance_status,'registered')":" 'registered' ";
  $rows=$wpdb->get_results($wpdb->prepare(
   "SELECT g.id signup_id,g.name,g.contact,$status_select AS attendance_status,
      s.id shift_id,s.area_name,s.assigned_group,s.shift_date,s.start_time,s.end_time,
      e.id event_id,e.name event_name
    FROM $signups g
    INNER JOIN $shifts s ON s.id=g.shift_id
    INNER JOIN $events e ON e.id=s.event_id
    WHERE s.shift_date >= %s AND s.shift_date < %s
    ORDER BY g.name,g.id",
   sprintf('%04d-01-01',$year),sprintf('%04d-01-01',$year+1)
  )) ?: [];

  $people=[];
  $pending=0;
  $no_show=0;
  $total_minutes=0;
  $total_shifts=0;
  $total_events=[];
  foreach($rows as $row){
   if($row->attendance_status==='no_show'){ $no_show++; continue; }
   if($row->attendance_status!=='attended'){ $pending++; continue; }
   $minutes=self::minutes($row->start_time,$row->end_time);
   if($minutes===0) continue;
   $name=trim((string)$row->name);
   $contact=trim((string)$row->contact);
   // Contact helps distinguish identical names, but is not authoritative membership identity.
   $key=strtolower($name.'|'.$contact);
   if(!isset($people[$key])){
    $people[$key]=['name'=>$name,'minutes'=>0,'shifts'=>0,'events'=>[],'details'=>[]];
   }
   $people[$key]['minutes']+=$minutes;
   $people[$key]['shifts']++;
   $people[$key]['events'][(int)$row->event_id]=true;
   $people[$key]['details'][]=$row;
   $total_minutes+=$minutes;
   $total_shifts++;
   $total_events[(int)$row->event_id]=true;
  }
  uasort($people,function($a,$b){return ($b['minutes']<=>$a['minutes']) ?: strcasecmp($a['name'],$b['name']);});
  $format=function($minutes){return number_format($minutes/60,2,',','.');};
  $url_for=function($year){return add_query_arg(['page'=>'vtp-helpers','helper_year'=>$year],admin_url('admin.php'));};
  echo '<div class="wrap vtp vtp-modern vtp-helper-annual">';
  echo '<h1>TuS Helferübersicht</h1><p class="description">Bestätigte Helfereinsätze und Stunden pro Kalenderjahr – aus den Veranstaltungen.</p>';
  echo '<div class="vtp-helper-actions"><a class="button" href="'.esc_url($url_for($year-1)).'">Vorjahr</a><strong>'.esc_html($year).'</strong>';
  if($year<$current) echo '<a class="button" href="'.esc_url($url_for($year+1)).'">Folgejahr</a>';
  echo '</div>';
  echo '<div class="vtp-helper-kpis">';
  foreach([
   [count($people),'Helfende'],
   [$total_shifts,'Bestätigte Einsätze'],
   [$format($total_minutes).' h','Bestätigte Stunden'],
   [count($total_events),'Veranstaltungen']
  ] as $kpi){echo '<div class="vtp-helper-kpi"><strong>'.esc_html($kpi[0]).'</strong><span>'.esc_html($kpi[1]).'</span></div>';}
  echo '</div><section class="vtp-card vtp-helper-panel"><h2>Helferinnen und Helfer '.esc_html($year).'</h2>';
  echo '<p class="description">Gezählt werden ausschließlich ausdrücklich als „Teilgenommen“ bestätigte Schichten. Dauer = geplante Start-/Endzeit, einschließlich Schichten über Mitternacht. Abweichende tatsächliche Zeiten sind derzeit nicht separat erfasst.</p>';
  if($pending) echo '<p class="vtp-helper-warning">'.esc_html($pending).' Anmeldung(en) noch ohne Teilnahmebestätigung – nicht in den Stunden enthalten.</p>';
  if($no_show) echo '<p class="description">'.esc_html($no_show).' als „Nicht erschienen“ markierte Anmeldung(en) ausgeschlossen.</p>';
  if(!$people) echo '<div class="vtp-helper-empty">Noch keine bestätigten Helfereinsätze für dieses Kalenderjahr. Teilnahme im jeweiligen Event über Schichten / Mitbringen bestätigen.</div>';
  else {
   echo '<div class="vtp-helper-table-scroll"><table class="widefat striped"><thead><tr><th>Person</th><th>Einsätze</th><th>Events</th><th>Stunden</th><th>Details</th></tr></thead><tbody>';
   foreach($people as $person){
    echo '<tr><td><strong>'.esc_html($person['name']).'</strong></td><td>'.esc_html($person['shifts']).'</td><td>'.esc_html(count($person['events'])).'</td><td><strong>'.esc_html($format($person['minutes'])).' h</strong></td><td><details><summary>Einsätze anzeigen</summary><ul>';
    foreach($person['details'] as $d){
     $url=add_query_arg(['page'=>'vtp-events','edit_event'=>absint($d->event_id)],admin_url('admin.php'));
     echo '<li><a href="'.esc_url($url).'">'.esc_html($d->event_name).'</a> · '.esc_html(date_i18n('d.m.Y',strtotime($d->shift_date))).' · '.esc_html($d->area_name).' ('.esc_html($format(self::minutes($d->start_time,$d->end_time))).' h)</li>';
    }
    echo '</ul></details></td></tr>';
   }
   echo '</tbody></table></div>';
  }
  echo '<p class="description vtp-helper-caveat">Wichtig: Personen werden vorläufig anhand von Name und optionalem Kontakt zugeordnet. Gleichnamige Personen sowie unterschiedliche Schreibweisen können die Jahresübersicht verfälschen. Die verbindliche personenbezogene Helferstundenbilanz wird später aus dem Mitglieder-/Engagement-Modul mit stabilen Personen-IDs kommen.</p>';
  echo '</section></div>';
 }
}
