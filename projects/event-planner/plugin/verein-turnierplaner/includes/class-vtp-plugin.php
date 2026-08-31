<?php
if (!defined('ABSPATH')) exit;
class VTP_Plugin {
 private static $i=null; public static function instance(){ return self::$i ?: (self::$i=new self()); }
 private function __construct(){
  add_action('admin_menu',[$this,'menu']); add_action('admin_enqueue_scripts',[$this,'assets']);
  foreach(['save_tournament','archive_tournament','restore_tournament','delete_tournament','save_teams','save_group_editor','regenerate_pin','generate_matches','generate_final_round','save_results','save_match_order','create_public_page','print_pdf','print_referees_pdf','save_sponsors','save_event','archive_event','restore_event','delete_event','save_event_items','save_helper_needs','generate_shifts','delete_shift','delete_signup','save_shift_assignments','save_referees','regenerate_referee_pin','delete_registration'] as $a) add_action('admin_post_vtp_'.$a,[$this,$a]);
 }
 public function assets($h){ if(strpos($h,'vtp')!==false || strpos($h,'turnierplaner')!==false) wp_enqueue_style('vtp-admin',VTP_URL.'assets/admin.css',[],VTP_VERSION); }
 public function menu(){
  add_menu_page('TuS Eventplaner','TuS Eventplaner','manage_options','vtp-dashboard',[$this,'dashboard_page'],'dashicons-calendar-alt',26);
  add_submenu_page('vtp-dashboard','Dashboard','Dashboard','manage_options','vtp-dashboard',[$this,'dashboard_page']);
  add_submenu_page('vtp-dashboard','Events','Events','manage_options','vtp-events',[$this,'events_page']);
  add_submenu_page('vtp-dashboard','Turnierplan','Turnierplan','manage_options','vtp',[$this,'page']);
  add_submenu_page('vtp-dashboard','Helferschichten','Helferschichten','manage_options','vtp-helpers',[$this,'helpers_page']);
}
 private function verify($a){ if(!current_user_can('manage_options') || !check_admin_referer($a)) wp_die('Nicht erlaubt.'); }
 private function go($args=[],$page='vtp'){ wp_safe_redirect(add_query_arg($args,admin_url('admin.php?page='.$page))); exit; }
 private function field($l,$n,$v,$type='text',$req=false){ echo '<p><label>'.esc_html($l).'<br><input class="regular-text" type="'.esc_attr($type).'" name="'.esc_attr($n).'" value="'.esc_attr($v).'" '.($req?'required':'').'></label></p>'; }
 public static function placeholder_side($round_label,$side='home'){
  $label=(string)$round_label;
  if(strpos($label,'·')!==false) $label=trim(substr($label,strpos($label,'·')+2));
  if(strpos($label,' gegen ')!==false){ $parts=explode(' gegen ',$label,2); return trim($side==='away'?$parts[1]:$parts[0]); }
  return 'offen';
 }
 public static function status_label($s){ $m=['scheduled'=>'Angesetzt','planned'=>'Geplant','running'=>'Läuft','finished'=>'Beendet','cancelled'=>'Abgesagt','abandoned'=>'Abgebrochen','postponed'=>'Verschoben','forfeit'=>'Wertung','noshow'=>'Nicht angetreten','angesetzt'=>'Angesetzt','geplant'=>'Geplant','läuft'=>'Läuft','beendet'=>'Beendet','wertung'=>'Wertung','aktiv'=>'Aktiv','archiviert'=>'Archiviert']; return $m[$s]??$s; }
 private function type_label($k){ $m=['jugendturnier'=>'Jugendturnier','einlagenspiel'=>'Einlagenspiel','elfmeterschiessen'=>'11m-Schießen','neunmeterschiessen'=>'9m-Schießen','hallenturnier'=>'Hallenturnier','ah_turnier'=>'AH-Turnier','blitzturnier'=>'Blitzturnier','turnier'=>'Turnier','bewirtung'=>'Bewirtung','programm'=>'Programmpunkt']; return $m[$k]??'Turnier'; }
 public function dashboard_page(){ global $wpdb;
  $events=$wpdb->get_results("SELECT * FROM ".VTP_DB::table('events')." WHERE status<>'archiviert' ORDER BY start_date DESC, created_at DESC LIMIT 12");
  $tcount=(int)$wpdb->get_var("SELECT COUNT(*) FROM ".VTP_DB::table('tournaments')." WHERE status<>'archiviert'");
  $ecount=(int)$wpdb->get_var("SELECT COUNT(*) FROM ".VTP_DB::table('events')." WHERE status<>'archiviert'");
  $scount=(int)$wpdb->get_var("SELECT COUNT(*) FROM ".VTP_DB::table('shifts'));
  $filled=(int)$wpdb->get_var("SELECT COUNT(*) FROM ".VTP_DB::table('shift_signups'));
  $needed=(int)$wpdb->get_var("SELECT COALESCE(SUM(slots_needed),0) FROM ".VTP_DB::table('shifts'));
  $open=max(0,$needed-$filled);
  echo '<div class="wrap vtp"><h1>TuS Eventplaner</h1><p class="description">Zentrale Übersicht für Events, Turnierplan und Helferschichten.</p>';
  echo '<div class="vtp-kpi-grid"><div class="vtp-kpi"><strong>'.esc_html($ecount).'</strong><span>aktive Events</span></div><div class="vtp-kpi"><strong>'.esc_html($tcount).'</strong><span>Turniere</span></div><div class="vtp-kpi"><strong>'.esc_html($scount).'</strong><span>Schichten</span></div><div class="vtp-kpi"><strong>'.esc_html($open).'</strong><span>offene Helferplätze</span></div></div>';
  echo '<div class="vtp-grid"><div class="vtp-card"><h2>Nächste Schritte</h2><ol class="vtp-steps"><li>Event anlegen und Veranstaltungsort pflegen</li><li>Programmübersicht mit Programmpunkten erstellen</li><li>Turniere verknüpfen oder Einzelturniere anlegen</li><li>Helferbedarf definieren und Schichten generieren</li><li>Helferschichten Mannschaften/Gruppen zuweisen</li></ol><p><a class="button button-primary" href="'.esc_url(admin_url('admin.php?page=vtp-events')).'">Events öffnen</a> <a class="button" href="'.esc_url(admin_url('admin.php?page=vtp')).'">Turnierplan öffnen</a> <a class="button" href="'.esc_url(admin_url('admin.php?page=vtp-helpers')).'">Helferschichten öffnen</a> <a class="button" target="_blank" href="'.esc_url(VTP_Public::calendar_url()).'">Veranstaltungskalender öffnen</a></p></div>';
  echo '<div class="vtp-card"><h2>Aktuelle Events</h2>';
  if(!$events){ echo '<p>Noch keine Events angelegt.</p>'; }
  else { echo '<table class="widefat striped"><thead><tr><th>Event</th><th>Datum</th><th>Ort</th><th>Fortschritt</th><th></th></tr></thead><tbody>'; foreach($events as $ev){
    $items=(int)$wpdb->get_var($wpdb->prepare('SELECT COUNT(*) FROM '.VTP_DB::table('event_items').' WHERE event_id=%d',$ev->id));
    $needs=(int)$wpdb->get_var($wpdb->prepare('SELECT COUNT(*) FROM '.VTP_DB::table('helper_needs').' WHERE event_id=%d',$ev->id));
    $shifts=(int)$wpdb->get_var($wpdb->prepare('SELECT COUNT(*) FROM '.VTP_DB::table('shifts').' WHERE event_id=%d',$ev->id));
    $checks=0; if($ev->name) $checks++; if($items>0) $checks++; if($needs>0) $checks++; if($shifts>0) $checks++;
    $pct=round($checks/4*100);
    echo '<tr><td><strong>'.esc_html($ev->name).'</strong></td><td>'.esc_html($ev->start_date.($ev->end_date && $ev->end_date!==$ev->start_date?' – '.$ev->end_date:'')).'</td><td>'.esc_html($ev->location).'</td><td><div class="vtp-progress"><span style="width:'.esc_attr($pct).'%"></span></div><small>'.esc_html($pct).'%</small></td><td><a class="button" href="'.esc_url(add_query_arg(['page'=>'vtp-events','edit_event'=>$ev->id],admin_url('admin.php'))).'">Bearbeiten</a></td></tr>';
  } echo '</tbody></table>'; }
  echo '</div></div></div>';
 }

