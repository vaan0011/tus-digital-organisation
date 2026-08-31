<?php
if (!defined('ABSPATH')) exit;
class VTP_DB {
 public static function table($n){ global $wpdb; return $wpdb->prefix.'vtp_'.$n; }
 public static function activate(){ self::schema(); self::ensure_calendar_page(); update_option('vtp_db_version', VTP_VERSION); flush_rewrite_rules(); }
 public static function maybe_upgrade(){ if(get_option('vtp_db_version')!==VTP_VERSION){ self::schema(); self::migrate(); self::ensure_calendar_page(); update_option('vtp_db_version', VTP_VERSION); flush_rewrite_rules(false); } }
 public static function migrate(){ global $wpdb; $table=self::table('tournaments'); $cols=$wpdb->get_col("DESC $table",0); if($cols && !in_array('event_id',$cols,true)) $wpdb->query("ALTER TABLE $table ADD event_id BIGINT UNSIGNED NULL AFTER parent_event"); $mt=self::table('matches'); $mcols=$wpdb->get_col("DESC $mt",0); if($mcols && !in_array('referee_id',$mcols,true)) $wpdb->query("ALTER TABLE $mt ADD referee_id BIGINT UNSIGNED NULL AFTER field_no"); $wpdb->query("UPDATE $table SET leader_pin = LPAD(FLOOR(1000 + RAND()*9000),4,'0') WHERE leader_pin IS NULL OR CHAR_LENGTH(leader_pin)<>4"); $st=self::table('shifts'); $scols=$wpdb->get_col("DESC $st",0); if($scols && !in_array('assigned_group',$scols,true)) $wpdb->query("ALTER TABLE $st ADD assigned_group VARCHAR(191) NULL AFTER slots_needed");
  $et=self::table('events'); $ecols=$wpdb->get_col("DESC $et",0);
  if($ecols && !in_array('location',$ecols,true)) $wpdb->query("ALTER TABLE $et ADD location VARCHAR(191) NULL AFTER description");
  if($ecols && !in_array('sponsors',$ecols,true)) $wpdb->query("ALTER TABLE $et ADD sponsors LONGTEXT NULL AFTER location");
  if($ecols && !in_array('calendar_visible',$ecols,true)) $wpdb->query("ALTER TABLE $et ADD calendar_visible TINYINT(1) NOT NULL DEFAULT 1 AFTER sponsors");
  if($ecols && !in_array('content_url',$ecols,true)) $wpdb->query("ALTER TABLE $et ADD content_url VARCHAR(255) NULL AFTER calendar_visible");
  $it=self::table('event_items'); $icols=$wpdb->get_col("DESC $it",0);
  if($icols && !in_array('visibility',$icols,true)) $wpdb->query("ALTER TABLE $it ADD visibility VARCHAR(40) NOT NULL DEFAULT 'public' AFTER title");
  $tt=self::table('teams'); $tcols=$wpdb->get_col("DESC $tt",0);
  if($tcols && !in_array('trainer_name',$tcols,true)) $wpdb->query("ALTER TABLE $tt ADD trainer_name VARCHAR(191) NULL AFTER name");
  if($tcols && !in_array('contact',$tcols,true)) $wpdb->query("ALTER TABLE $tt ADD contact VARCHAR(191) NULL AFTER trainer_name");
  if($tcols && !in_array('club_name',$tcols,true)) $wpdb->query("ALTER TABLE $tt ADD club_name VARCHAR(191) NULL AFTER name");
  if($tcols && !in_array('phone',$tcols,true)) $wpdb->query("ALTER TABLE $tt ADD phone VARCHAR(80) NULL AFTER contact");
  if($tcols && !in_array('email',$tcols,true)) $wpdb->query("ALTER TABLE $tt ADD email VARCHAR(191) NULL AFTER phone");
  if($tcols && !in_array('source',$tcols,true)) $wpdb->query("ALTER TABLE $tt ADD source VARCHAR(40) NOT NULL DEFAULT 'manuell' AFTER email");
  if($tcols && !in_array('registration_status',$tcols,true)) $wpdb->query("ALTER TABLE $tt ADD registration_status VARCHAR(40) NOT NULL DEFAULT 'bestaetigt' AFTER source"); }

