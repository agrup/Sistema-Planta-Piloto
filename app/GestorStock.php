<?php


namespace App;
use App\TipoMovimiento;
use App\Movimiento;
use App\DetalleSalida;
use App\Producto;
use Carbon\Carbon;
use Exception;
use InvalidArgumentException;

/**
 * @author brujua
 * @version 1.0
 * @created 22-abr.-2018 3:19:29 a. m.
 */

class GestorStock
{

    // MOVIMIENTOS DE ENTRADA
    //REALES
    /**
     *
     * @param string $idLote
     * @param int $idProducto
     * @param float $cantidad
     * @param string $fecha
     *
     */
    public static function entradaInsumoProducto(string $idLote, int $idProducto, float $cantidad, string $fecha)
    {
        $banderaRecalcular = false;
        $ultimoMovReal=Movimiento::ultimoRealProd($idProducto);
        $movAnterior = $ultimoMovReal;
        //Compruebo si estoy insertando antes del ultimo mov de ese producto
        if($ultimoMovReal->fecha > $fecha){
            //si es asi, recupero el mov anterior a este y deberé recalcular
            $movAnterior = Movimiento::getAnteriorProd($idProducto,$fecha);
            $banderaRecalcular=true;
        }
        $datosNuevoMov = [
            'producto_id'=>$idProducto,
            'fecha'=>$fecha,
            'tipo'=>TipoMovimiento::TIPO_MOV_ENTRADA_INSUMO,
            'idLoteConsumidor'=>$idLote,
            'idLoteIngrediente'=>$idLote,
            'debe'=>0,
            'haber'=>$cantidad,
            'saldoGlobal'=>($movAnterior->saldoGlobal+$cantidad), // cantidad nueva es la anterior mas lo que agrega la llegada
            'saldoLote'=>$cantidad
        ];

        $nuevoMov = Movimiento::create($datosNuevoMov); //puede que no ande, que haya que hacer ->get();

        if($banderaRecalcular){
            self::recalcularStockReal($nuevoMov);
        }
    }
    //PLANIFICADOS



    public static function entradaInsumoPlanificado(int $idProducto, float $cantidad, string $fecha, int $planificacion_id)

    {
        // si no posee un stock real crearlo con 0 en una fecha que no moleste debido a que se necesita para iniciar el recalculo de las planificaciones
        if(Movimiento::ultimoRealProd($idProducto)->count()==0){
            Movimiento::crearUltimoRealFicticio($idProducto);
        }
        //No deben existir mas de una entrada de insumo planificada para un mismo dia
        //debido a que los planificados se recalculan cada vez que se quiere saber algo de ellos,
        // simplemente inserto el mov sin calcular nada.
        $datosNuevoMov = [
            'producto_id'=>$idProducto,
            'fecha'=>$fecha,
            'tipo'=>TipoMovimiento::TIPO_MOV_ENTRADA_INSUMO_PLANIF,
            'idLoteConsumidor'=>null,
            'idLoteIngrediente'=>null,
            'debe'=>0,
            'haber'=>$cantidad,
            'saldoGlobal'=>null, // cantidad nueva es la anterior mas lo que agrega la llegada
            'saldoLote'=>$cantidad,
            'planificacion_id'=>$planificacion_id
        ];
        $mov=Movimiento::create($datosNuevoMov);
        return $mov;
    }

    /**
     * Modifica la cantidad de insumo que se planifica como entrada
     * @param $movimiento_id
     * @param $cantidad
     * @throws Exception si el mov no existe o es del tipo incorrecto
     */
    public static function modificarEntradaInsumoPlanif($movimiento_id, $cantidad)
    {
        $mov = Movimiento::find($movimiento_id);
        if($mov==null){
            throw new Exception('Movimiento no encontrado');
        }
        if($mov->tipo != TipoMovimiento::TIPO_MOV_ENTRADA_INSUMO_PLANIF){
            throw new Exception('Movimiento de tipo incorrecto');
        }
        $mov->haber = $cantidad;
        $mov->save();
    }

    public static function eliminarEntradaInsumoPlanificado(int $idProducto, string $fecha)

    {
        //No deben existir mas de una entrada de insumo planificada para un mismo dia
        Movimiento::eliminarEntradaInsumoPlanif($idProducto,$fecha);
    }