 public function page(){
  global $wpdb;
  $edit=absint($_GET['edit']??0);
  $show_archive=!empty($_GET['archive']) || (($_GET['view']??'')==='archive');
  $view=sanitize_key($_GET['view']??($show_archive?'archive':'active'));
  if(!in_array($view,['new','active','archive'],true)) $view='active';
  $t=$edit?$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('tournaments').' WHERE id=%d',$edit)):null;
  $where=$show_archive?"status='archiviert'":"status<>'archiviert'";
  $order = $show_archive ? "ORDER BY start_date DESC, start_time DESC, created_at DESC" : "ORDER BY start_date ASC, start_time ASC, created_at ASC";
  $rows=$wpdb->get_results("SELECT * FROM ".VTP_DB::table('tournaments')." WHERE $where $order");
  $events=$wpdb->get_results("SELECT id,name FROM ".VTP_DB::table('events')." WHERE status<>'archiviert' ORDER BY start_date DESC,name");

  echo '<div class="wrap vtp vtp-modern"><h1>TuS Mingolsheim Turniercenter</h1>';
  foreach(['saved'=>'Gespeichert.','generated'=>'Spielplan intelligent generiert.','finals'=>'Finalrunde generiert/aktualisiert.','created_page'=>'Turnierseite erstellt/aktualisiert.','archived'=>'Archiviert.','restored'=>'Wiederhergestellt.','deleted'=>'Gelöscht.'] as $k=>$m){
    if(isset($_GET[$k])) echo '<div class="notice notice-success"><p>'.$m.'</p></div>';
  }

  if($t){
    $teamCount=(int)$wpdb->get_var($wpdb->prepare('SELECT COUNT(*) FROM '.VTP_DB::table('teams').' WHERE tournament_id=%d',$t->id));
    $matchCount=(int)$wpdb->get_var($wpdb->prepare('SELECT COUNT(*) FROM '.VTP_DB::table('matches').' WHERE tournament_id=%d',$t->id));
    $finishedCount=(int)$wpdb->get_var($wpdb->prepare('SELECT COUNT(*) FROM '.VTP_DB::table('matches').' WHERE tournament_id=%d AND status=%s',$t->id,'finished'));
    echo '<div class="vtp-tournament-hero"><div><h2>'.esc_html($t->name).'</h2><p>'.esc_html($this->type_label($t->event_type)).($t->start_date?' · '.esc_html(date_i18n('d.m.Y',strtotime($t->start_date))):'').($t->start_time?' · '.esc_html(substr($t->start_time,0,5)).' Uhr':'').($t->location?' · '.esc_html($t->location):'').'</p></div><div class="vtp-hero-kpis"><span><strong>'.esc_html($teamCount).'</strong> Teams</span><span><strong>'.esc_html($matchCount).'</strong> Spiele</span><span><strong>'.esc_html($finishedCount).'</strong> beendet</span><form class="vtp-tournament-switch" method="get" action="'.esc_url(admin_url('admin.php')).'"><input type="hidden" name="page" value="vtp"><select name="edit" onchange="this.form.submit()">';
    foreach($rows as $rr){ echo '<option value="'.esc_attr($rr->id).'" '.selected($t->id,$rr->id,false).'>'.esc_html($rr->name).'</option>'; }
    echo '</select></form></div></div><nav class="vtp-tabs"><a href="#turnierdaten">Übersicht</a><a href="#turnierleitung">Turnierleitung</a><a href="#teams">Teams</a><a href="#gruppen">Gruppen</a><a href="#schiedsrichter">Schiedsrichter</a><a href="#sponsoren">Sponsoren</a><a href="#spielplan">Spielplan</a><a href="#ergebnisse">Ergebnisse</a></nav>';
    $this->render_tournament_assistant($t);

    echo '<div class="vtp-grid vtp-top-grid vtp-single-edit"><div class="vtp-card vtp-turnierdaten-card" id="turnierdaten">';
    echo '<details class="vtp-compact-editor"><summary><span><strong>Turnierdaten</strong><small>'.esc_html($t->name).' · '.esc_html($this->type_label($t->event_type)).($t->start_date?' · '.esc_html(date_i18n('d.m.Y',strtotime($t->start_date))):'').($t->start_time?' · '.esc_html(substr($t->start_time,0,5)).' Uhr':'').'</small></span><span><span class="button">Turnierdaten bearbeiten</span></span></summary>';
    $this->render_tournament_form($t,$events);
    echo '</details></div></div>';
    $this->manage($t);
    echo '</div>';
    return;
  }

  echo '<nav class="vtp-view-tabs"><a class="button '.($view==='new'?'button-primary':'').'" href="'.esc_url(admin_url('admin.php?page=vtp&view=new')).'">Neues Turnier anlegen</a> <a class="button '.($view==='active'?'button-primary':'').'" href="'.esc_url(admin_url('admin.php?page=vtp&view=active')).'">Aktive Turniere</a> <a class="button '.($view==='archive'?'button-primary':'').'" href="'.esc_url(admin_url('admin.php?page=vtp&view=archive&archive=1')).'">Archiv</a></nav>';

  if($view==='new'){
    echo '<div class="vtp-card vtp-wide"><h2>Neues Turnier anlegen</h2><p class="description">Lege hier ein neues Turnier an. Teams, Gruppen und Spielplan kannst du anschließend im Turnier bearbeiten.</p>';
    $this->render_tournament_form(null,$events);
    echo '</div></div>';
    return;
  }

  if($view==='archive'){
    echo '<div class="vtp-card vtp-wide"><h2>Archivierte Turniere</h2><p class="description">Hier werden ausschließlich archivierte Turniere angezeigt. Neue Turniere legst du im Bereich „Neues Turnier anlegen“ an.</p>';
  } else {
    echo '<div class="vtp-card vtp-wide"><h2>Aktive Turniere</h2><p class="description">Wähle ein Turnier aus, um Teams, Gruppen, Spielplan und Ergebnisse zu bearbeiten.</p>';
  }
  echo '<div class="vtp-tournament-cards vtp-tournament-card-grid">';
  if(!$rows){ echo '<p>'.($view==='archive'?'Noch keine archivierten Turniere vorhanden.':'Noch keine aktiven Turniere vorhanden.').'</p>'; }
  foreach($rows as $r){
    $teamCount=(int)$wpdb->get_var($wpdb->prepare('SELECT COUNT(*) FROM '.VTP_DB::table('teams').' WHERE tournament_id=%d',$r->id));
    $dateLabel=$r->start_date?date_i18n('d.m.Y',strtotime($r->start_date)):'kein Datum';
    $timeLabel=$r->start_time?substr($r->start_time,0,5).' Uhr':'';
    echo '<div class="vtp-tournament-card vtp-tournament-card-modern">';
    echo '<div class="vtp-card-accent"></div><div class="vtp-card-main"><div class="vtp-card-title-row"><h3>'.esc_html($r->name).'</h3><span class="vtp-status-badge">'.esc_html(self::status_label($r->status)).'</span></div>';
    echo '<p class="vtp-card-meta">'.esc_html($this->type_label($r->event_type)).' · '.esc_html($dateLabel).($timeLabel?' · '.esc_html($timeLabel):'').'</p>';
    if(!empty($r->location)) echo '<p class="vtp-card-location">'.esc_html($r->location).'</p>';
    echo '<p class="vtp-card-badges"><span class="vtp-pill">⚽ '.esc_html($teamCount).' Teams</span>'.($r->public_signup_enabled?'<span class="vtp-pill">Anmeldung aktiv</span>':'').'</p>';
    echo '<div class="vtp-card-actions"><a class="button button-primary" href="'.esc_url(add_query_arg(['page'=>'vtp','edit'=>$r->id],admin_url('admin.php'))).'">Öffnen</a> <a class="button" target="_blank" href="'.esc_url(VTP_Public::public_url($r)).'">Spielplan</a></div>';
    echo '</div></div>';
  }
  echo '</div></div></div>';
 }

 private function render_tournament_assistant($t){
  global $wpdb;
  $tid=(int)$t->id;
  $teams=(int)$wpdb->get_var($wpdb->prepare('SELECT COUNT(*) FROM '.VTP_DB::table('teams').' WHERE tournament_id=%d',$tid));
  $ungrouped=(int)$wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM ".VTP_DB::table('teams')." WHERE tournament_id=%d AND (group_name IS NULL OR group_name='')",$tid));
  $groups=(int)$wpdb->get_var($wpdb->prepare("SELECT COUNT(DISTINCT group_name) FROM ".VTP_DB::table('teams')." WHERE tournament_id=%d AND group_name<>''",$tid));
  $smallGroups=(int)$wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM (SELECT group_name, COUNT(*) c FROM ".VTP_DB::table('teams')." WHERE tournament_id=%d AND group_name<>'' GROUP BY group_name HAVING c<2) x",$tid));
  $matches=(int)$wpdb->get_var($wpdb->prepare('SELECT COUNT(*) FROM '.VTP_DB::table('matches').' WHERE tournament_id=%d',$tid));
  $finished=(int)$wpdb->get_var($wpdb->prepare('SELECT COUNT(*) FROM '.VTP_DB::table('matches').' WHERE tournament_id=%d AND status=%s',$tid,'finished'));
  $refs=(int)$wpdb->get_var($wpdb->prepare('SELECT COUNT(*) FROM '.VTP_DB::table('referees').' WHERE tournament_id=%d',$tid));
  $regEnabled=get_post_meta($tid,'_vtp_public_registration',true)==='1';
  $maxTeams=(int)get_post_meta($tid,'_vtp_max_teams',true);
  $steps=[];
  $steps[]=['Turnierdaten',!empty($t->name) && !empty($t->start_date) && !empty($t->start_time),'#turnierdaten'];
  $steps[]=['Teams',$teams>0,'#teams'];
  $steps[]=['Gruppen',($t->tournament_mode==='league' || $t->tournament_mode==='bambini') ? $teams>0 : $groups>0,'#gruppen'];
  $steps[]=['Spielplan',$matches>0,'#spielplan'];
  $steps[]=['Ergebnisse',$matches>0 && $finished>0,'#ergebnisse'];
  $steps[]=['Abschluss',$matches>0 && $finished>=$matches,'#ergebnisse'];
  echo '<div class="vtp-assistant vtp-card vtp-wide"><div class="vtp-assistant-head"><div><h2>Turnier-Check</h2><p class="description">Schneller Überblick, ob das Turnier bereit für den Spieltag ist.</p></div><div class="vtp-assistant-summary"><strong>'.esc_html($finished).' / '.esc_html($matches).'</strong><span>Spiele beendet</span></div></div>';
  echo '<div class="vtp-stepbar">';
  foreach($steps as $st){ echo '<a href="'.esc_attr($st[2]).'" class="vtp-step '.($st[1]?'done':'open').'"><span>'.($st[1]?'✓':'○').'</span>'.esc_html($st[0]).'</a>'; }
  echo '</div>';
  $warnings=[]; $oks=[];
  if($teams===0) $warnings[]='Noch keine Mannschaften angelegt.'; else $oks[]=$teams.' Mannschaften angelegt.';
  if($ungrouped>0 && $t->tournament_mode!=='league') $warnings[]=$ungrouped.' Mannschaft(en) sind noch keiner Gruppe zugeordnet.';
  if($smallGroups>0 && !in_array($t->tournament_mode,['league','bambini'],true)) $warnings[]=$smallGroups.' Gruppe(n) haben weniger als 2 Mannschaften.';
  if($matches===0) $warnings[]='Der Spielplan wurde noch nicht generiert.'; else $oks[]=$matches.' Spiele im Spielplan.';
  if($refs===0 && $matches>0) $warnings[]='Noch keine Schiedsrichter angelegt oder zugeteilt.'; else if($refs>0) $oks[]=$refs.' Schiedsrichter angelegt.';
  if($regEnabled && $maxTeams>0 && $teams>=$maxTeams) $warnings[]='Das Anmeldelimit ist erreicht: '.$teams.' / '.$maxTeams.' Mannschaften.';
  echo '<div class="vtp-check-grid"><div class="vtp-check-box"><h3>Hinweise</h3>';
  if($warnings){ echo '<ul class="vtp-check-list warn">'; foreach($warnings as $w) echo '<li>'.esc_html($w).'</li>'; echo '</ul>'; } else echo '<p class="vtp-ok">Alles sieht gut aus.</p>';
  echo '</div><div class="vtp-check-box"><h3>Bereit</h3>';
  if($oks){ echo '<ul class="vtp-check-list ok">'; foreach($oks as $o) echo '<li>'.esc_html($o).'</li>'; echo '</ul>'; } else echo '<p class="description">Noch keine geprüften Punkte vorhanden.</p>';
  echo '</div></div></div>';
 }

 private function render_tournament_form($t,$events){
  echo '<form method="post" action="'.esc_url(admin_url('admin-post.php')).'">'; wp_nonce_field('vtp_save_tournament'); echo '<input type="hidden" name="action" value="vtp_save_tournament"><input type="hidden" name="id" value="'.esc_attr($t->id??0).'">';
  echo '<div class="vtp-form-section"><h3>Turnierinformationen</h3>';
  $this->field('Name','name',$t->name??'','text',true); $this->field('Datum','start_date',$t->start_date??'','date'); $this->field('Startzeit','start_time',$t->start_time??'09:00','time');
  echo '<p><label>Veranstaltungsart<br><select name="event_type">'; $types=['jugendturnier'=>'Jugendturnier','hallenturnier'=>'Hallenturnier','elfmeterschiessen'=>'11m-Schießen','neunmeterschiessen'=>'9m-Schießen','einlagenspiel'=>'Einlagenspiel','turnier'=>'Turnier']; foreach($types as $k=>$v) echo '<option value="'.esc_attr($k).'" '.selected($t->event_type??'jugendturnier',$k,false).'>'.esc_html($v).'</option>'; echo '</select></label></p>';
  $this->field('Veranstaltungsort','location',$t->location??'','text');
  echo '<p><label>Beschreibung<br><textarea name="description" rows="3" class="large-text">'.esc_textarea($t->description??'').'</textarea></label></p></div>';
  echo '<div class="vtp-form-section"><h3>Event-Zuordnung</h3><p class="description">Turniere können eigenständig bleiben oder einem Event/Sportfest zugeordnet werden.</p><p><label>Teil eines Events<br><select name="event_id"><option value="0">Nein / Einzelturnier</option>'; foreach($events as $e) echo '<option value="'.esc_attr($e->id).'" '.selected($t->event_id??0,$e->id,false).'>'.esc_html($e->name).'</option>'; echo '</select></label></p></div>';
  echo '<div class="vtp-mode-layout"><div class="vtp-form-section vtp-mode-settings"><h3>Modus & Spielplan</h3>';
  echo '<p><label>Turniermodus<br><select id="vtp_tournament_mode" name="tournament_mode"><option value="league" '.selected($t->tournament_mode??'groups_ko','league',false).'>Liga-Modus / Jeder gegen jeden</option><option value="groups" '.selected($t->tournament_mode??'groups_ko','groups',false).'>Nur Gruppenphase</option><option value="groups_ko" '.selected($t->tournament_mode??'groups_ko','groups_ko',false).'>Gruppenphase + K.O.-Phase</option><option value="groups_placement" '.selected($t->tournament_mode??'groups_ko','groups_placement',false).'>Gruppenphase + Platzierungsspiele</option><option value="bambini" '.selected($t->tournament_mode??'groups_ko','bambini',false).'>Bambini-Spieltag (ohne Wertung)</option></select></label></p>';
  echo '<p class="vtp-mode-option" data-vtp-modes="groups_ko"><label>K.O.-Phase ab<br><select name="ko_size">'; foreach([16=>'Achtelfinale / 16 Teams',8=>'Viertelfinale / 8 Teams',4=>'Halbfinale / 4 Teams',2=>'Finale / 2 Teams'] as $k=>$v) echo '<option value="'.$k.'" '.selected($t->ko_size??4,$k,false).'>'.$v.'</option>'; echo '</select></label><span class="vtp-mode-disabled-note">Nur bei Gruppenphase + K.O.-Phase relevant.</span></p>';
  echo '<p class="vtp-mode-option" data-vtp-modes="groups_ko"><label><input type="checkbox" name="third_place_match" value="1" '.checked(get_post_meta(absint($t->id??0),'_vtp_third_place_match',true),'1',false).'> Spiel um Platz 3 / kleines Finale einplanen</label><span class="vtp-mode-disabled-note">Im aktuellen Modus nicht relevant.</span></p>';
  echo '<p class="vtp-mode-option" data-vtp-modes="groups_placement"><label><input type="checkbox" name="all_placement_matches" value="1" '.checked(get_post_meta(absint($t->id??0),'_vtp_all_placement_matches',true),'1',false).'> Bei Platzierungsspielen alle Plätze ausspielen</label><span class="vtp-mode-disabled-note">Nur bei Platzierungsspielen relevant.</span></p>';
  $this->field('Gruppenanzahl','auto_groups',$t->auto_groups??2,'number'); $this->field('Spieldauer Minuten','match_duration',$t->match_duration??10,'number'); $this->field('Pause Minuten','break_minutes',$t->break_minutes??2,'number'); $this->field('Anzahl Felder','fields_count',$t->fields_count??1,'number'); $this->field('Mindestpause pro Mannschaft in Spielrunden','min_team_rest',get_post_meta(absint($t->id??0),'_vtp_min_team_rest',true)?:1,'number');
  echo '</div><aside class="vtp-form-section vtp-ranking-info"><h3>Modus-Hilfe</h3>';
  echo '<div class="vtp-mode-help" data-vtp-help="league"><h4>Liga-Modus</h4><p>Alle Mannschaften spielen gegeneinander. Es gibt keine K.O.-Runde.</p><ol><li><strong>Punkte</strong></li><li><strong>Tordifferenz</strong></li><li><strong>Mehr erzielte Tore</strong></li><li><strong>Direkter Vergleich</strong>, falls eindeutig</li><li><strong>Losentscheid</strong></li></ol></div>';
  echo '<div class="vtp-mode-help" data-vtp-help="groups"><h4>Nur Gruppenphase</h4><p>Die Platzierungen entstehen ausschließlich aus den Gruppentabellen.</p><ol><li>Punkte</li><li>Tordifferenz</li><li>Erzielte Tore</li><li>Direkter Vergleich</li><li>Losentscheid</li></ol></div>';
  echo '<div class="vtp-mode-help" data-vtp-help="groups_ko"><h4>Gruppenphase + K.O.-Phase</h4><p>Nach Abschluss der Gruppenphase werden die K.O.-Spiele automatisch befüllt.</p><ul><li>Finale: 1A gegen 1B</li><li>Halbfinale: 1A gegen 2B und 1B gegen 2A</li><li>Spiel um Platz 3 optional</li></ul><div class="vtp-info-note">Gruppenwertung: Punkte → Tordifferenz → erzielte Tore → direkter Vergleich → Los.</div></div>';
  echo '<div class="vtp-mode-help" data-vtp-help="groups_placement"><h4>Gruppenphase + Platzierungsspiele</h4><p>Nach der Gruppenphase werden Platzierungsspiele erzeugt.</p><ul><li>1A gegen 1B = Platz 1/2</li><li>2A gegen 2B = Platz 3/4</li><li>3A gegen 3B usw.</li></ul></div>';
  echo '<div class="vtp-mode-help" data-vtp-help="bambini"><h4>Bambini-Spieltag</h4><p>Es wird ein Spielplan erstellt, aber keine Tabelle, keine K.O.-Phase und keine Endplatzierung angezeigt.</p><div class="vtp-info-note">Alle Kinder stehen im Mittelpunkt – ohne Wertung.</div></div>';
  echo '</aside></div>';
  echo '<script>(function(){var select=document.getElementById("vtp_tournament_mode");if(!select)return;function updateModeUi(){var mode=select.value;document.querySelectorAll(".vtp-mode-option").forEach(function(row){var modes=(row.getAttribute("data-vtp-modes")||"").split(/\s+/);var active=modes.indexOf(mode)!==-1;row.classList.toggle("vtp-mode-disabled",!active);row.querySelectorAll("input,select,textarea").forEach(function(el){el.disabled=!active;});});document.querySelectorAll(".vtp-mode-help").forEach(function(box){box.style.display=box.getAttribute("data-vtp-help")===mode?"block":"none";});}select.addEventListener("change",updateModeUi);updateModeUi();})();</script>';
  echo '<div class="vtp-form-section"><h3>Turnieranmeldung</h3><p class="description">Optional: öffentliche Anmeldung für Mannschaften aktivieren. Wenn diese Option nicht aktiv ist, wird kein Anmeldeformular angezeigt.</p>';
  echo '<p><label><input type="checkbox" name="public_registration" value="1" '.checked(get_post_meta(absint($t->id??0),'_vtp_public_registration',true),'1',false).'> Öffentliche Anmeldeseite erstellen</label></p>';
  $this->field('Maximale Anzahl Mannschaften','max_teams',get_post_meta(absint($t->id??0),'_vtp_max_teams',true),'number');
  echo '</div>';
  submit_button($t?'Turnier aktualisieren':'Turnier anlegen'); echo '</form>';
 }

 private function manage($t){ global $wpdb;
  $teams=$wpdb->get_results($wpdb->prepare('SELECT * FROM '.VTP_DB::table('teams').' WHERE tournament_id=%d ORDER BY group_name, sort_order, name',$t->id));
  $matches=$wpdb->get_results($wpdb->prepare('SELECT m.*, h.name home_name, a.name away_name FROM '.VTP_DB::table('matches').' m LEFT JOIN '.VTP_DB::table('teams').' h ON h.id=m.team_home LEFT JOIN '.VTP_DB::table('teams').' a ON a.id=m.team_away WHERE m.tournament_id=%d ORDER BY COALESCE(m.starts_at,"9999-12-31"),m.match_no',$t->id));
  $groups=[]; foreach($teams as $team){ $gn=trim((string)$team->group_name); if($gn!=='') $groups[$gn][]=$team; }
  $storedGroups=get_post_meta(absint($t->id),'_vtp_group_names',true); if(!is_array($storedGroups)) $storedGroups=[];
  foreach($storedGroups as $sg){ $sg=trim((string)$sg); if($sg!=='' && !isset($groups[$sg])) $groups[$sg]=[]; }
  ksort($groups, SORT_NATURAL);
  $unassigned=[]; foreach($teams as $team){ if(trim((string)$team->group_name)==='') $unassigned[]=$team; }
  $public=VTP_Public::public_url($t);
  $registration=method_exists('VTP_Public','registration_url') ? VTP_Public::registration_url($t) : add_query_arg('anmeldung','1',$public);
  if(strlen((string)$t->leader_pin)!==4){ $t->leader_pin=(string)wp_rand(1000,9999); $wpdb->update(VTP_DB::table('tournaments'),['leader_pin'=>$t->leader_pin],['id'=>$t->id]); }

  echo '<div class="vtp-card vtp-wide" id="turnierleitung"><h2>Turnierleitung</h2><div class="vtp-leader-grid">';
  echo '<div class="vtp-leader-box"><h3>Öffentlich</h3><p class="description">Links und Ausdrucke für Teilnehmer und Zuschauer.</p><div class="vtp-leader-actions">';
  if(get_post_meta(absint($t->id),'_vtp_public_registration',true)==='1') echo '<a class="button button-primary" target="_blank" href="'.esc_url($registration).'">Turnieranmeldung öffnen</a>';
  else echo '<button type="button" class="button" disabled>Turnieranmeldung öffnen</button><span class="description">nicht aktiviert</span>';
  echo '<a class="button button-primary" target="_blank" href="'.esc_url($public).'">Spielplan öffnen</a>';
  echo '<a class="button" target="_blank" href="'.esc_url(wp_nonce_url(admin_url('admin-post.php?action=vtp_print_pdf&tournament_id='.(int)$t->id),'vtp_print_pdf_'.(int)$t->id)).'">Spielplan drucken</a>';
  echo '</div></div>';
  echo '<div class="vtp-leader-box"><h3>Ergebnismeldung</h3><p class="description">Zugang für die Turnierleitung ohne WordPress-Login.</p><div class="vtp-leader-actions"><a class="button button-primary" target="_blank" href="'.esc_url(VTP_Public::leader_url($t)).'">Ergebnismeldung öffnen</a><div class="vtp-pin-line"><span>PIN</span><code>'.esc_html($t->leader_pin).'</code></div>';
  echo '<form method="post" action="'.esc_url(admin_url('admin-post.php')).'" class="vtp-inline-form">'.wp_nonce_field('vtp_regenerate_pin','_wpnonce',true,false).'<input type="hidden" name="action" value="vtp_regenerate_pin"><input type="hidden" name="tournament_id" value="'.esc_attr($t->id).'">'.get_submit_button('PIN neu generieren','secondary','submit',false).'</form>';
  echo '</div></div>';
  echo '<div class="vtp-leader-box"><h3>Schiedsrichter</h3><p class="description">Ausdruck mit QR-Code und PIN für die Ergebnismeldung.</p><div class="vtp-leader-actions"><a class="button" target="_blank" href="'.esc_url(wp_nonce_url(admin_url('admin-post.php?action=vtp_print_referees_pdf&tournament_id='.(int)$t->id),'vtp_print_referees_pdf_'.(int)$t->id)).'">Schiedsrichter PDF drucken</a></div></div>';
  echo '</div></div>';

  echo '<div class="vtp-card vtp-wide" id="teams"><h2>Teams</h2><p class="description">Alle angemeldeten oder manuell gepflegten Mannschaften. Vereine mit mehreren Mannschaften können später auf verschiedene Gruppen verteilt werden.</p>';
  echo '<form method="post" action="'.esc_url(admin_url('admin-post.php')).'">'; wp_nonce_field('vtp_save_group_editor'); echo '<input type="hidden" name="action" value="vtp_save_group_editor"><input type="hidden" name="tournament_id" value="'.esc_attr($t->id).'">';
  echo '<div class="vtp-add-row"><div><strong>Neue Mannschaft hinzufügen</strong><p class="description">Neue Teams bleiben ohne Gruppenzuordnung, solange keine Gruppe gewählt wird.</p></div><div class="vtp-add-fields"><input type="text" name="new_team_name[]" placeholder="Mannschaftsname"> <select name="new_team_group[]"><option value="">Noch keiner Gruppe zuordnen</option>'; foreach(array_keys($groups) as $gg) echo '<option value="'.esc_attr($gg).'">Gruppe '.esc_html($gg).'</option>'; echo '</select> <button class="button button-primary">Hinzufügen</button></div></div>';
  echo '<table class="widefat striped vtp-teams-table"><thead><tr><th>Mannschaft</th><th>Trainer</th><th>Kontakt</th><th>Gruppe</th><th>Entfernen</th></tr></thead><tbody>';
  if(!$teams) echo '<tr><td colspan="5">Noch keine Mannschaften vorhanden.</td></tr>';
  foreach($teams as $tm){ echo '<tr><td><input type="hidden" name="team_id[]" value="'.esc_attr($tm->id).'"><input type="text" name="team_name[]" value="'.esc_attr($tm->name).'" class="regular-text"></td><td><input type="text" name="team_trainer[]" value="'.esc_attr($tm->trainer_name ?? '').'"></td><td><input type="text" name="team_contact[]" value="'.esc_attr($tm->contact ?? '').'"></td><td><input type="text" name="team_group[]" value="'.esc_attr($tm->group_name).'" style="width:80px"></td><td><label><input type="checkbox" name="team_delete[]" value="'.esc_attr($tm->id).'"> löschen</label></td></tr>'; }
  echo '</tbody></table><p><button class="button button-primary">Teams speichern</button></p></form></div>';

  echo '<div class="vtp-card vtp-wide" id="gruppen"><h2>Gruppen</h2><p class="description">Gruppen können automatisch aus den Teams entstehen oder manuell gepflegt werden. Nach Änderungen wird der Spielplan automatisch angepasst bzw. kann neu generiert werden.</p>';
  echo '<form method="post" action="'.esc_url(admin_url('admin-post.php')).'">'; wp_nonce_field('vtp_save_group_editor'); echo '<input type="hidden" name="action" value="vtp_save_group_editor"><input type="hidden" name="tournament_id" value="'.esc_attr($t->id).'">';
  echo '<div class="vtp-add-row"><div><strong>Gruppen automatisch generieren</strong><p class="description">Verteilt alle Teams gleichmäßig auf die in den Turnierdaten festgelegte Gruppenanzahl. Vereine mit mehreren Mannschaften werden möglichst getrennt.</p></div><div class="vtp-add-fields"><button type="submit" name="vtp_generate_groups" value="1" class="button button-primary">Gruppen automatisch generieren</button></div></div>';
  echo '<div class="vtp-add-row"><div><strong>Neue Gruppe anlegen</strong><p class="description">Leere Gruppen können angelegt und anschließend mit noch nicht zugeordneten Mannschaften befüllt werden.</p></div><div class="vtp-add-fields"><input type="text" name="add_group_name" placeholder="z. B. C oder Goldrunde"> <button type="submit" class="button">Gruppe hinzufügen</button></div></div><div class="vtp-groups vtp-groups-wide">';
  foreach($groups as $g=>$list){ echo '<div class="vtp-group vtp-group-edit"><div class="vtp-group-head"><h3>Gruppe '.esc_html($g).'</h3><label class="vtp-delete-group"><input type="checkbox" name="delete_group[]" value="'.esc_attr($g).'"> Gruppe löschen</label></div>';
    if($list){ foreach($list as $tm){ echo '<div class="vtp-team-pill '.($tm->status==='noshow'?'noshow':'').'"><input type="hidden" name="team_id[]" value="'.esc_attr($tm->id).'"><input type="text" name="team_name[]" value="'.esc_attr($tm->name).'"><input type="hidden" name="team_trainer[]" value="'.esc_attr($tm->trainer_name ?? '').'"><input type="hidden" name="team_contact[]" value="'.esc_attr($tm->contact ?? '').'"><input type="text" name="team_group[]" value="'.esc_attr($tm->group_name).'" style="width:70px"><label><input type="checkbox" name="team_unassign[]" value="'.esc_attr($tm->id).'"> entfernen</label></div>'; } }
    else echo '<p class="description">Diese Gruppe ist noch leer.</p>';
    echo '<div class="vtp-new-team"><strong>Mannschaft zur Gruppe hinzufügen</strong><div class="vtp-add-fields"><select name="assign_team_to_group['.esc_attr($g).']"><option value="">Noch nicht zugeordnete Mannschaft wählen</option>'; foreach($unassigned as $ut){ echo '<option value="'.esc_attr($ut->id).'">'.esc_html($ut->name).'</option>'; } echo '</select> <button type="submit" class="button">Zuweisen</button></div>'; if(!$unassigned) echo '<p class="description">Keine unzugeordneten Mannschaften vorhanden.</p>'; echo '</div></div>'; }
  if(empty($groups)) echo '<p>Noch keine Gruppen vorhanden.</p>';
  echo '</div><p><button class="button button-primary">Gruppen speichern</button></p></form></div>';

  echo '<div class="vtp-card vtp-wide" id="schiedsrichter"><div class="vtp-card-head"><h2>Schiedsrichter</h2><button type="button" class="button" onclick="var r=document.querySelector(\'#vtp-referee-empty-row\'); if(r){ var c=r.cloneNode(true); c.removeAttribute(\'id\'); c.style.display=\'table-row\'; r.parentNode.appendChild(c); }">Schiedsrichter hinzufügen</button></div>';
  $refs=$wpdb->get_results($wpdb->prepare('SELECT * FROM '.VTP_DB::table('referees').' WHERE tournament_id=%d ORDER BY sort_order,id',$t->id));
  echo '<form method="post" action="'.esc_url(admin_url('admin-post.php')).'">'; wp_nonce_field('vtp_save_referees'); echo '<input type="hidden" name="action" value="vtp_save_referees"><input type="hidden" name="tournament_id" value="'.esc_attr($t->id).'"><table class="widefat striped"><thead><tr><th>Name</th><th>PIN</th><th>Link</th><th>Entfernen</th></tr></thead><tbody>';
  if($refs){ foreach($refs as $r){ echo '<tr><td><input type="hidden" name="referee_id[]" value="'.esc_attr($r->id).'"><input type="text" name="referee_name[]" value="'.esc_attr($r->name).'" class="regular-text"></td><td><code>'.esc_html($r->pin).'</code></td><td><a target="_blank" href="'.esc_url(VTP_Public::referee_url($r)).'">öffnen</a></td><td><label><input type="checkbox" name="referee_delete[]" value="'.esc_attr($r->id).'"> löschen</label></td></tr>'; } }
  else echo '<tr><td><input type="hidden" name="referee_id[]" value="0"><input type="text" name="referee_name[]" placeholder="Name" class="regular-text"></td><td>-</td><td>-</td><td></td></tr>';
  echo '<tr id="vtp-referee-empty-row" style="display:none"><td><input type="hidden" name="referee_id[]" value="0"><input type="text" name="referee_name[]" placeholder="Name" class="regular-text"></td><td>-</td><td>-</td><td></td></tr>';
  echo '</tbody></table><p>'; submit_button('Schiedsrichter speichern und Spiele zuweisen','secondary','submit',false); echo ' <a class="button button-primary" target="_blank" href="'.esc_url(wp_nonce_url(admin_url('admin-post.php?action=vtp_print_referees_pdf&tournament_id='.(int)$t->id),'vtp_print_referees_pdf_'.(int)$t->id)).'">Schiedsrichter-PDF drucken</a></p></form></div>';

  echo '<div class="vtp-card vtp-wide" id="sponsoren"><div class="vtp-card-head"><h2>Sponsoren</h2><button type="button" class="button" onclick="var r=document.querySelector(\'#vtp-sponsor-empty-row\'); if(r){ var c=r.cloneNode(true); c.removeAttribute(\'id\'); c.style.display=\'table-row\'; r.parentNode.appendChild(c); }">Sponsor hinzufügen</button></div><form method="post" action="'.esc_url(admin_url('admin-post.php')).'">'; wp_nonce_field('vtp_save_sponsors'); echo '<input type="hidden" name="action" value="vtp_save_sponsors"><input type="hidden" name="tournament_id" value="'.esc_attr($t->id).'"><table class="widefat striped"><thead><tr><th>Name</th><th>Logo-URL</th><th>Website</th><th>Entfernen</th></tr></thead><tbody>';
  $sponsorLines=preg_split('/\r\n|\r|\n/',(string)$t->sponsors); $shown=0; foreach($sponsorLines as $line){ $parts=array_map('trim',explode('|',$line)); if(empty($parts[0]) && empty($parts[1]) && empty($parts[2])) continue; $shown++; echo '<tr><td><input type="text" name="sponsor_name[]" value="'.esc_attr($parts[0]??'').'" placeholder="Sponsorname"></td><td><input type="text" name="sponsor_logo[]" value="'.esc_attr($parts[1]??'').'" placeholder="Logo-URL"></td><td><input type="url" name="sponsor_url[]" value="'.esc_attr($parts[2]??'').'" placeholder="Website"></td><td><label><input type="checkbox" name="sponsor_delete[]" value="1"> löschen</label></td></tr>'; }
  if(!$shown) echo '<tr><td><input type="text" name="sponsor_name[]" placeholder="Sponsorname"></td><td><input type="text" name="sponsor_logo[]" placeholder="Logo-URL"></td><td><input type="url" name="sponsor_url[]" placeholder="Website"></td><td></td></tr>';
  echo '<tr id="vtp-sponsor-empty-row" style="display:none"><td><input type="text" name="sponsor_name[]" placeholder="Sponsorname"></td><td><input type="text" name="sponsor_logo[]" placeholder="Logo-URL"></td><td><input type="url" name="sponsor_url[]" placeholder="Website"></td><td></td></tr>';
  echo '</tbody></table><p class="description">Logos können über die Mediathek hochgeladen und die Datei-URL hier eingefügt werden.</p>'; submit_button('Sponsoren speichern','secondary','submit',false); echo '</form></div>';

  echo '<div class="vtp-card vtp-wide" id="spielplan"><h2>Spielplan generieren</h2><p class="description">Die Startzeit wird aus den Turnierdaten übernommen: <strong>'.esc_html(substr($t->start_time?:'09:00',0,5)).' Uhr</strong>. Finalrunde und Nichtantritt-Optimierung werden automatisch berücksichtigt.</p><form method="post" action="'.esc_url(admin_url('admin-post.php')).'">'; wp_nonce_field('vtp_generate_matches'); echo '<input type="hidden" name="action" value="vtp_generate_matches"><input type="hidden" name="tournament_id" value="'.esc_attr($t->id).'"><input type="hidden" name="start_time" value="'.esc_attr($t->start_time?:'09:00').'">'; submit_button('Spielplan generieren / neu generieren','primary','submit',false); echo '</form></div>';

  echo '<div class="vtp-card vtp-wide" id="ergebnisse"><h2>Ergebnisse</h2>';
  echo '<details class="vtp-order-editor" style="margin-bottom:18px"><summary><strong>Spielreihenfolge bearbeiten</strong><span class="description" style="margin-left:8px">Für DFBnet-Spielpläne oder manuelle Feinjustierung.</span></summary>';
  echo '<form method="post" action="'.esc_url(admin_url('admin-post.php')).'" style="margin-top:14px">'; wp_nonce_field('vtp_save_match_order'); echo '<input type="hidden" name="action" value="vtp_save_match_order"><input type="hidden" name="tournament_id" value="'.esc_attr($t->id).'">';
  $teamOptions=[]; foreach($teams as $tmOpt){ $teamOptions[intval($tmOpt->id)]=$tmOpt->name; }
  echo '<table class="widefat striped"><thead><tr><th style="width:90px">Reihenfolge</th><th>#</th><th>Zeit</th><th>Feld</th><th>Runde</th><th>Heim / erstgenannt</th><th>Gast / zweitgenannt</th><th>Status</th></tr></thead><tbody>';
  foreach($matches as $m){
    echo '<tr><td><input type="number" min="1" name="match_order['.esc_attr($m->id).']" value="'.esc_attr($m->match_no).'" style="width:72px"></td><td>'.esc_html($m->match_no).'</td><td>'.esc_html($m->starts_at?date_i18n('H:i',strtotime($m->starts_at)):'-').'</td><td>'.esc_html($m->field_no?:'-').'</td><td>'.esc_html($m->round_label ?: ($m->group_name?'Gruppe '.$m->group_name:''));
    echo '</td><td><select name="match_home['.esc_attr($m->id).']"><option value="0">'.esc_html($m->home_name ?: self::placeholder_side($m->round_label,'home')).'</option>';
    foreach($teamOptions as $tidOpt=>$nameOpt){ echo '<option value="'.esc_attr($tidOpt).'" '.selected(intval($m->team_home),$tidOpt,false).'>'.esc_html($nameOpt).'</option>'; }
    echo '</select></td><td><select name="match_away['.esc_attr($m->id).']"><option value="0">'.esc_html($m->away_name ?: self::placeholder_side($m->round_label,'away')).'</option>';
    foreach($teamOptions as $tidOpt=>$nameOpt){ echo '<option value="'.esc_attr($tidOpt).'" '.selected(intval($m->team_away),$tidOpt,false).'>'.esc_html($nameOpt).'</option>'; }
    echo '</select></td><td>'.esc_html(self::status_label($m->status)).'</td></tr>';
  }
  echo '</tbody></table><p><label><input type="checkbox" name="recalculate_times" value="1"> Uhrzeiten und Felder strikt anhand der Reihenfolge neu berechnen</label></p><p class="description">Für DFBnet-Spielpläne: Startzeit aus den Turnierdaten, dann Spieldauer + Pause. Bei 1 Feld entstehen z. B. 14:00, 14:40, 15:20 ... Ergebnisse bleiben erhalten.</p>';
  submit_button('Spielreihenfolge speichern','secondary','submit',false); echo '</form></details>';
  echo '<form method="post" action="'.esc_url(admin_url('admin-post.php')).'">'; wp_nonce_field('vtp_save_results'); echo '<input type="hidden" name="action" value="vtp_save_results"><input type="hidden" name="tournament_id" value="'.esc_attr($t->id).'"><table class="widefat striped"><thead><tr><th>#</th><th>Zeit</th><th>Feld</th><th>Runde</th><th>Heim</th><th>Gast</th><th>Ergebnis</th><th>Status</th></tr></thead><tbody>'; foreach($matches as $m){ echo '<tr><td>'.esc_html($m->match_no).'</td><td>'.esc_html($m->starts_at?date_i18n('H:i',strtotime($m->starts_at)):'-').'</td><td>'.esc_html($m->field_no?:'-').'</td><td>'.esc_html($m->round_label).'</td><td>'.esc_html($m->home_name ?: self::placeholder_side($m->round_label,'home')).'</td><td>'.esc_html($m->away_name ?: self::placeholder_side($m->round_label,'away')).'</td><td><input type="number" name="goals_home['.esc_attr($m->id).']" value="'.esc_attr($m->goals_home).'" style="width:65px" '.(!empty($m->is_forfeit)?'readonly':'').'> : <input type="number" name="goals_away['.esc_attr($m->id).']" value="'.esc_attr($m->goals_away).'" style="width:65px" '.(!empty($m->is_forfeit)?'readonly':'').'></td><td>'.esc_html(self::status_label($m->status)).'</td></tr>'; } echo '</tbody></table>'; submit_button('Ergebnisse speichern'); echo '</form></div>';

  echo '<div class="vtp-card"><h2>Archivieren / Löschen</h2><div class="vtp-actions-stack">'; if($t->status!=='archiviert'){ echo '<form method="post" action="'.esc_url(admin_url('admin-post.php')).'">'; wp_nonce_field('vtp_archive_tournament'); echo '<input type="hidden" name="action" value="vtp_archive_tournament"><input type="hidden" name="tournament_id" value="'.esc_attr($t->id).'">'; submit_button('Turnier archivieren','secondary','submit',false); echo '</form>'; } else { echo '<form method="post" action="'.esc_url(admin_url('admin-post.php')).'">'; wp_nonce_field('vtp_restore_tournament'); echo '<input type="hidden" name="action" value="vtp_restore_tournament"><input type="hidden" name="tournament_id" value="'.esc_attr($t->id).'">'; submit_button('Turnier wiederherstellen','secondary','submit',false); echo '</form>'; } echo '<form method="post" action="'.esc_url(admin_url('admin-post.php')).'" onsubmit="return confirm(&quot;Turnier wirklich endgültig löschen? Diese Aktion kann nicht rückgängig gemacht werden.&quot;);">'; wp_nonce_field('vtp_delete_tournament'); echo '<input type="hidden" name="action" value="vtp_delete_tournament"><input type="hidden" name="tournament_id" value="'.esc_attr($t->id).'">'; submit_button('Turnier dauerhaft löschen','delete','submit',false); echo '</form></div></div>';
 }
 public function save_tournament(){ $this->verify('vtp_save_tournament'); global $wpdb; $id=absint($_POST['id']??0); $name=sanitize_text_field($_POST['name']); $now=current_time('mysql'); $data=['name'=>$name,'slug'=>sanitize_title($name),'description'=>sanitize_textarea_field($_POST['description']??''),'location'=>sanitize_text_field($_POST['location']??''),'sponsors'=>sanitize_textarea_field($_POST['sponsors']??''),'start_date'=>sanitize_text_field($_POST['start_date']??''),'start_time'=>sanitize_text_field($_POST['start_time']??'09:00'),'event_type'=>sanitize_key($_POST['event_type']??'jugendturnier'),'tournament_mode'=>sanitize_key($_POST['tournament_mode']??'groups_ko'),'ko_size'=>absint($_POST['ko_size']??4),'auto_groups'=>max(1,absint($_POST['auto_groups']??2)),'match_duration'=>max(1,absint($_POST['match_duration']??10)),'break_minutes'=>max(0,absint($_POST['break_minutes']??2)),'fields_count'=>max(1,absint($_POST['fields_count']??1)),'event_id'=>absint($_POST['event_id']??0),'updated_at'=>$now]; if($id){ $wpdb->update(VTP_DB::table('tournaments'),$data,['id'=>$id]); } else { $data['created_at']=$now; $data['leader_token']=wp_generate_password(32,false,false); $data['leader_pin']=(string)wp_rand(1000,9999); $data['status']='aktiv'; $wpdb->insert(VTP_DB::table('tournaments'),$data); $id=$wpdb->insert_id; } update_post_meta($id,'_vtp_min_team_rest',max(0,absint($_POST['min_team_rest']??1))); update_post_meta($id,'_vtp_max_teams',max(0,absint($_POST['max_teams']??0))); update_post_meta($id,'_vtp_public_registration',!empty($_POST['public_registration'])?'1':'0'); update_post_meta($id,'_vtp_third_place_match',!empty($_POST['third_place_match'])?'1':'0'); update_post_meta($id,'_vtp_all_placement_matches',!empty($_POST['all_placement_matches'])?'1':'0'); $this->ensure_page($id); $this->go(['edit'=>$id,'saved'=>1]); }
 private function ensure_page($id){ global $wpdb; $t=$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('tournaments').' WHERE id=%d',$id)); if(!$t) return 0; $content='[verein_turnier id="'.$id.'"]'; $page_id=absint($t->public_page_id); $post=['post_title'=>$t->name,'post_name'=>$t->slug,'post_content'=>$content,'post_status'=>'publish','post_type'=>'page']; if($page_id && get_post($page_id)){ $post['ID']=$page_id; wp_update_post($post); } else { $page_id=wp_insert_post($post); if($page_id && !is_wp_error($page_id)) $wpdb->update(VTP_DB::table('tournaments'),['public_page_id'=>$page_id],['id'=>$id]); } return $page_id; }
 public function create_public_page(){ $this->verify('vtp_create_public_page'); $id=absint($_POST['tournament_id']); $this->ensure_page($id); $this->go(['edit'=>$id,'created_page'=>1]); }
