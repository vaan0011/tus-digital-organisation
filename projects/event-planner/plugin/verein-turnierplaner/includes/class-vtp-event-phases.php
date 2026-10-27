<?php
if (!defined('ABSPATH')) exit;

/** Shared date-based operational phase; archiving remains an explicit action. */
class VTP_Event_Phases {
 public static function phase($start,$end,$today=null){
  $today=$today?:current_time('Y-m-d');
  $valid=function($date){return is_string($date) && preg_match('/^\d{4}-\d{2}-\d{2}$/',$date) && $date!=='0000-00-00' && date('Y-m-d',strtotime($date))===$date;};
  if(!$valid($start)) return 'undated';
  if(!$valid($end)) $end=$start;
  if($end<$start) $end=$start;
  if($today<$start) return 'upcoming';
  if($today>$end) return 'completed';
  return 'running';
 }
 public static function bucket($rows){
  $groups=['upcoming'=>[],'running'=>[],'completed'=>[],'undated'=>[]];
  foreach($rows as $row){
   if(($row->status??'')==='archiviert') continue;
   $groups[self::phase($row->start_date??null,$row->end_date??null)][]=$row;
  }
  return $groups;
 }
}