    public static function entradaProductoPlanificado(string $idLote, int $idProducto, float $cantidad, string $fecha, int $planificacion_id ){

        $producto = Producto::find($idProducto);
        //Doy de alta los consumos
        $ingredientes = $producto->getIngredientes();
        foreach ($ingredientes as $ing){
            //regla de 3 simple segun la formulación
            $cantConsumo = $cantidad * $ing['cantidadProducto'] / $ing['cantidad'];
            GestorStock::altaConsumoPlanificado($idLote, $ing['id'], $cantConsumo, $fecha );
        }


        // si no posee un stock real crearlo con 0 en una fecha que no moleste debido a que se necesita para iniciar el recalculo de las planificaciones
        if(Movimiento::ultimoRealProd($idProducto)->count()==0){
            Movimiento::crearUltimoRealFicticio($idProducto);
        }

        //debido a que los planificados se recalculan cada vez que se quiere saber algo de ellos,
        // simplemente inserto el mov sin calcular nada.
        $datosNuevoMov = [
            'producto_id'=>$idProducto,
            'fecha'=>$fecha,
            'tipo'=>TipoMovimiento::TIPO_MOV_ENTRADA_INSUMO_PLANIF,
            'idLoteConsumidor'=>$idLote,
            'idLoteIngrediente'=>$idLote,
            'debe'=>0,
            'haber'=>$cantidad,
            'saldoGlobal'=>null, //
            'saldoLote'=>$cantidad,
            'planificacion_id'=>$planificacion_id
        ];
       $mov=Movimiento::create($datosNuevoMov);
       return $mov;
    }

    public static function modificarEntradaProductoPlanif($movimiento_id, $cantidad)
    {
        $movPadre = Movimiento::find($movimiento_id);
        $producto = Producto::find($movPadre->producto_id);
        //actualizo los consumos
        $ingredientes = $producto->getIngredientes();
        foreach ($ingredientes as $ing){
            //regla de 3 simple segun la formulación
            $cantConsumo = $cantidad * $ing['cantidadProducto'] / $ing['cantidad'];
            Movimiento::modificarConsumoPlanificado($movPadre->idLoteConsumidor, $ing['id'], $cantConsumo);
        }
        $movPadre->haber = $cantidad;
        $movPadre->save();
    }

