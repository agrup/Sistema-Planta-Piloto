<?php


namespace App;

use Carbon\Carbon;
use Eloquent;
use Exception;
use Illuminate\Database\Eloquent\Model;

/**
 * Movimiento
 * @mixin Eloquent
 *
 * */
class Movimiento extends Model
{


    const FECHA_FICTICIA = '1994-06-12 00:00:01';
    const FORMATO_FECHA = 'Y-m-d H:i:s';
    protected $guarded=[];

    public static function getConsumoPlanif(int $idLoteConsumidor, int $producto_id)
    {
        return Movimiento::where('idLoteConsumidor','=',$idLoteConsumidor)
                            ->where('producto_id','=',$producto_id)
                            ->where('tipo','=',TipoMovimiento::TIPO_MOV_CONSUMO_PLANIF)
                            ->first();
    }

    public static function eliminarMovsPlanificados(int $planificacion_id)
    {
        if($planificacion_id==null){
            throw new Exception('planificacion id null');
        }
        self::where('planificacion_id','=',$planificacion_id)
            ->where('tipo','=',TipoMovimiento::TIPO_MOV_ENTRADA_PRODUCTO_PLANIF)
            ->delete();
        self::where('planificacion_id','=',$planificacion_id)
            ->where('tipo','=',TipoMovimiento::TIPO_MOV_CONSUMO_PLANIF)
            ->delete();
        self::where('planificacion_id','=',$planificacion_id)
            ->where('tipo','=',TipoMovimiento::TIPO_MOV_ENTRADA_INSUMO_PLANIF)
            ->delete();
    }




    public function planificacion(){
    	return $this->belongsTo('App\Planificacion');
    }


    /**
     *
     * @param int $producto_id
     * @return Movimiento
     */
    public static function ultimoRealProd($producto_id)
    {
       return self::whereIn('tipo',TipoMovimiento::reales())
           ->where('producto_id',$producto_id)
           ->orderBy('fecha', 'desc')
           ->first();
    }
    /**
     * @param string $idLote
     * @return Movimiento $mov
     */
    public static function ultimoRealLote($idLote)
    {

        return self::whereIn('tipo',TipoMovimiento::reales())
                    ->where('idLoteIngrediente','=',$idLote)
                    ->orderBy('fecha','desc')
                    ->first();

    }




    public static function getFechaUltimoReal()
    {
        return self::whereIn('tipo',TipoMovimiento::reales())
                        ->orderBy('fecha','desc')
                        ->first()
                        ->fecha;
    }


