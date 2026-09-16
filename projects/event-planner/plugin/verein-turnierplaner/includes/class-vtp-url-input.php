<?php
if (!defined('ABSPATH')) exit;

class VTP_URL_Input {
 public static function init(){
  add_action('admin_enqueue_scripts',[__CLASS__,'assets']);
  add_action('admin_post_vtp_save_event',[__CLASS__,'normalize_event_post'],0);
  add_action('admin_post_vtp_save_sponsors',[__CLASS__,'normalize_sponsor_post'],0);
 }

 public static function assets(){
  $page=sanitize_key($_GET['page']??'');
  if(strpos($page,'vtp')!==0) return;
  wp_enqueue_script('vtp-url-input',VTP_URL.'assets/url-input.js',[],VTP_VERSION,true);
 }

 public static function normalize($value){
  $value=trim((string)$value);
  if($value==='') return '';

  if(strpos($value,'//')===0) $value='https:'.$value;
  elseif(!preg_match('#^https?://#i',$value)) $value='https://'.$value;

  return esc_url_raw($value,['http','https']);
 }

 public static function normalize_event_post(){
  if(isset($_POST['content_url'])) $_POST['content_url']=self::normalize(wp_unslash($_POST['content_url']));

  if(isset($_POST['sponsor_url']) && is_array($_POST['sponsor_url'])){
   foreach($_POST['sponsor_url'] as $i=>$url){
    $_POST['sponsor_url'][$i]=self::normalize(wp_unslash($url));
   }
  }
 }

 public static function normalize_sponsor_post(){
  if(!isset($_POST['sponsor_url']) || !is_array($_POST['sponsor_url'])) return;
  foreach($_POST['sponsor_url'] as $i=>$url){
   $_POST['sponsor_url'][$i]=self::normalize(wp_unslash($url));
  }
 }
}
