<?php

namespace App\Http\Controllers;

use App\Lote;
use App\GestorLote;
use App\Producto;
use App\TipoLote;
use App\GestorStock;

class LotesController extends Controller
{
    public function index()
    {
    	$lotes= Lote::ALL();
    	 return view('lotes.index',compact('lotes'));
    }

    public function show()
    {
        $codigo=request()->input('codigo');
        $producto=Producto::where('codigo','=',$codigo)->first();
        $lotes=Producto::showLotesSinPlanifByProd($codigo);
        $lote=['nombre'=>$producto->nombre,'tipoUnidad'=>$producto->tipoUnidad,'lotes'=>$lotes];


		return view('informes.verLotes',compact('lote'));
    }

    public function showDetalle()
    {
        $lote=request()->input('lote');
        $detalle =Lote::find($lote)->toArray();
        $aux=GestorLote::getTrazabilidadLote($lote);
        $detalle['detalleElaboracion']=$aux;
        //trar trazabilidad y guardalo en detalleElaboracion
        //y dettale del lote que muestro la trazabilidad
        return view('informes.detalleLote',compact('detalle'));
    }

public static function showentradaLoteInsumo()
{
    $insumos= Producto::all();
    return view('gestionDeStock.entradaInsumo',compact('insumos'));
}

    public static function alta()
    {
        $producto_id=request()->input('id');
        $cantidad =request()->input('cantidadElaborada');

        $lote = [
            'cantidadElaborada' => $cantidad,
            'fechaInicio' => request()->input('fechaInicio'),
            'fechaVencimiento' =>request()->input('fechaVencimiento'),
            'costounitario' => request()->input('costounitario'),
            'producto_id'=>$producto_id,
            'tipoLote'=>TipoLote::INSUMO
        ];

        $lote=Lote::create($lote);
            // se concatena la horasminseg del momento a la fecha para crear el timestamp que requieren los movimientos
            $H_i_s = date('H:i:s');
            $fechaStamp = request()->input('fechaInicio') . " ". $H_i_s;
        GestorStock::entradaInsumo($lote->id,$producto_id,$cantidad,$fechaStamp);//,id lote, id producto, cantidad , fecha
        $insumos= Producto::all();
        return view('gestionDeStock.entradaInsumo',compact('insumos'))
                                        ->with(['succes'=>true])->withSuccess('Alta Exitosa');
    }

    public static function showControlExist(){

        $tipoUnidades = Producto::tipoUnidadesTodas();
        $productos= Producto::all();
        return view('gestionDeStock.controlExistencias')->with(compact('tipoUnidades'));
    }

    public static function saveControlExist(){

        $lote_id = request()->input('lote_id');
        $cantidadObservada = request()->input('cantidadObservada');
        $tipoUnidad = request()->input('tipoUnidad');

        $lote = Lote::find(request()->input('lote_id'));


        return \Response::json(compact($lote))->withSuccess('Alta Exitosa');    

    }

}
