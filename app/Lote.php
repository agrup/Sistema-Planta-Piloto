<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use App\Producto;

/**
 * Lote
 * @mixin Eloquent
 *
 * */

class Lote extends Model
{

    protected $guarded=[];

    /**
     * @param array $datos
     * @return $this|Model
     */
    public static function crearLoteNoPlanificado(array $datos)
    {
        $datosLote=[
            'producto_id'=>$datos['producto_id'],
            'tipoLote'=>TipoLote::INICIADO,
            'fechaInicio'=>$datos['fechaInicio'],
            'cantidadElaborada'=>$datos['cantidadElaborada'],
            'tipoTP'=>$datos['tipoTP'],
        ];
        if($datos['tipoTP']){
            $datosLote['asignatura'] = $datos['asignatura'];
        }
        return Lote::create($datosLote);
    }


    public function producto(){
		return $this->belongsTo('App\Producto','producto_id')->first();
	}


    public function getNameProd()
    {
        return (Producto::find($this->producto_id))->nombre;
    }
	public function toArray()
	{

        $producto = Producto::find($this->producto_id);
		return[
        'numeroLote'=>$this->id,//
        'cantidad'=>GestorStock::getSaldoLote($this->id), //
        'vencimiento'=>$this->fechaVencimiento, //
        'fechaInicio'=>$this->fechaInicio,//
        'nombreProducto'=>$producto->nombre,//
        'tipoUnidad'=>$producto->tipoUnidad,//
        'cantidadElaborada'=>$this->cantidadElaborada,//
        'costoUnitario'=>$this->costoUnitario,//
        'inicioMaduracion'=>$this->fechaInicioMaduracion,//
        'finalizacion'=>$this->fechaFinalizacion,//
        'cantidadFinal'=>$this->cantidadFinal,//
        'proveedor'=>null,//
        'tipoTp'=>$this->tipoTP,//
        'codigo'=>$producto->codigo,//
        'asignatura'=>null//
        ]	;

	}


    /**
     * Elimina un lote
     * @param int $idLote
     */
    public static function eliminarLote(int $idLote)
    {
        $lote=null;
        if(($lote=Lote::find($idLote))!=null){
            $lote->delete();
        }

    }


}
