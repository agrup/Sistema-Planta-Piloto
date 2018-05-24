<?php

namespace App\Http\Controllers;

use App\GestorStock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Planificacion;
use Mockery\Exception;

class PruebaController extends Controller
{
    public static function detalleLoteEnProduccion($id)
    {
       
        return view('produccion.detalleLoteEnProduccion');
    	
    }

}
