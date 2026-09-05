<?php
if (!defined('ABSPATH')) exit;
class VTP_Public { private static $i=null; public static function instance(){ return self::$i ?: (self::$i=new self()); }
 private function __construct(){ add_shortcode('verein_turnier',[$this,'shortcode']); add_shortcode('verein_event',[$this,'event_shortcode']); add_shortcode('verein_helferplan',[$this,'helpers_shortcode']); add_shortcode('verein_veranstaltungskalender',[$this,'calendar_shortcode']); add_action('init',[$this,'rewrite']); add_filter('query_vars',function($v){ foreach(['vtp_tournament','vtp_lead','vtp_referee','vtp_event','vtp_helpers','vtp_calendar','token'] as $q) $v[]=$q; return $v;}); add_action('template_redirect',[$this,'template']); add_action('wp_enqueue_scripts',[$this,'assets']); add_action('admin_post_nopriv_vtp_leader_save_results',[$this,'leader_save']); add_action('admin_post_vtp_leader_save_results',[$this,'leader_save']); add_action('admin_post_nopriv_vtp_leader_save_groups',[$this,'leader_save_groups']); add_action('admin_post_vtp_leader_save_groups',[$this,'leader_save_groups']); add_action('admin_post_nopriv_vtp_helper_signup',[$this,'helper_signup']); add_action('admin_post_vtp_helper_signup',[$this,'helper_signup']); add_action('admin_post_nopriv_vtp_referee_save_result',[$this,'referee_save']); add_action('admin_post_vtp_referee_save_result',[$this,'referee_save']); add_action('admin_post_nopriv_vtp_register_team',[$this,'register_team']); add_action('admin_post_vtp_register_team',[$this,'register_team']); }
 public function assets(){ wp_register_style('vtp-public',VTP_URL.'assets/public.css',['dashicons'],VTP_VERSION); }
 public function rewrite(){ add_rewrite_rule('turnier/([^/]+)/?$','index.php?vtp_tournament=$matches[1]','top'); }
 public static function public_url($t){ $pid=absint($t->public_page_id??0); if($pid && get_post($pid)) return get_permalink($pid); return home_url('/?vtp_tournament='.rawurlencode($t->slug)); }
 public static function leader_url($t){ return home_url('/?vtp_lead='.absint($t->id).'&token='.rawurlencode($t->leader_token)); }
 public static function registration_url($t){ return add_query_arg('anmeldung','1', self::public_url($t)); }
 public static function referee_url($r){ return home_url('/?vtp_referee='.absint($r->id).'&token='.rawurlencode($r->token)); }
 public static function event_url($e){ $pid=absint($e->public_page_id??0); if($pid && get_post($pid)) return get_permalink($pid); return home_url('/?vtp_event='.absint($e->id)); }
 public static function helpers_url($e){ $pid=absint($e->helper_page_id??0); if($pid && get_post($pid)) return get_permalink($pid); return home_url('/?vtp_helpers='.absint($e->id)); }
 public static function calendar_url(){
  $pid=absint(get_option('vtp_calendar_page_id'));
  if($pid && get_post($pid)) return get_permalink($pid);
  $p=get_page_by_path('veranstaltungskalender');
  if($p && $p->post_type==='page') return get_permalink($p);
  return home_url('/?vtp_calendar=1');
 }
 public function template(){ $slug=get_query_var('vtp_tournament'); $lead=absint(get_query_var('vtp_lead')); $referee=absint(get_query_var('vtp_referee')); $event=absint(get_query_var('vtp_event')); $helpers=absint(get_query_var('vtp_helpers')); $calendar=get_query_var('vtp_calendar'); if(!$slug && !$lead && !$referee && !$event && !$helpers && !$calendar) return; if($lead){ status_header(200); nocache_headers(); header('Content-Type: text/html; charset='.get_option('blog_charset')); echo $this->leader($lead); exit; } if($referee){ status_header(200); nocache_headers(); header('Content-Type: text/html; charset='.get_option('blog_charset')); echo $this->referee($referee); exit; } wp_enqueue_style('vtp-public'); if($calendar){
   $url=self::calendar_url();
   if($url && strpos($url,'vtp_calendar=1')===false){ wp_safe_redirect($url); exit; }
   status_header(200); nocache_headers(); get_header(); echo $this->render_calendar(); get_footer(); exit;
  } get_header(); if($event) echo $this->render_event($event); elseif($helpers) echo $this->render_helpers($helpers); else { global $wpdb; $t=$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('tournaments').' WHERE slug=%s',sanitize_title($slug))); echo $t?$this->render($t->id):'<p>Turnier nicht gefunden.</p>'; } get_footer(); exit; }
 public function shortcode($a){ $a=shortcode_atts(['id'=>0],$a); wp_enqueue_style('vtp-public'); return $this->render(absint($a['id'])); }
 public function event_shortcode($a){ $a=shortcode_atts(['id'=>0],$a); wp_enqueue_style('vtp-public'); return $this->render_event(absint($a['id'])); }
 public function helpers_shortcode($a){ $a=shortcode_atts(['id'=>0],$a); wp_enqueue_style('vtp-public'); return $this->render_helpers(absint($a['id'])); }
 public function calendar_shortcode($a=[]){ wp_enqueue_style('vtp-public'); return $this->render_calendar(); }
 private function type_label($k){ $m=['jugendturnier'=>'Jugendturnier','einlagenspiel'=>'Einlagenspiel','elfmeterschiessen'=>'11m-Schießen','neunmeterschiessen'=>'9m-Schießen','hallenturnier'=>'Hallenturnier','einlagenspiel'=>'Einlagenspiel','turnier'=>'Turnier','programm'=>'Programmpunkt','Programmpunkt'=>'Programmpunkt','Musik'=>'Musik','Spiel'=>'Spiel']; return $m[$k]??($k?:'Programmpunkt'); }
 private function event_status_label($t){
  $status=strtolower((string)($t->status??''));
  if(in_array($status,['beendet','abgeschlossen'],true)) return 'Beendet';
  if(in_array($status,['läuft','laufend','aktiv'],true)) return 'Läuft';
  if(in_array($status,['abgesagt','archiviert'],true)) return ucfirst($status);
  $today=current_time('Y-m-d'); $start=(string)($t->start_date??''); $end=(string)($t->end_date??$start);
  if($start && $today < $start) return 'Geplant';
  if($start && $today >= $start && (!$end || $today <= $end)) return 'Läuft';
  if($end && $today > $end) return 'Beendet';
  return 'Geplant';
 }
 private function safe_date_label($date){
  $date=trim((string)$date);
  if($date==='') return 'Ohne Datum';
  $ts=strtotime($date);
  if(!$ts) return $date;
  return date_i18n('l, d. F Y',$ts);
 }
 private function safe_time_label($start,$end=''){
  $start=trim((string)$start); $end=trim((string)$end);
  $out=$start!=='' ? substr($start,0,5).' Uhr' : '';
  if($end!=='') $out .= ($out?' – ':'').substr($end,0,5).' Uhr';
  return $out;
 }
 private function standings($tid){ global $wpdb; $teams=$wpdb->get_results($wpdb->prepare('SELECT * FROM '.VTP_DB::table('teams').' WHERE tournament_id=%d ORDER BY group_name, sort_order',$tid)); $tab=[]; foreach($teams as $team) $tab[$team->group_name][$team->id]=['team'=>$team,'played'=>0,'won'=>0,'draw'=>0,'lost'=>0,'gf'=>0,'ga'=>0,'gd'=>0,'pts'=>0]; $matches=$wpdb->get_results($wpdb->prepare("SELECT * FROM ".VTP_DB::table('matches')." WHERE tournament_id=%d AND round_type='group' AND goals_home IS NOT NULL AND goals_away IS NOT NULL",$tid)); foreach($matches as $m){ if(!isset($tab[$m->group_name][$m->team_home],$tab[$m->group_name][$m->team_away])) continue; $h=&$tab[$m->group_name][$m->team_home]; $a=&$tab[$m->group_name][$m->team_away]; $h['played']++;$a['played']++;$h['gf']+=$m->goals_home;$h['ga']+=$m->goals_away;$a['gf']+=$m->goals_away;$a['ga']+=$m->goals_home; if($m->goals_home>$m->goals_away){$h['won']++;$a['lost']++;$h['pts']+=3;} elseif($m->goals_home<$m->goals_away){$a['won']++;$h['lost']++;$a['pts']+=3;} else {$h['draw']++;$a['draw']++;$h['pts']++;$a['pts']++;} unset($h,$a); } foreach($tab as $g=>$rows){ $groupMatches=array_filter($matches,function($m) use ($g){ return (string)$m->group_name===(string)$g; }); $tab[$g]=VTP_Plugin::sort_standing_rows($rows,$groupMatches); } return $tab; }

 private function all_matches_finished($tid){
  global $wpdb;
  $open=$wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM ".VTP_DB::table('matches')." WHERE tournament_id=%d AND (goals_home IS NULL OR goals_away IS NULL)",$tid));
  $total=$wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM ".VTP_DB::table('matches')." WHERE tournament_id=%d",$tid));
  return intval($total)>0 && intval($open)===0;
 }
 private function match_winner_loser($m){
  if($m->goals_home===null || $m->goals_away===null || !$m->team_home || !$m->team_away) return [0,0];
  if(intval($m->goals_home)===intval($m->goals_away)) return [0,0];
  return intval($m->goals_home)>intval($m->goals_away) ? [intval($m->team_home),intval($m->team_away)] : [intval($m->team_away),intval($m->team_home)];
 }
 private function final_placements($tid,$stand){
  global $wpdb;
  $t=$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('tournaments').' WHERE id=%d',$tid));
  if(!$t) return [];
  $mode=(string)($t->tournament_mode ?? '');

  // Bambini-Spieltage haben bewusst keine Tabelle und keine Endplatzierung.
  if($mode==='bambini') return [];

  $teams=$wpdb->get_results($wpdb->prepare('SELECT id,name FROM '.VTP_DB::table('teams').' WHERE tournament_id=%d',$tid),OBJECT_K);
  $name=function($id) use ($teams){ return isset($teams[$id]) ? $teams[$id]->name : ''; };
  $placements=[];
  $set=function($place,$team_id,$note='') use (&$placements,$name){
   if($team_id && empty($placements[$place])) $placements[$place]=['place'=>$place,'name'=>$name($team_id),'note'=>$note];
  };
  $is_finished=function($m){
   return $m && !empty($m->team_home) && !empty($m->team_away) && $m->goals_home!==null && $m->goals_away!==null && intval($m->goals_home)!==intval($m->goals_away);
  };
  $label_has=function($m,$needle){ return stripos((string)($m->round_label??''),$needle)!==false; };

  $matches=$wpdb->get_results($wpdb->prepare('SELECT * FROM '.VTP_DB::table('matches').' WHERE tournament_id=%d AND round_type<>\'group\' ORDER BY starts_at, match_no',$tid));

  // Alle Plätze ausspielen: vollständige Endplatzierung aus den ausgespielten Platzierungsspielen.
  // Wichtig: Diese Logik vor der Final-Logik prüfen, weil das Spiel um Platz 1/2 kein klassisches Finale ist.
  if($mode==='groups_placement'){
   $placementMatches=[];
   foreach($matches as $m){
    $label=(string)$m->round_label;
    if($m->round_type==='placement' && preg_match('/Platz\s+(\d+)\s*\/\s*(\d+)/u',$label,$mm)){
     $placementMatches[]=[intval($mm[1]),intval($mm[2]),$m];
    }
   }
   if(empty($placementMatches)) return [];
   foreach($placementMatches as [$p1,$p2,$m]){
    if(!$is_finished($m)) return [];
    [$w,$l]=$this->match_winner_loser($m);
    if($w){ $set($p1,$w,'Platzierungsspiel'); $set($p2,$l,'Platzierungsspiel'); }
   }
   ksort($placements);
   return $placements;
  }

  // Gruppenphase + K.O.: Endplatzierung kommt ausschließlich aus den tatsächlichen Finalspielen.
  // Robust gegen unterschiedliche Labels wie "Finale", "Großes Finale", "Spiel um Platz 1/2"
  // und Platzhalter wie "Sieger Halbfinale 1 gegen Sieger Halbfinale 2".
  $finalMatch=null;
  foreach($matches as $m){
   $label=(string)$m->round_label;
   $isThirdLabel=(stripos($label,'Spiel um Platz 3')!==false) || preg_match('/Platz\s+3\s*\/\s*4/u',$label);
   $isSemiLabel=(stripos($label,'Halbfinale')!==false && stripos($label,'Sieger Halbfinale')===false);
   $isFinalLabel=(stripos($label,'Finale')!==false && !$isSemiLabel)
    || (stripos($label,'Sieger Halbfinale')!==false)
    || preg_match('/Platz\s+1\s*\/\s*2/u',$label);
   if($isFinalLabel && !$isThirdLabel){ $finalMatch=$m; }
  }
  // Fallback: Bei K.O.-Turnieren ist das Finale oft das letzte K.O.-Spiel, sofern es nicht das kleine Finale ist.
  if(!$finalMatch && in_array($mode,['groups_ko','ko'],true)){
   foreach($matches as $m){
    $label=(string)$m->round_label;
    $isThirdLabel=(stripos($label,'Spiel um Platz 3')!==false) || preg_match('/Platz\s+3\s*\/\s*4/u',$label);
    $isSemiLabel=(stripos($label,'Halbfinale')!==false && stripos($label,'Sieger Halbfinale')===false);
    if($m->round_type==='ko' && !$isSemiLabel && !$isThirdLabel){ $finalMatch=$m; }
   }
  }
  if($finalMatch){
   if(!$is_finished($finalMatch)) return [];
   [$w,$l]=$this->match_winner_loser($finalMatch);
   if(!$w || !$l) return [];
   $set(1,$w,'Finale');
   $set(2,$l,'Finale');

   $thirdMatch=null;
   foreach($matches as $m){
    $label=(string)$m->round_label;
    if((stripos($label,'Spiel um Platz 3')!==false) || preg_match('/Platz\s+3\s*\/\s*4/u',$label)){
     $thirdMatch=$m;
    }
   }
   // Gibt es ein kleines Finale, wird Platz 3 erst angezeigt, wenn dieses Spiel entschieden ist.
   // Gibt es kein kleines Finale, bleibt es bewusst bei Platz 1 und 2.
   if($thirdMatch){
    if(!$is_finished($thirdMatch)) return [];
    [$tw,$tl]=$this->match_winner_loser($thirdMatch);
    if($tw) $set(3,$tw,'Spiel um Platz 3');
   }
   ksort($placements);
   return $placements;
  }

  // Liga-Modus: Endplatzierung aus der finalen Tabelle. Nur hier wird eine Abschlusstabelle ausgegeben.
  if($mode==='league'){
   if(!$this->all_matches_finished($tid)) return [];
   $flat=[];
   if(count($stand)===1){ foreach(reset($stand) as $r) $flat[]=$r; }
   elseif(count($stand)>1){
    foreach($stand as $g=>$rows){ foreach($rows as $i=>$r){ $r['group_rank']=$i+1; $flat[]=$r; } }
    usort($flat,function($a,$b){ return [$a['group_rank'],$b['pts'],$b['gd'],$b['gf']] <=> [$b['group_rank'],$a['pts'],$a['gd'],$a['gf']]; });
   }
   $p=1; foreach($flat as $r){ $placements[$p]=['place'=>$p,'name'=>$r['team']->name,'note'=>'Abschlusstabelle']; $p++; }
   ksort($placements);
   return $placements;
  }

  return [];
 }
 private function placement_icon($place){
  if($place==1) return '🏆';
  if($place==2) return '🥈';
  if($place==3) return '🥉';
  return '⚽';
 }

 public function render($tid){ global $wpdb; $t=$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('tournaments').' WHERE id=%d',$tid)); if(!$t) return '<p>Turnier nicht gefunden.</p>'; if(isset($_GET['anmeldung']) && get_post_meta(absint($t->id),'_vtp_public_registration',true)==='1') return $this->render_registration($t); $matches=$wpdb->get_results($wpdb->prepare('SELECT m.*, h.name home_name, a.name away_name FROM '.VTP_DB::table('matches').' m LEFT JOIN '.VTP_DB::table('teams').' h ON h.id=m.team_home LEFT JOIN '.VTP_DB::table('teams').' a ON a.id=m.team_away WHERE m.tournament_id=%d ORDER BY m.starts_at,m.match_no',$tid)); $stand=$this->standings($tid); $placements=$this->final_placements($tid,$stand); $is_bambini=(($t->tournament_mode??'')==='bambini'); $sponsors=$this->parse_sponsors($t->sponsors); ob_start(); ?>
 <main class="vtp-public"><section class="vtp-hero"><div class="vtp-hero-inner"><img class="vtp-logo" src="<?php echo esc_url(VTP_URL.'assets/tus-mingolsheim-logo.png'); ?>" alt="TuS Mingolsheim"><div><div class="vtp-kicker">TuS Mingolsheim 1901 e.V.</div><h1><?php echo esc_html($t->name); ?></h1><p><?php echo esc_html($this->type_label($t->event_type)); ?><?php if($t->start_date) echo ' · '.esc_html(date_i18n(get_option('date_format'),strtotime($t->start_date))); ?></p><?php if($t->description) echo '<p>'.esc_html($t->description).'</p>'; ?></div></div></section>
 <nav class="vtp-tabs"><?php if(!empty($placements)): ?><a href="#endplatzierung">Endplatzierung</a><?php endif; ?><a href="#spielplan">Spielplan</a><?php if(!$is_bambini): ?><a href="#tabellen">Tabellen</a><?php endif; ?><?php if($sponsors): ?><a href="#sponsoren">Sponsoren</a><?php endif; ?></nav>

 <?php if(!empty($placements)): ?><section id="endplatzierung" class="vtp-section vtp-final-placements"><h2>Endplatzierung</h2><div class="vtp-podium"><?php foreach(array_slice($placements,0,3,true) as $pl): ?><article class="vtp-place vtp-place-<?php echo esc_attr($pl['place']); ?>"><div class="vtp-place-icon"><?php echo esc_html($this->placement_icon($pl['place'])); ?></div><div><strong>Platz <?php echo esc_html($pl['place']); ?></strong><span><?php echo esc_html($pl['name']); ?></span></div></article><?php endforeach; ?></div><?php if(count($placements)>3): ?><div class="vtp-table-wrap vtp-final-table"><table><thead><tr><th>Platz</th><th>Mannschaft</th></tr></thead><tbody><?php foreach($placements as $pl): ?><tr><td><?php echo esc_html($pl['place']); ?></td><td><?php echo esc_html($pl['name']); ?></td></tr><?php endforeach; ?></tbody></table></div><?php endif; ?></section><?php endif; ?>
 <?php if(!$is_bambini): ?> <section id="tabellen" class="vtp-section"><h2>Tabellen</h2><?php if(empty($stand)): ?><p>Noch keine Teams vorhanden.</p><?php endif; foreach($stand as $g=>$rows): ?><h3>Gruppe <?php echo esc_html($g); ?></h3><div class="vtp-table-wrap"><table><thead><tr><th>Pl.</th><th>Team</th><th>Sp</th><th>S</th><th>U</th><th>N</th><th>Tore</th><th>Diff</th><th>Pkt</th></tr></thead><tbody><?php $p=1; foreach($rows as $r): ?><tr class="<?php echo $r['team']->status==='noshow'?'vtp-noshow':''; ?>"><td><?php echo $p++; ?></td><td><?php echo esc_html($r['team']->name); ?><?php if($r['team']->status==='noshow') echo ' <small>(nicht angetreten)</small>'; ?></td><td><?php echo $r['played']; ?></td><td><?php echo $r['won']; ?></td><td><?php echo $r['draw']; ?></td><td><?php echo $r['lost']; ?></td><td><?php echo esc_html($r['gf'].' : '.$r['ga']); ?></td><td><?php echo esc_html($r['gd']); ?></td><td><strong><?php echo $r['pts']; ?></strong></td></tr><?php endforeach; ?></tbody></table></div><?php endforeach; ?></section>
 <?php endif; ?>
 <section id="spielplan" class="vtp-section"><h2>Spielplan & Ergebnisse</h2><?php if(empty($matches)): ?><p>Noch kein Spielplan vorhanden.</p><?php endif; foreach($matches as $m): ?><article class="vtp-match"><div class="vtp-meta"><span class="vtp-badge">#<?php echo esc_html($m->match_no); ?></span> <?php echo esc_html($m->starts_at?date_i18n('H:i',strtotime($m->starts_at)):'ohne Spielzeit'); ?> · <?php echo $m->field_no ? 'Feld '.esc_html($m->field_no).' · ' : ''; ?><?php echo esc_html($m->round_label ?: ('Gruppe '.$m->group_name)); ?> · <?php echo esc_html(class_exists('VTP_Plugin') ? VTP_Plugin::status_label($m->status) : $m->status); ?></div><div class="vtp-teams"><span><?php echo esc_html($m->home_name ?: (class_exists('VTP_Plugin') ? VTP_Plugin::placeholder_side($m->round_label,'home') : 'offen')); ?></span><strong><?php echo ($m->goals_home===null||$m->goals_away===null)?'- : -':esc_html($m->goals_home.' : '.$m->goals_away); ?></strong><span><?php echo esc_html($m->away_name ?: (class_exists('VTP_Plugin') ? VTP_Plugin::placeholder_side($m->round_label,'away') : 'offen')); ?></span></div></article><?php endforeach; ?></section>
 <?php if($sponsors): ?><section id="sponsoren" class="vtp-section"><h2>Sponsoren</h2><div class="vtp-sponsors"><?php foreach($sponsors as $sp): ?><a href="<?php echo esc_url($sp['url']?:'#'); ?>" target="_blank"><img src="<?php echo esc_url($sp['logo']); ?>" alt="<?php echo esc_attr($sp['name']); ?>"><span><?php echo esc_html($sp['name']); ?></span></a><?php endforeach; ?></div></section><?php endif; ?></main><?php return ob_get_clean(); }
 private function parse_sponsors($txt){ $out=[]; foreach(preg_split('/\r\n|\r|\n/',(string)$txt) as $l){ $p=array_map('trim',explode('|',$l)); if(!empty($p[0])) $out[]=['name'=>$p[0],'logo'=>$p[1]??'','url'=>$p[2]??'']; } return $out; }
 public function leader($id){
 global $wpdb;
 $t=$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('tournaments').' WHERE id=%d',$id));
 $token=sanitize_text_field($_GET['token']??'');
 $charset=esc_attr(get_option('blog_charset')?:'UTF-8');
 $css='<style>html,body{margin:0;padding:0;background:#f5f5f5;color:#222;font-family:Arial,Helvetica,sans-serif}*{box-sizing:border-box}.vtp-login-wrap{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px}.vtp-login-card{width:100%;max-width:420px;background:#fff;border:1px solid #e4e4e4;border-radius:18px;padding:28px;box-shadow:0 12px 32px rgba(0,0,0,.10);text-align:center}.vtp-login-logo{width:82px;height:auto;margin:0 auto 14px;display:block}.vtp-login-card h1{font-size:28px;line-height:1.2;margin:0 0 8px;color:#b4001c}.vtp-login-card p{margin:0 0 22px;color:#555}.vtp-login-card label{display:block;text-align:left;font-weight:700;margin-bottom:8px}.vtp-login-card input{width:100%;height:56px;border:1px solid #cfcfcf;border-radius:12px;font-size:30px;text-align:center;letter-spacing:.35em;padding-left:.35em}.vtp-login-card button{width:100%;height:52px;margin-top:18px;border:0;border-radius:12px;background:#b4001c;color:#fff;font-size:17px;font-weight:800;cursor:pointer}.vtp-leader-page{max-width:1120px;margin:0 auto;padding:24px}.vtp-leader-head{background:linear-gradient(135deg,#b4001c,#7d0015);color:#fff;border-radius:18px;padding:20px 22px;margin-bottom:18px;display:flex;gap:18px;align-items:center;box-shadow:0 12px 28px rgba(180,0,28,.18)}.vtp-leader-logo{width:78px;height:78px;object-fit:contain;background:#fff;border-radius:16px;padding:7px;flex:0 0 auto}.vtp-leader-head h1{margin:0;font-size:28px;color:#fff}.vtp-leader-head .vtp-sub{opacity:.92;margin-top:4px}.vtp-leader-card{background:#fff;border:1px solid #e4e4e4;border-radius:16px;padding:18px;margin-bottom:18px}.vtp-standings-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(430px,1fr));gap:14px}.vtp-standings-table-wrap{overflow-x:auto}.vtp-standings-table{width:100%;border-collapse:collapse;font-size:13px}.vtp-standings-table th,.vtp-standings-table td{padding:7px 8px;border-bottom:1px solid #eee;text-align:left;white-space:nowrap}.vtp-standings-table th{background:#fff5f6;color:#5b0010;font-weight:800}.vtp-standings-table td.num,.vtp-standings-table th.num{text-align:center}.vtp-rank-qual{background:#f0fff4}.vtp-rank-qual td:first-child{font-weight:800;color:#08722b}.vtp-match{border-bottom:1px solid #eee;padding:14px 0}.vtp-match:last-child{border-bottom:0}.vtp-score{display:flex;align-items:center;gap:10px;margin-top:8px}.vtp-score input{width:84px;height:44px;font-size:22px;text-align:center}.vtp-save{position:sticky;bottom:12px;width:100%;height:52px;margin-top:18px;border:0;border-radius:12px;background:#b4001c;color:#fff;font-size:17px;font-weight:800}.vtp-groups{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:12px}.vtp-group{border:1px solid #eee;border-radius:14px;padding:12px;background:#fafafa}.vtp-team-row{display:grid;grid-template-columns:1fr 70px 90px 55px;gap:6px;align-items:center;margin:6px 0}.vtp-team-row input[type=text]{height:36px;border:1px solid #ccc;border-radius:8px;padding:0 8px}.vtp-team-row select{height:36px;border:1px solid #ccc;border-radius:8px}.vtp-team-row label{font-size:12px}.vtp-next-list{margin-top:18px;text-align:left}.vtp-next-item{padding:10px 0;border-top:1px solid #eee}.vtp-ok{padding:10px 12px;border-radius:12px;background:#f0fff4;color:#08722b;font-weight:800;margin-bottom:12px}@media(max-width:650px){.vtp-groups{grid-template-columns:1fr}.vtp-leader-page{padding:14px}.vtp-leader-head{align-items:flex-start}.vtp-leader-logo{width:60px;height:60px}.vtp-standings-grid{grid-template-columns:1fr}}</style>';
 $logo=esc_url(VTP_URL.'assets/tus-mingolsheim-logo.png');
 if(!$t || $token!==$t->leader_token){
  return '<!doctype html><html><head><meta charset="'.$charset.'"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Turnierleitung</title>'.$css.'</head><body><main class="vtp-login-wrap"><section class="vtp-login-card"><img class="vtp-login-logo" src="'.$logo.'" alt="TuS Mingolsheim"><h1>Zugriff nicht erlaubt</h1><p>Der Link ist ungültig oder wurde deaktiviert.</p></section></main></body></html>';
 }
 if(strlen((string)$t->leader_pin)!==4){ $t->leader_pin=(string)wp_rand(1000,9999); $wpdb->update(VTP_DB::table('tournaments'),['leader_pin'=>$t->leader_pin],['id'=>$id]); }
 $pin=sanitize_text_field($_POST['pin']??'');
 $cookieName='vtp_leader_'.$id;
 $cookieOk=!empty($_COOKIE[$cookieName]) && hash_equals(wp_hash($t->leader_token.'|'.$t->leader_pin), sanitize_text_field(wp_unslash($_COOKIE[$cookieName])));
 if($pin===$t->leader_pin && !$cookieOk){ setcookie($cookieName, wp_hash($t->leader_token.'|'.$t->leader_pin), time()+12*HOUR_IN_SECONDS, COOKIEPATH ?: '/', COOKIE_DOMAIN, is_ssl(), true); $_COOKIE[$cookieName]=wp_hash($t->leader_token.'|'.$t->leader_pin); $cookieOk=true; }
 if(!$cookieOk){
  $error=$pin!==''?'<p style="color:#b4001c;font-weight:700">PIN ist nicht korrekt.</p>':'';
  return '<!doctype html><html><head><meta charset="'.$charset.'"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Turnierleitung</title>'.$css.'</head><body><main class="vtp-login-wrap"><section class="vtp-login-card"><img class="vtp-login-logo" src="'.$logo.'" alt="TuS Mingolsheim"><h1>Turnierleitung</h1><p>'.esc_html($t->name).'</p>'.$error.'<form method="post"><label for="vtp-pin">PIN eingeben</label><input id="vtp-pin" name="pin" type="password" maxlength="4" pattern="[0-9]{4}" inputmode="numeric" autocomplete="one-time-code" autofocus><button>Anmelden</button></form></section></main></body></html>';
 }
 $teams=$wpdb->get_results($wpdb->prepare('SELECT * FROM '.VTP_DB::table('teams').' WHERE tournament_id=%d ORDER BY group_name, sort_order, name',$id));
 $groups=[]; foreach($teams as $tm) $groups[$tm->group_name][]=$tm;
 $standings=$this->standings($id);
 $hasResult=(int)$wpdb->get_var($wpdb->prepare('SELECT COUNT(*) FROM '.VTP_DB::table('matches').' WHERE tournament_id=%d AND goals_home IS NOT NULL AND goals_away IS NOT NULL AND is_forfeit=0',$id));
 $matches=$wpdb->get_results($wpdb->prepare('SELECT m.*, h.name home_name, a.name away_name FROM '.VTP_DB::table('matches').' m LEFT JOIN '.VTP_DB::table('teams').' h ON h.id=m.team_home LEFT JOIN '.VTP_DB::table('teams').' a ON a.id=m.team_away WHERE m.tournament_id=%d ORDER BY m.starts_at,m.match_no',$id));
 ob_start(); ?><!doctype html><html><head><meta charset="<?php echo $charset; ?>"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Ergebnismeldung</title><?php echo $css; ?></head><body><main class="vtp-leader-page"><header class="vtp-leader-head"><img class="vtp-leader-logo" src="<?php echo $logo; ?>" alt="TuS Mingolsheim"><div><h1>Ergebnismeldung</h1><div class="vtp-sub"><?php echo esc_html($t->name); ?><?php if($t->start_date) echo ' · '.esc_html(date_i18n(get_option('date_format'),strtotime($t->start_date))); ?><?php if(!empty($t->location)) echo ' · '.esc_html($t->location); ?></div></div></header><?php if(!empty($_GET['saved'])) echo '<section class="vtp-leader-card" style="border-color:#0a7f2e;background:#f0fff4;margin-bottom:12px"><strong>Ergebnis gespeichert.</strong> Du kannst Ergebnisse unten weiterhin ändern und erneut speichern.</section>'; if(!empty($_GET['groups_saved'])) echo '<section class="vtp-leader-card" style="border-color:#0a7f2e;background:#f0fff4;margin-bottom:12px"><strong>Gruppen gespeichert.</strong></section>'; if(!empty($_GET['locked'])) echo '<section class="vtp-leader-card" style="border-color:#b4001c;background:#fff2f4;margin-bottom:12px"><strong>Gruppenänderungen sind gesperrt.</strong> Nach dem ersten eingetragenen Spiel können Gruppen und Teams nicht mehr geändert werden.</section>'; ?>