    /**
     * Elimina todos los consumos planificados asociados a este movimiento y el movimiento mismo
     *
     * @param int $movimiento_id
     * @throws Exception si no existe el movimiento o si el tipo es incorrecto.
     */
    public static function eliminarEntradaProductoPlanificado(int $movimiento_id)
    {
        $movPadre = Movimiento::find($movimiento_id);
        if($movPadre==null){
            throw new Exception('Movimiento no encontrado');
        }
        if($movPadre->tipo != TipoMovimiento::TIPO_MOV_ENTRADA_PRODUCTO_PLANIF){
            throw new Exception('Movimiento de tipo incorrecto');
        }
        Movimiento::eliminarConsumosPlanificados($movPadre->idLoteConsumidor);
        Movimiento::eliminarEntradaProductoPlanif($movimiento_id);
    }
    /**
     *
     * @param string $idLote
     * @param int $idProducto
     * @param float $cantidadObsrv
     * @param string $fecha
     */
    public static function controlarExistencia(string $idLote, int $idProducto, float $cantidadObsrv, string $fecha)
    {
        $banderaRecalcular = false;
        $ultimoMovReal=Movimiento::ultimoRealProd($idProducto);
        $ultiMovLote=Movimiento::ultimoRealLote($idLote);
        $movAnteriorProd = $ultimoMovReal;
        //Compruebo si estoy insertando antes del ultimo mov de ese producto
        if($ultimoMovReal->fecha>$fecha){
            //si es asi, recupero el mov anterior a este y deberé recalcular
            $movAnteriorProd = Movimiento::getAnteriorProd($idProducto,$fecha);
            $banderaRecalcular=true;
        }
        //Compruebo si estoy insertando antes del ultimo mov de ese lote
        if($ultiMovLote->fecha>$fecha){
            //si es asi, deberé recalcular
            $banderaRecalcular=true;
        }
        // Ajusto el saldo global la diferencia entre la cantidad anterior y la observada
        $diferencia = $cantidadObsrv - $ultiMovLote->saldoLote;
        //calculo debe y haber
        if($diferencia>0){
            $haber = $diferencia;
            $debe = 0;
        } else {
            $debe = abs($diferencia);
            $haber = 0;
        }

        $nuevoSaldoGlobal = $movAnteriorProd->saldoGlobal+ $debe - $haber;



        $datosNuevoMov = [
            'producto_id'=>$idProducto,
            'fecha'=>$fecha,
            'tipo'=>TipoMovimiento::TIPO_MOV_CONTROL_EXISTENCIAS,
            'idLoteConsumidor'=>$idLote,
            'idLoteIngrediente'=>$idLote,
            'debe'=>$debe,
            'haber'=>$haber,
            'saldoGlobal'=>$nuevoSaldoGlobal,
            'saldoLote'=>$cantidadObsrv,
        ];

        $nuevoMov = Movimiento::create($datosNuevoMov);
        if($banderaRecalcular){
            self::recalcularStockReal($nuevoMov);
        }
        
    }
    //MOVIMIENTOS DE SALIDA
    //REALES
    /**
     *
     * @param int $idLoteConsumidor
     * @param int $idLoteIngrediente
     * @param int $idProductoIng
     * @param float $cantidad
     * @param string $fecha
     */
    public static function altaConsumo(int $idLoteConsumidor, int $idLoteIngrediente, int $idProductoIng, float $cantidad, string $fecha)
    {
        $banderaRecalcular = false;
        $ultimoMovRealProd=Movimiento::ultimoRealProd($idProductoIng);
        $ultimoMovRealLote = Movimiento::ultimoRealLote($idLoteIngrediente);
        $movAnteriorProd = $ultimoMovRealProd;
        $movAnteriorLote = $ultimoMovRealLote;
        //Compruebo si estoy insertando antes del ultimo mov de ese producto
        if($ultimoMovRealProd->fecha > $fecha){
            //si es asi, recupero el mov anterior a este y deberé recalcular
            $movAnteriorProd = Movimiento::getAnteriorProd($idProductoIng,$fecha);
            $banderaRecalcular=true;
        }
        //Compruebo si estoy insertando antes del ultimo mov de ese lote
        if($ultimoMovRealLote->fecha > $fecha){
            //si es asi, recupero el mov anterior a este y deberé recalcular
            $movAnteriorLote = Movimiento::getAnteriorLote($idLoteIngrediente,$fecha);
            $banderaRecalcular=true;
        }
        $datosNuevoMov = [
            'producto_id'=>$idProductoIng,
            'fecha'=>$fecha,
            'tipo'=>TipoMovimiento::TIPO_MOV_CONSUMO,
            'idLoteConsumidor'=>$idLoteConsumidor,
            'idLoteIngrediente'=>$idLoteIngrediente,
            'debe'=>$cantidad,
            'haber'=>0,
            'saldoGlobal'=>$movAnteriorProd->saldoGlobal - $cantidad, // cantidad nueva es la anterior menos consumo
            'saldoLote'=>$movAnteriorLote->saldoLote - $cantidad
        ];
        $nuevoMov = Movimiento::create($datosNuevoMov);
        if($banderaRecalcular){
            self::recalcularStockReal($nuevoMov);
        }

    }
    /**
     *
     * @param string $idLote
     * @param int $idProducto
     * @param float $cantidad
     * @param string $fecha
     * @param String $motivo
     * @param string $detalle
     * @parm string tipo
     */
    public static function salidaExcepcional(string $idLote, int $idProducto, float $cantidad, string $fecha, String $motivo, String $detalle )
    {
        $banderaRecalcular = false;
        $ultimoMovRealProd=Movimiento::ultimoRealProd($idProducto);
        $ultimoMovRealLote=Movimiento::ultimoRealLote($idLote);
        if(is_null($ultimoMovRealLote)||is_null($ultimoMovRealProd)){
            throw new InvalidArgumentException("No hay movimientos anteriores para ese lote o producto");
        }
        $movAnteriorProd = $ultimoMovRealProd;
        $movAnteriorLote = $ultimoMovRealLote;
        //Compruebo si estoy insertando antes del ultimo mov de ese producto
        if($ultimoMovRealProd->fecha>$fecha){
            //si es asi, recupero el mov anterior a este y deberé recalcular
            $movAnteriorProd = Movimiento::getAnteriorProd($idProducto,$fecha);
            $banderaRecalcular=true;
        }
        //Compruebo si estoy insertando antes del ultimo mov de ese lote
        if($ultimoMovRealLote->fecha>$fecha){
            //si es asi, recupero el mov anterior a este y deberé recalcular
            $movAnteriorLote = Movimiento::getAnteriorLote($idLote,$fecha);
            $banderaRecalcular=true;
        }
        $datosNuevoMov = [
            'producto_id'=>$idProducto,
            'fecha'=>$fecha,
            'tipo'=>TipoMovimiento::TIPO_MOV_SALIDA_EXCEP,
            'idLoteConsumidor'=>$idLote,
            'idLoteIngrediente'=>$idLote,
            'debe'=>$cantidad,
            'haber'=>0,
            // cantidad nueva es la anterior menos la salida
            'saldoglobal'=>($movAnteriorProd->saldoGlobal - $cantidad),
            // descuento el saldo del lote restando del saldo anterior
            'saldolote'=>($movAnteriorLote->saldoLote - $cantidad)
        ];
        $nuevoMov = Movimiento::create($datosNuevoMov);
        //agrego la entrada en salida detalle
        $datosSalidaExcep=[
            'movimiento_id'=>$nuevoMov->id,
            'lote_id'=>$idLote,
            'fecha'=>$fecha,
            'motivo'=>$motivo,
            'detalle'=>$detalle,
            'cantidad'=>$cantidad
        ];
        $salida = DetalleSalida::create($datosSalidaExcep);
        //De ser necesario recalculo.
        if($banderaRecalcular){
            self::recalcularStockReal($nuevoMov);
        }
    }
    /**
     *
     * @param string $idLote
     * @param int $idProducto
     * @param float $cantidad
     * @param string $fecha
     */
    public static function salidaVentas(string $idLote, int $idProducto, float $cantidad, string $fecha)
    {
        $banderaRecalcular = false;
        $ultimoMovRealProd=Movimiento::ultimoRealProd($idProducto);
        $ultimoMovRealLote=Movimiento::ultimoRealLote($idLote);
        if(is_null($ultimoMovRealLote)||is_null($ultimoMovRealProd)){
            throw new InvalidArgumentException("No hay movimientos anteriores para ese lote o producto");
        }
        $movAnteriorProd = $ultimoMovRealProd;
        $movAnteriorLote = $ultimoMovRealLote;
        //Compruebo si estoy insertando antes del ultimo mov de ese producto
        if($ultimoMovRealProd->fecha>$fecha){
            //si es asi, recupero el mov anterior a este y deberé recalcular
            $movAnteriorProd = Movimiento::getAnteriorProd($idProducto,$fecha);
            $banderaRecalcular=true;
        }
        //Compruebo si estoy insertando antes del ultimo mov de ese lote
        if($ultimoMovRealLote->fecha>$fecha){
            //si es asi, recupero el mov anterior a este y deberé recalcular
            $movAnteriorLote = Movimiento::getAnteriorLote($idLote,$fecha);
            $banderaRecalcular=true;
        }
        $datosNuevoMov = [
            'producto_id'=>$idProducto,
            'fecha'=>$fecha,
            'tipo'=>TipoMovimiento::TIPO_MOV_SALIDA_VENTAS,
            'idLoteConsumidor'=>$idLote,
            'idLoteIngrediente'=>$idLote,
            'debe'=>$cantidad,
            'haber'=>0,
            // cantidad nueva es la anterior menos la salida
            'saldoglobal'=>($movAnteriorProd->saldoGlobal - $cantidad),
            // descuento el saldo del lote restando del saldo anterior
            'saldolote'=>($movAnteriorLote->saldoLote - $cantidad)
        ];
        $nuevoMov = Movimiento::create($datosNuevoMov);
        //De ser necesario recalculo.
        if($banderaRecalcular){
            self::recalcularStockReal($nuevoMov);
        }
    }
    /**
     *
     * @param string $idLote
     * @param int $idProducto
     * @param float $cantidad
     * @param String $detalle
     * @param string $fecha
     *
     */
    public static function decomisar(string $idLote, int $idProducto, float $cantidad, String $detalle, string $fecha)
    {
        $banderaRecalcular = false;
        $ultimoMovRealProd=Movimiento::ultimoRealProd($idProducto);
        $ultimoMovRealLote=Movimiento::ultimoRealLote($idLote);
        if(is_null($ultimoMovRealLote)||is_null($ultimoMovRealProd)){
            throw new InvalidArgumentException("No hay movimientos anteriores para ese lote o producto");
        }
        $movAnteriorProd = $ultimoMovRealProd;
        $movAnteriorLote = $ultimoMovRealLote;
        //Compruebo si estoy insertando antes del ultimo mov de ese producto
        if($ultimoMovRealProd->fecha>$fecha){
            //si es asi, recupero el mov anterior a este y deberé recalcular
            $movAnteriorProd = Movimiento::getAnteriorProd($idProducto,$fecha);
            $banderaRecalcular=true;
        }
        //Compruebo si estoy insertando antes del ultimo mov de ese lote
        if($ultimoMovRealLote->fecha>$fecha){
            //si es asi, recupero el mov anterior a este y deberé recalcular
            $movAnteriorLote = Movimiento::getAnteriorLote($idLote,$fecha);
            $banderaRecalcular=true;
        }
        $datosNuevoMov = [
            'producto_id'=>$idProducto,
            'fecha'=>$fecha,
            'tipo'=>TipoMovimiento::TIPO_MOV_SALIDA_DECOMISO,
            'idLoteConsumidor'=>$idLote,
            'idLoteIngrediente'=>$idLote,
            'debe'=>$cantidad,
            'haber'=>0,
            // cantidad nueva es la anterior menos la salida
            'saldoglobal'=>($movAnteriorProd->saldoGlobal - $cantidad),
            // descuento el saldo del lote restando del saldo anterior
            'saldolote'=>($movAnteriorLote->saldoLote - $cantidad)
        ];
        $nuevoMov = Movimiento::create($datosNuevoMov);
        //agrego la entrada en detalleSalida
        $datosSalidaExcep=[
            'movimiento_id'=>$nuevoMov->id,
            'lote_id'=>$idLote,
            'fecha'=>$fecha,
            'motivo'=>DetalleSalida::MOTIVO_DECOMISO,
            'detalle'=>$detalle,
            'cantidad'=>$cantidad
        ];
        $salida = DetalleSalida::create($datosSalidaExcep);
        //De ser necesario recalculo.
        if($banderaRecalcular){
            self::recalcularStockReal($nuevoMov);
        }
    }
    //PLANIFICADOS
    /**
     * @param int $idLoteConsumidor
     * @param int $idProdIng
     * @param float $cantidad
     * @param string $fecha
     * @return \Illuminate\Database\Eloquent\Model|$this
     */
    public static function altaConsumoPlanificado(int $idLoteConsumidor, int $idProdIng, float $cantidad, string $fecha)
    {

        // si no posee un stock real crearlo con 0 en una fecha que no moleste debido a que se necesita para iniciar el recalculo de las planificaciones
        if(Movimiento::ultimoRealProd($idProdIng)->count()==0){
            Movimiento::crearUltimoRealFicticio($idProdIng);
        }
        $datosNuevoMov = [
            'producto_id'=>$idProdIng,
            'fecha'=>$fecha,
            'tipo'=>TipoMovimiento::TIPO_MOV_CONSUMO_PLANIF,
            'idLoteConsumidor'=>$idLoteConsumidor,
            'idLoteIngrediente'=>null,
            'debe'=>$cantidad,
            'haber'=>0,
            'saldoGlobal'=>null,
            'saldoLote'=>null
        ];
        $nuevoMov = Movimiento::create($datosNuevoMov);
        return $nuevoMov;
    }

