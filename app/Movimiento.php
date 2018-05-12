<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{


    protected $guarded=[];



    public function planificacion(){
    	return $this->belongsTo('App\Planificacion');
}



    private $campos=['id','fecha','tipo','loteconsumidor',
        'loteingrediente','debe','haber','salgoglobal','saldolote', 'estado'
    ];
    // TODO hacer geters y seters
    /*
    public function __construct($datos)
    {
    }

*/

    /**
     * @param $producto string
     * @return Movimiento
     */
    public static function ultimoRealProd($producto_id)
    {
       return self::where('producto_id','=',$producto_id)
           ->whereRaw('tipo =' . TipoMovimiento::TIPO_MOV_CONSUMO .
               'or tipo=' . TipoMovimiento::TIPO_MOV_ENTRADA_INSUMO .
               'or tipo=' . TipoMovimiento::TIPO_MOV_CONTROL_EXISTENCIAS)
           ->orderBy('fecha','desc')
           ->first();
    }
    /**
     * @param string $idLote
     * @return Movimiento $mov
     */
    public static function ultimoRealLote($idLote)
    {

        return self::where('idLoteIngrediente','=',$idLote)
            ->whereRaw('tipo='. TipoMovimiento::TIPO_MOV_ENTRADA_INSUMO.
                            'or tipo='.TipoMovimiento::TIPO_MOV_SALIDA_VENTAS.
                            'or tipo='.TipoMovimiento::TIPO_MOV_SALIDA_EXCEP.
                            'or tipo='.TipoMovimiento::TIPO_MOV_SALIDA_DECOMISO.
                            'or tipo='.TipoMovimiento::TIPO_MOV_CONTROL_EXISTENCIAS
                            )
            ->orderBy('fecha','desc')
            ->first();

    }




    public static function getFechaUltimoReal()

    {

        

        return self::whereRaw('tipo='.TipoMovimiento::SIN_TIPO.
                            'or tipo='. TipoMovimiento::TIPO_MOV_ENTRADA_INSUMO.
                            'or tipo='.TipoMovimiento::TIPO_MOV_SALIDA_VENTAS.
                            'or tipo='.TipoMovimiento::TIPO_MOV_SALIDA_EXCEP.
                            'or tipo='.TipoMovimiento::TIPO_MOV_SALIDA_DECOMISO.
                            'or tipo='.TipoMovimiento::TIPO_MOV_CONTROL_EXISTENCIAS
                            )
                        ->orderBy('fecha','desc')
                        ->first()
                        ->fecha
                        ;


    }

/*
    const SIN_TIPO=-1;
    const TIPO_MOV_ENTRADA_INSUMO=1;
    const TIPO_MOV_SALIDA_VENTAS=2;
    const TIPO_MOV_SALIDA_EXCEP=3;
    const TIPO_MOV_SALIDA_DECOMISO = 4;
    const TIPO_MOV_CONSUMO=5;
    const TIPO_MOV_CONTROL_EXISTENCIAS = 6;
*/


   /**
     * @param int $productoId id del producto a buscar el movimiento mas viejo donde se vuelve 0

     * @return
     */

    public static function getMovsCriticos (string $fechaTope)
    {
        $arrayResult=[];
        $fechaInicio = self::getFechaUltimoReal();
        $movimientosProd= self::distinct()->select('producto_id')->get();
        foreach ($movimientosProd as $movProd){
            $mov = self::where('producto_id','=',$movProd->producto_id)
                ->where('fecha','>',$fechaInicio)
                ->where('fecha','<',$fechaTope)
                ->where('saldoGlobal','<','0')
                ->orderBy('fecha','asc')->first();
            if($mov!=null){
                array_push($arrayResult,$mov);
            }

        }

        return $arrayResult;

        //TODO Retornar MOVIMIENTO[] con los primeros movimientos criticos(los mas viejos) que tienen su saldo global < 0 para cada producto despues de la fecha del ultimo real de ese año (o fecha tope)


    }



    /**
     * @param string $idLote
     * @return Movimiento[]
     */
    public static function getTrazabilidadLote($idLote)
    {
    	return self::where('idLoteConsumidor','=',$idLote)
    				->where('idLoteIngrediente','<>',$idLote)
    				->where('tipo','=',TipoMovimiento::TIPO_MOV_CONSUMO)
    				->get();

        //recuperar todos los movientos que poseean $idLote como consumidor y tengan id de lote ingrediente diferente
        // movimientos de tipo consumo real
    }
    /**
     * @param string $producto_id
     * @param string $fechaHasta
     * @return Movimiento[]
     */
    public static function getPlanificadosProd(int $producto_id, string $fechaHasta)
    {
	return self::whereRaw(
						'producto_id= '.$producto_id.
						'and (tipo =' . TipoMovimiento::TIPO_MOV_ENTRADA_INSUMO_PLANIF .
                        'or tipo=' . TipoMovimiento::TIPO_MOV_ENTRADA_PRODUCTO_PLANIF .
                        'or tipo=' . TipoMovimiento::TIPO_MOV_CONSUMO_PLANIF.')'
                        )
				->where('fecha','<',$fechaHasta)
				->orderBy('fecha','asc')
				->get();
        //Recuperar los movimientos planificados de ese producto hata la fecha indicada
        //IMPORTANTE: solo los que no sean de tipo CUMPLIDO o INCUMPLIDO ver TipoMovimiento
        //Es decir los que posean el tipo:
        //TIPO_MOV_ENTRADA_INSUMO_PLANIF o TIPO_MOV_ENTRADA_PRODUCTO_PLANIF o TIPO_MOV_CONSUMO_PLANIF
        //devolver el array de movimientos Ordenado cronológicamente
    }


    public static function getAnteriorRealProd(int $producto_id, string $fecha){
        return(self::where('producto_id','=',$producto_id)
            ->where('fecha','<',$fecha)
            ->whereRaw('tipo='. TipoMovimiento::TIPO_MOV_ENTRADA_INSUMO.
                'or tipo='.TipoMovimiento::TIPO_MOV_SALIDA_VENTAS.
                'or tipo='.TipoMovimiento::TIPO_MOV_SALIDA_EXCEP.
                'or tipo='.TipoMovimiento::TIPO_MOV_SALIDA_DECOMISO.
                'or tipo='.TipoMovimiento::TIPO_MOV_CONTROL_EXISTENCIAS
            )
            ->orderBy('fecha','desc')
            ->first()
        );
    }
    /**
     * @param string $producto_id
     * @param string $fecha
     * @return Movimiento
     */

    //Ultimo movimiento real del id producto anterior a una fecha
    public static function getAnteriorProd(int $producto_id, string $fecha)
    {


    	return(self::where('producto_id','=',$producto_id)
			    		->where('fecha','<',$fecha)
			    		->orderBy('fecha','desc')
			    		->first()
			    		);


    }
    /**
     * @param string $idLoteIngrediente
     * @param string $fecha
     * @return Movimiento
     */
    public static function getAnteriorLote($idLoteIngrediente, $fecha)
    {
        return(self::where('idLoteIngrediente','=',$idLoteIngrediente)
            ->where('fecha','<',$fecha)
            ->whereRaw('tipo='. TipoMovimiento::TIPO_MOV_ENTRADA_INSUMO.
                'or tipo='.TipoMovimiento::TIPO_MOV_SALIDA_VENTAS.
                'or tipo='.TipoMovimiento::TIPO_MOV_SALIDA_EXCEP.
                'or tipo='.TipoMovimiento::TIPO_MOV_SALIDA_DECOMISO.
                'or tipo='.TipoMovimiento::TIPO_MOV_CONTROL_EXISTENCIAS
            )
            ->orderBy('fecha','desc')
            ->first()
        );
    }
    /**
     * @param $producto_id
     * @param $fechaCambio
     * @return Movimiento[] $movimientos
     */
    public static function getMovimientosProdDespuesDe($producto_id, $fechaCambio)
    {
        //real
        //Ordenados por favooor
    }
    /**
     * @param string $producto_id
     * @param string $fecha
     *
     */




    public static function eliminarEntradaInsumoPlanif($producto_id, $fecha)
    {
    }
    /**
     * @param string $idLote/
     * @param string $fecha
     */
    public static function eliminarEntradaProductoPlanif($idLote, $fecha)
    {

    }
    /**
     * @param string $idLoteConsumidor
     * @param string $fecha
     */
    public static function eliminarConsumosPlanificados($idLoteConsumidor, $fecha)
    {
        //eliminar todos los insumos planificados de tipo consumo con ese lote como consumidor
    }
    /**
     * @param string $fechaDesde
     * @param string $fechaHasta
     * @return Movimiento[]
     */
    public static function getSalidasVenta(string $fechaDesde, string $fechaHasta)
    {
    }
    /**
     * @param string $fechaHasta
     * @return Movimiento[]

     *
     * devolver los ultimos movimientos hasta la fecha para cada producto.
     *   incluir planificados
     */
    public static function ultimoStockProdTodos(string $fechaHasta)
    {
        $result = [];
        $productosid = self::distinct()->select('producto_id')->get();
        foreach ($productosid as $producto) {
            if (($aux = self::getAnteriorProd($producto->producto_id, $fechaHasta)) != null) {
                $result[] = $aux;
            }
        }
        return $result;
    }
        public static function ultimoStockRealProdTodos($fechaHasta)
    {
        $result = [];
        $movProductos = self::distinct()->select('producto_id')->get();
        foreach ($movProductos as $movProducto) {
            if (($aux = self::ultimoRealProd($movProducto->producto_id)) != null) {
                $result[] = $aux;
            }
        }
        return $result;

    }



}

