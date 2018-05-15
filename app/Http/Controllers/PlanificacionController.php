<?php

namespace App\Http\Controllers;

use App\GestorStock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Planificacion;
use Mockery\Exception;

class PlanificacionController extends Controller
{
    public static function index()
    {
        $fechaE=Carbon::now()->format('d-m-y');
        $planificaciones = Planificacion::getSemana(Carbon::now()->format('Y-m-d'));
        return view('programaProduccionSemanal.programaProduccionSemanal',['planificaciones'=>$planificaciones])->with('fechaE',$fechaE);
    	
    }

    public static function calendarioSig(){
        //$fechaE =Carbon::createFromFormat('d-m-Y',request()->input('fecha'));
        $fechaC = Carbon::createFromFormat('Y-m-d',request()->input('fecha'));
         $fechaE=$fechaC->format('d-m-y');
        $fechaC = $fechaC->startOfWeek();
        $fechaC = $fechaC->addWeek();
        $fecha = $fechaC->format('Y-m-d');
        $planificaciones = Planificacion::getSemana($fecha);
        return view('programaProduccionSemanal.programaProduccionSemanal',['planificaciones'=>$planificaciones])->with('fechaE',$fechaE);
    }

    public static function calendarioAnt(){
        /*$data = request()->input('fecha')
        return view()*/
        //$fechaE = Carbon::createFromFormat('d-m-Y',request()->input('fecha'));
        $fechaC = Carbon::createFromFormat('Y-m-d',request()->input('fecha'));
        $fechaE=$fechaC->format('d-m-y');
        $fechaC = $fechaC->startOfWeek();
        $fechaC = $fechaC->subWeek();
        $fecha = $fechaC->format('Y-m-d');
        $planificaciones = Planificacion::getSemana($fecha);
        return view('programaProduccionSemanal.programaProduccionSemanal',['planificaciones'=>$planificaciones])->with('fechaE',$fechaE);
    }

    public static function show(){
        $planificaciones = [];
        //agarro la fecha
        $fechaC = Carbon::createFromFormat('Y-m-d',request()->input('fecha'));
        $fechaE=$fechaC->format('d-m-y');
        $fechaC = $fechaC->startOfWeek();

        // la paso a formato yyyy-mm-dd
        $fecha = $fechaC->format('Y-m-d');

        $planificaciones = Planificacion::getSemana($fecha);

        return  view('programaProduccionSemanal.programaProduccionSemanal', ['planificaciones'=>$planificaciones])->with('fechaE',$fechaE);

    }

    public static function planificacionDia(){
        $fecha =request()->input('fecha');
        if($fecha==null){
            throw new Exception('Fecha inválida');
        }
        $planificacion=Planificacion::where('fecha','=',$fecha)->first();

        $planificaciones = [];
        array_push($planificaciones,$planificacion->toArray());
        return view('programaProduccionSemanal.planificacionProductosEInsumos',compact('planificaciones'));
    }

    public static function verNecesidadInsumos(){
        $fechaHasta = request()->input('fecha');
        if($fechaHasta==null)
            throw new Exception('Fecha inválida');
        $fecha = Carbon::createFromFormat('Y-m-d',$fechaHasta);
        $necesidad =GestorStock::getNecesidadInsumos($fecha->format('Y-m-d H:i:s'));
        return view('informes.sumatoriaDeNecesidadDeInsumos',compact('necesidad'));

    }

}
