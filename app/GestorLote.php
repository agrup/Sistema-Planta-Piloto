<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GestorLote extends Model
{
    /**
    *@param $int[] //  $idLoteProducto es un array de lotes de productos con id y cantidad
    *@return $lote [] // array con los lotes de insumos para ese producto
   */
    //
   
    public static function getLotes(int[] $ingredientes)
    {
    	$lote=[];
    	foreach ($ingredientes as $ingrediente) {
    		$lote=[$ingrediente->
    	}


    	return 
    }
}
