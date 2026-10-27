<?php
if (!defined('ABSPATH')) exit;

/** Shared date-based phase for events and tournaments; archiving is always explicit. */
class VTP_Event_Lifecycle {
 public static function phase($start,$end,$today=null){
  $today=$today ?: current_time('Y-m-d');
  $start=(string)$start;
  $end=(string)$end;
  $valid=function($date){ return preg_match('/^\d{4}-\d{2}-\d{2}$/',$date) && $date!=='0000-00-00' && checkdate((int)substr($date,5,2),(int)substr($date,8,2),(int)substr($date,0,4)); };
  if(!$valid($start)) return 'upcoming'; // Undated stays visible in the first column.
  if(!$valid($end) || $end<$start) $end=$start;
  if($today<$start) return 'upcoming';
  if($today>$end) return 'completed';
  return 'running';
 }
 public static function group($rows,$today=null){
  $groups=['upcoming'=>[],'running'=>[],'completed'=>[]];
  foreach($rows as $row){
   $phase=self::phase($row->start_date??'', $row->end_date??'', $today);
   $groups[$phase][]=$row;
  }
  return $groups;
 }
}
