<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Producto;


class Lote extends Model
{

    protected $guarded=[];

	public function producto(){
		return $this->belongsTo('App\Producto','producto_id')->first();
	}


    public static function getNameProdByIdLote()
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
        'tu'=>$producto->tipoUnidad,//
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
    




}