public function print_pdf(){
  if(!current_user_can('manage_options')) wp_die('Nicht erlaubt.');
  $id=absint($_GET['tournament_id']??0);
  if(!$id || !wp_verify_nonce($_GET['_wpnonce']??'', 'vtp_print_pdf_'.$id)) wp_die('Nicht erlaubt.');
  global $wpdb;
  $t=$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('tournaments').' WHERE id=%d',$id));
  if(!$t) wp_die('Turnier nicht gefunden.');
  $public=VTP_Public::public_url($t);
  $qr='https://api.qrserver.com/v1/create-qr-code/?size=180x180&data='.rawurlencode($public);
  $matches=$wpdb->get_results($wpdb->prepare('SELECT m.*, h.name home_name, a.name away_name FROM '.VTP_DB::table('matches').' m LEFT JOIN '.VTP_DB::table('teams').' h ON h.id=m.team_home LEFT JOIN '.VTP_DB::table('teams').' a ON a.id=m.team_away WHERE m.tournament_id=%d ORDER BY COALESCE(m.starts_at,"9999-12-31"),m.field_no,m.match_no',$id));
  $teams=$wpdb->get_results($wpdb->prepare('SELECT * FROM '.VTP_DB::table('teams').' WHERE tournament_id=%d ORDER BY group_name,name',$id));
  $groups=[]; foreach($teams as $team){ $groups[$team->group_name ?: 'Ohne Gruppe'][]=$team; }
  $totalTeams=count($teams); $totalMatches=count($matches);
  nocache_headers();
  header('Content-Type: text/html; charset='.get_bloginfo('charset'));
  ?><!doctype html><html><head><meta charset="<?php echo esc_attr(get_bloginfo('charset')); ?>"><meta name="viewport" content="width=device-width,initial-scale=1"><title><?php echo esc_html($t->name); ?> - Spielplan</title><style>
  @page{margin:12mm}*{box-sizing:border-box}body{font-family:Arial,Helvetica,sans-serif;margin:0;color:#1f2937;background:#fff}.wrap{max-width:1120px;margin:0 auto;padding:22px}.printbar{position:sticky;top:0;background:#fff;padding:10px 0;border-bottom:1px solid #ddd;margin-bottom:12px;z-index:5}.btn{display:inline-block;background:#b4001c;color:#fff;text-decoration:none;border:0;border-radius:8px;padding:10px 16px;font-weight:700;cursor:pointer}.head{display:grid;grid-template-columns:1fr auto;align-items:center;gap:20px;border-bottom:6px solid #b4001c;padding-bottom:14px;margin-bottom:16px}.brand{display:flex;align-items:center;gap:16px;min-width:0}.brand img.logo{width:74px;height:auto;flex:0 0 auto}.brand h1{margin:0;color:#b4001c;font-size:30px;line-height:1.05}.meta{margin-top:8px;color:#4b5563;font-size:15px}.qr{text-align:center;font-size:12px;color:#4b5563}.qr img{width:94px;height:94px;display:block;margin:0 auto 3px}.qr strong{color:#111827}.section{margin-top:16px}.section h2{color:#b4001c;border-bottom:2px solid #e5e7eb;padding-bottom:6px;margin:0 0 12px;font-size:21px}.group-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:12px}.group-box{border:1px solid #d6dce5;border-radius:10px;overflow:hidden;break-inside:avoid;background:#fff}.group-title{background:#b4001c;color:#fff;font-weight:800;padding:7px 10px;font-size:14px}.team-list{list-style:none;margin:0;padding:0}.team-list li{padding:6px 10px;border-top:1px solid #edf0f4;font-size:13px}.info-strip{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:10px;margin-top:16px}.info-card{border:1px solid #d6dce5;border-radius:10px;padding:10px;background:#fafafa}.info-card .label{font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:.04em}.info-card .value{font-weight:800;margin-top:3px}.hint{margin-top:14px;border-left:5px solid #b4001c;background:#fff7f7;padding:10px 12px;color:#374151}.full-schedule{page-break-before:always;break-before:page}.group-schedule{page-break-before:always;break-before:page}table{width:100%;border-collapse:collapse;font-size:12px;margin-top:8px}th,td{border:1px solid #d9dde4;padding:5px 6px;text-align:left;vertical-align:top}th{background:#f3f4f6;color:#111827}.small-note{color:#6b7280;font-size:12px;margin-top:-4px}.result-note{font-size:10px;color:#6b7280}@media print{.printbar{display:none}.wrap{padding:0;max-width:none}.head,.group-box,.info-card{break-inside:avoid}.section{break-inside:auto}.full-schedule,.group-schedule{page-break-before:always;break-before:page}.group-grid{grid-template-columns:repeat(3,1fr);gap:8px}.brand img.logo{width:66px}.brand h1{font-size:26px}.qr img{width:78px;height:78px}.section h2{font-size:18px}.team-list li{padding:4px 8px;font-size:11px}table{font-size:10.5px}th,td{padding:4px}.info-strip{grid-template-columns:repeat(4,1fr);gap:7px}.info-card{padding:7px}.hint{font-size:11px;margin-top:10px;padding:8px 10px}}@media(max-width:900px){.group-grid{grid-template-columns:repeat(2,minmax(0,1fr))}.info-strip{grid-template-columns:repeat(2,minmax(0,1fr))}}@media(max-width:640px){.head{grid-template-columns:1fr}.group-grid{grid-template-columns:1fr}.brand{align-items:flex-start}.info-strip{grid-template-columns:1fr}}
  </style></head><body><div class="wrap"><div class="printbar"><button class="btn" onclick="window.print()">Spielplan drucken</button></div><header class="head"><div class="brand"><img class="logo" src="<?php echo esc_url(VTP_URL.'assets/tus-mingolsheim-logo.png'); ?>" alt="TuS Mingolsheim"><div><h1><?php echo esc_html($t->name); ?></h1><div class="meta"><?php echo esc_html($this->type_label($t->event_type)); ?><?php echo $t->start_date?' · '.esc_html(date_i18n('d.m.Y',strtotime($t->start_date))):''; ?><?php echo $t->start_time?' · '.esc_html(substr($t->start_time,0,5)).' Uhr':''; ?><?php echo $t->location?' · '.esc_html($t->location):''; ?></div></div></div><div class="qr"><img src="<?php echo esc_url($qr); ?>" alt="QR-Code"><strong>Spielplan</strong><br><span>QR-Code scannen</span></div></header>
  <?php if($groups): ?><section class="section"><h2>Gruppenübersicht</h2><div class="group-grid"><?php foreach($groups as $g=>$list): ?><div class="group-box"><div class="group-title">Gruppe <?php echo esc_html($g); ?></div><ul class="team-list"><?php foreach($list as $team): ?><li><?php echo esc_html($team->name); ?></li><?php endforeach; ?></ul></div><?php endforeach; ?></div></section><?php endif; ?>
  <section class="section"><div class="info-strip"><div class="info-card"><div class="label">Teams</div><div class="value"><?php echo esc_html($totalTeams); ?></div></div><div class="info-card"><div class="label">Gruppen</div><div class="value"><?php echo esc_html(count($groups)); ?></div></div><div class="info-card"><div class="label">Felder</div><div class="value"><?php echo esc_html((int)$t->fields_count); ?></div></div><div class="info-card"><div class="label">Spielzeit</div><div class="value"><?php echo esc_html((int)$t->match_duration); ?> Min.</div></div></div><p class="hint"><strong>Hinweis:</strong> Der vollständige Spielplan folgt auf der nächsten Seite. Danach gibt es je Gruppe einen eigenen Gruppenspielplan zum Weitergeben an die Mannschaften.</p></section>
  <section class="section full-schedule"><h2>Spielplan komplett</h2><table><thead><tr><th>#</th><th>Zeit</th><th>Feld</th><th>Runde</th><th>Heim</th><th>Gast</th><th>Ergebnis</th></tr></thead><tbody><?php foreach($matches as $m): ?><tr><td><?php echo esc_html($m->match_no); ?></td><td><?php echo esc_html($m->starts_at?date_i18n('H:i',strtotime($m->starts_at)).' Uhr':'-'); ?></td><td><?php echo esc_html($m->field_no?:'-'); ?></td><td><?php echo esc_html($m->round_label ?: ($m->group_name ? 'Gruppe '.$m->group_name : '')); ?></td><td><?php echo esc_html($m->home_name ?: self::placeholder_side($m->round_label,'home')); ?></td><td><?php echo esc_html($m->away_name ?: self::placeholder_side($m->round_label,'away')); ?></td><td><?php echo ($m->goals_home!==null && $m->goals_away!==null)?esc_html($m->goals_home.' : '.$m->goals_away):''; ?><?php echo !empty($m->is_forfeit)?'<br><span class="result-note">Wertung wegen Nichtantritt</span>':''; ?></td></tr><?php endforeach; ?></tbody></table></section>
  <?php if($groups): foreach($groups as $g=>$list): $gm=[]; foreach($matches as $m){ if((string)$m->group_name===(string)$g && $m->round_type==='group') $gm[]=$m; } if(!$gm) continue; ?><section class="section group-schedule"><h2>Spielplan Gruppe <?php echo esc_html($g); ?></h2><p class="small-note">Gruppenspezifischer Spielplan zum Weitergeben an die Mannschaften dieser Gruppe.</p><div class="group-box" style="margin-bottom:12px"><div class="group-title">Mannschaften Gruppe <?php echo esc_html($g); ?></div><ul class="team-list"><?php foreach($list as $team): ?><li><?php echo esc_html($team->name); ?></li><?php endforeach; ?></ul></div><table><thead><tr><th>#</th><th>Zeit</th><th>Feld</th><th>Heim</th><th>Gast</th></tr></thead><tbody><?php foreach($gm as $m): ?><tr><td><?php echo esc_html($m->match_no); ?></td><td><?php echo esc_html($m->starts_at?date_i18n('H:i',strtotime($m->starts_at)).' Uhr':'-'); ?></td><td><?php echo esc_html($m->field_no?:'-'); ?></td><td><?php echo esc_html($m->home_name ?: self::placeholder_side($m->round_label,'home')); ?></td><td><?php echo esc_html($m->away_name ?: self::placeholder_side($m->round_label,'away')); ?></td></tr><?php endforeach; ?></tbody></table></section><?php endforeach; endif; ?>
  </div><script>setTimeout(function(){ if(location.hash==='#print') window.print(); },300);</script></body></html><?php
  exit;
}

 public function print_referees_pdf(){
  global $wpdb; $id=absint($_GET['tournament_id']??0);
  if(!$id || !wp_verify_nonce($_GET['_wpnonce']??'', 'vtp_print_referees_pdf_'.$id)) wp_die('Nicht erlaubt.');
  $t=$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('tournaments').' WHERE id=%d',$id)); if(!$t) wp_die('Turnier nicht gefunden.');
  $refs=$wpdb->get_results($wpdb->prepare('SELECT * FROM '.VTP_DB::table('referees').' WHERE tournament_id=%d ORDER BY sort_order,id',$id));
  ?><!doctype html><html><head><meta charset="<?php bloginfo('charset'); ?>"><title>Schiedsrichter-Zugänge</title><style>
  body{font-family:Arial,Helvetica,sans-serif;margin:0;color:#222;background:#fff}.wrap{max-width:1000px;margin:0 auto;padding:28px}.head{display:flex;align-items:center;gap:16px;border-bottom:5px solid #b4001c;padding-bottom:16px;margin-bottom:18px}.logo{width:78px}.head h1{margin:0;color:#b4001c}.grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px}.card{border:1px solid #ddd;border-radius:14px;padding:16px;break-inside:avoid}.card h2{margin:0 0 8px;color:#b4001c}.qr{width:130px;height:130px}.pin{font-size:26px;font-weight:800;letter-spacing:.12em}.url{font-size:11px;word-break:break-all;color:#555}.printbar{position:sticky;top:0;background:#fff;padding:10px 0;border-bottom:1px solid #ddd}.btn{background:#b4001c;color:#fff;border:0;border-radius:8px;padding:10px 16px;font-weight:700}@media print{.printbar{display:none}.wrap{padding:0}.grid{grid-template-columns:repeat(2,1fr)}}
  </style></head><body><div class="wrap"><div class="printbar"><button class="btn" onclick="window.print()">Spielplan drucken</button></div><header class="head"><img class="logo" src="<?php echo esc_url(VTP_URL.'assets/tus-mingolsheim-logo.png'); ?>" alt="TuS Mingolsheim"><div><h1>Schiedsrichter-Zugänge</h1><p><?php echo esc_html($t->name); ?></p></div></header><?php if(!$refs): ?><p>Noch keine Schiedsrichter angelegt.</p><?php else: ?><div class="grid"><?php foreach($refs as $r): $url=VTP_Public::referee_url($r); $qr='https://api.qrserver.com/v1/create-qr-code/?size=220x220&data='.rawurlencode($url); ?><section class="card"><h2><?php echo esc_html($r->name); ?></h2><p><img class="qr" src="<?php echo esc_url($qr); ?>" alt="QR-Code"></p><p>PIN</p><p class="pin"><?php echo esc_html($r->pin); ?></p><p class="url"><?php echo esc_html($url); ?></p></section><?php endforeach; ?></div><?php endif; ?></div><script>setTimeout(function(){ if(location.hash==='#print') window.print(); },300);</script></body></html><?php exit;
 }

 public function delete_registration(){
  $this->verify('vtp_delete_registration');
  global $wpdb; $tid=absint($_POST['tournament_id']??0); $team_id=absint($_POST['team_id']??0);
  if($tid && $team_id){
    $wpdb->delete(VTP_DB::table('teams'),['id'=>$team_id,'tournament_id'=>$tid]);
    if(method_exists($this,'rebuild_schedule_after_team_change')) $this->rebuild_schedule_after_team_change($tid);
  }
  $this->go(['edit'=>$tid,'saved'=>1]);
}
 public function save_sponsors(){ $this->verify('vtp_save_sponsors'); global $wpdb; $id=absint($_POST['tournament_id']); $lines=[]; $names=$_POST['sponsor_name']??[]; $logos=$_POST['sponsor_logo']??[]; $urls=$_POST['sponsor_url']??[]; $deletes=$_POST['sponsor_delete']??[]; if(is_array($names)){ foreach($names as $i=>$n){ if(!empty($deletes[$i])) continue; $n=sanitize_text_field($n); $logo=esc_url_raw($logos[$i]??''); $url=esc_url_raw($urls[$i]??''); if($n!=='' || $logo!=='' || $url!=='') $lines[]=$n.'|'.$logo.'|'.$url; } $txt=implode("\n",$lines); } else { $txt=sanitize_textarea_field($_POST['sponsors']??''); } $wpdb->update(VTP_DB::table('tournaments'),['sponsors'=>$txt,'updated_at'=>current_time('mysql')],['id'=>$id]); $this->go(['edit'=>$id,'saved'=>1]); }
 public function save_group_editor(){
  $this->verify('vtp_save_group_editor');
  global $wpdb;
  $tid=absint($_POST['tournament_id']??0);
  if(!$tid) wp_die('Turnier nicht gefunden.');

  $ids=array_map('absint', $_POST['team_id']??[]);
  $names=$_POST['team_name']??[];
  $groups=$_POST['team_group']??[];
  $trainers=$_POST['team_trainer']??[];
  $contacts=$_POST['team_contact']??[];
  $delete=array_map('absint', $_POST['team_delete']??[]);
  // Entfernen in der Gruppen-Kachel bedeutet nur: Gruppenzuweisung lösen, nicht Team löschen.
  $unassign=array_map('absint', $_POST['team_unassign']??[]);
  $structuralChange=false;
  $nameOnlyChange=false;
  $noshowChanged=false;

  $storedGroups=get_post_meta($tid,'_vtp_group_names',true); if(!is_array($storedGroups)) $storedGroups=[];
  $deleteGroups=array_map('sanitize_text_field', $_POST['delete_group']??[]); $deleteGroups=array_values(array_unique(array_map('trim',$deleteGroups)));
  $addGroup=sanitize_text_field($_POST['add_group_name']??'');
  if($addGroup!==''){ $storedGroups[]=$addGroup; }
  foreach($deleteGroups as $dg){
    $dg=trim((string)$dg); if($dg==='') continue;
    // Eine Gruppe ist nur eine Zuordnung. Beim Löschen bleiben die Mannschaften erhalten
    // und werden wieder als "ohne Gruppe" geführt.
    $wpdb->update(VTP_DB::table('teams'),['group_name'=>''],['tournament_id'=>$tid,'group_name'=>$dg]);
    $structuralChange=true;
  }

  $assignToGroup=$_POST['assign_team_to_group']??[];
  if(is_array($assignToGroup)){
    foreach($assignToGroup as $targetGroup=>$teamToAssign){
      $targetGroup=sanitize_text_field($targetGroup);
      $teamToAssign=absint($teamToAssign);
      if($targetGroup==='' || !$teamToAssign) continue;
      $teamRow=$wpdb->get_row($wpdb->prepare('SELECT id,group_name FROM '.VTP_DB::table('teams').' WHERE id=%d AND tournament_id=%d',$teamToAssign,$tid));
      if($teamRow && trim((string)$teamRow->group_name)===''){
        $wpdb->update(VTP_DB::table('teams'),['group_name'=>$targetGroup],['id'=>$teamToAssign,'tournament_id'=>$tid]);
        $structuralChange=true;
      }
    }
  }

  foreach($ids as $i=>$team_id){
    if(!$team_id) continue;
    $old=$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('teams').' WHERE id=%d AND tournament_id=%d',$team_id,$tid));
    if(!$old) continue;
    if(in_array($old->group_name,$deleteGroups,true)) continue;

    if(in_array($team_id,$unassign,true)){
      // Team bleibt erhalten, nur die Gruppenzuordnung wird entfernt.
      $structuralChange=true;
      $name=sanitize_text_field($names[$i]??$old->name);
      $trainer=sanitize_text_field($trainers[$i]??($old->trainer_name ?? ''));
      $contact=sanitize_text_field($contacts[$i]??($old->contact ?? ''));
      $wpdb->update(VTP_DB::table('teams'),[
        'name'=>$name ?: $old->name,
        'trainer_name'=>$trainer,
        'contact'=>$contact,
        'group_name'=>'',
        'status'=>$old->status ?: 'active'
      ],['id'=>$team_id,'tournament_id'=>$tid]);
      continue;
    }

    if(in_array($team_id,$delete,true)){
      $structuralChange=true;
      $wpdb->delete(VTP_DB::table('teams'),['id'=>$team_id,'tournament_id'=>$tid]);
      $wpdb->query($wpdb->prepare(
        'DELETE FROM '.VTP_DB::table('matches').' WHERE tournament_id=%d AND (team_home=%d OR team_away=%d) AND (goals_home IS NULL OR goals_away IS NULL OR is_forfeit=1)',
        $tid,$team_id,$team_id
      ));
      continue;
    }

    $name=sanitize_text_field($names[$i]??'');
    $grp=sanitize_text_field($groups[$i]??'');
    // Wenn eine Gruppe gelöscht wurde, dürfen Formularwerte aus alten Gruppenzeilen
    // die vorher gelöste Zuordnung nicht wiederherstellen. Teams bleiben erhalten,
    // nur die Gruppenzuweisung wird geleert.
    if(in_array($grp,$deleteGroups,true)){
      $grp='';
    }
    $trainer=sanitize_text_field($trainers[$i]??'');
    $contact=sanitize_text_field($contacts[$i]??'');
    if($name===''){
      $structuralChange=true;
      $wpdb->delete(VTP_DB::table('teams'),['id'=>$team_id,'tournament_id'=>$tid]);
      $wpdb->query($wpdb->prepare(
        'DELETE FROM '.VTP_DB::table('matches').' WHERE tournament_id=%d AND (team_home=%d OR team_away=%d) AND (goals_home IS NULL OR goals_away IS NULL OR is_forfeit=1)',
        $tid,$team_id,$team_id
      ));
      continue;
    }
    // Nichtantritt wird ausschließlich über die Turnierleitungsseite gepflegt.
    $newStatus=$old->status ?: 'active';
    $newGroup=$grp;
    if($old->group_name !== $newGroup || $old->status !== $newStatus) $structuralChange=true;
    if($old->status !== $newStatus) $noshowChanged=true;
    if($old->name !== $name && $old->group_name === $newGroup && $old->status === $newStatus) $nameOnlyChange=true;
    $wpdb->update(VTP_DB::table('teams'),[
      'name'=>$name,
      'trainer_name'=>$trainer,
      'contact'=>$contact,
      'group_name'=>$newGroup,
      'status'=>$newStatus
    ],['id'=>$team_id,'tournament_id'=>$tid]);
  }

  $new_names=$_POST['new_team_name']??[];
  $new_groups=$_POST['new_team_group']??[];
  $sort=(int)$wpdb->get_var($wpdb->prepare('SELECT COALESCE(MAX(sort_order),0)+1 FROM '.VTP_DB::table('teams').' WHERE tournament_id=%d',$tid));
  foreach($new_names as $i=>$raw){
    $name=sanitize_text_field($raw);
    if($name==='') continue;
    $exists=$wpdb->get_var($wpdb->prepare('SELECT id FROM '.VTP_DB::table('teams').' WHERE tournament_id=%d AND LOWER(name)=LOWER(%s) LIMIT 1',$tid,$name));
    if($exists) continue;
    $structuralChange=true;
    $grp=sanitize_text_field($new_groups[$i]??'');
    $wpdb->insert(VTP_DB::table('teams'),[
      'tournament_id'=>$tid,
      'name'=>$name,
      'group_name'=>$grp,
      'status'=>'active',
      'sort_order'=>$sort++
    ]);
  }

  if(!empty($_POST['vtp_generate_groups'])){
    $this->auto_generate_groups_for_tournament($tid);
    $structuralChange=true;
  }

  $currentGroups=[];
  foreach($wpdb->get_col($wpdb->prepare('SELECT DISTINCT group_name FROM '.VTP_DB::table('teams').' WHERE tournament_id=%d',$tid)) as $cg){ $cg=trim((string)$cg); if($cg!=='') $currentGroups[]=$cg; }
  foreach($storedGroups as $sg){ $sg=trim((string)$sg); if($sg!=='' && !in_array($sg,$deleteGroups,true)) $currentGroups[]=$sg; }
  $currentGroups=array_values(array_unique($currentGroups)); sort($currentGroups, SORT_NATURAL);
  update_post_meta($tid,'_vtp_group_names',$currentGroups);

  // Reine Namenskorrekturen ändern keinen Ablauf. Sportliche Änderungen erzeugen die betroffenen Paarungen, Zeiten, Felder und Schiedsrichter neu.
  if($structuralChange){
    $this->rebuild_schedule_after_team_change($tid);
  } else {
    $this->apply_noshow_forfeits($tid);
    $this->assign_referees($tid);
  }
  $this->go(['edit'=>$tid,'saved'=>1]);
 }

 private function rebuild_schedule_after_team_change($tid){
  global $wpdb;
  $t=$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('tournaments').' WHERE id=%d',$tid));
  if(!$t) return;

  // Bestehende Ergebnisse für unveränderte Paarungen merken.
  $oldRows=$wpdb->get_results($wpdb->prepare("SELECT * FROM ".VTP_DB::table('matches')." WHERE tournament_id=%d",$tid));
  $old=[];
  foreach($oldRows as $om){
    $h=absint($om->team_home); $a=absint($om->team_away);
    if($h && $a){
      $key=$om->round_type.'|'.$om->group_name.'|'.min($h,$a).'-'.max($h,$a);
      $old[$key]=$om;
    }
  }

  // Nach Team-Hinzufügen/-Löschen wird der sportliche Spielplan komplett neu aufgebaut.
  $wpdb->delete(VTP_DB::table('matches'),['tournament_id'=>$tid]);

  $teams=$this->active_teams($tid); $groups=[];
  foreach($teams as $team) $groups[$team->group_name][]=$team;
  $startDate=$t->start_date ?: current_time('Y-m-d');
  $startTime=$t->start_time ?: '09:00';
  $fields=max(1,absint($t->fields_count));
  $slotMinutes=max(1,absint($t->match_duration)+absint($t->break_minutes));
  $minRest=max(0,absint(get_post_meta($tid,'_vtp_min_team_rest',true) ?: 1));
  $no=1; $pairs=[]; $forfeits=[];

  foreach($groups as $g=>$list){
    $n=count($list);
    for($i=0;$i<$n;$i++) for($j=$i+1;$j<$n;$j++){
      $h=$list[$i]; $a=$list[$j];
      if($h->status==='noshow'||$a->status==='noshow') $forfeits[]=['h'=>$h,'a'=>$a,'g'=>$g];
      else $pairs[]=['h'=>$h,'a'=>$a,'g'=>$g];
    }
  }
  $scheduled=$this->schedule_group_matches($pairs,$fields,$minRest);
  foreach($scheduled as $p){
    $dt=date('Y-m-d H:i:s',strtotime($startDate.' '.$startTime.' +'.($p['slot']*$slotMinutes).' minutes'));
    $h=absint($p['h']->id); $a=absint($p['a']->id);
    $data=['tournament_id'=>$tid,'round_type'=>'group','round_label'=>'Gruppe '.$p['g'],'group_name'=>$p['g'],'match_no'=>$no++,'team_home'=>$h,'team_away'=>$a,'starts_at'=>$dt,'field_no'=>$p['field'],'status'=>'angesetzt'];
    $key='group|'.$p['g'].'|'.min($h,$a).'-'.max($h,$a);
    if(isset($old[$key]) && $old[$key]->goals_home!==null && $old[$key]->goals_away!==null){
      // Ergebnis seitenrichtig übernehmen.
      if(absint($old[$key]->team_home)===$h){ $data['goals_home']=$old[$key]->goals_home; $data['goals_away']=$old[$key]->goals_away; }
      else { $data['goals_home']=$old[$key]->goals_away; $data['goals_away']=$old[$key]->goals_home; }
      $data['status']=$old[$key]->status ?: 'beendet';
    }
    $wpdb->insert(VTP_DB::table('matches'),$data);
  }
  foreach($forfeits as $p){
    $gh=$p['h']->status==='noshow'?0:3;
    $ga=$p['a']->status==='noshow'?0:3;
    if($p['h']->status==='noshow' && $p['a']->status==='noshow'){ $gh=0; $ga=0; }
    $wpdb->insert(VTP_DB::table('matches'),['tournament_id'=>$tid,'round_type'=>'group','round_label'=>'Gruppe '.$p['g'],'group_name'=>$p['g'],'match_no'=>$no++,'team_home'=>$p['h']->id,'team_away'=>$p['a']->id,'goals_home'=>$gh,'goals_away'=>$ga,'field_no'=>0,'status'=>'wertung','is_forfeit'=>1]);
  }

  $lastSlot=empty($scheduled)?0:max(array_column($scheduled,'slot'))+1;
  if($t->tournament_mode==='groups_ko'){
    $labels=[16=>'Achtelfinale',8=>'Viertelfinale',4=>'Halbfinale',2=>'Finale']; $size=absint($t->ko_size);
    $firstSeedLabels=$this->ko_first_seed_labels($size, array_keys($groups));
    // Alle K.O.-Runden bis einschließlich Halbfinale erzeugen. Das Finale wird separat erzeugt,
    // damit ein optionales Spiel um Platz 3 garantiert davor und nie parallel dazu liegt.
    for($r=$size;$r>=4;$r/=2){
      $round=$labels[$r]??'K.O.-Runde'; $games=$r/2;
      for($x=1;$x<=$games;$x++){
        $slot=$lastSlot+floor(($x-1)/$fields); $field=(($x-1)%$fields)+1;
        $dt=date('Y-m-d H:i:s',strtotime($startDate.' '.$startTime.' +'.($slot*$slotMinutes).' minutes'));
        if($r===$size && !empty($firstSeedLabels[$x-1])) $rl=$round.' '.$x.' · '.$firstSeedLabels[$x-1];
        elseif($r===4) $rl='Halbfinale '.$x.' · Sieger '.($size>=8?'Viertelfinale':'Halbfinale').' '.(($x-1)*2+1).' gegen Sieger '.($size>=8?'Viertelfinale':'Halbfinale').' '.(($x-1)*2+2);
        else $rl=$round.' '.$x.' · Sieger '.$labels[$r*2].' '.(($x-1)*2+1).' gegen Sieger '.$labels[$r*2].' '.(($x-1)*2+2);
        $wpdb->insert(VTP_DB::table('matches'),['tournament_id'=>$tid,'round_type'=>'ko','round_label'=>$rl,'match_no'=>$no++,'starts_at'=>$dt,'field_no'=>$field,'status'=>'geplant']);
      }
      $lastSlot+=ceil($games/$fields)+$minRest;
    }
    // Bei einer direkten Finalrunde (K.O.-Größe 2) muss ebenfalls die nötige Basiszeit vorhanden sein.
    if($size<4) $lastSlot=max($lastSlot, empty($scheduled)?0:max(array_column($scheduled,'slot'))+1);
    if(get_post_meta($tid,'_vtp_third_place_match',true)==='1' && $size>=4){
      $dt=date('Y-m-d H:i:s',strtotime($startDate.' '.$startTime.' +'.($lastSlot*$slotMinutes).' minutes'));
      $wpdb->insert(VTP_DB::table('matches'),['tournament_id'=>$tid,'round_type'=>'placement','round_label'=>'Spiel um Platz 3 · Verlierer Halbfinale 1 gegen Verlierer Halbfinale 2','match_no'=>$no++,'starts_at'=>$dt,'field_no'=>1,'status'=>'geplant']);
      $lastSlot++; // Exklusiver Slot: Finale darf niemals zeitgleich stattfinden.
    }
    $dt=date('Y-m-d H:i:s',strtotime($startDate.' '.$startTime.' +'.($lastSlot*$slotMinutes).' minutes'));
    $finalLabel=$size>=4 ? 'Finale · Sieger Halbfinale 1 gegen Sieger Halbfinale 2' : (!empty($firstSeedLabels[0]) ? 'Finale · '.$firstSeedLabels[0] : 'Finale');
    $wpdb->insert(VTP_DB::table('matches'),['tournament_id'=>$tid,'round_type'=>'ko','round_label'=>$finalLabel,'match_no'=>$no++,'starts_at'=>$dt,'field_no'=>1,'status'=>'geplant']);
    $lastSlot++;
  }
  if($t->tournament_mode==='groups_placement'){
    $groupNames=array_keys($groups); sort($groupNames);
    if(count($groupNames)>=2){ $a=$groupNames[0]; $b=$groupNames[1]; $count=min(count($groups[$a]), count($groups[$b])); $all=get_post_meta($tid,'_vtp_all_placement_matches',true)==='1'; $maxRank=$all ? $count : min(2,$count);
      for($rank=1;$rank<=$maxRank;$rank++){ $place1=($rank*2)-1; $place2=$rank*2; $label=$rank===1?'Spiel um Platz 1/2':'Spiel um Platz '.$place1.'/'.$place2; $slot=$lastSlot+floor(($rank-1)/$fields); $field=(($rank-1)%$fields)+1; $dt=date('Y-m-d H:i:s',strtotime($startDate.' '.$startTime.' +'.($slot*$slotMinutes).' minutes')); $wpdb->insert(VTP_DB::table('matches'),['tournament_id'=>$tid,'round_type'=>'placement','round_label'=>$label.' · '.$rank.'. Gruppe '.$a.' gegen '.$rank.'. Gruppe '.$b,'match_no'=>$no++,'starts_at'=>$dt,'field_no'=>$field,'status'=>'geplant']); }
    }
  }
  $this->reset_dependent_rounds($tid);
  $this->assign_referees($tid);
 }

 private function group_name_by_index($idx){
  $idx=max(0,(int)$idx); $name='';
  do { $name=chr(65+($idx%26)).$name; $idx=intdiv($idx,26)-1; } while($idx>=0);
  return $name;
 }
 private function club_key_from_team_name($name){
  $n=remove_accents(strtolower((string)$name));
  $n=preg_replace('/\([^)]*\)/',' ',$n);
  $n=preg_replace('/\b(u\s?\d{1,2}|d\s?junioren|c\s?junioren|b\s?junioren|a\s?junioren|e\s?junioren|f\s?junioren|g\s?junioren)\b/u',' ',$n);
  $n=preg_replace('/\b(1\.|2\.|3\.|i{1,3}|iv|v|erste|zweite|dritte|mannschaft|team\s*[a-z0-9]+)\b/u',' ',$n);
  $n=preg_replace('/[^a-z0-9]+/',' ',$n);
  $n=trim(preg_replace('/\s+/',' ',$n));
  return $n!=='' ? $n : strtolower(trim((string)$name));
 }
 private function auto_generate_groups_for_tournament($tid){
  global $wpdb;
  $t=$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('tournaments').' WHERE id=%d',$tid));
  if(!$t) return;
  $groupCount=max(1,absint($t->auto_groups));
  $groupNames=[]; for($i=0;$i<$groupCount;$i++) $groupNames[]=$this->group_name_by_index($i);
  $teams=$wpdb->get_results($wpdb->prepare('SELECT * FROM '.VTP_DB::table('teams').' WHERE tournament_id=%d ORDER BY sort_order,id',$tid));
  if(!$teams){ update_post_meta($tid,'_vtp_group_names',$groupNames); return; }
  $groups=[]; $clubInGroup=[];
  foreach($groupNames as $g){ $groups[$g]=[]; $clubInGroup[$g]=[]; }

  // Mannschaften gleicher Vereine nacheinander verteilen, damit sie möglichst in unterschiedlichen Gruppen landen.
  $byClub=[];
  foreach($teams as $team){ $key=$this->club_key_from_team_name($team->name); $byClub[$key][]=$team; }
  uasort($byClub,function($a,$b){ return count($b)<=>count($a); });
  $ordered=[];
  foreach($byClub as $clubTeams){ foreach($clubTeams as $team) $ordered[]=$team; }

  foreach($ordered as $team){
    $club=$this->club_key_from_team_name($team->name);
    $best=null; $bestScore=PHP_INT_MAX;
    foreach($groupNames as $g){
      $duplicateClub=in_array($club,$clubInGroup[$g],true) ? 1000 : 0;
      $score=$duplicateClub + count($groups[$g]);
      if($score<$bestScore){ $bestScore=$score; $best=$g; }
    }
    if($best===null) $best=$groupNames[0];
    $groups[$best][]=$team;
    if(!in_array($club,$clubInGroup[$best],true)) $clubInGroup[$best][]=$club;
    $wpdb->update(VTP_DB::table('teams'),['group_name'=>$best],['id'=>absint($team->id),'tournament_id'=>$tid]);
  }
  update_post_meta($tid,'_vtp_group_names',$groupNames);
 }
 private function apply_noshow_forfeits($tid){
  global $wpdb;
  $matches=$wpdb->get_results($wpdb->prepare("SELECT m.*, h.status home_status, a.status away_status FROM ".VTP_DB::table('matches')." m LEFT JOIN ".VTP_DB::table('teams')." h ON h.id=m.team_home LEFT JOIN ".VTP_DB::table('teams')." a ON a.id=m.team_away WHERE m.tournament_id=%d AND m.round_type='group'",$tid));
  foreach($matches as $m){
    $homeNo=($m->home_status==='noshow'); $awayNo=($m->away_status==='noshow');
    if($homeNo || $awayNo){
      if($homeNo && $awayNo){ $gh=0; $ga=0; }
      elseif($homeNo){ $gh=0; $ga=3; }
      else { $gh=3; $ga=0; }
      $wpdb->update(VTP_DB::table('matches'),['goals_home'=>$gh,'goals_away'=>$ga,'status'=>'wertung','is_forfeit'=>1],['id'=>absint($m->id)]);
    } elseif(intval($m->is_forfeit)===1){
      $wpdb->update(VTP_DB::table('matches'),['goals_home'=>null,'goals_away'=>null,'status'=>'angesetzt','is_forfeit'=>0],['id'=>absint($m->id)]);
    }
  }
 }
 private function compact_schedule($tid){
  global $wpdb;
  $t=$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('tournaments').' WHERE id=%d',$tid));
  if(!$t) return;

  // Nur offene, echte Gruppenspiele neu takten. Wertungen wegen Nichtantritt blockieren kein Feld und keine Uhrzeit.
  $open=$wpdb->get_results($wpdb->prepare("SELECT * FROM ".VTP_DB::table('matches')." WHERE tournament_id=%d AND round_type='group' AND is_forfeit=0 AND goals_home IS NULL AND goals_away IS NULL ORDER BY match_no ASC",$tid));
  if(!$open){ $this->retime_final_round_after_groups($tid); return; }

  $startTs=strtotime(($t->start_date ?: current_time('Y-m-d')).' '.($t->start_time ?: '09:00'));
  // Wenn schon Spiele eine Uhrzeit haben, behalten wir den frühesten echten Gruppenspiel-Start als Basis.
  foreach($open as $m){ if(!empty($m->starts_at)){ $startTs=strtotime($m->starts_at); break; } }

  $slotMinutes=max(1,intval($t->match_duration)+intval($t->break_minutes));
  $fields=max(1,intval($t->fields_count));
  $minRest=max(0,absint(get_post_meta($tid,'_vtp_min_team_rest',true) ?: 1));
  $lastTeamSlot=[];      // team_id => letzter belegter Slot
  $occupied=[];          // slot => Anzahl Spiele in diesem Slot

  foreach($open as $m){
    $h=absint($m->team_home); $a=absint($m->team_away);
    $slotIndex=0; $placed=false;
    while(!$placed && $slotIndex<1000){
      $usedInSlot=absint($occupied[$slotIndex] ?? 0);
      if($usedInSlot >= $fields){ $slotIndex++; continue; }

      $ok=true;
      foreach([$h,$a] as $team){
        if($team && isset($lastTeamSlot[$team]) && (($slotIndex - $lastTeamSlot[$team] - 1) < $minRest)) { $ok=false; break; }
      }
      if(!$ok){ $slotIndex++; continue; }

      $field=$usedInSlot+1;
      $dt=date('Y-m-d H:i:s',$startTs+($slotIndex*$slotMinutes*60));
      $wpdb->update(VTP_DB::table('matches'),['starts_at'=>$dt,'field_no'=>$field],['id'=>absint($m->id)]);
      $occupied[$slotIndex]=$usedInSlot+1;
      foreach([$h,$a] as $team){ if($team) $lastTeamSlot[$team]=$slotIndex; }
      $placed=true;
    }
  }

  // Wertungsspiele bewusst ohne Feld- und Zeitblock darstellen.
  $wpdb->query($wpdb->prepare("UPDATE ".VTP_DB::table('matches')." SET starts_at=NULL, field_no=0 WHERE tournament_id=%d AND round_type='group' AND is_forfeit=1",$tid));
  $this->retime_final_round_after_groups($tid);
 }

 private function retime_final_round_after_groups($tid){
  global $wpdb;
  $t=$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('tournaments').' WHERE id=%d',$tid));
  if(!$t) return;
  $slot=max(1,intval($t->match_duration)+intval($t->break_minutes));
  $fields=max(1,intval($t->fields_count));
  $startDate=$t->start_date ?: current_time('Y-m-d');
  $startTime=$t->start_time ?: '09:00';

  // Nur echte Gruppenspiele zählen für das zeitliche Ende. Nichtantritt-Wertungen blockieren keine Felder.
  $maxGroup=$wpdb->get_var($wpdb->prepare("SELECT MAX(starts_at) FROM ".VTP_DB::table('matches')." WHERE tournament_id=%d AND round_type='group' AND is_forfeit=0 AND starts_at IS NOT NULL",$tid));
  $base=$maxGroup ? strtotime($maxGroup)+($slot*60) : strtotime($startDate.' '.$startTime);

  $finals=$wpdb->get_results($wpdb->prepare("SELECT * FROM ".VTP_DB::table('matches')." WHERE tournament_id=%d AND round_type<>'group' ORDER BY match_no ASC",$tid));
  // Auch bestehende/ältere Spielpläne robust behandeln: Spiel um Platz 3 vor das Finale sortieren.
  usort($finals,function($a,$b){
    $rank=function($m){
      $label=(string)$m->round_label;
      $third=(stripos($label,'Spiel um Platz 3')!==false) || preg_match('/Platz\s+3\s*\/\s*4/u',$label);
      $semi=(stripos($label,'Halbfinale')!==false && stripos($label,'Sieger Halbfinale')===false && stripos($label,'Verlierer Halbfinale')===false);
      $final=(stripos($label,'Finale')!==false && !$semi && !$third);
      if($third) return 900000;
      if($final) return 1000000;
      return absint($m->match_no);
    };
    $ra=$rank($a); $rb=$rank($b);
    return $ra===$rb ? (absint($a->match_no)<=>absint($b->match_no)) : ($ra<=>$rb);
  });
  $slotIndex=0;
  $fieldIndex=0;
  foreach($finals as $m){
    $label=(string)$m->round_label;
    $isThird=(stripos($label,'Spiel um Platz 3')!==false) || preg_match('/Platz\s+3\s*\/\s*4/u',$label);
    $isSemi=(stripos($label,'Halbfinale')!==false && stripos($label,'Sieger Halbfinale')===false && stripos($label,'Verlierer Halbfinale')===false);
    $isFinal=(stripos($label,'Finale')!==false && !$isSemi && !$isThird);

    // Kleines Finale und Finale sind bewusst exklusive Slots: Platz 3 zuerst, Finale danach.
    // Dadurch können sie auch bei mehreren Feldern niemals parallel angesetzt werden.
    if($isThird || $isFinal){
      if($fieldIndex>0){ $slotIndex++; $fieldIndex=0; }
      $dt=date('Y-m-d H:i:s',$base+($slotIndex*$slot*60));
      $wpdb->update(VTP_DB::table('matches'),['starts_at'=>$dt,'field_no'=>1],['id'=>absint($m->id)]);
      $slotIndex++;
      $fieldIndex=0;
      continue;
    }

    $dt=date('Y-m-d H:i:s',$base+($slotIndex*$slot*60));
    $field=$fieldIndex+1;
    $wpdb->update(VTP_DB::table('matches'),['starts_at'=>$dt,'field_no'=>$field],['id'=>absint($m->id)]);
    $fieldIndex++;
    if($fieldIndex >= $fields){ $slotIndex++; $fieldIndex=0; }
  }
 }
 public function save_teams(){ $this->verify('vtp_save_teams'); global $wpdb; $tid=absint($_POST['tournament_id']); $t=$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('tournaments').' WHERE id=%d',$tid)); $wpdb->delete(VTP_DB::table('teams'),['tournament_id'=>$tid]); $lines=preg_split('/\r\n|\r|\n/',sanitize_textarea_field($_POST['teams']??'')); $auto=max(1,absint($t->auto_groups??2)); $i=0; foreach($lines as $line){ $line=trim($line); if($line==='') continue; $p=array_map('trim',explode(';',$line)); $name=$p[0]; $grp=$p[1]??chr(65+($i%$auto)); $status=(isset($p[2]) && stripos($p[2],'nicht')!==false)?'noshow':'active'; if($name) $wpdb->insert(VTP_DB::table('teams'),['tournament_id'=>$tid,'name'=>$name,'group_name'=>$grp,'status'=>$status,'sort_order'=>$i++]); } $this->go(['edit'=>$tid,'saved'=>1]); }
 private function active_teams($tid){ global $wpdb; return $wpdb->get_results($wpdb->prepare('SELECT * FROM '.VTP_DB::table('teams').' WHERE tournament_id=%d ORDER BY group_name, sort_order',$tid)); }
 private function schedule_group_matches($pairs,$fields,$minRest){
  $scheduled=[]; $last=[]; $slot=0; $lastGroup='';
  while(count($pairs)>0){
   $used=[]; $slotGames=[];
   for($f=1;$f<=$fields;$f++){
    $bestIndex=null; $bestScore=-999999;
    foreach($pairs as $idx=>$p){
     $h=$p['h']->id; $a=$p['a']->id;
     if(isset($used[$h])||isset($used[$a])) continue;
     $rh=isset($last[$h])?($slot-$last[$h]-1):99; $ra=isset($last[$a])?($slot-$last[$a]-1):99;
     $restOk=($rh>=$minRest && $ra>=$minRest);
     if(!$restOk && count($slotGames)>0) continue;
     $score=($restOk?1000:0)+min($rh,$ra)*10;
     // Auf einem Feld Gruppen möglichst abwechseln (A, B, A, B ...).
     // Bei mehreren Feldern bevorzugen wir zusätzlich unterschiedliche Gruppen innerhalb desselben Zeitslots.
     if($fields===1 && $lastGroup!=='' && $p['g']!==$lastGroup) $score+=500;
     if(!empty($slotGames) && end($slotGames)['g']!==$p['g']) $score+=50;
     if($score>$bestScore){ $bestScore=$score; $bestIndex=$idx; }
    }
    if($bestIndex===null) break;
    $p=$pairs[$bestIndex]; array_splice($pairs,$bestIndex,1); $p['field']=$f; $slotGames[]=$p;
    $used[$p['h']->id]=1; $used[$p['a']->id]=1;
   }
   if(empty($slotGames)){ $slot++; continue; }
   foreach($slotGames as $p){ $p['slot']=$slot; $scheduled[]=$p; $last[$p['h']->id]=$slot; $last[$p['a']->id]=$slot; $lastGroup=$p['g']; }
   $slot++;
  }
  return $scheduled;
 }
 public function generate_matches(){
  $this->verify('vtp_generate_matches'); global $wpdb;
  $tid=absint($_POST['tournament_id']);
  $t=$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('tournaments').' WHERE id=%d',$tid));
  if(!$t) wp_die('Turnier nicht gefunden.');
  $wpdb->delete(VTP_DB::table('matches'),['tournament_id'=>$tid]);
  $teams=$this->active_teams($tid); $groups=[];
  foreach($teams as $team) $groups[$team->group_name][]=$team;
  $startDate=$t->start_date ?: current_time('Y-m-d');
  $startTime=sanitize_text_field($_POST['start_time']??($t->start_time?:'09:00'));
  $fields=max(1,absint($t->fields_count));
  $slotMinutes=max(1,absint($t->match_duration)+absint($t->break_minutes));
  $minRest=max(0,absint(get_post_meta($tid,'_vtp_min_team_rest',true) ?: 1));
  $no=1; $pairs=[]; $forfeits=[];
  foreach($groups as $g=>$list){ $n=count($list); for($i=0;$i<$n;$i++) for($j=$i+1;$j<$n;$j++){ $h=$list[$i]; $a=$list[$j]; if($h->status==='noshow'||$a->status==='noshow') $forfeits[]=['h'=>$h,'a'=>$a,'g'=>$g]; else $pairs[]=['h'=>$h,'a'=>$a,'g'=>$g]; } }
  $scheduled=$this->schedule_group_matches($pairs,$fields,$minRest);
  foreach($scheduled as $p){ $dt=date('Y-m-d H:i:s',strtotime($startDate.' '.$startTime.' +'.($p['slot']*$slotMinutes).' minutes')); $wpdb->insert(VTP_DB::table('matches'),['tournament_id'=>$tid,'round_type'=>'group','round_label'=>'Gruppe '.$p['g'],'group_name'=>$p['g'],'match_no'=>$no++,'team_home'=>$p['h']->id,'team_away'=>$p['a']->id,'starts_at'=>$dt,'field_no'=>$p['field'],'status'=>'angesetzt']); }
  foreach($forfeits as $p){ $gh=$p['h']->status==='noshow'?0:3; $ga=$p['a']->status==='noshow'?0:3; if($p['h']->status==='noshow' && $p['a']->status==='noshow'){ $gh=0; $ga=0; } $wpdb->insert(VTP_DB::table('matches'),['tournament_id'=>$tid,'round_type'=>'group','round_label'=>'Gruppe '.$p['g'],'group_name'=>$p['g'],'match_no'=>$no++,'team_home'=>$p['h']->id,'team_away'=>$p['a']->id,'goals_home'=>$gh,'goals_away'=>$ga,'field_no'=>0,'status'=>'wertung','is_forfeit'=>1]); }
  $lastSlot=empty($scheduled)?0:max(array_column($scheduled,'slot'))+1;
  if($t->tournament_mode==='groups_ko'){
    $labels=[16=>'Achtelfinale',8=>'Viertelfinale',4=>'Halbfinale',2=>'Finale']; $size=absint($t->ko_size);
    $firstSeedLabels=$this->ko_first_seed_labels($size, array_keys($groups));
    // K.O.-Runden nur bis einschließlich Halbfinale erzeugen. Finale und optionales
    // Spiel um Platz 3 werden anschließend explizit in der sportlich richtigen Reihenfolge angelegt.
    for($r=$size;$r>=4;$r/=2){
      $round=$labels[$r]??'K.O.-Runde'; $games=$r/2;
      for($x=1;$x<=$games;$x++){
        $slot=$lastSlot+floor(($x-1)/$fields); $field=(($x-1)%$fields)+1;
        $dt=date('Y-m-d H:i:s',strtotime($startDate.' '.$startTime.' +'.($slot*$slotMinutes).' minutes'));
        if($r===$size && !empty($firstSeedLabels[$x-1])) $rl=$round.' '.$x.' · '.$firstSeedLabels[$x-1];
        elseif($r===4) $rl='Halbfinale '.$x.' · Sieger '.($size>=8?'Viertelfinale':'Halbfinale').' '.(($x-1)*2+1).' gegen Sieger '.($size>=8?'Viertelfinale':'Halbfinale').' '.(($x-1)*2+2);
        else $rl=$round.' '.$x.' · Sieger '.$labels[$r*2].' '.(($x-1)*2+1).' gegen Sieger '.$labels[$r*2].' '.(($x-1)*2+2);
        $wpdb->insert(VTP_DB::table('matches'),['tournament_id'=>$tid,'round_type'=>'ko','round_label'=>$rl,'match_no'=>$no++,'starts_at'=>$dt,'field_no'=>$field,'status'=>'geplant']);
      }
      $lastSlot+=ceil($games/$fields)+$minRest;
    }
    if($size<4) $lastSlot=max($lastSlot, empty($scheduled)?0:max(array_column($scheduled,'slot'))+1);

    // Kleines Finale zwingend VOR dem Finale und in einem eigenen Zeitslot.
    if(get_post_meta($tid,'_vtp_third_place_match',true)==='1' && $size>=4){
      $dt=date('Y-m-d H:i:s',strtotime($startDate.' '.$startTime.' +'.($lastSlot*$slotMinutes).' minutes'));
      $wpdb->insert(VTP_DB::table('matches'),['tournament_id'=>$tid,'round_type'=>'placement','round_label'=>'Spiel um Platz 3 · Verlierer Halbfinale 1 gegen Verlierer Halbfinale 2','match_no'=>$no++,'starts_at'=>$dt,'field_no'=>1,'status'=>'geplant']);
      $lastSlot++;
    }

    // Finale ist immer das letzte Spiel der K.O.-Phase.
    $dt=date('Y-m-d H:i:s',strtotime($startDate.' '.$startTime.' +'.($lastSlot*$slotMinutes).' minutes'));
    $finalLabel=$size>=4 ? 'Finale · Sieger Halbfinale 1 gegen Sieger Halbfinale 2' : (!empty($firstSeedLabels[0]) ? 'Finale · '.$firstSeedLabels[0] : 'Finale');
    $wpdb->insert(VTP_DB::table('matches'),['tournament_id'=>$tid,'round_type'=>'ko','round_label'=>$finalLabel,'match_no'=>$no++,'starts_at'=>$dt,'field_no'=>1,'status'=>'geplant']);
    $lastSlot++;
  }
  if($t->tournament_mode==='groups_placement'){
    $groupNames=array_keys($groups); sort($groupNames);
    if(count($groupNames)>=2){ $a=$groupNames[0]; $b=$groupNames[1]; $count=min(count($groups[$a]), count($groups[$b])); $all=get_post_meta($tid,'_vtp_all_placement_matches',true)==='1'; $maxRank=$all ? $count : min(2,$count);
      for($rank=1;$rank<=$maxRank;$rank++){ $place1=($rank*2)-1; $place2=$rank*2; $label=$rank===1?'Spiel um Platz 1/2':'Spiel um Platz '.$place1.'/'.$place2; $slot=$lastSlot+($rank-1); $dt=date('Y-m-d H:i:s',strtotime($startDate.' '.$startTime.' +'.($slot*$slotMinutes).' minutes')); $wpdb->insert(VTP_DB::table('matches'),['tournament_id'=>$tid,'round_type'=>'placement','round_label'=>$label.' · '.$rank.'. Gruppe '.$a.' gegen '.$rank.'. Gruppe '.$b,'match_no'=>$no++,'starts_at'=>$dt,'field_no'=>1,'status'=>'geplant']); }
    }
  }
  $this->assign_referees($tid); $this->go(['edit'=>$tid,'generated'=>1]); }


 private function ko_first_seed_labels($size,$groupNames){ sort($groupNames); $a=$groupNames[0]??'A'; $b=$groupNames[1]??'B'; if($size<=2) return ['Platz 1 Gruppe '.$a.' gegen Platz 1 Gruppe '.$b]; if($size===4) return ['Platz 1 Gruppe '.$a.' gegen Platz 2 Gruppe '.$b, 'Platz 1 Gruppe '.$b.' gegen Platz 2 Gruppe '.$a]; if($size===8) return ['Platz 1 Gruppe '.$a.' gegen Platz 4 Gruppe '.$b, 'Platz 2 Gruppe '.$a.' gegen Platz 3 Gruppe '.$b, 'Platz 1 Gruppe '.$b.' gegen Platz 4 Gruppe '.$a, 'Platz 2 Gruppe '.$b.' gegen Platz 3 Gruppe '.$a]; if($size>=16) return ['Platz 1 Gruppe '.$a.' gegen Platz 8 Gruppe '.$b, 'Platz 4 Gruppe '.$a.' gegen Platz 5 Gruppe '.$b, 'Platz 2 Gruppe '.$a.' gegen Platz 7 Gruppe '.$b, 'Platz 3 Gruppe '.$a.' gegen Platz 6 Gruppe '.$b, 'Platz 1 Gruppe '.$b.' gegen Platz 8 Gruppe '.$a, 'Platz 4 Gruppe '.$b.' gegen Platz 5 Gruppe '.$a, 'Platz 2 Gruppe '.$b.' gegen Platz 7 Gruppe '.$a, 'Platz 3 Gruppe '.$b.' gegen Platz 6 Gruppe '.$a]; return []; }
 private function ko_first_seed_pairs($size,$stand,$groups){ sort($groups); $a=$groups[0]??''; $b=$groups[1]??''; $tid=function($g,$rank) use ($stand){ return $stand[$g][$rank-1]['team']->id ?? 0; }; if(!$a||!$b) return []; if($size<=2) return [[$tid($a,1),$tid($b,1)]]; if($size===4) return [[$tid($a,1),$tid($b,2)],[$tid($b,1),$tid($a,2)]]; if($size===8) return [[$tid($a,1),$tid($b,4)],[$tid($a,2),$tid($b,3)],[$tid($b,1),$tid($a,4)],[$tid($b,2),$tid($a,3)]]; if($size>=16) return [[$tid($a,1),$tid($b,8)],[$tid($a,4),$tid($b,5)],[$tid($a,2),$tid($b,7)],[$tid($a,3),$tid($b,6)],[$tid($b,1),$tid($a,8)],[$tid($b,4),$tid($a,5)],[$tid($b,2),$tid($a,7)],[$tid($b,3),$tid($a,6)]]; return []; }
 private function round_complete($tid,$label){ global $wpdb; $rows=$wpdb->get_results($wpdb->prepare('SELECT * FROM '.VTP_DB::table('matches').' WHERE tournament_id=%d AND round_type=%s AND round_label LIKE %s ORDER BY match_no ASC',$tid,'ko',$label.'%')); if(!$rows) return false; foreach($rows as $m){ if(!$this->ko_winner_id($m)) return false; } return true; }

 private function ranked_standings($tid){ global $wpdb; $teams=$wpdb->get_results($wpdb->prepare('SELECT * FROM '.VTP_DB::table('teams').' WHERE tournament_id=%d ORDER BY group_name, sort_order, name',$tid)); $tab=[]; foreach($teams as $team){ if($team->status==='noshow') continue; $tab[$team->group_name][$team->id]=['team'=>$team,'played'=>0,'won'=>0,'draw'=>0,'lost'=>0,'gf'=>0,'ga'=>0,'gd'=>0,'pts'=>0]; } $matches=$wpdb->get_results($wpdb->prepare("SELECT * FROM ".VTP_DB::table('matches')." WHERE tournament_id=%d AND round_type='group' AND goals_home IS NOT NULL AND goals_away IS NOT NULL",$tid)); foreach($matches as $m){ if(empty($tab[$m->group_name][$m->team_home]) || empty($tab[$m->group_name][$m->team_away])) continue; $h=&$tab[$m->group_name][$m->team_home]; $a=&$tab[$m->group_name][$m->team_away]; $h['played']++; $a['played']++; $h['gf']+=intval($m->goals_home); $h['ga']+=intval($m->goals_away); $a['gf']+=intval($m->goals_away); $a['ga']+=intval($m->goals_home); if($m->goals_home>$m->goals_away){ $h['won']++; $a['lost']++; $h['pts']+=3; } elseif($m->goals_home<$m->goals_away){ $a['won']++; $h['lost']++; $a['pts']+=3; } else { $h['draw']++; $a['draw']++; $h['pts']++; $a['pts']++; } unset($h,$a); } foreach($tab as $g=>$rows){ foreach($rows as &$r) $r['gd']=$r['gf']-$r['ga']; unset($r); usort($rows,function($a,$b){ return [$b['pts'],$b['gd'],$b['gf'],$a['team']->name] <=> [$a['pts'],$a['gd'],$a['gf'],$b['team']->name]; }); $tab[$g]=$rows; } ksort($tab); return $tab; }
 private function groups_complete($tid){ global $wpdb; $open=$wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM ".VTP_DB::table('matches')." WHERE tournament_id=%d AND round_type='group' AND is_forfeit=0 AND (goals_home IS NULL OR goals_away IS NULL)",$tid)); return intval($open)===0; }
 private function ko_winner_id($m){ if($m->goals_home===null || $m->goals_away===null || $m->team_home<=0 || $m->team_away<=0 || intval($m->goals_home)===intval($m->goals_away)) return 0; return intval($m->goals_home)>intval($m->goals_away)?intval($m->team_home):intval($m->team_away); }
 private function ko_loser_id($m){ if($m->goals_home===null || $m->goals_away===null || $m->team_home<=0 || $m->team_away<=0 || intval($m->goals_home)===intval($m->goals_away)) return 0; return intval($m->goals_home)>intval($m->goals_away)?intval($m->team_away):intval($m->team_home); }
 private function next_ko_label($label){ $map=['Achtelfinale'=>'Viertelfinale','Viertelfinale'=>'Halbfinale','Halbfinale'=>'Finale']; return $map[$label]??''; }

 private function reset_match_pair($match_id){
  global $wpdb;
  $wpdb->update(VTP_DB::table('matches'),['team_home'=>null,'team_away'=>null,'goals_home'=>null,'goals_away'=>null,'status'=>'geplant'],['id'=>absint($match_id)]);
 }
 private function update_match_pair($match_id,$home,$away){
  global $wpdb;
  $m=$wpdb->get_row($wpdb->prepare('SELECT team_home,team_away,goals_home,goals_away,status FROM '.VTP_DB::table('matches').' WHERE id=%d',absint($match_id)));
  if(!$m) return false;
  $home=absint($home); $away=absint($away);
  $data=['team_home'=>$home,'team_away'=>$away,'status'=>'angesetzt'];
  // Wenn sich die Paarung durch eine geänderte Vorrunde/K.O.-Runde ändert, alte Ergebnisse entfernen.
  if(absint($m->team_home)!==$home || absint($m->team_away)!==$away){
    $data['goals_home']=null; $data['goals_away']=null;
  }
  $wpdb->update(VTP_DB::table('matches'),$data,['id'=>absint($match_id)]);
  return true;
 }
 private function reset_dependent_rounds($tid){
  global $wpdb;
  $t=$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('tournaments').' WHERE id=%d',absint($tid)));
  if(!$t) return;
  // Solange die Gruppenphase nicht vollständig ist, bleiben alle Folgerunden Platzhalter.
  if(!$this->groups_complete($tid)){
    $wpdb->query($wpdb->prepare("UPDATE ".VTP_DB::table('matches')." SET team_home=NULL, team_away=NULL, goals_home=NULL, goals_away=NULL, status=%s WHERE tournament_id=%d AND round_type IN ('ko','placement')",'geplant',$tid));
    return;
  }
  if($t->tournament_mode==='groups_placement') return;
  if($t->tournament_mode!=='groups_ko') return;
  $size=absint($t->ko_size);
  $sequence=[];
  if($size>=16) $sequence[]='Achtelfinale';
  if($size>=8) $sequence[]='Viertelfinale';
  if($size>=4) $sequence[]='Halbfinale';
  $sequence[]='Finale';
  // Wenn eine K.O.-Runde nicht vollständig entschieden ist, alle nachfolgenden Runden auf Platzhalter zurücksetzen.
  for($i=0;$i<count($sequence)-1;$i++){
    $label=$sequence[$i];
    if(!$this->round_complete($tid,$label)){
      for($j=$i+1;$j<count($sequence);$j++){
        $wpdb->query($wpdb->prepare("UPDATE ".VTP_DB::table('matches')." SET team_home=NULL, team_away=NULL, goals_home=NULL, goals_away=NULL, status=%s WHERE tournament_id=%d AND round_type=%s AND round_label LIKE %s",'geplant',$tid,'ko',$sequence[$j].'%'));
      }
      $wpdb->query($wpdb->prepare("UPDATE ".VTP_DB::table('matches')." SET team_home=NULL, team_away=NULL, goals_home=NULL, goals_away=NULL, status=%s WHERE tournament_id=%d AND round_type=%s AND round_label LIKE %s",'geplant',$tid,'placement','Spiel um Platz 3%'));
      return;
    }
  }
  // Speziell: kleines Finale erst nach vollständig entschiedenen Halbfinals befüllen.
  if(in_array('Halbfinale',$sequence,true) && !$this->round_complete($tid,'Halbfinale')){
    $wpdb->query($wpdb->prepare("UPDATE ".VTP_DB::table('matches')." SET team_home=NULL, team_away=NULL, goals_home=NULL, goals_away=NULL, status=%s WHERE tournament_id=%d AND round_type=%s AND round_label LIKE %s",'geplant',$tid,'placement','Spiel um Platz 3%'));
  }
 }

 private function fill_final_round($tid){
  global $wpdb;
  $t=$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('tournaments').' WHERE id=%d',$tid));
  if(!$t) return false;
  $this->reset_dependent_rounds($tid);
  $changed=false;
  $stand=$this->ranked_standings($tid); $groups=array_keys($stand); sort($groups);
  if(count($groups)<1) return false;

  // Final-/Platzierungsrunden werden erst befüllt, wenn die Gruppenphase vollständig abgeschlossen ist.
  if(!$this->groups_complete($tid)) return false;

  if($t->tournament_mode==='groups_placement' && count($groups)>=2){
    $a=$groups[0]; $b=$groups[1]; $count=min(count($stand[$a]),count($stand[$b]));
    for($rank=1;$rank<=$count;$rank++){
      $home=$stand[$a][$rank-1]['team']->id ?? 0; $away=$stand[$b][$rank-1]['team']->id ?? 0;
      if(!$home || !$away) continue;
      $like=$rank===1?'Spiel um Platz 1/2%':'Spiel um Platz '.(($rank*2)-1).'/'.($rank*2).'%';
      $pm=$wpdb->get_row($wpdb->prepare('SELECT id FROM '.VTP_DB::table('matches').' WHERE tournament_id=%d AND round_type=%s AND round_label LIKE %s ORDER BY match_no ASC LIMIT 1',$tid,'placement',$like));
      if($pm){ $this->update_match_pair($pm->id,$home,$away); $changed=true; }
    }
    return $changed;
  }

  if($t->tournament_mode==='groups_ko' && count($groups)>=2){
    $size=absint($t->ko_size);
    $firstLabel=$size>=16?'Achtelfinale':($size>=8?'Viertelfinale':($size>=4?'Halbfinale':'Finale'));
    $pairs=$this->ko_first_seed_pairs($size,$stand,$groups);
    if($pairs){
      $firstMatches=$wpdb->get_results($wpdb->prepare('SELECT id FROM '.VTP_DB::table('matches').' WHERE tournament_id=%d AND round_type=%s AND round_label LIKE %s ORDER BY match_no ASC',$tid,'ko',$firstLabel.'%'));
      foreach($firstMatches as $i=>$m){
        $home=$pairs[$i][0]??0; $away=$pairs[$i][1]??0;
        if($home && $away){
          $this->update_match_pair($m->id,$home,$away);
          $changed=true;
        }
      }
    }

    // Jede weitere K.O.-Runde wird erst befüllt, wenn ALLE Spiele der vorherigen Runde entschieden sind.
    foreach(['Achtelfinale','Viertelfinale','Halbfinale'] as $label){
      $next=$this->next_ko_label($label); if(!$next) continue;
      $prev=$wpdb->get_results($wpdb->prepare('SELECT * FROM '.VTP_DB::table('matches').' WHERE tournament_id=%d AND round_type=%s AND round_label LIKE %s ORDER BY match_no ASC',$tid,'ko',$label.'%'));
      if(!$prev) continue;
      $winners=[]; $losers=[];
      foreach($prev as $pm){ $w=$this->ko_winner_id($pm); $l=$this->ko_loser_id($pm); if($w) $winners[]=$w; if($l) $losers[]=$l; }
      if(count($winners)!==count($prev)) continue;
      $nextMatches=$wpdb->get_results($wpdb->prepare('SELECT id FROM '.VTP_DB::table('matches').' WHERE tournament_id=%d AND round_type=%s AND round_label LIKE %s ORDER BY match_no ASC',$tid,'ko',$next.'%'));
      foreach($nextMatches as $i=>$nm){
        $home=$winners[$i*2]??0; $away=$winners[$i*2+1]??0;
        if($home && $away){ $this->update_match_pair($nm->id,$home,$away); $changed=true; }
      }
      if($label==='Halbfinale' && count($losers)===count($prev) && count($losers)>=2 && get_post_meta($tid,'_vtp_third_place_match',true)==='1'){
        $third=$wpdb->get_row($wpdb->prepare('SELECT id FROM '.VTP_DB::table('matches').' WHERE tournament_id=%d AND round_type=%s AND round_label LIKE %s ORDER BY match_no ASC LIMIT 1',$tid,'placement','Spiel um Platz 3%'));
        if($third){ $this->update_match_pair($third->id,$losers[0],$losers[1]); $changed=true; }
      }
    }
    return $changed;
  }
  return $changed;
 }
 public function generate_final_round(){ $this->verify('vtp_generate_final_round'); $tid=absint($_POST['tournament_id']); $this->fill_final_round($tid); $this->go(['edit'=>$tid,'finals'=>1]); }

 public function save_match_order(){
  $this->verify('vtp_save_match_order');
  global $wpdb;
  $tid=absint($_POST['tournament_id']??0);
  $orders=$_POST['match_order']??[];
  if(!$tid || !is_array($orders)) wp_die('Turnier nicht gefunden.');

  $rows=$wpdb->get_results($wpdb->prepare('SELECT * FROM '.VTP_DB::table('matches').' WHERE tournament_id=%d',$tid));
  $homes=$_POST['match_home']??[]; $aways=$_POST['match_away']??[];
  $items=[];
  foreach($rows as $m){
    $mid=absint($m->id);
    if(isset($homes[$mid]) || isset($aways[$mid])){
      $home=isset($homes[$mid]) ? absint($homes[$mid]) : absint($m->team_home);
      $away=isset($aways[$mid]) ? absint($aways[$mid]) : absint($m->team_away);
      if($home && $away && $home!==$away){
        $wpdb->update(VTP_DB::table('matches'),['team_home'=>$home,'team_away'=>$away],['id'=>$mid,'tournament_id'=>$tid]);
        $m->team_home=$home; $m->team_away=$away;
      }
    }
    $items[]=['id'=>$mid,'order'=>isset($orders[$mid])?intval($orders[$mid]):intval($m->match_no),'old'=>intval($m->match_no),'row'=>$m];
  }
  usort($items,function($a,$b){ if($a['order']===$b['order']) return $a['old']<=>$b['old']; return $a['order']<=>$b['order']; });

  $no=1;
  foreach($items as $it){
    $wpdb->update(VTP_DB::table('matches'),['match_no'=>$no++],['id'=>$it['id'],'tournament_id'=>$tid]);
  }

  if(!empty($_POST['recalculate_times'])){
    $t=$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('tournaments').' WHERE id=%d',$tid));
    if($t){
      $startTs=strtotime(($t->start_date ?: current_time('Y-m-d')).' '.($t->start_time ?: '09:00'));
      $slotMinutes=max(1,absint($t->match_duration)+absint($t->break_minutes));
      $fields=max(1,absint($t->fields_count));
      $playIndex=0;
      foreach($items as $it){
        $m=$it['row'];
        if(!empty($m->is_forfeit)){
          $wpdb->update(VTP_DB::table('matches'),['starts_at'=>null,'field_no'=>0],['id'=>absint($m->id),'tournament_id'=>$tid]);
          continue;
        }
        $slotIndex=intdiv($playIndex,$fields);
        $field=($playIndex % $fields)+1;
        $dt=date('Y-m-d H:i:s',$startTs+($slotIndex*$slotMinutes*60));
        $wpdb->update(VTP_DB::table('matches'),['starts_at'=>$dt,'field_no'=>$field],['id'=>absint($m->id),'tournament_id'=>$tid]);
        $playIndex++;
      }
    }
  }
  $this->assign_referees($tid);
  $this->go(['edit'=>$tid,'saved'=>1]);
 }
 public function save_results(){ $this->verify('vtp_save_results'); global $wpdb; $tid=absint($_POST['tournament_id']); foreach(($_POST['goals_home']??[]) as $mid=>$gh){ $ga=$_POST['goals_away'][$mid]??''; $wpdb->update(VTP_DB::table('matches'),['goals_home'=>($gh===''?null:intval($gh)),'goals_away'=>($ga===''?null:intval($ga)),'status'=>($gh!==''&&$ga!==''?'beendet':'angesetzt')],['id'=>absint($mid),'tournament_id'=>$tid]); } $this->fill_final_round($tid); $this->assign_referees($tid); $this->go(['edit'=>$tid,'saved'=>1]); }

 public function archive_tournament(){ $this->verify('vtp_archive_tournament'); global $wpdb; $id=absint($_POST['tournament_id']); $wpdb->update(VTP_DB::table('tournaments'),['status'=>'archiviert','updated_at'=>current_time('mysql')],['id'=>$id]); $this->go(['archived'=>1]); }
 public function restore_tournament(){ $this->verify('vtp_restore_tournament'); global $wpdb; $id=absint($_POST['tournament_id']); $wpdb->update(VTP_DB::table('tournaments'),['status'=>'aktiv','updated_at'=>current_time('mysql')],['id'=>$id]); $this->go(['edit'=>$id,'restored'=>1]); }
 public function delete_tournament(){ $this->verify('vtp_delete_tournament'); global $wpdb; $id=absint($_POST['tournament_id']); $t=$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('tournaments').' WHERE id=%d',$id)); if($t && !empty($_POST['delete_page']) && $t->public_page_id) wp_delete_post(absint($t->public_page_id),true); $wpdb->delete(VTP_DB::table('matches'),['tournament_id'=>$id]); $wpdb->delete(VTP_DB::table('teams'),['tournament_id'=>$id]); $wpdb->delete(VTP_DB::table('tournaments'),['id'=>$id]); $this->go(['deleted'=>1]); }

 public function regenerate_pin(){
  $this->verify('vtp_regenerate_pin'); global $wpdb; $id=absint($_POST['tournament_id']??0);
  $pin=(string)wp_rand(1000,9999);
  $wpdb->update(VTP_DB::table('tournaments'),['leader_pin'=>$pin,'updated_at'=>current_time('mysql')],['id'=>$id]);
  $this->go(['edit'=>$id,'saved'=>1]);
 }
 private function assign_referees($tid){
  global $wpdb;
  $refs=$wpdb->get_results($wpdb->prepare('SELECT * FROM '.VTP_DB::table('referees').' WHERE tournament_id=%d ORDER BY sort_order,id',$tid));
  if(!$refs) return;
  $t=$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('tournaments').' WHERE id=%d',$tid));
  $matches=$wpdb->get_results($wpdb->prepare('SELECT * FROM '.VTP_DB::table('matches').' WHERE tournament_id=%d ORDER BY starts_at, match_no',$tid));
  if(!$matches) return;
  $isShoot=in_array($t->event_type??'', ['elfmeterschiessen','neunmeterschiessen'], true);
  $refCount=count($refs);
  $i=0;
  foreach($matches as $m){
    if($isShoot){ $ref=$refs[max(0, min($refCount-1, intval($m->field_no)-1))]; }
    else { $ref=$refs[$i % $refCount]; $i++; }
    $wpdb->update(VTP_DB::table('matches'),['referee_id'=>intval($ref->id)],['id'=>intval($m->id)]);
  }
 }
 public function save_referees(){
  $this->verify('vtp_save_referees'); global $wpdb; $tid=absint($_POST['tournament_id']??0);
  $names=[]; $delete=array_map('absint', $_POST['referee_delete']??[]);
  if(isset($_POST['referee_name']) && is_array($_POST['referee_name'])){
    $ids=array_map('absint', $_POST['referee_id']??[]);
    foreach($_POST['referee_name'] as $i=>$raw){
      $rid=$ids[$i]??0; if($rid && in_array($rid,$delete,true)) continue;
      $name=trim(sanitize_text_field($raw)); if($name!=='') $names[]=$name;
    }
  } else {
    foreach(preg_split('/\r\n|\r|\n/', sanitize_textarea_field($_POST['referees']??'')) as $line){ $name=trim($line); if($name!=='') $names[]=$name; }
  }
  $wpdb->delete(VTP_DB::table('referees'),['tournament_id'=>$tid]);
  $i=0; foreach($names as $name){
    $wpdb->insert(VTP_DB::table('referees'),['tournament_id'=>$tid,'name'=>$name,'token'=>wp_generate_password(32,false,false),'pin'=>(string)wp_rand(1000,9999),'sort_order'=>$i++,'created_at'=>current_time('mysql')]);
  }
  $this->assign_referees($tid); $this->go(['edit'=>$tid,'saved'=>1]);
 }
 public function regenerate_referee_pin(){
  $this->verify('vtp_regenerate_referee_pin'); global $wpdb; $tid=absint($_POST['tournament_id']??0); $rid=absint($_POST['referee_id']??0);
  $wpdb->update(VTP_DB::table('referees'),['pin'=>(string)wp_rand(1000,9999),'token'=>wp_generate_password(32,false,false)],['id'=>$rid,'tournament_id'=>$tid]);
  $this->go(['edit'=>$tid,'saved'=>1]);
 }

 public function events_page(){ global $wpdb;
  $edit=absint($_GET['edit_event']??0);
  $view=sanitize_key($_GET['view']??($edit?'active':'active'));
  if(!in_array($view,['new','active','archive'],true)) $view='active';
  $ev=$edit?$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('events').' WHERE id=%d',$edit)):null;
  $active=$wpdb->get_results("SELECT * FROM ".VTP_DB::table('events')." WHERE status<>'archiviert' ORDER BY start_date ASC, end_date ASC, name ASC");
  $archived=$wpdb->get_results("SELECT * FROM ".VTP_DB::table('events')." WHERE status='archiviert' ORDER BY start_date DESC, end_date DESC, name ASC");
  echo '<div class="wrap vtp vtp-modern"><h1>Events</h1>';
  foreach(['saved'=>'Gespeichert.','deleted'=>'Gelöscht.','archived'=>'Archiviert.','restored'=>'Wiederhergestellt.','created_page'=>'Seite erstellt/aktualisiert.'] as $k=>$m) if(isset($_GET[$k])) echo '<div class="notice notice-success"><p>'.$m.'</p></div>';
  echo '<nav class="vtp-view-tabs"><a class="button '.($view==='new'?'button-primary':'').'" href="'.esc_url(admin_url('admin.php?page=vtp-events&view=new')).'">Neues Event anlegen</a> <a class="button '.($view==='active'?'button-primary':'').'" href="'.esc_url(admin_url('admin.php?page=vtp-events&view=active')).'">Aktive Events</a> <a class="button '.($view==='archive'?'button-primary':'').'" href="'.esc_url(admin_url('admin.php?page=vtp-events&view=archive')).'">Archiv</a></nav>';
  if($view==='new' || $ev){
    echo '<div class="vtp-card vtp-wide"><h2>'.($ev?'Event bearbeiten':'Neues Event').'</h2><form method="post" action="'.esc_url(admin_url('admin-post.php')).'">';
    wp_nonce_field('vtp_save_event'); echo '<input type="hidden" name="action" value="vtp_save_event"><input type="hidden" name="id" value="'.esc_attr($ev->id??0).'">';
    echo '<div class="vtp-form-section"><h3>Eventdaten</h3>';
    $this->field('Eventname','name',$ev->name??'','text',true); $this->field('Startdatum','start_date',$ev->start_date??'','date'); $this->field('Enddatum','end_date',$ev->end_date??'','date'); $this->field('Veranstaltungsort','location',$ev->location??'','text'); $this->field('Link zum Inhalt','content_url',$ev->content_url??'','url'); echo '<p class="description">Optionaler Link, der auf der öffentlichen Eventseite als Button angezeigt wird, z. B. Ticketshop, externe Anmeldung oder Detailseite.</p>'; echo '<p><label><input type="checkbox" name="calendar_visible" value="1" '.checked(isset($ev->calendar_visible)?absint($ev->calendar_visible):1,1,false).'> Im Veranstaltungskalender anzeigen</label></p>';
    echo '<p><label>Beschreibung<br><textarea name="description" rows="4" class="large-text">'.esc_textarea($ev->description??'').'</textarea></label></p></div>';
    echo '<div class="vtp-form-section"><h3>Sponsoren</h3><p><label>Sponsoren des Events<br><textarea name="sponsors" rows="4" class="large-text" placeholder="Name|Logo-URL|Website">'.esc_textarea($ev->sponsors??'').'</textarea></label><br><span class="description">Ein Sponsor pro Zeile: Name|Logo-URL|Website</span></p></div>';
    submit_button($ev?'Event aktualisieren':'Event anlegen'); echo '</form></div>';
  }
  if($view==='active' && !$ev){
    echo '<div class="vtp-card vtp-wide"><h2>Aktive Events</h2>';
    if(!$active) echo '<p>Noch keine aktiven Events vorhanden.</p>'; else { echo '<div class="vtp-tournament-card-grid">'; foreach($active as $e){
      $range=trim(($e->start_date?date_i18n('d.m.Y',strtotime($e->start_date)):'').(($e->end_date && $e->end_date!==$e->start_date)?' – '.date_i18n('d.m.Y',strtotime($e->end_date)):''));
      echo '<article class="vtp-tournament-card-modern"><div class="vtp-card-accent"></div><div class="vtp-card-main"><div class="vtp-card-title-row"><h3>'.esc_html($e->name).'</h3><span class="vtp-status-badge">Aktiv</span></div><p class="vtp-card-meta">'.esc_html($range).'</p><p class="vtp-card-location">'.esc_html($e->location).'</p><div class="vtp-card-actions"><a class="button button-primary" href="'.esc_url(admin_url('admin.php?page=vtp-events&edit_event='.$e->id)).'">Öffnen</a><a class="button" target="_blank" href="'.esc_url(VTP_Public::event_url($e)).'">Programmübersicht</a></div></div></article>';
    } echo '</div>'; }
    echo '</div>';
  }
  if($view==='archive'){
    echo '<div class="vtp-card vtp-wide"><h2>Archivierte Events</h2><p class="description">Archivierte Events können wiederhergestellt oder dauerhaft gelöscht werden.</p>';
    if(!$archived) echo '<p>Noch keine archivierten Events vorhanden.</p>'; else { echo '<div class="vtp-tournament-card-grid">'; foreach($archived as $e){
      $range=trim(($e->start_date?date_i18n('d.m.Y',strtotime($e->start_date)):'').(($e->end_date && $e->end_date!==$e->start_date)?' – '.date_i18n('d.m.Y',strtotime($e->end_date)):''));
      echo '<article class="vtp-tournament-card-modern"><div class="vtp-card-accent"></div><div class="vtp-card-main"><div class="vtp-card-title-row"><h3>'.esc_html($e->name).'</h3><span class="vtp-pill">Archiviert</span></div><p class="vtp-card-meta">'.esc_html($range).'</p><p class="vtp-card-location">'.esc_html($e->location).'</p><div class="vtp-card-actions"><a class="button" href="'.esc_url(admin_url('admin.php?page=vtp-events&edit_event='.$e->id.'&view=archive')).'">Ansehen</a><form method="post" action="'.esc_url(admin_url('admin-post.php')).'" style="display:inline">'; wp_nonce_field('vtp_restore_event'); echo '<input type="hidden" name="action" value="vtp_restore_event"><input type="hidden" name="event_id" value="'.esc_attr($e->id).'">'.get_submit_button('Wiederherstellen','secondary','submit',false).'</form></div></div></article>';
    } echo '</div>'; }
    echo '</div>';
  }
  if($ev) $this->manage_event($ev);
  echo '</div>'; }
 private function manage_event($ev){ global $wpdb;
  $items=$wpdb->get_results($wpdb->prepare('SELECT i.*, t.name tournament_name FROM '.VTP_DB::table('event_items').' i LEFT JOIN '.VTP_DB::table('tournaments').' t ON t.id=i.tournament_id WHERE i.event_id=%d ORDER BY item_date,start_time,sort_order',$ev->id));
  $shifts=$wpdb->get_results($wpdb->prepare('SELECT s.*, COUNT(g.id) signups FROM '.VTP_DB::table('shifts').' s LEFT JOIN '.VTP_DB::table('shift_signups').' g ON g.shift_id=s.id WHERE s.event_id=%d GROUP BY s.id ORDER BY shift_date,start_time,area_name',$ev->id));
  $signups=$wpdb->get_results($wpdb->prepare('SELECT g.*, s.area_name, s.shift_date, s.start_time, s.end_time FROM '.VTP_DB::table('shift_signups').' g JOIN '.VTP_DB::table('shifts').' s ON s.id=g.shift_id WHERE s.event_id=%d ORDER BY g.created_at DESC',$ev->id));
  $helperNeeds=$wpdb->get_results($wpdb->prepare('SELECT * FROM '.VTP_DB::table('helper_needs').' WHERE event_id=%d ORDER BY need_date, sort_order, id',$ev->id));
  $ts=$wpdb->get_results($wpdb->prepare('SELECT id,name,start_date,start_time,event_type FROM '.VTP_DB::table('tournaments').' WHERE event_id=%d OR parent_event=%s ORDER BY start_date,start_time',$ev->id,$ev->name));
  $programCount=count($items)+count($ts);
  $shiftCount=count($shifts);
  $slotsNeeded=0; $slotsFilled=0;
  foreach($shifts as $s){ $slotsNeeded += absint($s->slots_needed); $slotsFilled += absint($s->signups); }
  $needsCount=count($helperNeeds);
  $days=[]; if($ev->start_date){ $sd=strtotime($ev->start_date); $ed=strtotime($ev->end_date?:$ev->start_date); if($ed<$sd) $ed=$sd; for($d=$sd;$d<=$ed;$d=strtotime('+1 day',$d)) $days[date('Y-m-d',$d)]=[]; }
  foreach($items as $it){ if($it->item_date) $days[$it->item_date][]=['linked'=>false,'time'=>$it->start_time,'end'=>$it->end_time,'type'=>$it->item_type,'title'=>$it->title,'visibility'=>($it->visibility ?: 'public'),'sort'=>intval($it->sort_order)]; }
  foreach($ts as $tr){ if($tr->start_date) $days[$tr->start_date][]=['linked'=>true,'time'=>$tr->start_time,'end'=>'','type'=>$this->type_label($tr->event_type),'title'=>$tr->name,'sort'=>0]; }
  ksort($days); foreach($days as &$arr) usort($arr,function($a,$b){ $c=strcmp(($a['time']?:'99:99'),($b['time']?:'99:99')); if($c!==0) return $c; $c=strcmp(($a['end']?:'99:99'),($b['end']?:'99:99')); if($c!==0) return $c; if(($a['linked']??false)!==($b['linked']??false)) return ($a['linked']??false)?1:-1; return strcmp(($a['title']??''),($b['title']??'')); }); unset($arr);
  $helperDays=[]; $autoBuildNeeds=[];
  foreach($days as $date=>$program){
    $hasAnyProgram=false;
    foreach($program as $it){
      $typ=(string)($it['type']??'');
      if($typ==='') continue;
      $hasAnyProgram=true;
      if(in_array($typ,['Aufbau','Abbau'],true)) $autoBuildNeeds[$date][$typ]=true;
    }
    if($hasAnyProgram) $helperDays[$date]=[];
  }
  foreach($helperNeeds as $hn){ if($hn->need_date && array_key_exists($hn->need_date,$helperDays)) $helperDays[$hn->need_date][]=$hn; }
  foreach($autoBuildNeeds as $date=>$types){
    if(!array_key_exists($date,$helperDays)) $helperDays[$date]=[];
    foreach(['Aufbau','Abbau'] as $autoDesc){
      if(empty($types[$autoDesc])) continue;
      $exists=false;
      foreach($helperDays[$date] as $hn){ if(strtolower(trim((string)$hn->need_type))==='helferschicht' && strtolower(trim((string)$hn->description))===strtolower($autoDesc)){ $exists=true; break; } }
      if(!$exists){ $o=(object)['need_date'=>$date,'need_type'=>'Helferschicht','description'=>$autoDesc,'amount'=>1,'unit'=>'Personen']; array_unshift($helperDays[$date],$o); }
    }
  }
  echo '<div class="vtp-grid"><div class="vtp-card"><h2>Öffentliche Seiten</h2><p><a class="button button-primary" target="_blank" href="'.esc_url(VTP_Public::event_url($ev)).'">Programmübersicht öffnen</a></p><p class="description">Die öffentlichen Seiten wurden automatisch erzeugt. Shortcodes müssen nicht manuell gepflegt werden.</p></div><div class="vtp-card"><h2>Verknüpfte Turniere</h2>'; if($ts){ echo '<ul>'; foreach($ts as $tr) echo '<li>'.esc_html($tr->start_date.' '.$tr->start_time.' · '.$this->type_label($tr->event_type).' · '.$tr->name).'</li>'; echo '</ul>'; } else echo '<p>Noch keine Turniere verknüpft. Beim Turnier unter „Teil eines Events“ auswählen.</p>'; echo '</div></div>';
  echo '<div class="vtp-card vtp-dashboard"><h2>Event-Status</h2><div class="vtp-status-grid"><div><strong>'.esc_html($programCount).'</strong><span>Programmpunkte</span></div><div><strong>'.esc_html($needsCount).'</strong><span>Helferbedarfe</span></div><div><strong>'.esc_html($shiftCount).'</strong><span>Schichten</span></div><div><strong>'.esc_html($slotsFilled).' / '.esc_html($slotsNeeded).'</strong><span>Helferplätze belegt</span></div></div><ul class="vtp-checklist"><li class="'.($ev->name?'done':'').'">Event erstellt</li><li class="'.($programCount>0?'done':'').'">Programm gepflegt</li><li class="'.($needsCount>0?'done':'').'">Helferbedarf gepflegt</li><li class="'.($shiftCount>0?'done':'').'">Schichten generiert</li></ul></div>';

  echo '<div class="vtp-card"><h2>Event-Ablauf</h2><p class="description">Erstelle hier die Programmübersicht des Events. Tage und Programmpunkte können über die Buttons hinzugefügt oder entfernt werden.</p><form method="post" action="'.esc_url(admin_url('admin-post.php')).'">';
  wp_nonce_field('vtp_save_event_items'); echo '<input type="hidden" name="action" value="vtp_save_event_items"><input type="hidden" name="event_id" value="'.esc_attr($ev->id).'">';
  echo '<style>.vtp-day-card{border:1px solid #ccd0d4;border-radius:10px;padding:14px;margin:14px 0;background:#fff}.vtp-day-head{display:flex;gap:10px;align-items:center;justify-content:space-between;flex-wrap:wrap}.vtp-day-actions{display:flex;gap:6px;align-items:center;flex-wrap:wrap}.vtp-day-card.is-collapsed .vtp-day-body{display:none}.vtp-status-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:10px}.vtp-status-grid div{background:#f6f7f7;border-radius:10px;padding:12px}.vtp-status-grid strong{font-size:22px;display:block}.vtp-status-grid span{color:#646970}.vtp-checklist{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:6px;margin-top:14px}.vtp-checklist li{background:#fff7e6;border:1px solid #f0c36d;border-radius:999px;padding:6px 10px}.vtp-checklist li.done{background:#edfaef;border-color:#7ad18b}.vtp-program-row{display:grid;grid-template-columns:110px 110px 150px 1fr 150px auto;gap:8px;align-items:center;margin:8px 0}.vtp-need-row{display:grid;grid-template-columns:160px 1fr 100px 120px auto;gap:8px;align-items:center;margin:8px 0}.vtp-linked-row{padding:8px 10px;background:#f6f7f7;border-radius:8px;margin:8px 0}.vtp-icon-btn{border:1px solid #c3c4c7;background:#fff;border-radius:6px;padding:4px 8px;cursor:pointer}.vtp-icon-btn:hover{background:#f0f0f1}@media(max-width:900px){.vtp-program-row,.vtp-need-row{grid-template-columns:1fr 1fr}.vtp-program-row input,.vtp-program-row select,.vtp-need-row input,.vtp-need-row select{width:100%}}</style>';
  echo '<div id="vtp-event-days">';
  $dayIndex=0; if(!$days && $ev->start_date) $days[$ev->start_date]=[];
  foreach($days as $date=>$program){ $dayIndex++; echo '<div class="vtp-day-card"><div class="vtp-day-head"><h3>Tag '.$dayIndex.' – '.esc_html($date?date_i18n('l, d. F Y',strtotime($date)):'neuer Tag').'</h3><p class="vtp-day-actions"><label>Datum <input type="date" class="vtp-day-date" value="'.esc_attr($date).'"></label> <button type="button" class="button vtp-toggle-day">Einklappen</button> <button type="button" class="button vtp-duplicate-day">Tag duplizieren</button> <button type="button" class="button vtp-add-program">Programmpunkt hinzufügen</button> <button type="button" class="button vtp-remove-day">Tag entfernen</button></p></div><div class="vtp-day-body"><div class="vtp-program-rows">';
    foreach($program as $it){
      if(!empty($it['linked'])){ echo '<div class="vtp-linked-row"><strong>Verknüpftes Turnier:</strong> '.esc_html(substr((string)$it['time'],0,5).' · '.$it['type'].' · '.$it['title']).'</div>'; continue; }
      echo '<div class="vtp-program-row"><input type="time" name="start_time[]" value="'.esc_attr(substr((string)$it['time'],0,5)).'" aria-label="Start"><input type="time" name="end_time[]" value="'.esc_attr(substr((string)$it['end'],0,5)).'" aria-label="Ende"><select name="item_type[]"><option '.selected($it['type'],'Aufbau',false).'>Aufbau</option><option '.selected($it['type'],'Abbau',false).'>Abbau</option><option '.selected($it['type'],'Programmpunkt',false).'>Programmpunkt</option><option '.selected($it['type'],'Musik',false).'>Musik</option><option '.selected($it['type'],'Spiel',false).'>Spiel</option></select><input type="text" name="title[]" value="'.esc_attr($it['title']).'" placeholder="Titel"><select name="visibility[]" aria-label="Sichtbarkeit"><option value="public" '.selected($it['visibility']??'public','public',false).'>öffentlich</option><option value="private" '.selected($it['visibility']??'public','private',false).'>nicht öffentlich</option><option value="ticket" '.selected($it['visibility']??'public','ticket',false).'>Eintrittskarte</option><option value="members" '.selected($it['visibility']??'public','members',false).'>Mitglieder</option></select><input type="hidden" name="item_date[]" value="'.esc_attr($date).'"><button type="button" class="vtp-icon-btn vtp-remove-program" title="Programmpunkt entfernen">✕</button></div>';
    }
    echo '</div></div></div>'; }
  echo '</div><p><button type="button" class="button" id="vtp-add-day">Tag hinzufügen</button></p>'; submit_button('Event-Ablauf speichern'); echo '</form>';
  echo '<script>(function(){function renumber(){document.querySelectorAll("#vtp-event-days .vtp-day-card").forEach(function(card,i){var h=card.querySelector("h3");var d=card.querySelector(".vtp-day-date"); if(h){var txt="Tag "+(i+1); if(d&&d.value){try{txt += " – "+new Date(d.value+"T00:00:00").toLocaleDateString("de-DE",{weekday:"long",year:"numeric",month:"long",day:"numeric"});}catch(e){txt += " – "+d.value;}} h.textContent=txt;} card.querySelectorAll("input[name=\'item_date[]\']").forEach(function(x){x.value=d?d.value:"";});});} function row(date){return `<div class="vtp-program-row"><input type="time" name="start_time[]" aria-label="Start"><input type="time" name="end_time[]" aria-label="Ende"><select name="item_type[]"><option>Aufbau</option><option>Abbau</option><option>Programmpunkt</option><option>Musik</option><option>Spiel</option></select><input type="text" name="title[]" placeholder="Titel"><select name="visibility[]" aria-label="Sichtbarkeit"><option value="public" selected>öffentlich</option><option value="private">nicht öffentlich</option><option value="ticket">Eintrittskarte</option><option value="members">Mitglieder</option></select><input type="hidden" name="item_date[]" value="${date||""}"><button type="button" class="vtp-icon-btn vtp-remove-program" title="Programmpunkt entfernen">✕</button></div>`;} function dayCard(date){return `<div class="vtp-day-card"><div class="vtp-day-head"><h3>Neuer Tag</h3><p class="vtp-day-actions"><label>Datum <input type="date" class="vtp-day-date" value="${date||""}"></label> <button type="button" class="button vtp-toggle-day">Einklappen</button> <button type="button" class="button vtp-duplicate-day">Tag duplizieren</button> <button type="button" class="button vtp-add-program">Programmpunkt hinzufügen</button> <button type="button" class="button vtp-remove-day">Tag entfernen</button></p></div><div class="vtp-day-body"><div class="vtp-program-rows"></div></div></div>`;} document.addEventListener("click",function(e){if(e.target.id==="vtp-add-day"){var box=document.getElementById("vtp-event-days");box.insertAdjacentHTML("beforeend",dayCard(""));renumber();} if(e.target.classList.contains("vtp-toggle-day")){var card=e.target.closest(".vtp-day-card");card.classList.toggle("is-collapsed");e.target.textContent=card.classList.contains("is-collapsed")?"Aufklappen":"Einklappen";} if(e.target.classList.contains("vtp-duplicate-day")){var card=e.target.closest(".vtp-day-card"), box=document.getElementById("vtp-event-days"); var oldDate=card.querySelector(".vtp-day-date").value; var nd=oldDate?new Date(oldDate+"T00:00:00"):null; var newDate=""; if(nd&&!isNaN(nd)){nd.setDate(nd.getDate()+1); newDate=nd.toISOString().slice(0,10);} var wrap=document.createElement("div"); wrap.innerHTML=dayCard(newDate); var clone=wrap.firstElementChild; card.querySelectorAll(".vtp-program-row").forEach(function(r){var nr=r.cloneNode(true); var hidden=nr.querySelector("input[name=\'item_date[]\']"); if(hidden) hidden.value=newDate; clone.querySelector(".vtp-program-rows").appendChild(nr);}); box.insertBefore(clone,card.nextSibling); renumber();} if(e.target.classList.contains("vtp-remove-day")){if(confirm("Tag mit allen Programmpunkten entfernen?")){e.target.closest(".vtp-day-card").remove();renumber();}} if(e.target.classList.contains("vtp-add-program")){var card=e.target.closest(".vtp-day-card");var d=card.querySelector(".vtp-day-date").value;card.querySelector(".vtp-program-rows").insertAdjacentHTML("beforeend",row(d));renumber();} if(e.target.classList.contains("vtp-remove-program")){e.target.closest(".vtp-program-row").remove();}}); document.addEventListener("change",function(e){if(e.target.classList.contains("vtp-day-date")) renumber();});})();</script>';
  echo '</div>';

  echo '<div class="vtp-card"><h2>Helferbedarf für das Event</h2><p class="description">Pflege hier pro Event-Tag, was mitgebracht werden soll und welche Stationen zu besetzen sind. Daraus wird später der konkrete Schichtplan erzeugt.</p><form method="post" action="'.esc_url(admin_url('admin-post.php')).'">';
  wp_nonce_field('vtp_save_helper_needs'); echo '<input type="hidden" name="action" value="vtp_save_helper_needs"><input type="hidden" name="event_id" value="'.esc_attr($ev->id).'">';
  echo '<div id="vtp-helper-needs">';
  $needDayIndex=0;
  if(!$helperDays){ echo '<p class="description">Für dieses Event gibt es aktuell noch keine Programmpunkte. Helferbedarf wird angezeigt, sobald im Event-Ablauf Programmpunkte gepflegt sind.</p>'; }
  foreach($helperDays as $date=>$needs){ $needDayIndex++; echo '<div class="vtp-day-card vtp-helper-day"><div class="vtp-day-head"><h3>Tag '.$needDayIndex.' – '.esc_html($date?date_i18n('l, d. F Y',strtotime($date)):'neuer Tag').'</h3><p><button type="button" class="button vtp-add-need">Eintrag hinzufügen</button></p></div><div class="vtp-need-rows"><input type="hidden" class="vtp-helper-date" value="'.esc_attr($date).'">';
    foreach($needs as $need){ echo '<div class="vtp-need-row"><select name="need_type[]"><option '.selected($need->need_type,'Mitbringen',false).'>Mitbringen</option><option '.selected($need->need_type,'Helferschicht',false).'>Helferschicht</option></select><input type="text" name="need_description[]" value="'.esc_attr($need->description).'" placeholder="Beschreibung"><input type="number" min="1" name="need_amount[]" value="'.esc_attr(max(1,intval($need->amount))).'" placeholder="Anzahl"><input type="text" name="need_unit[]" value="'.esc_attr($need->unit ?: ($need->need_type==='Mitbringen'?'Stück':'Personen')).'" placeholder="Einheit"><input type="hidden" name="need_date[]" value="'.esc_attr($date).'"><button type="button" class="vtp-icon-btn vtp-remove-need" title="Eintrag entfernen">✕</button></div>'; }
    echo '</div></div>'; }
  echo '</div>'; submit_button('Helferbedarf speichern'); echo '</form>';
  echo '<script>(function(){function needRow(date){return `<div class="vtp-need-row"><select name="need_type[]"><option>Mitbringen</option><option selected>Helferschicht</option></select><input type="text" name="need_description[]" placeholder="Beschreibung"><input type="number" min="1" name="need_amount[]" value="1" placeholder="Anzahl"><input type="text" name="need_unit[]" value="Personen" placeholder="Einheit"><input type="hidden" name="need_date[]" value="${date||""}"><button type="button" class="vtp-icon-btn vtp-remove-need" title="Eintrag entfernen">✕</button></div>`;} document.addEventListener("click",function(e){if(e.target.classList.contains("vtp-add-need")){var card=e.target.closest(".vtp-helper-day");var d=card.querySelector(".vtp-helper-date").value;card.querySelector(".vtp-need-rows").insertAdjacentHTML("beforeend",needRow(d));} if(e.target.classList.contains("vtp-remove-need")){e.target.closest(".vtp-need-row").remove();}}); document.addEventListener("change",function(e){if(e.target && e.target.name==="need_type[]"){var row=e.target.closest(".vtp-need-row");var unit=row.querySelector("input[name=\"need_unit[]\"]"); if(unit && (!unit.value || unit.value==="Personen" || unit.value==="Stück")){unit.value=e.target.value==="Mitbringen"?"Stück":"Personen";}}});})();</script>';
  echo '</div>';

  echo '<div class="vtp-card"><h2>Helferschichten generieren</h2><p class="description">Erzeugt die konkrete Schichtübersicht aus <strong>Event-Ablauf</strong> und <strong>Helferbedarf</strong>. Die weitere Verwaltung und Helfer-Eintragung erfolgt anschließend im Menüpunkt <strong>Helferschichten</strong>.</p><form method="post" action="'.esc_url(admin_url('admin-post.php')).'">'; wp_nonce_field('vtp_generate_shifts'); echo '<input type="hidden" name="action" value="vtp_generate_shifts"><input type="hidden" name="event_id" value="'.esc_attr($ev->id).'"><p><label><input type="checkbox" name="replace" value="1" checked> vorhandene Schichten dieses Events vorher löschen</label></p><div class="vtp-form-stack"><label><strong>Blocklänge</strong><br><select name="block_minutes" id="vtp_block_minutes"><option value="60">1 Stunde</option><option value="90">1,5 Stunden</option><option value="120" selected>2 Stunden</option><option value="180">3 Stunden</option><option value="custom">Eigene Dauer</option></select></label><label><strong>Eigene Dauer in Minuten</strong><br><input type="number" min="15" step="15" name="custom_block_minutes" id="vtp_custom_block_minutes" value="" placeholder="z. B. 150" disabled></label></div><script>(function(){var s=document.getElementById("vtp_block_minutes"),i=document.getElementById("vtp_custom_block_minutes");if(!s||!i)return;function t(){var c=s.value==="custom";i.disabled=!c;if(!c)i.value="";}s.addEventListener("change",t);t();})();</script><p class="description">Mitbringen wird automatisch 30 Minuten vor dem ersten öffentlichen Programmpunkt des Tages angesetzt. Aufbau/Abbau werden aus dem Event-Ablauf übernommen und mit der Personenanzahl aus dem Helferbedarf erzeugt.</p>'; submit_button('Helferschichten generieren','primary'); echo '</form></div>';
  echo '<div class="vtp-card"><h2>Schichtübersicht</h2><table class="widefat striped"><thead><tr><th>Datum</th><th>Zeit</th><th>Bereich / Mitbringliste</th><th>Belegt</th><th></th></tr></thead><tbody>'; foreach($shifts as $s){ echo '<tr><td>'.esc_html($s->shift_date).'</td><td>'.esc_html($s->start_time.' - '.$s->end_time).'</td><td>'.esc_html($s->area_name).'</td><td>'.esc_html($s->signups.' / '.$s->slots_needed).'</td><td>—</td></tr>'; } echo '</tbody></table></div>';
  echo '<div class="vtp-card"><h2>Archivieren / Löschen</h2><p class="description">Beim Archivieren wird auch der zugehörige Helferplan aus den aktiven Ansichten ausgeblendet. Eine Wiederherstellung macht Event und Helferplan wieder sichtbar.</p><div class="vtp-actions-stack">';
  if($ev->status!=='archiviert'){
    echo '<form method="post" action="'.esc_url(admin_url('admin-post.php')).'">'; wp_nonce_field('vtp_archive_event'); echo '<input type="hidden" name="action" value="vtp_archive_event"><input type="hidden" name="event_id" value="'.esc_attr($ev->id).'">'; submit_button('Event archivieren','secondary','submit',false); echo '</form>';
  } else {
    echo '<form method="post" action="'.esc_url(admin_url('admin-post.php')).'">'; wp_nonce_field('vtp_restore_event'); echo '<input type="hidden" name="action" value="vtp_restore_event"><input type="hidden" name="event_id" value="'.esc_attr($ev->id).'">'; submit_button('Event wiederherstellen','secondary','submit',false); echo '</form>';
  }
  echo '<form method="post" action="'.esc_url(admin_url('admin-post.php')).'" onsubmit="return confirm(&quot;Event wirklich endgültig löschen? Diese Aktion kann nicht rückgängig gemacht werden.&quot;);">'; wp_nonce_field('vtp_delete_event'); echo '<input type="hidden" name="action" value="vtp_delete_event"><input type="hidden" name="event_id" value="'.esc_attr($ev->id).'">'; submit_button('Event dauerhaft löschen','delete','submit',false); echo '</form></div></div>';
  // Helfer-Eintragungen werden nur im Modul Helferschichten angezeigt.
 }
 public function save_event(){ $this->verify('vtp_save_event'); global $wpdb; $id=absint($_POST['id']??0); $name=sanitize_text_field($_POST['name']); $now=current_time('mysql'); $data=['name'=>$name,'slug'=>sanitize_title($name),'description'=>sanitize_textarea_field($_POST['description']??''),'location'=>sanitize_text_field($_POST['location']??''),'sponsors'=>sanitize_textarea_field($_POST['sponsors']??''),'calendar_visible'=>!empty($_POST['calendar_visible'])?1:0,'content_url'=>esc_url_raw($_POST['content_url']??''),'start_date'=>sanitize_text_field($_POST['start_date']??''),'end_date'=>sanitize_text_field($_POST['end_date']??''),'updated_at'=>$now]; if($id){ $wpdb->update(VTP_DB::table('events'),$data,['id'=>$id]); } else { $data['created_at']=$now; $data['status']='aktiv'; $wpdb->insert(VTP_DB::table('events'),$data); $id=$wpdb->insert_id; } $this->ensure_event_pages($id); $this->go(['edit_event'=>$id,'saved'=>1],'vtp-events'); }

 public function helpers_page(){ global $wpdb; $edit=absint($_GET['edit_event']??0); $ev=$edit?$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('events').' WHERE id=%d',$edit)):null; $events=$wpdb->get_results("SELECT * FROM ".VTP_DB::table('events')." WHERE status<>'archiviert' ORDER BY start_date DESC,name"); echo '<div class="wrap vtp"><h1>Helferschichten</h1>'; foreach(['saved'=>'Gespeichert.','deleted'=>'Gelöscht.'] as $k=>$m) if(isset($_GET[$k])) echo '<div class="notice notice-success"><p>'.$m.'</p></div>'; echo '<div class="vtp-card"><h2>Events mit Helferplan</h2><p class="description">Helferpläne hängen am Event. Wird ein Event archiviert, verschwindet der zugehörige Helferplan automatisch aus dieser aktiven Übersicht und wird bei Wiederherstellung wieder sichtbar.</p><table class="widefat striped"><thead><tr><th>Event</th><th>Datum</th><th>Helfer Anmeldung</th><th></th></tr></thead><tbody>'; foreach($events as $e){ echo '<tr><td><strong>'.esc_html($e->name).'</strong></td><td>'.esc_html($e->start_date).($e->end_date?' - '.esc_html($e->end_date):'').'</td><td><a target="_blank" href="'.esc_url(VTP_Public::helpers_url($e)).'">Gesamt öffnen</a></td><td><a class="button" href="'.esc_url(admin_url('admin.php?page=vtp-helpers&edit_event='.$e->id)).'">Schichten verwalten</a></td></tr>'; } echo '</tbody></table></div>'; if($ev){ echo '<hr>'; $this->manage_helpers($ev); } echo '</div>'; }

 private function manage_helpers($ev){ global $wpdb;
  $shifts=$wpdb->get_results($wpdb->prepare('SELECT s.*, COUNT(g.id) signups FROM '.VTP_DB::table('shifts').' s LEFT JOIN '.VTP_DB::table('shift_signups').' g ON g.shift_id=s.id WHERE s.event_id=%d GROUP BY s.id ORDER BY s.shift_date,s.start_time,s.area_name',$ev->id));
  $signups=$wpdb->get_results($wpdb->prepare('SELECT g.*, s.area_name, s.shift_date, s.start_time, s.end_time, s.assigned_group FROM '.VTP_DB::table('shift_signups').' g JOIN '.VTP_DB::table('shifts').' s ON s.id=g.shift_id WHERE s.event_id=%d ORDER BY s.shift_date,s.start_time,s.area_name,g.created_at',$ev->id));
  foreach($signups as $g){ $g->program_label=$this->helper_program_label($ev->id,$g->shift_date,$g->start_time,$g->end_time); }
  $groups=[]; foreach($shifts as $s){ $g=trim((string)($s->assigned_group??'')); if($g!=='' && !in_array($g,$groups,true)) $groups[]=$g; } sort($groups);
  echo '<div class="vtp-card"><h2>Schichtübersicht</h2><p class="description">Hier verwaltest du den generierten Schichtplan. Weise Schichten einer Mannschaft/Gruppe zu. Die jeweilige Helfer-Anmeldung zeigt dann nur diese zugewiesenen Schichten.</p>';
  echo '<p><a class="button button-primary" target="_blank" href="'.esc_url(VTP_Public::helpers_url($ev)).'">Gesamte Helfer Anmeldung öffnen</a></p>';
  if($groups){
    echo '<div class="vtp-signup-cards"><h3>Öffentliche Anmeldeseiten</h3><p class="description">Pro Mannschaft/Gruppe wird genau eine gesammelte Anmeldeseite angezeigt. Dort erscheinen alle zugewiesenen Schichten aus allen Programmpunkten dieses Events.</p>';
    foreach($groups as $g){
      $needed=0; $filled=0; $open=0;
      foreach($shifts as $s){ if(trim((string)($s->assigned_group??''))===$g){ $needed += absint($s->slots_needed); $filled += min(absint($s->signups),absint($s->slots_needed)); if(absint($s->signups)<absint($s->slots_needed)) $open++; } }
      $class = ($needed>0 && $filled >= $needed) ? 'is-full' : (($needed>0 && $needed-$filled<=2) ? 'is-almost' : 'is-open');
      echo '<div class="vtp-signup-card '.esc_attr($class).'"><h4>'.esc_html($g).'</h4><p><strong>'.esc_html($filled).' / '.esc_html($needed).'</strong> besetzt</p><p>'.esc_html($open).' offene Schichten</p><p><a class="button" target="_blank" href="'.esc_url(add_query_arg('gruppe',rawurlencode($g),VTP_Public::helpers_url($ev))).'">Anmeldeliste öffnen</a></p></div>';
    }
    echo '</div>';
  }
  echo '<form method="post" action="'.esc_url(admin_url('admin-post.php')).'">'; wp_nonce_field('vtp_save_shift_assignments'); echo '<input type="hidden" name="action" value="vtp_save_shift_assignments"><input type="hidden" name="event_id" value="'.esc_attr($ev->id).'">';
  $blocks=[];
  foreach($shifts as $s){
    $area=trim((string)$s->area_name);
    if(strtolower($area)==='aufbau') $program='Aufbau';
    elseif(strtolower($area)==='abbau') $program='Abbau';
    elseif(stripos($area,'Mitbringen')===0) $program='Mitbringen';
    else $program=$this->helper_program_label($ev->id,$s->shift_date,$s->start_time,$s->end_time);
    $key=$s->shift_date.'|'.$program;
    if(!isset($blocks[$key])) $blocks[$key]=['date'=>$s->shift_date,'start'=>substr((string)$s->start_time,0,5),'title'=>$program,'rows'=>[]];
    if(strcmp(substr((string)$s->start_time,0,5),$blocks[$key]['start'])<0) $blocks[$key]['start']=substr((string)$s->start_time,0,5);
    $blocks[$key]['rows'][]=$s;
  }
  uasort($blocks,function($a,$b){ $c=strcmp($a['date'],$b['date']); if($c) return $c; $c=strcmp($a['start'],$b['start']); if($c) return $c; return strcmp($a['title'],$b['title']); });
  if(!$blocks){ echo '<p>Für dieses Event wurden noch keine Helferschichten generiert.</p>'; }
  $blockIdx=0;
  foreach($blocks as $block){
    $blockClass='vtp-helper-block';
    $title=$block['title'];
    $blockId='vtp-helper-block-'.(++$blockIdx);
    echo '<div class="'.esc_attr($blockClass).'" data-vtp-helper-block="'.esc_attr($blockId).'"><h3>'.esc_html($title).'</h3><p class="description">'.esc_html(date_i18n('l, d. F Y',strtotime($block['date']))).'</p>';
    echo '<div class="vtp-bulk-assign"><label><strong>Mannschaft/Gruppe für alle Schichten dieses Blocks</strong><br><input type="text" class="vtp-bulk-assign-input" placeholder="z. B. D-Junioren"></label> <button type="button" class="button vtp-bulk-assign-button">Auf alle Schichten anwenden</button><p class="description">Füllt alle Zuweisungen in diesem Block. Einzelne Schichten können danach weiterhin manuell angepasst werden.</p></div>';
    echo '<table class="widefat striped"><thead><tr><th>Zeit</th><th>Aufgabe</th><th>Bedarf</th><th>Belegt</th><th>Status</th><th>Zugewiesen an</th><th></th></tr></thead><tbody>';
    foreach($block['rows'] as $s){ $full=absint($s->signups)>=absint($s->slots_needed); $status=$full?'Voll':'Offen'; echo '<tr><td>'.esc_html(substr($s->start_time,0,5).' - '.substr($s->end_time,0,5)).'</td><td>'.esc_html($s->area_name).'</td><td>'.esc_html($s->slots_needed).'</td><td>'.esc_html($s->signups).'</td><td><strong>'.esc_html($status).'</strong></td><td><input type="text" class="vtp-assigned-input" name="assigned_group['.esc_attr($s->id).']" value="'.esc_attr($s->assigned_group??'').'" placeholder="z. B. B-Jugend"></td><td>—</td></tr>'; }
    echo '</tbody></table></div>';
  }
  echo '<script>(function(){document.querySelectorAll(".vtp-helper-block").forEach(function(block){var input=block.querySelector(".vtp-bulk-assign-input");var btn=block.querySelector(".vtp-bulk-assign-button");if(!input||!btn)return;btn.addEventListener("click",function(){var val=input.value.trim();if(!val){input.focus();return;}block.querySelectorAll(".vtp-assigned-input").forEach(function(target){target.value=val;});});});})();</script>';
  submit_button('Zuweisungen speichern'); echo '</form></div>';
  $signupGroups=[];
  foreach($signups as $g){
    $key=$g->shift_date.'|'.$g->start_time.'|'.$g->end_time.'|'.$g->program_label.'|'.$g->area_name.'|'.$g->assigned_group;
    if(!isset($signupGroups[$key])) $signupGroups[$key]=['meta'=>$g,'items'=>[]];
    $signupGroups[$key]['items'][]=$g;
  }
  echo '<div class="vtp-card"><h2>Helfer-Eintragungen</h2><p class="description">Die Eintragungen sind nach Schichten gruppiert, damit schnell sichtbar ist, wer wo eingetragen ist.</p>';
  if(!$signupGroups){ echo '<p>Noch keine Helfer eingetragen.</p>'; }
  foreach($signupGroups as $grp){ $m=$grp['meta'];
    echo '<div class="vtp-helper-signup-group"><div class="vtp-helper-signup-head"><div><strong>'.esc_html($m->program_label).'</strong><br><span>'.esc_html($m->area_name).' · '.esc_html(date_i18n('d.m.Y',strtotime($m->shift_date))).' · '.esc_html(substr($m->start_time,0,5).'-'.substr($m->end_time,0,5)).' Uhr</span></div><span class="vtp-pill">'.esc_html($m->assigned_group ?: 'ohne Zuweisung').'</span></div>';
    echo '<table class="widefat striped"><thead><tr><th>Name</th><th>Aktion</th></tr></thead><tbody>';
    foreach($grp['items'] as $g){ echo '<tr><td>'.esc_html($g->name).'</td><td><form method="post" action="'.esc_url(admin_url('admin-post.php')).'">'; wp_nonce_field('vtp_delete_signup'); echo '<input type="hidden" name="action" value="vtp_delete_signup"><input type="hidden" name="from_helpers" value="1"><input type="hidden" name="event_id" value="'.esc_attr($ev->id).'"><input type="hidden" name="signup_id" value="'.esc_attr($g->id).'">'; submit_button('Austragen','delete','submit',false); echo '</form></td></tr>'; }
    echo '</tbody></table></div>';
  }
  echo '</div>'; }

 private function helper_program_label($event_id,$date,$start,$end){ global $wpdb; $date=(string)$date; $start=substr((string)$start,0,5); $end=substr((string)$end,0,5); if(!$date) return 'Event'; $items=$wpdb->get_results($wpdb->prepare('SELECT item_type,title,start_time,end_time FROM '.VTP_DB::table('event_items').' WHERE event_id=%d AND item_date=%s ORDER BY start_time,sort_order',$event_id,$date)); $event=$wpdb->get_row($wpdb->prepare('SELECT name FROM '.VTP_DB::table('events').' WHERE id=%d',$event_id)); $ts=$wpdb->get_results($wpdb->prepare('SELECT name,start_time,event_type FROM '.VTP_DB::table('tournaments').' WHERE (event_id=%d OR parent_event=%s) AND start_date=%s ORDER BY start_time',$event_id,$event->name??'',$date)); $candidates=[]; foreach($items as $it){ if(in_array((string)$it->item_type,['Aufbau','Abbau'],true)) continue; $candidates[]=['from'=>substr((string)$it->start_time,0,5),'to'=>substr((string)$it->end_time,0,5),'label'=>$it->title?:$it->item_type]; } foreach($ts as $t){ $candidates[]=['from'=>substr((string)$t->start_time,0,5),'to'=>'23:59','label'=>$t->name]; } foreach($candidates as $c){ if(!$c['from']) continue; $to=$c['to']?:'23:59'; if($start>=$c['from'] && $start<$to) return $c['label']; } return 'Event allgemein'; }

 public function save_shift_assignments(){ $this->verify('vtp_save_shift_assignments'); global $wpdb; $eid=absint($_POST['event_id']??0); foreach((array)($_POST['assigned_group']??[]) as $sid=>$group){ $wpdb->update(VTP_DB::table('shifts'),['assigned_group'=>sanitize_text_field($group)],['id'=>absint($sid),'event_id'=>$eid]); } $this->go(['edit_event'=>$eid,'saved'=>1],'vtp-helpers'); }


 private function ensure_event_pages($id){ global $wpdb; $e=$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('events').' WHERE id=%d',$id)); if(!$e) return; foreach(['public_page_id'=>[$e->name,'[verein_event id="'.$id.'"]'],'helper_page_id'=>['Helfer Anmeldung: '.$e->name,'[verein_helferplan id="'.$id.'"]']] as $field=>$cfg){ $pid=absint($e->$field); $post=['post_title'=>$cfg[0],'post_name'=>sanitize_title($cfg[0]),'post_content'=>$cfg[1],'post_status'=>'publish','post_type'=>'page']; if($pid && get_post($pid)){ $post['ID']=$pid; wp_update_post($post); } else { $pid=wp_insert_post($post); if($pid && !is_wp_error($pid)) $wpdb->update(VTP_DB::table('events'),[$field=>$pid],['id'=>$id]); } } }
 public function save_event_items(){
  $this->verify('vtp_save_event_items'); global $wpdb; $eid=absint($_POST['event_id']);
  $wpdb->delete(VTP_DB::table('event_items'),['event_id'=>$eid]); $i=0;
  if(isset($_POST['title']) && is_array($_POST['title'])){
    $dates=(array)($_POST['item_date']??[]); $starts=(array)($_POST['start_time']??[]); $ends=(array)($_POST['end_time']??[]); $types=(array)($_POST['item_type']??[]); $titles=(array)($_POST['title']??[]); $visibilities=(array)($_POST['visibility']??[]);
    foreach($titles as $idx=>$title){ $title=sanitize_text_field($title); if($title==='') continue; $date=sanitize_text_field($dates[$idx]??''); if($date==='') continue;
      $visibility=sanitize_key($visibilities[$idx]??'public'); if(!in_array($visibility,['public','private','ticket','members'],true)) $visibility='public';
      $wpdb->insert(VTP_DB::table('event_items'),['event_id'=>$eid,'item_date'=>$date,'start_time'=>sanitize_text_field($starts[$idx]??''),'end_time'=>sanitize_text_field($ends[$idx]??''),'item_type'=>sanitize_text_field($types[$idx]??'Programmpunkt'),'title'=>$title,'visibility'=>$visibility,'sort_order'=>$i++]);
    }
  } else {
    foreach(preg_split('/\r\n|\r|\n/',sanitize_textarea_field($_POST['items']??'')) as $line){ $line=trim($line); if(!$line) continue; $p=array_map('trim',explode(';',$line)); if(count($p)<5) continue; $visibility=isset($p[5])?sanitize_key($p[5]):'public'; if(!in_array($visibility,['public','private','ticket','members'],true)) $visibility='public'; $wpdb->insert(VTP_DB::table('event_items'),['event_id'=>$eid,'item_date'=>$p[0],'start_time'=>$p[1],'end_time'=>$p[2],'item_type'=>$p[3],'title'=>$p[4],'visibility'=>$visibility,'sort_order'=>$i++]); }
  }
  $this->go(['edit_event'=>$eid,'saved'=>1],'vtp-events');
 }

 public function save_helper_needs(){
  $this->verify('vtp_save_helper_needs'); global $wpdb; $eid=absint($_POST['event_id']??0); if(!$eid) wp_die('Event nicht gefunden.');
  $wpdb->delete(VTP_DB::table('helper_needs'),['event_id'=>$eid]);
  $dates=(array)($_POST['need_date']??[]); $types=(array)($_POST['need_type']??[]); $descs=(array)($_POST['need_description']??[]); $amounts=(array)($_POST['need_amount']??[]); $units=(array)($_POST['need_unit']??[]);
  $i=0; foreach($descs as $idx=>$desc){ $desc=sanitize_text_field($desc); $date=sanitize_text_field($dates[$idx]??''); if($desc==='' || $date==='') continue; $type=sanitize_text_field($types[$idx]??'Helferschicht'); if(!in_array($type,['Mitbringen','Helferschicht'],true)) $type='Helferschicht'; $amount=max(1,absint($amounts[$idx]??1)); $unit=sanitize_text_field($units[$idx]??($type==='Mitbringen'?'Stück':'Personen')); if($unit==='') $unit=$type==='Mitbringen'?'Stück':'Personen';
    $wpdb->insert(VTP_DB::table('helper_needs'),['event_id'=>$eid,'need_date'=>$date,'need_type'=>$type,'description'=>$desc,'amount'=>$amount,'unit'=>$unit,'sort_order'=>$i++]);
  }
  $this->go(['edit_event'=>$eid,'saved'=>1],'vtp-events');
 }
 public function generate_shifts(){
  $this->verify('vtp_generate_shifts'); global $wpdb; $eid=absint($_POST['event_id']??0); if(!$eid) wp_die('Event nicht gefunden.');
  if(!empty($_POST['replace'])){
    $ids=$wpdb->get_col($wpdb->prepare('SELECT id FROM '.VTP_DB::table('shifts').' WHERE event_id=%d',$eid));
    if($ids){ $wpdb->query('DELETE FROM '.VTP_DB::table('shift_signups').' WHERE shift_id IN ('.implode(',',array_map('absint',$ids)).')'); }
    $wpdb->delete(VTP_DB::table('shifts'),['event_id'=>$eid]);
  }
  $blockRaw=sanitize_text_field($_POST['block_minutes']??'120');
  $blockMinutes=($blockRaw==='custom')?absint($_POST['custom_block_minutes']??120):absint($blockRaw);
  $block=max(15,$blockMinutes)*60;
  $ev=$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('events').' WHERE id=%d',$eid)); if(!$ev){ $this->go(['saved'=>1],'vtp-events'); }
  $needs=$wpdb->get_results($wpdb->prepare('SELECT * FROM '.VTP_DB::table('helper_needs').' WHERE event_id=%d ORDER BY need_date, sort_order, id',$eid));
  $needsByDate=[];
  foreach($needs as $n){ if($n->need_date) $needsByDate[$n->need_date][]=$n; }
  $program=[]; $internal=[];
  $items=$wpdb->get_results($wpdb->prepare('SELECT * FROM '.VTP_DB::table('event_items').' WHERE event_id=%d ORDER BY item_date,start_time,sort_order',$eid));
  foreach($items as $it){
    if(!$it->item_date || !$it->start_time) continue;
    $to=$it->end_time?:date('H:i',strtotime($it->item_date.' '.$it->start_time.' +2 hours'));
    $row=['from'=>$it->start_time,'to'=>$to,'title'=>$it->title?:$it->item_type,'type'=>$it->item_type];
    if(in_array($it->item_type,['Aufbau','Abbau'],true)) $internal[$it->item_date][]=$row; else $program[$it->item_date][]=$row;
  }
  $ts=$wpdb->get_results($wpdb->prepare('SELECT * FROM '.VTP_DB::table('tournaments').' WHERE event_id=%d OR parent_event=%s ORDER BY start_date,start_time',$eid,$ev->name));
  foreach($ts as $t){
    if(!$t->start_date || !$t->start_time) continue;
    $dur=max(60,((int)$t->match_duration+(int)$t->break_minutes)*max(4,(int)$t->fields*3));
    $program[$t->start_date][]=['from'=>$t->start_time,'to'=>date('H:i',strtotime($t->start_date.' '.$t->start_time.' +'.$dur.' minutes')),'title'=>$t->name,'type'=>'Turnier'];
  }
  $insert=function($area,$date,$from,$to,$slots=1) use ($wpdb,$eid){
    if(!$area||!$date||!$from||!$to) return;
    if(strtotime($date.' '.$to)<=strtotime($date.' '.$from)) return;
    $wpdb->insert(VTP_DB::table('shifts'),['event_id'=>$eid,'area_name'=>$area,'shift_date'=>$date,'start_time'=>$from,'end_time'=>$to,'slots_needed'=>max(1,absint($slots))]);
  };
  $allDates=array_unique(array_merge(array_keys($program),array_keys($internal),array_keys($needsByDate)));
  sort($allDates);
  foreach($allDates as $date){
    $public=$program[$date]??[];
    usort($public,function($a,$b){ $c=strcmp($a['from'],$b['from']); return $c?:strcmp($a['to'],$b['to']); });
    $inside=$internal[$date]??[];
    usort($inside,function($a,$b){ $c=strcmp($a['from'],$b['from']); return $c?:strcmp($a['to'],$b['to']); });
    $dayNeeds=$needsByDate[$date]??[];
    $shiftNeeds=[]; $bringNeeds=[]; $buildSlots=[];
    foreach($dayNeeds as $n){
      $type=trim((string)$n->need_type); $desc=trim((string)$n->description); if($desc==='') continue;
      if($type==='Mitbringen') $bringNeeds[]=$n;
      elseif(strtolower($desc)==='aufbau' || strtolower($desc)==='abbau') $buildSlots[strtolower($desc)]=max(1,absint($n->amount));
      else $shiftNeeds[]=$n;
    }
    foreach($inside as $it){
      $key=strtolower((string)$it['type']);
      if($key==='aufbau' || $key==='abbau') $insert(ucfirst($key),$date,substr($it['from'],0,5),substr($it['to'],0,5),$buildSlots[$key]??1);
    }
    if($public){
      $first=$public[0]['from']; $last=end($public)['to']; reset($public);
      foreach($public as $p){ if(strcmp($p['to'],$last)>0) $last=$p['to']; }
      $bringTime=date('H:i',strtotime($date.' '.$first.' -30 minutes'));
      foreach($bringNeeds as $n){ $insert('Mitbringen · '.$n->description,$date,$bringTime,date('H:i',strtotime($date.' '.$bringTime.' +30 minutes')),max(1,absint($n->amount))); }
      $fromTs=strtotime($date.' '.$first); $toTs=strtotime($date.' '.$last); if($toTs<=$fromTs) $toTs=$fromTs+2*3600;
      for($cur=$fromTs;$cur<$toTs;$cur+=$block){
        $end=min($cur+$block,$toTs);
        foreach($shiftNeeds as $n){ $insert($n->description,$date,date('H:i',$cur),date('H:i',$end),max(1,absint($n->amount))); }
      }
    } else {
      foreach($bringNeeds as $n){ $insert('Mitbringen · '.$n->description,$date,'10:00','10:30',max(1,absint($n->amount))); }
    }
  }
  $this->go(['edit_event'=>$eid,'saved'=>1],'vtp-events'); }
 public function delete_shift(){ $this->verify('vtp_delete_shift'); global $wpdb; $eid=absint($_POST['event_id']); $sid=absint($_POST['shift_id']); $wpdb->delete(VTP_DB::table('shift_signups'),['shift_id'=>$sid]); $wpdb->delete(VTP_DB::table('shifts'),['id'=>$sid,'event_id'=>$eid]); $this->go(['edit_event'=>$eid,'deleted'=>1],($_POST['from_helpers']??'')==='1'?'vtp-helpers':'vtp-events'); }
 public function delete_signup(){ $this->verify('vtp_delete_signup'); global $wpdb; $eid=absint($_POST['event_id']); $wpdb->delete(VTP_DB::table('shift_signups'),['id'=>absint($_POST['signup_id'])]); $this->go(['edit_event'=>$eid,'deleted'=>1],($_POST['from_helpers']??'')==='1'?'vtp-helpers':'vtp-events'); }
 public function archive_event(){ $this->verify('vtp_archive_event'); global $wpdb; $id=absint($_POST['event_id']??0); $wpdb->update(VTP_DB::table('events'),['status'=>'archiviert','updated_at'=>current_time('mysql')],['id'=>$id]); $this->go(['view'=>'archive','archived'=>1],'vtp-events'); }
 public function restore_event(){ $this->verify('vtp_restore_event'); global $wpdb; $id=absint($_POST['event_id']??0); $wpdb->update(VTP_DB::table('events'),['status'=>'aktiv','updated_at'=>current_time('mysql')],['id'=>$id]); $this->go(['edit_event'=>$id,'restored'=>1],'vtp-events'); }
 public function delete_event(){ $this->verify('vtp_delete_event'); global $wpdb; $id=absint($_POST['event_id']??0); $e=$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('events').' WHERE id=%d',$id)); if($e){ if($e->public_page_id) wp_delete_post(absint($e->public_page_id),true); if($e->helper_page_id) wp_delete_post(absint($e->helper_page_id),true); }
  $shift_ids=$wpdb->get_col($wpdb->prepare('SELECT id FROM '.VTP_DB::table('shifts').' WHERE event_id=%d',$id)); if($shift_ids){ foreach($shift_ids as $sid) $wpdb->delete(VTP_DB::table('shift_signups'),['shift_id'=>absint($sid)]); }
  foreach(['event_items','helper_needs','shifts'] as $tab) $wpdb->delete(VTP_DB::table($tab),['event_id'=>$id]);
  $wpdb->delete(VTP_DB::table('events'),['id'=>$id]); $this->go(['view'=>'archive','deleted'=>1],'vtp-events'); }
}