<section class="vtp-leader-card"><h2>Aktuelle Tabellenstände</h2><div class="vtp-standings-grid"><?php foreach($standings as $g=>$rows): ?><div><h3>Gruppe <?php echo esc_html($g); ?></h3><div class="vtp-standings-table-wrap"><table class="vtp-standings-table"><thead><tr><th>Pl.</th><th>Mannschaft</th><th class="num">Sp</th><th class="num">S</th><th class="num">U</th><th class="num">N</th><th class="num">Tore</th><th class="num">GT</th><th class="num">Diff</th><th class="num">Pkt</th></tr></thead><tbody><?php $p=1; foreach($rows as $r): ?><tr class="<?php echo $p<=2?'vtp-rank-qual':''; ?>"><td><?php echo esc_html($p++); ?></td><td><?php echo esc_html($r['team']->name); ?><?php if($r['team']->status==='noshow') echo ' <small>(nicht angetreten)</small>'; ?></td><td class="num"><?php echo esc_html($r['played']); ?></td><td class="num"><?php echo esc_html($r['won']); ?></td><td class="num"><?php echo esc_html($r['draw']); ?></td><td class="num"><?php echo esc_html($r['lost']); ?></td><td class="num"><?php echo esc_html($r['gf']); ?></td><td class="num"><?php echo esc_html($r['ga']); ?></td><td class="num"><?php echo esc_html($r['gd']); ?></td><td class="num"><strong><?php echo esc_html($r['pts']); ?></strong></td></tr><?php endforeach; ?></tbody></table></div></div><?php endforeach; ?></div></section>
<section class="vtp-leader-card" style="margin-bottom:18px"><h2>Teams & Gruppen</h2><?php if($hasResult): ?><p>Gruppenänderungen sind gesperrt, weil bereits ein Ergebnis eingetragen wurde. Ergebnisse können weiterhin bearbeitet werden.</p><div class="vtp-groups"><?php foreach($groups as $gn=>$rows): ?><div class="vtp-group"><h3>Gruppe <?php echo esc_html($gn); ?></h3><?php foreach($rows as $tm): ?><div><?php echo esc_html($tm->name); ?><?php if($tm->status==='noshow') echo ' <strong>(nicht angetreten)</strong>'; ?></div><?php endforeach; ?></div><?php endforeach; ?></div><?php else: ?><form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>"><input type="hidden" name="action" value="vtp_leader_save_groups"><input type="hidden" name="tournament_id" value="<?php echo esc_attr($id); ?>"><input type="hidden" name="token" value="<?php echo esc_attr($t->leader_token); ?>"><input type="hidden" name="pin" value="<?php echo esc_attr($t->leader_pin); ?>"><div class="vtp-groups"><?php foreach($groups as $gn=>$rows): ?><div class="vtp-group"><h3>Gruppe <?php echo esc_html($gn); ?></h3><?php foreach($rows as $tm): ?><div class="vtp-team-row"><input type="hidden" name="team_id[]" value="<?php echo esc_attr($tm->id); ?>"><input type="text" name="team_name[]" value="<?php echo esc_attr($tm->name); ?>"><input type="text" name="team_group[]" value="<?php echo esc_attr($tm->group_name); ?>"><label><input type="checkbox" name="team_noshow[<?php echo esc_attr($tm->id); ?>]" value="1" <?php checked($tm->status,'noshow'); ?>> Nichtantritt</label><label><input type="checkbox" name="team_delete[<?php echo esc_attr($tm->id); ?>]" value="1"> löschen</label></div><?php endforeach; ?></div><?php endforeach; ?></div><p><strong>Neue Mannschaften hinzufügen</strong><br><textarea name="new_teams" rows="3" style="width:100%" placeholder="Mannschaft;Gruppe"></textarea></p><button class="vtp-save" style="position:static">Gruppenänderungen speichern</button></form><?php endif; ?></section>
<section class="vtp-leader-card"><form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>"><input type="hidden" name="action" value="vtp_leader_save_results"><input type="hidden" name="tournament_id" value="<?php echo esc_attr($id); ?>"><input type="hidden" name="token" value="<?php echo esc_attr($t->leader_token); ?>"><input type="hidden" name="pin" value="<?php echo esc_attr($t->leader_pin); ?>"><?php foreach($matches as $m): ?><div class="vtp-match"><strong>#<?php echo esc_html($m->match_no); ?></strong> · <?php echo esc_html($m->starts_at?date_i18n('H:i',strtotime($m->starts_at)).' Uhr · ':''); ?><?php echo esc_html($m->home_name ?: (class_exists('VTP_Plugin') ? VTP_Plugin::placeholder_side($m->round_label,'home') : 'offen')); ?> - <?php echo esc_html($m->away_name ?: (class_exists('VTP_Plugin') ? VTP_Plugin::placeholder_side($m->round_label,'away') : 'offen')); ?><?php if(!empty($m->is_forfeit)): ?><div style="margin-top:8px;padding:8px 10px;border-radius:10px;background:#fff4d6;color:#7a4b00;font-weight:700">Wertung wegen Nichtantritt</div><?php endif; ?><div class="vtp-score"><input type="number" name="goals_home[<?php echo esc_attr($m->id); ?>]" value="<?php echo esc_attr($m->goals_home); ?>" <?php echo !empty($m->is_forfeit)?'readonly':''; ?>> : <input type="number" name="goals_away[<?php echo esc_attr($m->id); ?>]" value="<?php echo esc_attr($m->goals_away); ?>" <?php echo !empty($m->is_forfeit)?'readonly':''; ?>></div></div><?php endforeach; ?><button class="vtp-save">Ergebnisse speichern</button></form></section></main></body></html><?php return ob_get_clean();
}

