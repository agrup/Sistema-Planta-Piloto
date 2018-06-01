<?php

namespace App\Http\Controllers;

use App\GestorStock;
use App\Producto;
use Carbon\Carbon;

use App\Planificacion;
use Mockery\Exception;

class PlanificacionController extends Controller
{
    public static function index()
    {
        $planificaciones = Planificacion::getSemana(Carbon::now()->format('Y-m-d'));
        return view('programaProduccionSemanal.programaProduccionSemanal',['planificaciones'=>$planificaciones]);
    	
    }

    public static function calendarioSig(){
        $fechaC = Carbon::createFromFormat('Y-m-d',request()->input('fecha'));
        $fechaC = $fechaC->startOfWeek();
        $fechaC = $fechaC->addWeek();
        $fecha = $fechaC->format('Y-m-d');
        $planificaciones = Planificacion::getSemana($fecha);
        return view('programaProduccionSemanal.programaProduccionSemanal',['planificaciones'=>$planificaciones]);
    }

    public static function calendarioAnt(){

        $fechaC = Carbon::createFromFormat('Y-m-d',request()->input('fecha'));
        $fechaC = $fechaC->startOfWeek();
        $fechaC = $fechaC->subWeek();
        $fecha = $fechaC->format('Y-m-d');
        $planificaciones = Planificacion::getSemana($fecha);
        return view('programaProduccionSemanal.programaProduccionSemanal',['planificaciones'=>$planificaciones]);
    }

    public static function show(){
        //agarro la fecha
        $fechaC = Carbon::createFromFormat('Y-m-d',request()->input('fecha'));
        $fechaC = $fechaC->startOfWeek();

        // la paso a formato yyyy-mm-dd
        $fecha = $fechaC->format('Y-m-d');

        $planificaciones = Planificacion::getSemana($fecha);

        return  view('programaProduccionSemanal.programaProduccionSemanal', ['planificaciones'=>$planificaciones]);

    }

    public static function planificacionDia(){
        $fecha =request()->input('fecha');
        if($fecha==null){
            throw new Exception('Fecha inválida');
        }
        $planificacion=Planificacion::where('fecha','=',$fecha)->first();
        $productos = Producto::getProductosSinInsumosArr();
        $insumos = Producto::all()->toArray();
        $planificaciones = [];
        array_push($planificaciones,$planificacion->toArray());
        return view('programaProduccionSemanal.planificacionProductosEInsumos',compact('planificaciones'))
            ->with(compact('productos'))
            ->with(compact('insumos'));
    }

    public static function postPlanificacionDia(){
        $fecha = request()->input('fecha');
        $insumos = request()->input('insumos');
        $productos = request()->input('productos');
        var_dump($fecha);
        var_dump($insumos);
        var_dump($productos);
        return response()->json('OK');
    }

    public static function verNecesidadInsumos(){
        $fechaHasta = request()->input('fecha');
        if($fechaHasta==null)
            throw new Exception('Fecha inválida');
        $fecha = Carbon::createFromFormat('Y-m-d',$fechaHasta);
        $necesidad =GestorStock::getNecesidadInsumos($fecha->format('Y-m-d H:i:s'));
        return view('informes.sumatoriaDeNecesidadDeInsumos',compact('necesidad'));

    }

    /**
     * Funcion que agrega un producto o insumo a una planificacion
     */
    public static function agregarProducto ()
    {
        if(($fecha  = request()->input('fecha'))==null){
            throw new Exception("Error: fecha igual a null");
        }
        $Planificacion = Planificacion::where('fecha','=',$fecha)->first();
        $movimiento_id = $Planificacion->agregarProducto(request()->input('codigo'),
                                                        request()->input('cantidad'),
                                                        request()->input('tipoTP'),
                                                        request()->input('asignatura'),
                                                        request('fecha'));
        if($movimiento_id==null){
            return response()->json('error');
        } else {
            return response()->json($movimiento_id);
        }
    }

    public static function agregarInsumo()
    {
        if(($fecha  = request()->input('fecha'))==null){
            throw new Exception("Error: Error: fecha igual a null");
        }
        $Planificacion = Planificacion::where('fecha','=',$fecha)->first();
        $movimiento_id = $Planificacion->agregarInsumo(request()->input('codigo'),
                                                        request()->input('cantidad'),
                                                        request('fecha'));
        if($movimiento_id==null){
            return response()->json('error');
        } else {
            return response()->json($movimiento_id);
        }
    }

    public static function eliminar()
    {
        if(($fecha  = request()->input('fecha'))==null){
            throw new Exception("Error: Error: fecha igual a null");
        }
        $planificacion = Planificacion::where('fecha','=',$fecha)->first();
        $planificacion->eliminarInsPro(request()->input('movimiento_id'));
        return response('OK');

    }

    public static function modificar()
    {
        if(($fecha  = request()->input('fecha'))==null){
            throw new Exception("Error: agregar prod movimiento_id null");
        }
        $Planificacion = Planificacion::where('fecha','=',$fecha)->first();
        $movimiento_id = $Planificacion->modificarInsPro(request()->input('movimiento_id'), request()->input('cantidad'));
        if($movimiento_id==null){
            return response()->json('error');
        } else {
            return response()->json($movimiento_id);
        }
    }

}
