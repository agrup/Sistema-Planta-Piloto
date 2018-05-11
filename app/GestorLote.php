<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\GestorStock;
use App\Lote;
use App\Producto;

class GestorLote extends Model
{
    /**
    *@param $int[] //  $idLoteProducto es un array de lotes de productos con id y cantidad
    *@return $lote [] // array con los lotes de insumos para ese producto
   */
    //
   
    public static function getTrazabilidadLote(int $idLote)
    {
        $ingredientes = GestorStock::Trazabilidad($idLote);
        $lotes=[];
    	
    	foreach ($ingredientes as $ingrediente) {
            $lote=(Lote::find($ingrediente['idLote']));
            $producto = Producto::find($lote->producto_id);
            array_push($lotes,[
                    'numeroLote'=>$ingrediente['idLote'],
                    'cantidad'=>$ingrediente['cantidad'], 
                    'vencimiento'=>$lote->fechaVencimiento, 
                    'fechaInicio'=>$lote->fechaInicio,
                    'producto'=>$producto->nombre,
                    'tu'=>$producto->tipoUnidad
                    ]);
    	}
    return $lotes;
    }




}