 public static function ensure_calendar_page(){
  if(!function_exists('wp_insert_post')) return 0;
  $page_id=absint(get_option('vtp_calendar_page_id'));
  $content='[verein_veranstaltungskalender]';
  $post=['post_title'=>'Veranstaltungskalender','post_name'=>'veranstaltungskalender','post_content'=>$content,'post_status'=>'publish','post_type'=>'page'];
  if($page_id && get_post($page_id)){
   $post['ID']=$page_id;
   wp_update_post($post);
   return $page_id;
  }
  $existing=get_page_by_path('veranstaltungskalender');
  if($existing && $existing->post_type==='page'){
   $page_id=absint($existing->ID);
   if(strpos((string)$existing->post_content,'[verein_veranstaltungskalender')===false){
    $post['ID']=$page_id;
    wp_update_post($post);
   }
   update_option('vtp_calendar_page_id',$page_id);
   return $page_id;
  }
  $page_id=wp_insert_post($post);
  if($page_id && !is_wp_error($page_id)){
   update_option('vtp_calendar_page_id',absint($page_id));
   return absint($page_id);
  }
  return 0;
 }

 public static function schema(){ global $wpdb; require_once ABSPATH.'wp-admin/includes/upgrade.php'; $c=$wpdb->get_charset_collate();
  dbDelta("CREATE TABLE ".self::table('tournaments')." (
   id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   name VARCHAR(191) NOT NULL,
   slug VARCHAR(191) NOT NULL,
   description TEXT NULL,
   location VARCHAR(191) NULL,
   sponsors LONGTEXT NULL,
   calendar_visible TINYINT(1) NOT NULL DEFAULT 1,
   start_date DATE NULL,
   start_time VARCHAR(10) NULL,
   event_type VARCHAR(50) NOT NULL DEFAULT 'jugendturnier',
   tournament_mode VARCHAR(50) NOT NULL DEFAULT 'groups_ko',
   ko_size INT NOT NULL DEFAULT 4,
   auto_groups INT NOT NULL DEFAULT 2,
   match_duration INT NOT NULL DEFAULT 10,
   break_minutes INT NOT NULL DEFAULT 2,
   fields_count INT NOT NULL DEFAULT 1,
   points_win INT NOT NULL DEFAULT 3,
   points_draw INT NOT NULL DEFAULT 1,
   points_loss INT NOT NULL DEFAULT 0,
   status VARCHAR(30) NOT NULL DEFAULT 'aktiv',
   public_page_id BIGINT UNSIGNED NULL,
   leader_token VARCHAR(80) NULL,
   leader_pin VARCHAR(20) NULL,
   sponsors LONGTEXT NULL,
   parent_event VARCHAR(191) NULL,
   event_id BIGINT UNSIGNED NULL,
   created_at DATETIME NOT NULL,
   updated_at DATETIME NOT NULL,
   PRIMARY KEY (id), UNIQUE KEY slug (slug), KEY event_id (event_id)
  ) $c;");
  dbDelta("CREATE TABLE ".self::table('teams')." (
   id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   tournament_id BIGINT UNSIGNED NOT NULL,
   name VARCHAR(191) NOT NULL,
   club_name VARCHAR(191) NULL,
   trainer_name VARCHAR(191) NULL,
   contact VARCHAR(191) NULL,
   phone VARCHAR(80) NULL,
   email VARCHAR(191) NULL,
   source VARCHAR(40) NOT NULL DEFAULT 'manuell',
   registration_status VARCHAR(40) NOT NULL DEFAULT 'bestaetigt',
   group_name VARCHAR(50) NOT NULL DEFAULT 'A',
   status VARCHAR(30) NOT NULL DEFAULT 'active',
   sort_order INT NOT NULL DEFAULT 0,
   PRIMARY KEY (id), KEY tournament_id (tournament_id), KEY group_name (group_name)
  ) $c;");
  dbDelta("CREATE TABLE ".self::table('matches')." (
   id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   tournament_id BIGINT UNSIGNED NOT NULL,
   round_type VARCHAR(30) NOT NULL DEFAULT 'group',
   round_label VARCHAR(80) NULL,
   group_name VARCHAR(50) NULL,
   match_no INT NOT NULL DEFAULT 0,
   team_home BIGINT UNSIGNED NULL,
   team_away BIGINT UNSIGNED NULL,
   goals_home INT NULL,
   goals_away INT NULL,
   starts_at DATETIME NULL,
   field_no INT NOT NULL DEFAULT 1,
   referee_id BIGINT UNSIGNED NULL,
   status VARCHAR(30) NOT NULL DEFAULT 'angesetzt',
   is_forfeit TINYINT(1) NOT NULL DEFAULT 0,
   PRIMARY KEY (id), KEY tournament_id (tournament_id), KEY starts_at (starts_at)
  ) $c;");

  dbDelta("CREATE TABLE ".self::table('referees')." (
   id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   tournament_id BIGINT UNSIGNED NOT NULL,
   name VARCHAR(191) NOT NULL,
   token VARCHAR(80) NULL,
   pin VARCHAR(4) NOT NULL,
   sort_order INT NOT NULL DEFAULT 0,
   created_at DATETIME NOT NULL,
   PRIMARY KEY (id), KEY tournament_id (tournament_id)
  ) $c;");
  dbDelta("CREATE TABLE ".self::table('events')." (
   id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   name VARCHAR(191) NOT NULL,
   slug VARCHAR(191) NOT NULL,
   description TEXT NULL,
   location VARCHAR(191) NULL,
   sponsors LONGTEXT NULL,
   calendar_visible TINYINT(1) NOT NULL DEFAULT 1,
   content_url VARCHAR(255) NULL,
   start_date DATE NULL,
   end_date DATE NULL,
   status VARCHAR(30) NOT NULL DEFAULT 'aktiv',
   public_page_id BIGINT UNSIGNED NULL,
   helper_page_id BIGINT UNSIGNED NULL,
   created_at DATETIME NOT NULL,
   updated_at DATETIME NOT NULL,
   PRIMARY KEY (id), UNIQUE KEY slug (slug)
  ) $c;");
  dbDelta("CREATE TABLE ".self::table('event_items')." (
   id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   event_id BIGINT UNSIGNED NOT NULL,
   item_date DATE NULL,
   start_time VARCHAR(10) NULL,
   end_time VARCHAR(10) NULL,
   item_type VARCHAR(50) NOT NULL DEFAULT 'programmpunkt',
   title VARCHAR(191) NOT NULL,
   visibility VARCHAR(40) NOT NULL DEFAULT 'public',
   tournament_id BIGINT UNSIGNED NULL,
   sort_order INT NOT NULL DEFAULT 0,
   PRIMARY KEY (id), KEY event_id (event_id), KEY tournament_id (tournament_id)
  ) $c;");

  dbDelta("CREATE TABLE ".self::table('helper_needs')." (
   id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   event_id BIGINT UNSIGNED NOT NULL,
   need_date DATE NULL,
   need_type VARCHAR(50) NOT NULL DEFAULT 'Helferschicht',
   description VARCHAR(191) NOT NULL,
   amount INT NOT NULL DEFAULT 1,
   unit VARCHAR(40) NOT NULL DEFAULT 'Personen',
   sort_order INT NOT NULL DEFAULT 0,
   PRIMARY KEY (id), KEY event_id (event_id), KEY need_date (need_date)
  ) $c;");

  dbDelta("CREATE TABLE ".self::table('shifts')." (
   id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   event_id BIGINT UNSIGNED NOT NULL,
   area_name VARCHAR(120) NOT NULL,
   shift_date DATE NULL,
   start_time VARCHAR(10) NOT NULL,
   end_time VARCHAR(10) NOT NULL,
   slots_needed INT NOT NULL DEFAULT 2,
   assigned_group VARCHAR(191) NULL,
   PRIMARY KEY (id), KEY event_id (event_id)
  ) $c;");
  dbDelta("CREATE TABLE ".self::table('shift_signups')." (
   id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   shift_id BIGINT UNSIGNED NOT NULL,
   name VARCHAR(191) NOT NULL,
   contact VARCHAR(191) NULL,
   comment TEXT NULL,
   created_at DATETIME NOT NULL,
   PRIMARY KEY (id), KEY shift_id (shift_id)
  ) $c;");
 }
}