public function referee($rid){
 global $wpdb;
 $r=$wpdb->get_row($wpdb->prepare('SELECT r.*, t.name tournament_name FROM '.VTP_DB::table('referees').' r JOIN '.VTP_DB::table('tournaments').' t ON t.id=r.tournament_id WHERE r.id=%d',$rid));
 $charset=esc_attr(get_option('blog_charset')); $logo=esc_url(VTP_URL.'assets/tus-mingolsheim-logo.png');
 $css='<style>body{margin:0;background:#f6f6f6;font-family:system-ui,-apple-system,Segoe UI,sans-serif;color:#151515}.vtp-login-wrap,.vtp-ref-wrap{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:18px}.vtp-login-card,.vtp-ref-card{width:min(520px,100%);background:#fff;border-radius:22px;box-shadow:0 20px 60px rgba(0,0,0,.14);padding:26px;text-align:center;border-top:8px solid #b4001c}.vtp-login-logo{width:92px;height:92px;object-fit:contain}.vtp-login-card input{font-size:28px;text-align:center;letter-spacing:.3em;width:180px;max-width:100%;padding:10px;border:1px solid #ccc;border-radius:12px}.vtp-login-card button,.vtp-ref-card button{background:#b4001c;color:white;border:0;border-radius:14px;padding:14px 20px;font-weight:800;font-size:17px;margin-top:14px}.vtp-scoreline{display:flex;align-items:center;justify-content:center;gap:10px;margin:18px 0}.vtp-scoreline input{width:72px;font-size:32px;text-align:center;border:1px solid #ccc;border-radius:12px;padding:8px}.vtp-scoreline button{width:42px;height:42px;border-radius:12px;margin:0;padding:0}.vtp-team{font-size:20px;font-weight:800}.vtp-meta{color:#555;margin:8px 0 18px}.vtp-ok{background:#f0fff4;border:1px solid #77c991;color:#075d23;border-radius:12px;padding:10px;margin:0 0 12px}</style>';
 if(!$r || ($_GET['token']??'')!==$r->token) return '<!doctype html><html><head><meta charset="'.$charset.'"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Schiedsrichter</title>'.$css.'</head><body><main class="vtp-login-wrap"><section class="vtp-login-card"><img class="vtp-login-logo" src="'.$logo.'" alt="TuS Mingolsheim"><h1>Zugriff nicht erlaubt</h1></section></main></body></html>';
 $pin=sanitize_text_field($_POST['pin']??''); $cookieName='vtp_ref_'.$rid; $hash=wp_hash($r->token.'|'.$r->pin);
 $cookieOk=!empty($_COOKIE[$cookieName]) && hash_equals($hash, sanitize_text_field(wp_unslash($_COOKIE[$cookieName])));
 if($pin===$r->pin && !$cookieOk){ setcookie($cookieName,$hash,time()+12*HOUR_IN_SECONDS,COOKIEPATH ?: '/',COOKIE_DOMAIN,is_ssl(),true); $_COOKIE[$cookieName]=$hash; $cookieOk=true; }
 if(!$cookieOk){ $error=$pin!==''?'<p style="color:#b4001c;font-weight:700">PIN ist nicht korrekt.</p>':''; return '<!doctype html><html><head><meta charset="'.$charset.'"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Schiedsrichter</title>'.$css.'</head><body><main class="vtp-login-wrap"><section class="vtp-login-card"><img class="vtp-login-logo" src="'.$logo.'" alt="TuS Mingolsheim"><h1>Schiedsrichter</h1><p>'.esc_html($r->name).' · '.esc_html($r->tournament_name).'</p>'.$error.'<form method="post"><label for="vtp-pin">PIN eingeben</label><br><input id="vtp-pin" name="pin" type="password" maxlength="4" pattern="[0-9]{4}" inputmode="numeric" autocomplete="one-time-code" autofocus><br><button>Anmelden</button></form></section></main></body></html>'; }
 $m=$wpdb->get_row($wpdb->prepare('SELECT m.*, h.name home_name, a.name away_name FROM '.VTP_DB::table('matches').' m LEFT JOIN '.VTP_DB::table('teams').' h ON h.id=m.team_home LEFT JOIN '.VTP_DB::table('teams').' a ON a.id=m.team_away WHERE m.referee_id=%d AND m.tournament_id=%d AND m.team_home IS NOT NULL AND m.team_away IS NOT NULL AND (m.goals_home IS NULL OR m.goals_away IS NULL) ORDER BY m.starts_at,m.match_no LIMIT 1',$rid,$r->tournament_id));
 $upcoming=$wpdb->get_results($wpdb->prepare('SELECT m.*, h.name home_name, a.name away_name FROM '.VTP_DB::table('matches').' m LEFT JOIN '.VTP_DB::table('teams').' h ON h.id=m.team_home LEFT JOIN '.VTP_DB::table('teams').' a ON a.id=m.team_away WHERE m.referee_id=%d AND m.tournament_id=%d AND m.team_home IS NOT NULL AND m.team_away IS NOT NULL AND (m.goals_home IS NULL OR m.goals_away IS NULL) ORDER BY m.starts_at,m.match_no LIMIT 20',$rid,$r->tournament_id));
 ob_start(); ?><!doctype html><html><head><meta charset="<?php echo $charset; ?>"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Schiedsrichter</title><?php echo $css; ?><script>function ch(id,d){var e=document.getElementById(id);var v=parseInt(e.value||'0',10)+d;if(v<0)v=0;e.value=v;}</script></head><body><main class="vtp-ref-wrap"><section class="vtp-ref-card"><img class="vtp-login-logo" src="<?php echo $logo; ?>" alt="TuS Mingolsheim"><h1><?php echo esc_html($r->name); ?></h1><p><?php echo esc_html($r->tournament_name); ?></p><?php if(!empty($_GET['saved'])): ?><div class="vtp-ok">Ergebnis gemeldet.</div><?php endif; ?><?php if(!$m): ?><h2>Aktuell kein offenes Spiel zugewiesen.</h2><p>Bitte später erneut aktualisieren.</p><?php else: ?><h2>Nächstes Spiel</h2><div class="vtp-meta"><?php echo esc_html($m->starts_at?date_i18n('H:i',strtotime($m->starts_at)).' Uhr · ':''); ?>Feld <?php echo esc_html($m->field_no); ?></div><form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>"><input type="hidden" name="action" value="vtp_referee_save_result"><input type="hidden" name="referee_id" value="<?php echo esc_attr($rid); ?>"><input type="hidden" name="match_id" value="<?php echo esc_attr($m->id); ?>"><input type="hidden" name="token" value="<?php echo esc_attr($r->token); ?>"><input type="hidden" name="pin" value="<?php echo esc_attr($r->pin); ?>"><div class="vtp-team"><?php echo esc_html($m->home_name); ?></div><div class="vtp-scoreline"><button type="button" onclick="ch('gh',-1)">−</button><input id="gh" name="goals_home" type="number" value="<?php echo esc_attr($m->goals_home??0); ?>" min="0"><button type="button" onclick="ch('gh',1)">+</button></div><div class="vtp-team"><?php echo esc_html($m->away_name); ?></div><div class="vtp-scoreline"><button type="button" onclick="ch('ga',-1)">−</button><input id="ga" name="goals_away" type="number" value="<?php echo esc_attr($m->goals_away??0); ?>" min="0"><button type="button" onclick="ch('ga',1)">+</button></div><button>Ergebnis melden</button></form><?php endif; ?><?php if(!empty($upcoming)): ?><div class="vtp-next-list"><h2>Meine nächsten Spiele</h2><?php foreach($upcoming as $um): ?><div class="vtp-next-item"><strong><?php echo esc_html($um->starts_at?date_i18n('H:i',strtotime($um->starts_at)).' Uhr':'ohne Uhrzeit'); ?></strong> · Feld <?php echo esc_html($um->field_no); ?><br><?php echo esc_html($um->home_name); ?> - <?php echo esc_html($um->away_name); ?></div><?php endforeach; ?></div><?php endif; ?></section></main></body></html><?php return ob_get_clean();
}
private function render_registration($t){ global $wpdb;
 $maxTeams=max(0,absint(get_post_meta(absint($t->id),'_vtp_max_teams',true)));
 $teamCount=(int)$wpdb->get_var($wpdb->prepare('SELECT COUNT(*) FROM '.VTP_DB::table('teams').' WHERE tournament_id=%d',$t->id));
 $isFull=($maxTeams>0 && $teamCount >= $maxTeams);
 ob_start(); ?>
 <main class="vtp-public vtp-registration-page"><section class="vtp-hero"><div class="vtp-hero-inner"><img class="vtp-logo" src="<?php echo esc_url(VTP_URL.'assets/tus-mingolsheim-logo.png'); ?>" alt="TuS Mingolsheim"><div><div class="vtp-kicker">Turnieranmeldung</div><h1><?php echo esc_html($t->name); ?></h1><p><?php echo esc_html($this->type_label($t->event_type)); ?><?php if($t->start_date) echo ' · '.esc_html(date_i18n(get_option('date_format'),strtotime($t->start_date))); ?><?php if($t->start_time) echo ' · '.esc_html(substr($t->start_time,0,5)).' Uhr'; ?><?php if($t->location) echo ' · '.esc_html($t->location); ?></p></div></div></section>
 <section class="vtp-section vtp-registration"><h2>Anmeldung</h2><?php if(!empty($_GET['registered'])): ?><div class="vtp-ok">Mannschaft wurde angemeldet.</div><?php endif; ?>
 <div class="vtp-registration-stats"><strong><?php echo esc_html($teamCount); ?></strong> gemeldet<?php if($maxTeams): ?> · <strong><?php echo esc_html(max(0,$maxTeams-$teamCount)); ?></strong> Plätze frei · maximal <?php echo esc_html($maxTeams); ?> Mannschaften<?php endif; ?></div>
 <?php if($isFull): ?><div class="vtp-full"><strong>Ausgebucht</strong><p>Für dieses Turnier sind aktuell keine weiteren Anmeldungen möglich.</p></div><?php else: ?>
 <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" class="vtp-registration-form"><input type="hidden" name="action" value="vtp_register_team"><input type="hidden" name="tournament_id" value="<?php echo esc_attr($t->id); ?>"><?php wp_nonce_field('vtp_register_team_'.$t->id); ?>
 <label>Verein<br><input type="text" name="club_name" placeholder="z. B. TuS Mingolsheim"></label>
 <label>Mannschaftsname<br><input type="text" name="team_name" required placeholder="z. B. U13 / D-Junioren / Team 1"></label>
 <label>Trainername<br><input type="text" name="trainer_name" placeholder="Name Trainer/in"></label>
 <label>Telefon<br><input type="text" name="phone" placeholder="Telefonnummer"></label>
 <label>E-Mail<br><input type="email" name="email" placeholder="E-Mail-Adresse"></label>
 <button>Mannschaft anmelden</button></form><?php endif; ?></section></main><?php return ob_get_clean(); }
