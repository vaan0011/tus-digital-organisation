<?php
if (!defined('ABSPATH')) exit;

/** Shared, read-only date phases. Archiving remains an explicit admin action. */
class VTP_Event_Lifecycle {
 public static function phase($row, $today=null){
  if((string)($row->status??'')==='archiviert') return 'archived';
  $today=$today?:current_time('Y-m-d');
  $start=(string)($row->start_date??'');
  $end=(string)($row->end_date??'');
  $valid=function($d){
   if(!preg_match('/^\d{4}-\d{2}-\d{2}$/',$d)) return false;
   $parts=explode('-',$d);
   return checkdate((int)$parts[1],(int)$parts[2],(int)$parts[0]);
  };
  if(!$valid($start)) return 'unscheduled';
  if(!$valid($end) || $end<$start) $end=$start;
  if($start>$today) return 'upcoming';
  if($end<$today) return 'completed';
  return 'running';
 }
 public static function columns(){
  return ['upcoming'=>'Anstehend','running'=>'Am Laufen','completed'=>'Durchgeführt','unscheduled'=>'Termin offen'];
 }
}
