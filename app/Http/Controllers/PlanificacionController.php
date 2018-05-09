<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Planificacion;

class PlanificacionController extends Controller
{
    public function index()
    {
    	
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
        // si no hay planificaciones creadas, se crean
        if(Planificacion::where('fecha','=',$fecha)->count()==0){
            $planificaciones=Planificacion::crearSemana($fecha);
        } else {
            $planificaciones=Planificacion::getSemana($fecha);
           /*$planificaciones=Planificacion::whereRaw('fecha>=' . $fecha .
               'and fecha<=' .
               $fechaC->addDays(4)->format('Y-m-d'));*/
        }

        return  view('', $planificaciones);

    }

}