public function register_team(){
 global $wpdb;
 $tid=absint($_POST['tournament_id']??0);
 if(!$tid || !wp_verify_nonce($_POST['_wpnonce']??'', 'vtp_register_team_'.$tid)) wp_die('Nicht erlaubt.');
 $t=$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('tournaments').' WHERE id=%d',$tid));
 if(!$t) wp_die('Turnier nicht gefunden.');
 if(get_post_meta($tid,'_vtp_public_registration',true)!=='1') wp_die('Für dieses Turnier ist keine öffentliche Anmeldung aktiviert.');
 $max=max(0,absint(get_post_meta($tid,'_vtp_max_teams',true)));
 $count=(int)$wpdb->get_var($wpdb->prepare('SELECT COUNT(*) FROM '.VTP_DB::table('teams').' WHERE tournament_id=%d',$tid));
 if($max>0 && $count >= $max) wp_die('Dieses Turnier ist ausgebucht.');
 $club=sanitize_text_field($_POST['club_name']??'');
 $name=sanitize_text_field($_POST['team_name']??'');
 $trainer=sanitize_text_field($_POST['trainer_name']??'');
 $phone=sanitize_text_field($_POST['phone']??'');
 $email=sanitize_email($_POST['email']??'');
 $contact=trim($phone.($phone && $email ? ' / ' : '').$email);
 if($name==='') wp_die('Bitte Mannschaftsname eingeben.');
 $exists=(int)$wpdb->get_var($wpdb->prepare('SELECT COUNT(*) FROM '.VTP_DB::table('teams').' WHERE tournament_id=%d AND LOWER(name)=LOWER(%s)',$tid,$name));
 if($exists>0) wp_die('Diese Mannschaft ist bereits angemeldet.');
 $sort=(int)$wpdb->get_var($wpdb->prepare('SELECT COALESCE(MAX(sort_order),0)+1 FROM '.VTP_DB::table('teams').' WHERE tournament_id=%d',$tid));
 $wpdb->insert(VTP_DB::table('teams'),['tournament_id'=>$tid,'name'=>$name,'club_name'=>$club,'trainer_name'=>$trainer,'contact'=>$contact,'phone'=>$phone,'email'=>$email,'group_name'=>'','status'=>'active','source'=>'anmeldung','registration_status'=>'bestaetigt','sort_order'=>$sort]);
 wp_safe_redirect(add_query_arg('registered','1', self::registration_url($t))); exit;
}
public function referee_save(){
 global $wpdb; $rid=absint($_POST['referee_id']??0); $mid=absint($_POST['match_id']??0);
 $r=$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('referees').' WHERE id=%d',$rid));
 if(!$r || ($_POST['token']??'')!==$r->token || ($_POST['pin']??'')!==$r->pin) wp_die('Nicht erlaubt.');
 $wpdb->update(VTP_DB::table('matches'),['goals_home'=>intval($_POST['goals_home']??0),'goals_away'=>intval($_POST['goals_away']??0),'status'=>'beendet'],['id'=>$mid,'referee_id'=>$rid,'tournament_id'=>intval($r->tournament_id)]);
 setcookie('vtp_ref_'.$rid, wp_hash($r->token.'|'.$r->pin), time()+12*HOUR_IN_SECONDS, COOKIEPATH ?: '/', COOKIE_DOMAIN, is_ssl(), true);
 if(class_exists('VTP_Plugin')){ $ref=new ReflectionClass('VTP_Plugin'); if($ref->hasMethod('fill_final_round')){ $obj=VTP_Plugin::instance(); $m=$ref->getMethod('fill_final_round'); $m->setAccessible(true); $m->invoke($obj,intval($r->tournament_id)); } }
 wp_safe_redirect(add_query_arg('saved','1',self::referee_url($r))); exit;
}
public function leader_save_groups(){
 global $wpdb; $tid=absint($_POST['tournament_id']??0);
 $t=$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('tournaments').' WHERE id=%d',$tid));
 if(!$t || ($_POST['token']??'')!==$t->leader_token || ($_POST['pin']??'')!==$t->leader_pin) wp_die('Nicht erlaubt.');
 $hasResult=(int)$wpdb->get_var($wpdb->prepare('SELECT COUNT(*) FROM '.VTP_DB::table('matches').' WHERE tournament_id=%d AND goals_home IS NOT NULL AND goals_away IS NOT NULL AND is_forfeit=0',$tid));
 if($hasResult){ wp_safe_redirect(add_query_arg('locked','1',self::leader_url($t))); exit; }
 $ids=$_POST['team_id']??[]; $names=$_POST['team_name']??[]; $groups=$_POST['team_group']??[]; $structural=false; $noshowChanged=false;
 foreach($ids as $i=>$rawId){ $teamId=absint($rawId); if(!$teamId) continue; $old=$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('teams').' WHERE id=%d AND tournament_id=%d',$teamId,$tid)); if(!$old) continue;
   if(!empty($_POST['team_delete'][$teamId])){ $wpdb->delete(VTP_DB::table('teams'),['id'=>$teamId,'tournament_id'=>$tid]); $structural=true; continue; }
   $name=sanitize_text_field($names[$i]??$old->name); $group=sanitize_text_field($groups[$i]??$old->group_name); $status=!empty($_POST['team_noshow'][$teamId])?'noshow':'active';
   if($group!==$old->group_name || $status!==$old->status) $structural=true; if($status!==$old->status) $noshowChanged=true;
   $wpdb->update(VTP_DB::table('teams'),['name'=>$name,'group_name'=>$group?:'A','status'=>$status],['id'=>$teamId,'tournament_id'=>$tid]);
 }
 $sort=(int)$wpdb->get_var($wpdb->prepare('SELECT COALESCE(MAX(sort_order),0)+1 FROM '.VTP_DB::table('teams').' WHERE tournament_id=%d',$tid));
 foreach(preg_split('/\r\n|\r|\n/', sanitize_textarea_field($_POST['new_teams']??'')) as $line){ $line=trim($line); if($line==='') continue; $p=array_map('trim',explode(';',$line)); $name=$p[0]??''; if($name==='') continue; $wpdb->insert(VTP_DB::table('teams'),['tournament_id'=>$tid,'name'=>$name,'group_name'=>($p[1]??'A')?:'A','status'=>'active','sort_order'=>$sort++]); $structural=true; }
 if(class_exists('VTP_Plugin')){
  $obj=VTP_Plugin::instance();
  $ref=new ReflectionClass('VTP_Plugin');
  if($structural && $ref->hasMethod('rebuild_schedule_after_team_change')){
    // Team hinzugefügt/gelöscht/Nichtantritt: Spielplan vollständig aus den aktuell gespeicherten Gruppen neu aufbauen.
    // Dadurch werden neue Mannschaften wirklich in die Gruppenspiele aufgenommen und gelöschte entfernt.
    $m=$ref->getMethod('rebuild_schedule_after_team_change'); $m->setAccessible(true); $m->invoke($obj,$tid);
  } else {
    foreach(['apply_noshow_forfeits','reset_dependent_rounds','compact_schedule','assign_referees'] as $mn){
      if($ref->hasMethod($mn)){
        if($mn==='reset_dependent_rounds' && !$structural) continue;
        if($mn==='apply_noshow_forfeits' && !$structural) continue;
        $m=$ref->getMethod($mn); $m->setAccessible(true); $m->invoke($obj,$tid);
      }
    }
  }
}
 setcookie('vtp_leader_'.$tid, wp_hash($t->leader_token.'|'.$t->leader_pin), time()+12*HOUR_IN_SECONDS, COOKIEPATH ?: '/', COOKIE_DOMAIN, is_ssl(), true);
 wp_safe_redirect(add_query_arg('groups_saved','1',self::leader_url($t))); exit;
}
public function leader_save(){ global $wpdb; $tid=absint($_POST['tournament_id']); $t=$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('tournaments').' WHERE id=%d',$tid)); if(!$t || ($_POST['token']??'')!==$t->leader_token || ($_POST['pin']??'')!==$t->leader_pin) wp_die('Nicht erlaubt.'); foreach(($_POST['goals_home']??[]) as $mid=>$gh){ $ga=$_POST['goals_away'][$mid]??''; $wpdb->update(VTP_DB::table('matches'),['goals_home'=>($gh===''?null:intval($gh)),'goals_away'=>($ga===''?null:intval($ga)),'status'=>($gh!==''&&$ga!==''?'beendet':'angesetzt')],['id'=>absint($mid),'tournament_id'=>$tid]); } setcookie('vtp_leader_'.$tid, wp_hash($t->leader_token.'|'.$t->leader_pin), time()+12*HOUR_IN_SECONDS, COOKIEPATH ?: '/', COOKIE_DOMAIN, is_ssl(), true); if(class_exists('VTP_Plugin')){ $ref=new ReflectionClass('VTP_Plugin'); if($ref->hasMethod('fill_final_round')){ $obj=VTP_Plugin::instance(); $m=$ref->getMethod('fill_final_round'); $m->setAccessible(true); $m->invoke($obj,$tid); } } wp_safe_redirect(add_query_arg('saved','1',self::leader_url($t))); exit; }

 public function render_calendar(){
  global $wpdb;
  $today=current_time('Y-m-d');
  $events=$wpdb->get_results($wpdb->prepare("SELECT * FROM ".VTP_DB::table('events')." WHERE status<>'archiviert' AND COALESCE(calendar_visible,1)=1 AND (start_date IS NULL OR start_date='' OR start_date >= %s OR (end_date IS NOT NULL AND end_date<>'' AND end_date >= %s)) ORDER BY COALESCE(NULLIF(start_date,''),'9999-12-31') ASC, name ASC",$today,$today));
  $by_month=[];
  foreach((array)$events as $e){
    $key=!empty($e->start_date)?date_i18n('F Y',strtotime($e->start_date)):'Ohne Datum';
    $by_month[$key][]=$e;
  }
  ob_start(); ?>
  <main class="vtp-public vtp-event-modern vtp-calendar-modern-clean">
   <section class="vtp-event-shell">
    <div class="vtp-event-head">
     <div>
      <div class="vtp-event-pill"><span class="dashicons dashicons-calendar-alt"></span> Veranstaltungskalender</div>
      <h1>Veranstaltungskalender</h1>
      <p class="vtp-event-subtitle">Alle kommenden Termine des Vereins auf einen Blick</p>
     </div>
     <aside class="vtp-event-info-card"><span class="dashicons dashicons-calendar-alt"></span><div><strong>TuS Mingolsheim</strong><br><span>Events, Turniere und Vereinsveranstaltungen</span></div></aside>
    </div>
    <section class="vtp-event-program vtp-calendar-list-clean">
     <?php if(!$events): ?><div class="vtp-calendar-empty">Aktuell sind keine kommenden Veranstaltungen hinterlegt.</div><?php endif; ?>
     <?php foreach($by_month as $month=>$rows): ?>
      <div class="vtp-event-day vtp-calendar-month-clean">
       <h2><span class="dashicons dashicons-calendar-alt"></span><?php echo esc_html($month); ?></h2>
       <?php foreach($rows as $e):
        $dateLabel='Termin offen';
        $dateShort='Termin offen';
        if(!empty($e->start_date)){
          $dateLabel=$this->safe_date_label($e->start_date);
          $dateShort=date_i18n('d.m.Y',strtotime($e->start_date));
          if(!empty($e->end_date) && $e->end_date!==$e->start_date){
            $dateLabel.=' – '.$this->safe_date_label($e->end_date);
            $dateShort.=' – '.date_i18n('d.m.Y',strtotime($e->end_date));
          }
        }
        $url=self::event_url($e);
        $desc=wp_trim_words((string)$e->description,24,' …');
        $status=$this->event_status_label($e);
       ?>
       <article class="vtp-event-item vtp-calendar-event-card vtp-kind-game">
        <div class="vtp-event-time"><span class="dashicons dashicons-clock"></span><strong><?php echo esc_html($dateShort); ?></strong><small><?php echo esc_html($dateLabel); ?></small></div>
        <div class="vtp-event-icon"><span class="dashicons dashicons-calendar-alt"></span></div>
        <div class="vtp-event-content"><span class="vtp-event-type"><?php echo esc_html($status); ?></span><h3><?php echo esc_html($e->name); ?></h3><?php if(!empty($e->location)): ?><p><strong><?php echo esc_html($e->location); ?></strong></p><?php endif; ?><?php if($desc): ?><p><?php echo esc_html($desc); ?></p><?php endif; ?></div>
        <div class="vtp-event-audience"><a class="vtp-event-link vtp-calendar-link" href="<?php echo esc_url($url); ?>">Mehr erfahren</a></div>
       </article>
       <?php endforeach; ?>
      </div>
     <?php endforeach; ?>
     <div class="vtp-event-note"><span class="dashicons dashicons-info-outline"></span><div><strong>Hinweis:</strong> Änderungen und Ergänzungen im Veranstaltungskalender vorbehalten.</div></div>
    </section>
   </section>
  </main><?php return ob_get_clean(); }

 public function render_event($eid){
  global $wpdb;
  $e=$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('events').' WHERE id=%d',$eid));
  if(!$e) return '<p>Event nicht gefunden.</p>';

  $items=$wpdb->get_results($wpdb->prepare('SELECT * FROM '.VTP_DB::table('event_items').' WHERE event_id=%d ORDER BY item_date,start_time,sort_order',$eid));
  $turniere=$wpdb->get_results($wpdb->prepare('SELECT * FROM '.VTP_DB::table('tournaments').' WHERE event_id=%d ORDER BY start_date,start_time',$eid));

  $program=[];
  foreach((array)$items as $it){
   $type=trim((string)($it->item_type??''));
   if(in_array($type, ['Aufbau','Abbau'], true)) continue;
   $visibility=sanitize_key($it->visibility ?? 'public');
   if($visibility==='private') continue;
   if(!in_array($visibility,['public','ticket','members'],true)) $visibility='public';
   $date=trim((string)($it->item_date??''));
   $title=trim((string)($it->title??''));
   if($title==='') continue;
   // Verwaiste/defekte Einträge ohne Datum werden nicht fatal gerendert, sondern ans Ende sortiert.
   $program[]=(object)[
    'date'=>$date,
    'start'=>trim((string)($it->start_time??'')),
    'end'=>trim((string)($it->end_time??'')),
    'type'=>$type ?: 'Programmpunkt',
    'title'=>$title,
    'url'=>'',
    'status'=>'',
    'visibility'=>$visibility
   ];
  }
  foreach((array)$turniere as $t){
   $title=trim((string)($t->name??''));
   if($title==='') continue;
   $program[]=(object)[
    'date'=>trim((string)($t->start_date??'')),
    'start'=>trim((string)($t->start_time??'')),
    'end'=>trim((string)($t->end_time??'')),
    'type'=>$this->type_label($t->event_type??'turnier'),
    'title'=>$title,
    'url'=>self::public_url($t),
    'status'=>$this->event_status_label($t),
    'visibility'=>'public'
   ];
  }

  usort($program,function($a,$b){
   $ad=$a->date ?: '9999-12-31'; $bd=$b->date ?: '9999-12-31';
   $as=$a->start ?: '99:99'; $bs=$b->start ?: '99:99';
   return [$ad,$as,strval($a->title)] <=> [$bd,$bs,strval($b->title)];
  });
  $by_day=[];
  foreach($program as $p){ $by_day[$p->date ?: 'ohne-datum'][]=$p; }
  $event_sponsors=$this->parse_sponsors($e->sponsors ?? '');
  ob_start(); ?>
  <main class="vtp-public vtp-event-modern">
   <section class="vtp-event-shell">
    <div class="vtp-event-head">
     <div>
      <div class="vtp-event-pill"><span class="dashicons dashicons-calendar-alt"></span> Programmübersicht</div>
      <h1>Programmübersicht</h1>
      <p class="vtp-event-subtitle">Alle Highlights auf einen Blick</p><?php if(!empty($e->content_url)): ?><p><a class="vtp-event-link vtp-event-main-link" href="<?php echo esc_url($e->content_url); ?>" target="_blank" rel="noopener">Zum Inhalt</a></p><?php endif; ?>
     </div>
     <aside class="vtp-event-info-card"><span class="dashicons dashicons-calendar-alt"></span><div><strong><?php echo esc_html($e->name); ?></strong><?php if(!empty($e->location)): ?><br><span><?php echo esc_html($e->location); ?></span><?php endif; ?></div></aside>
    </div>
    <nav class="vtp-event-tabs"><a class="active" href="#ablauf"><span class="dashicons dashicons-calendar-alt"></span> Programm</a><?php if(!empty($e->description) || !empty($e->location) || $event_sponsors): ?><a href="#ueber"><span class="dashicons dashicons-info-outline"></span> Über das Event</a><?php endif; ?></nav>
    <section id="ablauf" class="vtp-event-program">
     <?php if(!$program): ?><p>Noch kein Ablauf hinterlegt.</p><?php endif; ?>
     <?php foreach($by_day as $date=>$rows): ?>
      <div class="vtp-event-day">
       <h2><span class="dashicons dashicons-calendar-alt"></span><?php echo esc_html($date==='ohne-datum' ? 'Ohne Datum' : $this->safe_date_label($date)); ?></h2>
       <?php foreach($rows as $p):
        $type_lc=strtolower((string)$p->type);
        $icon='dashicons-megaphone'; $kind='default'; $audience='Für alle'; if(($p->visibility??'public')==='ticket') $audience='Eintrittskarte'; elseif(($p->visibility??'public')==='members') $audience='Mitglieder';
        if(strpos($type_lc,'musik')!==false){ $icon='dashicons-format-audio'; $kind='music'; }
        elseif(strpos($type_lc,'spiel')!==false || strpos($type_lc,'turnier')!==false || strpos($type_lc,'schießen')!==false){ $icon='dashicons-awards'; $kind='game'; }
        elseif(strpos($type_lc,'programm')!==false){ $icon='dashicons-microphone'; $kind='program'; }
        $time=$this->safe_time_label($p->start,$p->end);
       ?>
       <article class="vtp-event-item vtp-kind-<?php echo esc_attr($kind); ?>">
        <div class="vtp-event-time"><span class="dashicons dashicons-clock"></span><strong><?php echo esc_html($time ?: 'Uhrzeit offen'); ?></strong></div>
        <div class="vtp-event-icon"><span class="dashicons <?php echo esc_attr($icon); ?>"></span></div>
        <div class="vtp-event-content"><span class="vtp-event-type"><?php echo esc_html($p->type); ?></span><h3><?php echo esc_html($p->title); ?></h3><?php if($p->status): ?><p><?php echo esc_html($p->status); ?></p><?php endif; ?><?php if($p->url): ?><a class="vtp-event-link" href="<?php echo esc_url($p->url); ?>">Turnier öffnen</a><?php endif; ?></div>
        <div class="vtp-event-audience"><span class="dashicons dashicons-groups"></span><?php echo esc_html($audience); ?></div>
       </article>
       <?php endforeach; ?>
      </div>
     <?php endforeach; ?>
    </section>
    <?php if(!empty($e->description) || !empty($e->location) || $event_sponsors): ?><section id="ueber" class="vtp-event-about">
     <?php if(!empty($e->description)): ?><p><?php echo esc_html($e->description); ?></p><?php endif; ?>
     <?php if(!empty($e->location)): ?><p><strong>Veranstaltungsort:</strong> <?php echo esc_html($e->location); ?></p><?php endif; ?>
     <?php if($event_sponsors): ?><h2>Sponsoren</h2><div class="vtp-sponsors"><?php foreach($event_sponsors as $sp): ?><a href="<?php echo esc_url($sp['url']?:'#'); ?>" target="_blank"><img src="<?php echo esc_url($sp['logo']); ?>" alt="<?php echo esc_attr($sp['name']); ?>"><span><?php echo esc_html($sp['name']); ?></span></a><?php endforeach; ?></div><?php endif; ?>
    </section><?php endif; ?>
    <div class="vtp-event-note"><span class="dashicons dashicons-info-outline"></span><div><strong>Änderungen im Programm vorbehalten.</strong><br>Aktuelle Informationen findest du immer hier auf unserer Website.</div></div>
   </section>
  </main><?php return ob_get_clean(); }
 public function render_helpers($eid){ global $wpdb; $e=$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('events').' WHERE id=%d',$eid)); if(!$e) return '<p>Event nicht gefunden.</p>'; $gruppe=sanitize_text_field($_GET['gruppe']??''); if($gruppe!==''){ $shifts=$wpdb->get_results($wpdb->prepare('SELECT s.*, COUNT(g.id) signups FROM '.VTP_DB::table('shifts').' s LEFT JOIN '.VTP_DB::table('shift_signups').' g ON g.shift_id=s.id WHERE s.event_id=%d AND s.assigned_group=%s GROUP BY s.id ORDER BY s.shift_date,s.start_time,s.area_name',$eid,$gruppe)); } else { $shifts=$wpdb->get_results($wpdb->prepare('SELECT s.*, COUNT(g.id) signups FROM '.VTP_DB::table('shifts').' s LEFT JOIN '.VTP_DB::table('shift_signups').' g ON g.shift_id=s.id WHERE s.event_id=%d GROUP BY s.id ORDER BY s.shift_date,s.start_time,s.area_name',$eid)); }
  $needed=0; $filled=0; $open=0; foreach($shifts as $s){ $is_bring=(stripos((string)$s->area_name,'Mitbringen')===0); $need=$is_bring?1:absint($s->slots_needed); $done=$is_bring?(absint($s->signups)>0?1:0):min(absint($s->signups),$need); $needed+=$need; $filled+=$done; if($done<$need) $open++; }
  ob_start(); ?><main class="vtp-public"><section class="vtp-hero"><div class="vtp-hero-inner"><img class="vtp-logo" src="<?php echo esc_url(VTP_URL.'assets/tus-mingolsheim-logo.png'); ?>" alt="TuS Mingolsheim"><div><div class="vtp-kicker">Helfer Anmeldung<?php echo $gruppe?' · '.esc_html($gruppe):''; ?></div><h1><?php echo esc_html($e->name); ?></h1><p>Trage dich mit deinem Namen für eine freie Schicht ein.</p></div></div></section><?php if(!empty($_GET['danke'])) echo '<section class="vtp-section"><p><strong>Danke! Deine Eintragung wurde gespeichert.</strong></p></section>'; ?><section class="vtp-section"><h2><?php echo $gruppe?'Schichten für '.esc_html($gruppe):'Alle Helferschichten'; ?></h2><div class="vtp-helper-summary"><strong><?php echo esc_html($filled.' / '.$needed); ?></strong> Plätze besetzt · <?php echo esc_html($open); ?> offene Schichten</div><?php if(!$shifts) echo '<p>Aktuell sind keine Schichten hinterlegt.</p>'; foreach($shifts as $s): $is_bring=(stripos((string)$s->area_name,'Mitbringen')===0); $full=$is_bring ? (absint($s->signups)>0) : ($s->signups >= $s->slots_needed); $program=$this->helper_program_label($eid,$s->shift_date,$s->start_time,$s->end_time); ?><article class="vtp-shift <?php echo $full?'full':''; ?>"><div><strong><?php echo esc_html($s->area_name); ?></strong><br><span><?php echo esc_html($program); ?></span><?php if(!empty($s->assigned_group)): ?><br><span><?php echo esc_html($s->assigned_group); ?></span><?php endif; ?><br><?php echo esc_html(date_i18n('d.m.Y',strtotime($s->shift_date)).' · '.substr($s->start_time,0,5).' - '.substr($s->end_time,0,5).' Uhr'); ?><br><span><?php echo $is_bring ? esc_html(($full?'Erledigt':'Offen').' · Bedarf: '.$s->slots_needed.' Stück') : esc_html($s->signups.' / '.$s->slots_needed.' belegt · '.($full?'Voll':'Offen')); ?></span></div><?php if(!$full): ?><form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>"><input type="hidden" name="action" value="vtp_helper_signup"><input type="hidden" name="event_id" value="<?php echo esc_attr($eid); ?>"><input type="hidden" name="shift_id" value="<?php echo esc_attr($s->id); ?>"><?php if($gruppe): ?><input type="hidden" name="gruppe" value="<?php echo esc_attr($gruppe); ?>"><?php endif; ?><input name="name" placeholder="Dein Name" required><button>Eintragen</button></form><?php else: ?><strong>Anmeldung geschlossen</strong><?php endif; ?></article><?php endforeach; ?></section></main><?php return ob_get_clean(); }
 private function helper_program_label($event_id,$date,$start,$end){ global $wpdb; $date=(string)$date; $start=substr((string)$start,0,5); if(!$date) return 'Event'; $items=$wpdb->get_results($wpdb->prepare('SELECT item_type,title,start_time,end_time FROM '.VTP_DB::table('event_items').' WHERE event_id=%d AND item_date=%s ORDER BY start_time,sort_order',$event_id,$date)); $event=$wpdb->get_row($wpdb->prepare('SELECT name FROM '.VTP_DB::table('events').' WHERE id=%d',$event_id)); $ts=$wpdb->get_results($wpdb->prepare('SELECT name,start_time FROM '.VTP_DB::table('tournaments').' WHERE (event_id=%d OR parent_event=%s) AND start_date=%s ORDER BY start_time',$event_id,$event->name??'',$date)); $candidates=[]; foreach($items as $it){ if(in_array((string)$it->item_type,['Aufbau','Abbau'],true)) continue; $candidates[]=['from'=>substr((string)$it->start_time,0,5),'to'=>substr((string)$it->end_time,0,5),'label'=>$it->title?:$it->item_type]; } foreach($ts as $t){ $candidates[]=['from'=>substr((string)$t->start_time,0,5),'to'=>'23:59','label'=>$t->name]; } foreach($candidates as $c){ if(!$c['from']) continue; $to=$c['to']?:'23:59'; if($start>=$c['from'] && $start<$to) return $c['label']; } return 'Event allgemein'; }
 public function helper_signup(){ global $wpdb; $sid=absint($_POST['shift_id']); $eid=absint($_POST['event_id']); $s=$wpdb->get_row($wpdb->prepare('SELECT s.*, COUNT(g.id) signups FROM '.VTP_DB::table('shifts').' s LEFT JOIN '.VTP_DB::table('shift_signups').' g ON g.shift_id=s.id WHERE s.id=%d GROUP BY s.id',$sid)); $is_bring=(stripos((string)$s->area_name,'Mitbringen')===0); if(!$s || $s->event_id!=$eid || ($is_bring ? absint($s->signups)>0 : $s->signups >= $s->slots_needed)) wp_die($is_bring ? 'Dieser Mitbring-Eintrag ist bereits erledigt.' : 'Diese Schicht ist leider bereits voll.'); $wpdb->insert(VTP_DB::table('shift_signups'),['shift_id'=>$sid,'name'=>sanitize_text_field($_POST['name']),'contact'=>'','created_at'=>current_time('mysql')]); $e=$wpdb->get_row($wpdb->prepare('SELECT * FROM '.VTP_DB::table('events').' WHERE id=%d',$eid)); $url=self::helpers_url($e); if(!empty($_POST['gruppe'])) $url=add_query_arg('gruppe',rawurlencode(sanitize_text_field($_POST['gruppe'])),$url); wp_safe_redirect(add_query_arg('danke','1',$url)); exit; }
}