    //INFORMES
    public static function getSaldoLote(string $idLote)
    {
        $ultMov = Movimiento::ultimoRealLote($idLote);
        return $ultMov->saldoLote;
    }
    /**
     *
     * @param string $idLote
     * @return array de arrays de la forma ['idLote'=> , 'cantidad'=> ]
     *     */
    public static function Trazabilidad(string $idLote)
    {
        $arrayReturn = [];
        $movimientos= Movimiento::getTrazabilidadLote($idLote);
        foreach ($movimientos as $mov){
            $arrayAux=[];
            $arrayAux['lote_id']=$mov->idLoteIngrediente;
            $arrayAux['cantidad']=$mov->debe;
            array_push($arrayReturn,$arrayAux);
        }
        return $arrayReturn;
    }
    /**
     * @param string $fechaDesde
     * @param string $fechaHasta
     * @return DetalleSalida[]
     */
    public static function getSalidasExcpYdecomisos(string $fechaDesde, string $fechaHasta)
    {
        return DetalleSalida::getSalidas($fechaDesde, $fechaHasta);
    }
    /**
     * @param string $fechaDesde
     * @param string $fechaHasta
     * @return DetalleSalida[]
     */
    public static function getSalidasVentas(string $fechaDesde, string $fechaHasta)
    {
        $result = [];
        $movimientos= Movimiento::getSalidasVenta($fechaDesde, $fechaHasta);
        foreach ($movimientos as $movimiento){
            $datosSalida=[
                'movimiento_id'=>$movimiento->id,
                'lote_id'=>$movimiento->idLoteIngrediente,
                'fecha'=>$movimiento->fecha,
                'motivo'=>DetalleSalida::MOTIVO_VENTAS,
                'detalle'=>'Salida a ventas',
                'cantidad'=>$movimiento->debe
            ];
            $salida = new DetalleSalida($datosSalida);
            array_push($result,$salida);
        }
        return $result;
    }
    /**
     * @param string $fechaHasta
     * @return array [['nombre'=>,'codigo'=>, 'tu'=>, 'alarma'=>, 'stock'=>, 'producto_id'=>, ]...] hashmap key: idProducto, value: cantidad
     * Hay que evaluar si con esta funcion no alcanza ya para desde afuera calcular getNecesidadInsumos y otras por el estilo
     */
    public static function getStockPorProd(string $fechaHasta, bool $planificados)
    {
        $result=[];
        //self::recalcularPlanificados($fechaHasta);
         if(!$planificados){
                
            $movimientos =Movimiento::ultimoStockRealProdTodos($fechaHasta);


            }
        else
            {

             $movimientos =Movimiento::ultimoStockProdTodos($fechaHasta);

            }
        if(!empty($movimientos )){
            foreach ($movimientos as $movimiento){
                $arrAux=[];
                $producto=Producto::find($movimiento->producto_id);
                $stock=$movimiento->saldoGlobal;
                $arrAux['alarma']='normal';
                $arrAux['nombre']=$producto->nombre;
                $arrAux['codigo']=$producto->codigo;
                $arrAux['tipoUnidad']=$producto->tipoUnidad;
                $arrAux['stock']=$stock;
                $arrAux['producto_id']=$movimiento->producto_id;
                if($producto->alarmaActiva){
                    if($stock<$producto->alarmaAmarilla){
                        $arrAux['alarma']='amarilla';
                    }
                    if($stock<$producto->alarmaRoja){
                        $arrAux['alarma']='roja';
                    }
                }

                    array_push($result, $arrAux);
            }
                
       }
        return $result;
    }

