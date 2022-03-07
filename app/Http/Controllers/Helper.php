<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class Helper extends Controller
{
    public static function date($fecha,$timezone = false){
        if ($fecha!="") {
           
           $fecha =  Carbon::parse($fecha)->locale('es_ES');
            if ($timezone) {
                $fecha =  $fecha->timezone('America/Santiago');
            }
            return  $fecha;
        }
        return false;
    } 

    public static function fechaHora($fecha){
        if ($fecha!="") {
            return Carbon::createFromFormat('Y-m-d H:i:s', $fecha)->locale('es')->timezone('America/Santiago');
        }
    }
}