    /**
     * Devuelve los primeros movimientos criticos de cada producto limitandose a la fecha tope.
     * Un Movimiento Critico es aquel que tiene su saldo global <0.
     * @param string $fechaTope
     * @return array
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
                ->where('tipo','=',TipoMovimiento::TIPO_MOV_CONSUMO_PLANIF)
                ->orderBy('fecha','asc')
                ->first();
            if($mov!=null){
                array_push($arrayResult,$mov);
            }

        }
        return $arrayResult;
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
	return self::whereIn('tipo',TipoMovimiento::planificadosPendientes())
                ->where('producto_id',$producto_id)
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
        return(self::whereIn('tipo',TipoMovimiento::reales())
            ->where('producto_id','=',$producto_id)
            ->where('fecha','<',$fecha)
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

        return(self::whereIn('tipo',TipoMovimiento::reales())
            ->where('idLoteIngrediente','=',$idLoteIngrediente)
            ->where('fecha','<',$fecha)
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

        return Movimiento::whereIn('tipo',TipoMovimiento::reales())
                ->where('producto_id','=',$producto_id)
                ->where('fecha','>=',$fechaCambio)
                ->orderBy('fecha','asc');

        //movimientos reales
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
     * @param int $movimiento_id
     */
    public static function eliminarEntradaProductoPlanif(int $movimiento_id)
    {
        Movimiento::find($movimiento_id)->delete();
    }
    /**
     * @param int $idLoteConsumidor
     */
    public static function eliminarConsumosPlanificados($idLoteConsumidor)
    {
        Movimiento::where('idLoteConsumidor','=',$idLoteConsumidor)
            ->where('tipo','=',TipoMovimiento::TIPO_MOV_CONSUMO_PLANIF)->delete();
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
                array_push($result,$aux);
                //$result[] = $aux;
            }

        }
        return $result;

    }


    public static function ultimoStockRealProdTodosHasta(string $fechaHasta)
    {
        $result = [];
        $productosid = self::distinct()->select('producto_id')->get();
        foreach ($productosid as $producto) {
            if (($aux = self::getAnteriorRealProd($producto->producto_id, $fechaHasta)) != null) {
                array_push($result,$aux);
                //$result[] = $aux;
            }

        }
        return $result;

    }



    
        public static function ultimoStockRealProdTodos()
    {
        $result = [];
        $movProductos = self::distinct()->select('producto_id')->get();
        foreach ($movProductos as $movProducto) {
            if (($aux = self::ultimoRealProd($movProducto->producto_id)) != null) {
                array_push($result,$aux);
            }
        }
        return $result;

    }

    /**
     * Crea un movimiento real de entrada de insumo para el producto
     * en una fecha ficticia vieja, con stock 0
     * @param int $producto_id
     */
    public static function crearUltimoRealFicticio(int $producto_id)
    {
        $datosMov = [
        'producto_id'=>$producto_id,
        'fecha'=>self::FECHA_FICTICIA,
        'tipo'=>TipoMovimiento::TIPO_MOV_ENTRADA_INSUMO,
        'idLoteConsumidor'=>null,
        'idLoteIngrediente'=>null,
        'debe'=>0,
        'haber'=>0,
        'saldoGlobal'=>0, //
        'saldoLote'=>null,
        'planificacion_id'=>null
        ];
        self::create($datosMov);
    }

    /**
     * Funcion que modifica un movimento de tipo Consumo planificado,
     * no chekea que sea de tipo consumo_planificado
     * @param int $idLoteConsumidor
     * @param int $producto_id
     * @param double $cantConsumo
     * @throws Exception si no se encuentra el consumo
     */
    public static function modificarConsumoPlanificado(int $idLoteConsumidor, int $producto_id , double $cantConsumo)
    {
        $mov = Movimiento::where('idLoteConsumidor','=',$idLoteConsumidor)
            ->where('producto_id','=',$producto_id)
            ->limit(1);
        if($mov == null || $mov->count()==0){
            throw new Exception('Consumo no encontrado');
        }
        $mov->debe=$cantConsumo;
        $mov->save();
    }

    public static function getEntradaPlanificada($idLote)
    {
        return Movimiento::where('tipo','=',TipoMovimiento::TIPO_MOV_ENTRADA_PRODUCTO_PLANIF)
                    ->where('idLoteConsumidor')
                    ->first();
    }

    public static function getEntradaInsumoPlanificada($idProducto, $fecha)
    {
        $fechaStr = Carbon::createFromFormat('Y-m-d H:i:s',$fecha)->format('Y-m-d');
        $fechaMin = $fechaStr ." ". '00:00:00';
        $fechaMax = $fechaStr . " ". '23:59:59';
        return Movimiento::where('producto_id','=',$idProducto)
                        ->where('fecha','>',$fechaMin)
                        ->where('fecha','<',$fechaMax)
                        ->where('tipo','=',TipoMovimiento::TIPO_MOV_ENTRADA_INSUMO_PLANIF)
                        ->first();
    }

    /**
     * Elimina los consumos de ese lote_id y devuelve el planificacion_id si corresponde, sino null
     * @param int $lote_id
     */
    public static function eliminarConsumos(int $lote_id)
    {
        Movimiento::where('idLoteConsumidor','=',$lote_id)
            ->where('tipo','=',TipoMovimiento::TIPO_MOV_CONSUMO)
            ->delete();
    }

}

