<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Planificacion;

class PlanificacionController extends Controller
{
    public function index()
    {
        $planificaciones = Planificacion::getSemana(Carbon::now()->format('Y-m-d'));
        return view('',$planificaciones);
    	
    }

    public function show(){
        $planificaciones = [];
        setlocale(LC_TIME, 'spanish');
        Carbon::setUtf8(true);
        //agarro la fecha
        $fechaC = Carbon::createFromFormat('Y-m-d',request('fecha'));
        $fechaC = $fechaC->startOfWeek();
        //segun el sentido me muevo de semana
        if(request('sentido')=='siguiente'){
            $fechaC = $fechaC->addWeek();
        }
        if(request('sentido')=='anterior'){
            $fechaC = $fechaC->subWeek();
        }
        // la paso a formato yyyy-mm-dd
        $fecha = $fechaC->format('Y-m-d');

        $planificaciones = Planificacion::getSemana($fecha);

        return  view('', $planificaciones);

    }

}