    /**
     * @param $fechaHasta
     * @return array   de la forma
     * [
     *  'fecha'=>,
     * 'necesidades'=>[
     *      ['codigo'=>,'insumo'=>, 'necesidadFinal'=>, 'tipoUnidad'=>, 'fechaAgotamiento'=> ],
     *      [...]
     *  ],
     * 'alarmas'=>[
     *      ['codigo'=>,'insumo'=>,'cantidad'=>, 'color'=>],
     *      [...]
     *  ],
     * ]
     */

    public static function getNecesidadInsumos($fechaHasta){


        $necesidades = [];
        $alarmas =[];
        $fechaVista = Carbon::createFromFormat('Y-m-d H:i:s',$fechaHasta);
        $fechaVista = $fechaVista->format('Y-m-d');
        //primero recalculo los planificados
        self::recalcularPlanificados($fechaHasta);
        //Luego guardamos los movimientos criticos para ver la necesidad de insumos
        $movimientosC = Movimiento::getMovsCriticos($fechaHasta);
        foreach ($movimientosC as $movC){
            $arrAux=[];
            //recupero producto para guardar los datos
            $producto = Producto::find($movC->producto_id);
            //y su stock final para ver la necesidad final
            $stockFinal = self::getStockProd($movC->producto_id,$fechaHasta);
            $fechaAgot = Carbon::createFromFormat('Y-m-d H:i:s',$movC->fecha);
            //paso la fecha a yyyy/mm/dd
            $fechaAgot = $fechaAgot->format('Y-m-d');
            //armo el array
            $arrAux['codigo']=$producto->codigo;
            $arrAux['insumo']=$producto->nombre;
            $arrAux['tipoUnidad']=$producto->tipoUnidad;
            $arrAux['fechaAgotamiento']=$fechaAgot;
            //calculo la necesidad en funcion del stock final del producto a la fecha
            if($stockFinal>0){
                $necesidad = 0;
            } else {
                $necesidad = abs($stockFinal);
            }
            $arrAux['necesidadFinal']=$necesidad;
            array_push($necesidades,$arrAux);
        }
        //calculo de las alarmas
        $stocks = self::getStockPorProd($fechaHasta);
        foreach ($stocks as $stock){
            $arrAux = [];
            if($stock['alarma']!='normal'){
                $arrAux['codigo']=$stock['codigo'];
                $arrAux['insumo']=$stock['nombre'];
                $arrAux['cantidad']=$stock['stock'];
                $arrAux['tipoUnidad']=$stock['tipoUnidad'];
                $arrAux['color']=$stock['alarma'];
                array_push($alarmas,$arrAux);
            }

        }

        return ['fecha'=>$fechaVista,'necesidades'=>$necesidades,'alarmas'=>$alarmas];






    }
    //PRIVADOS
    /**
     * @param Movimiento $movimientoDesde
     */
    private static function recalcularStockReal(Movimiento $movimientoDesde)
    {

        $movimientos = Movimiento::getMovimientosProdDespuesDe($movimientoDesde->producto_id,$movimientoDesde->fecha);

        $movAnteriorProd = $movimientoDesde;
        $movAnteriorLote= $movimientoDesde;
        foreach ($movimientos as $movimiento) {

            $debe = $movimiento->debe;
            $haber = $movimiento->haber;


            //si es movimiento del lote recalculo saldoLote
            if ($movimiento->idLoteIngrediente == $movimientoDesde->idLoteIngrediente) {

                $nuevoSaldoLote = $movAnteriorLote->saldoLote + $haber - $debe;

                $movimiento->saldoLote = $nuevoSaldoLote;
                //actualizo para la próxima iteración
                $movAnteriorLote = $movimiento;
            }


            $nuevoSaldoGlobal = $movAnteriorProd->saldoGlobal + $haber - $debe;

            $movimiento->saldoGlobal = $nuevoSaldoGlobal;
            //guardo
            $movimiento->save();
            //actualizo para la próxima iteración
            $movAnteriorProd = $movimiento;
        }
    }
    private static function recalcularPlanificados($fechaHasta)
    {
        //Guardo el ultimo mov de cada producto, ya que el recalculo se hará por cada producto
        $movimientosInicialesProducto = Movimiento::ultimoStockRealProdTodos();
        //Por cada producto
        foreach ($movimientosInicialesProducto as $ultMovRealProd){
            //Tomo el ultimo movimiento
            $producto = $ultMovRealProd->producto_id;
            $movAnteriorProd =$ultMovRealProd;
            $planificacionesProd = Movimiento::getPlanificadosProd($producto,$fechaHasta);
            //itero para todas las planificaciones de este producto
            foreach ($planificacionesProd as $planif){

                //si la planificacion es anterior al ultimo mov debo darla como Incumplido
                if($planif->fecha < $movAnteriorProd->fecha) {
                    $planif->tipo = TipoMovimiento::incumplidoDe($planif->tipo);
                } else {
                    //sino recalculo
                    $debe = $planif->debe;
                    $haber = $planif->haber;
                    $nuevoSaldoG = $movAnteriorProd->saldoGlobal + $haber - $debe;
                    $planif->saldoGlobal = $nuevoSaldoG;
                }
                $planif->save();
                //actualizo para la proxima iteracion
                $movAnteriorProd = $planif;
            }
        }
    }

    /**
     * @param int $producto_id
     * @param string $fechaHasta
     * @return $float
     */
    public static function getStockProd($producto_id, $fechaHasta)
    {
        $mov=Movimiento::getAnteriorProd($producto_id,$fechaHasta);
        return $mov->saldoGlobal;
    }




}
