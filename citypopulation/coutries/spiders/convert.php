<?php
function DMStoDEC($dms) {

  $ar_deg = explode("°", $dms);
  $degrees = trim($ar_deg[0]);
  $ar_min = explode("'", $ar_deg[1]);
  $minutes = trim($ar_min[0]);
  $seconds = 0;
  $direction = trim($ar_min[1]);

   $d = strtolower($direction);
   $ok = array('n', 's', 'e', 'w');
   //degrees must be integer between 0 and 180
   if(!is_numeric($degrees) || $degrees < 0 || $degrees > 180) {
     $decimal = false;
   }
   //minutes must be integer or float between 0 and 59
   elseif(!is_numeric($minutes) || $minutes < 0 || $minutes > 59) {
     $decimal = false;
   }
   //seconds must be integer or float between 0 and 59
   elseif(!is_numeric($seconds) || $seconds < 0 || $seconds > 59) {
     $decimal = false;
   }
   elseif(!in_array($d, $ok)) {
     $decimal = false;
   }
   else {
     //inputs clean, calculate
     $decimal = $degrees + ($minutes / 60) + ($seconds / 3600);
     //reverse for south or west coordinates; north is assumed
     if($d == 's' || $d == 'w') {
       $decimal *= -1;
     }
   }
    
   return $decimal;
 }
 ?>