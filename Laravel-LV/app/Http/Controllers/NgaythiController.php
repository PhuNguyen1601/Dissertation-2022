<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NgaythiController extends Controller
{
    $date1 = "2008-11-01 22:45:00";   
        $date2 = "2009-12-04 13:44:01";    
      $diff = abs(strtotime($date2) - strtotime($date1));     
      $years = floor($diff / (365*60*60*24));   
      $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));   
      $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24) / (60*60*24));   
      echo $years." năm, ".$months." tháng, ".$days." ngày, ".$hours." giờ, ".$minutes." phút, ".$seconds." giây";


}