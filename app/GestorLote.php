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
            $lote=(Lote::find($ingrediente['lote_id']));
            $producto = Producto::find($lote->producto_id);

            array_push($lotes,[
                    'lote_id'=>$ingrediente['lote_id'],
                    'cantidad'=>$ingrediente['cantidad'], 
                    'fechaVencimiento'=>$lote->fechaVencimiento, 
                    'fechaInicio'=>$lote->fechaInicio,
                    'nombre'=>$producto->nombre,
                    'producto_id'=>$producto->id,
                    'tipoUnidad'=>$producto->tipoUnidad,
                    'costounitario'=>$lote->costounitario,
                //Las siguientes operaciones deben ser seguras ya que un lote solo puede consumir de otro finalizado
                    'fechaFinalizacion'=>$lote->fechaFinalizacion
                    /*
                    'cantidadElaborada'=>$lote->cantidadElaborada,
                    ,
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

public static function getProdPorLote (int $lote)
    {

        
        
        return Producto::find(Lote::where('producto_id','=',$lote)->first()->producto_id);
        

    }    





}
