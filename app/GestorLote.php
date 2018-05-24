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

    public static function getLotesFecha(string $fecha){
        return Lote::where('fechaInicio','=',$fecha)->get();
    }
   
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
                    'nombreProducto'=>$producto->nombre,
                    'tu'=>$producto->tipoUnidad
                    /*
                    'cantidadElaborada'=>$lote->cantidadElaborada,
                    'costoUnitario'=>$lote->costounitario,
                    'inicioMaduracion'=>$lote->fechaInicioMaduracion,
                    'finalizacion'=>$lote->fechaFinalizacion,
                    'cantidadFinal'=>$lote->cantidadFinal,
                    'proveedor'=>$lote->null,
                    'tipoTp'=>$lote->tipoTP,
                    'codigo'=>$producto->codigo,
                    'asignatura'=>$lote->null

*/
                    ]);
    	}
    return $lotes;
    }

    public static function getLoteById($id){
        return Lote::find($id);
        ;
    }

public static function getLotesPorProd (string $codigo)
    {

        return Producto::where('codigo','=',$codigo)->first()->lotes();
        

    }

public static function getProdPorLote (string $lote)
    {

        return Producto::find(Lote::where('producto_id','=',$lote)->first()->producto_id);
        

    }    


}
