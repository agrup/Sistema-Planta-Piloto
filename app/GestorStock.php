<?php

namespace App;
use App\TipoMovimiento;
use App\Movimiento;
use App\DetalleSalida;
use App\Producto;
use InvalidArgumentException;

/**
 * @author brujua
 * @version 1.0
 * @created 22-abr.-2018 3:19:29 a. m.
 */

class GestorStock
{



    function __construct()
    {
    }



    function __destruct()
    {
    }



    // MOVIMIENTOS DE ENTRADA
    //REALES

    /**
     *
     * @param string $idLote
     * @param int $idProducto
     * @param double $cantidad
     * @param string $fecha
     *
     */
    public static function entradaInsumoProducto(string $idLote, int $idProducto, double $cantidad, string $fecha)
    {
        $banderaRecalcular = false;
        $ultimoMovReal=Movimiento::ultimoRealProd($idProducto);
        $movAnterior = $ultimoMovReal;

        //Compruebo si estoy insertando antes del ultimo mov de ese producto
        if($ultimoMovReal->getFecha()>$fecha){
            //si es asi, recupero el mov anterior a este y deberé recalcular
            $movAnterior = Movimiento::getAnteriorProd($idProducto,$fecha);
            $banderaRecalcular=true;
        }

        $datosNuevoMov = [
            'producto'=>$idProducto,
            'fecha'=>$fecha,
            'tipo'=>TipoMovimiento::TIPO_MOV_ENTRADA_INSUMO,
            'loteConsumidor'=>$idLote,
            'loteIngrediente'=>$idLote,
            'debe'=>0,
            'haber'=>$cantidad,
            'saldoGlobal'=>($movAnterior->getSaldoGlobal()+$cantidad), // cantidad nueva es la anterior mas lo que agrega la llegada
            'saldoLote'=>$cantidad
        ];
        $nuevoMov = new Movimiento($datosNuevoMov);
        $nuevoMov->persist();
        if($banderaRecalcular){
            self::recalcularStockReal($nuevoMov);
        }

    }



    //PLANIFICADOS


    public static function entradaInsumoPlanificado(int $idProducto, double $cantidad, string $fecha)
    {
        //No deben existir mas de una entrada de insumo planificada para un mismo dia
        //debido a que los planificados se recalculan cada vez que se quiere saber algo de ellos,
        // simplemente inserto el mov sin calcular nada.

        $datosNuevoMov = [
            'producto'=>$idProducto,
            'fecha'=>$fecha,
            'tipo'=>TipoMovimiento::TIPO_MOV_ENTRADA_INSUMO_PLANIF,
            'loteConsumidor'=>null,
            'loteIngrediente'=>null,
            'debe'=>0,
            'haber'=>$cantidad,
            'saldoGlobal'=>null, // cantidad nueva es la anterior mas lo que agrega la llegada
            'saldoLote'=>$cantidad
        ];
        $nuevoMov = new Movimiento($datosNuevoMov);
        $nuevoMov->persist();

    }

    public static function eliminarEntradaInsumoPlanificado(int $idProducto, string $fecha)
    {
        //No deben existir mas de una entrada de insumo planificada para un mismo dia
        Movimiento::eliminarEntradaInsumoPlanif($idProducto,$fecha);
    }

    public static function entradaProductoPlanificado(string $idLote, int $idProducto, double $cantidad, string $fecha )
    {
        //debido a que los planificados se recalculan cada vez que se quiere saber algo de ellos,
        // simplemente inserto el mov sin calcular nada.

        $datosNuevoMov = [
            'producto'=>$idProducto,
            'fecha'=>$fecha,
            'tipo'=>TipoMovimiento::TIPO_MOV_ENTRADA_INSUMO_PLANIF,
            'loteConsumidor'=>$idLote,
            'loteIngrediente'=>$idLote,
            'debe'=>0,
            'haber'=>$cantidad,
            'saldoGlobal'=>null, //
            'saldoLote'=>$cantidad
        ];
        $nuevoMov = new Movimiento($datosNuevoMov);
        $nuevoMov->persist();
    }

    public static function eliminarEntradaProductoPlanificado(string $idLote, string $fecha)
    {
        Movimiento::eliminarEntradaProductoPlanif($idLote,$fecha);
    }


    /**
     *
     * @param string $idLote
     * @param int $idProducto
     * @param double $cantidadObsrv
     * @param string $fecha
     */
    public static function controlarExistencia(string $idLote, int $idProducto, double $cantidadObsrv, string $fecha)
    {
        $banderaRecalcular = false;
        $ultimoMovReal=Movimiento::ultimoRealProd($idProducto);
        $ultiMovLote=Movimiento::ultimoRealLote($idLote);
        $movAnteriorProd = $ultimoMovReal;


        //Compruebo si estoy insertando antes del ultimo mov de ese producto
        if($ultimoMovReal->getFecha()>$fecha){
            //si es asi, recupero el mov anterior a este y deberé recalcular
            $movAnteriorProd = Movimiento::getAnteriorProd($idProducto,$fecha);
            $banderaRecalcular=true;
        }
        //Compruebo si estoy insertando antes del ultimo mov de ese lote
        if($ultiMovLote->getFecha()>$fecha){
            //si es asi, deberé recalcular
            $banderaRecalcular=true;
        }

        // Ajusto el saldo global la diferencia entre la cantidad anterior y la observada
        $diferencia = $cantidadObsrv - $ultiMovLote->getSaldoLote();
        //calculo debe y haber
        if($diferencia>0){
            $haber = $diferencia;
            $debe = 0;
        } else {
            $debe = abs($diferencia);
            $haber = 0;
        }
        $nuevoSaldoGlobal = $movAnteriorProd->getSaldoGlobal()+ $debe - $haber;


        $datosNuevoMov = [
            'producto'=>$idProducto,
            'fecha'=>$fecha,
            'tipo'=>TipoMovimiento::TIPO_MOV_CONTROL_EXISTENCIAS,
            'loteConsumidor'=>$idLote,
            'loteIngrediente'=>$idLote,
            'debe'=>$debe,
            'haber'=>$haber,
            'saldoGlobal'=>$nuevoSaldoGlobal,
            'saldoLote'=>$cantidadObsrv
        ];
        $nuevoMov = new Movimiento($datosNuevoMov);
        $nuevoMov->persist();
        if($banderaRecalcular){
            self::recalcularStockReal($nuevoMov);
        }
        //TODO
    }
    //MOVIMIENTOS DE SALIDA
    //REALES

    /**
     *
     * @param string $idLoteConsumidor
     * @param string $idLoteIngrediente
     * @param int $idProductoIng
     * @param double $cantidad
     * @param string $fecha
     */
    public static function altaConsumo(string $idLoteConsumidor, string $idLoteIngrediente, int $idProductoIng, double $cantidad, string $fecha)
    {

        $banderaRecalcular = false;
        $ultimoMovRealProd=Movimiento::ultimoRealProd($idProductoIng);
        $ultimoMovRealLote = Movimiento::ultimoRealLote($idLoteIngrediente);
        $movAnteriorProd = $ultimoMovRealProd;
        $movAnteriorLote = $ultimoMovRealLote;

        //Compruebo si estoy insertando antes del ultimo mov de ese producto
        if($ultimoMovRealProd->getFecha()>$fecha){
            //si es asi, recupero el mov anterior a este y deberé recalcular
            $movAnteriorProd = Movimiento::getAnteriorProd($idProductoIng,$fecha);
            $banderaRecalcular=true;
        }

        //Compruebo si estoy insertando antes del ultimo mov de ese lote
        if($ultimoMovRealLote->getFecha()>$fecha){
            //si es asi, recupero el mov anterior a este y deberé recalcular
            $movAnteriorLote = Movimiento::getAnteriorLote($idLoteIngrediente,$fecha);
            $banderaRecalcular=true;
        }

        $datosNuevoMov = [
            'producto'=>$idProductoIng,
            'fecha'=>$fecha,
            'tipo'=>TipoMovimiento::TIPO_MOV_CONSUMO,
            'loteConsumidor'=>$idLoteConsumidor,
            'loteIngrediente'=>$idLoteIngrediente,
            'debe'=>$cantidad,
            'haber'=>0,
            'saldoGlobal'=>$movAnteriorProd->getSaldoGlobal() - $cantidad, // cantidad nueva es la anterior menos consumo
            'saldoLote'=>$movAnteriorLote->getSaldoLote() - $cantidad
        ];
        $nuevoMov = new Movimiento($datosNuevoMov);
        $nuevoMov->persist();
        if($banderaRecalcular){
            self::recalcularStockReal($nuevoMov);
        }
    }

    /**
     *
     * @param string $idLote
     * @param int $idProducto
     * @param double $cantidad
     * @param string $fecha
     * @param String $motivo
     * @param string $detalle
     * @parm string tipo
     */
    public static function salidaExcepcional(string $idLote, int $idProducto, double $cantidad, string $fecha, String $motivo, String $detalle )
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
        if($ultimoMovRealProd->getFecha()>$fecha){
            //si es asi, recupero el mov anterior a este y deberé recalcular
            $movAnteriorProd = Movimiento::getAnteriorProd($idProducto,$fecha);
            $banderaRecalcular=true;
        }

        //Compruebo si estoy insertando antes del ultimo mov de ese lote
        if($ultimoMovRealLote->getFecha()>$fecha){
            //si es asi, recupero el mov anterior a este y deberé recalcular
            $movAnteriorLote = Movimiento::getAnteriorLote($idLote,$fecha);
            $banderaRecalcular=true;
        }

        $datosNuevoMov = [
            'producto'=>$idProducto,
            'fecha'=>$fecha,
            'tipo'=>TipoMovimiento::TIPO_MOV_SALIDA_EXCEP,
            'loteconsumidor'=>$idLote,
            'loteingrediente'=>$idLote,
            'debe'=>$cantidad,
            'haber'=>0,
            // cantidad nueva es la anterior menos la salida
            'saldoglobal'=>($movAnteriorProd->getSaldoGlobal() - $cantidad),
            // descuento el saldo del lote restando del saldo anterior
            'saldolote'=>($movAnteriorLote->getSaldoLote() - $cantidad)
        ];
        $nuevoMov = new Movimiento($datosNuevoMov);
        $nuevoMov->persist();

        //agrego la entrada en salida detalle
        $datosSalidaExcep=[
            'idMov'=>$nuevoMov->getIDMov(),
            'idLote'=>$idLote,
            'fecha'=>$fecha,
            'motivo'=>$motivo,
            'detalle'=>$detalle,
            'cantidad'=>$cantidad
        ];

        $salida = new DetalleSalida($datosSalidaExcep);
        $salida->persist();

        //De ser necesario recalculo.
        if($banderaRecalcular){
            self::recalcularStockReal($nuevoMov);
        }

    }

    /**
     *
     * @param string $idLote
     * @param int $idProducto
     * @param double $cantidad
     * @param string $fecha

     */
    public static function salidaVentas(string $idLote, int $idProducto, double $cantidad, string $fecha)
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
        if($ultimoMovRealProd->getFecha()>$fecha){
            //si es asi, recupero el mov anterior a este y deberé recalcular
            $movAnteriorProd = Movimiento::getAnteriorProd($idProducto,$fecha);
            $banderaRecalcular=true;
        }

        //Compruebo si estoy insertando antes del ultimo mov de ese lote
        if($ultimoMovRealLote->getFecha()>$fecha){
            //si es asi, recupero el mov anterior a este y deberé recalcular
            $movAnteriorLote = Movimiento::getAnteriorLote($idLote,$fecha);
            $banderaRecalcular=true;
        }

        $datosNuevoMov = [
            'producto'=>$idProducto,
            'fecha'=>$fecha,
            'tipo'=>TipoMovimiento::TIPO_MOV_SALIDA_VENTAS,
            'loteconsumidor'=>$idLote,
            'loteingrediente'=>$idLote,
            'debe'=>$cantidad,
            'haber'=>0,
            // cantidad nueva es la anterior menos la salida
            'saldoglobal'=>($movAnteriorProd->getSaldoGlobal() - $cantidad),
            // descuento el saldo del lote restando del saldo anterior
            'saldolote'=>($movAnteriorLote->getSaldoLote() - $cantidad)
        ];
        $nuevoMov = new Movimiento($datosNuevoMov);
        $nuevoMov->persist();

        //De ser necesario recalculo.
        if($banderaRecalcular){
            self::recalcularStockReal($nuevoMov);
        }

    }

    /**
     *
     * @param string $idLote
     * @param int $idProducto
     * @param double $cantidad
     * @param String $detalle
     * @param string $fecha
     *
     */
    public static function decomisar(string $idLote, int $idProducto, double $cantidad, String $detalle, string $fecha)
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
        if($ultimoMovRealProd->getFecha()>$fecha){
            //si es asi, recupero el mov anterior a este y deberé recalcular
            $movAnteriorProd = Movimiento::getAnteriorProd($idProducto,$fecha);
            $banderaRecalcular=true;
        }

        //Compruebo si estoy insertando antes del ultimo mov de ese lote
        if($ultimoMovRealLote->getFecha()>$fecha){
            //si es asi, recupero el mov anterior a este y deberé recalcular
            $movAnteriorLote = Movimiento::getAnteriorLote($idLote,$fecha);
            $banderaRecalcular=true;
        }

        $datosNuevoMov = [
            'producto'=>$idProducto,
            'fecha'=>$fecha,
            'tipo'=>TipoMovimiento::TIPO_MOV_SALIDA_DECOMISO,
            'loteconsumidor'=>$idLote,
            'loteingrediente'=>$idLote,
            'debe'=>$cantidad,
            'haber'=>0,
            // cantidad nueva es la anterior menos la salida
            'saldoglobal'=>($movAnteriorProd->getSaldoGlobal() - $cantidad),
            // descuento el saldo del lote restando del saldo anterior
            'saldolote'=>($movAnteriorLote->getSaldoLote() - $cantidad)
        ];
        $nuevoMov = new Movimiento($datosNuevoMov);
        $nuevoMov->persist();

        //agrego la entrada en detalleSalida
        $datosSalidaExcep=[
            'idMov'=>$nuevoMov->getIDMov(),
            'idLote'=>$idLote,
            'fecha'=>$fecha,
            'motivo'=>DetalleSalida::MOTIVO_DECOMISO,
            'detalle'=>$detalle,
            'cantidad'=>$cantidad
        ];
        $salida = new DetalleSalida($datosSalidaExcep);
        $salida->persist();


        //De ser necesario recalculo.
        if($banderaRecalcular){
            self::recalcularStockReal($nuevoMov);
        }





    }


    //PLANIFICADOS

    /**
     * @param string $idLoteConsumidor
     * @param string $idProdIng
     * @param double $cantidad
     * @param string $fecha
     */
    public static function altaConsumoPlanificado(string $idLoteConsumidor, string $idProdIng, double $cantidad, string $fecha)
    {

        $datosNuevoMov = [
            'producto'=>$idProdIng,
            'fecha'=>$fecha,
            'tipo'=>TipoMovimiento::TIPO_MOV_CONSUMO_PLANIF,
            'loteConsumidor'=>$idLoteConsumidor,
            'loteIngrediente'=>null,
            'debe'=>$cantidad,
            'haber'=>0,
            'saldoGlobal'=>null,
            'saldoLote'=>null
        ];
        $nuevoMov = new Movimiento($datosNuevoMov);
        $nuevoMov->persist();

    }

    public static function eliminarConsumosPlanificados(string $idLoteConsumidor, string $fecha)
    {
        Movimiento::eliminarConsumosPlanificados($idLoteConsumidor, $fecha);
    }

    //INFORMES

    public static function getSaldoLote(string $idLote)
    {
        $ultMov = Movimiento::ultimoRealLote($idLote);
        return $ultMov->getSaldoLote();
    }

    /**
     *
     * @param string $idLote
     * @return int[] $idsLotesTrazabilidad // devolvera hashmap donde la key será el id de lote y el valor la cantidad usada
     */
    public static function Trazabilidad(string $idLote)
    {
        $arrayReturn = [];
        $movimientos= Movimiento::getTrazabilidadLote($idLote);
        foreach ($movimientos as $mov){
            $arrayReturn[$mov->getIDLoteIngrediente()] = $mov->getDebe();
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
                'idMov'=>$movimiento->getIDMov(),
                'idLote'=>$movimiento->getLoteIng(),
                'fecha'=>$movimiento->getFecha(),
                'motivo'=>DetalleSalida::MOTIVO_VENTAS,
                'detalle'=>'Salida a ventas',
                'cantidad'=>$movimiento->getDebe()
            ];

            $salida = new DetalleSalida($datosSalida);
            array_push($result,$salida);
        }
        return $result;
    }

    /**
     * @param string $fechaHasta
     * @return array [['nombre'=>,'codigo'=>, 'tipoUnidad'=>, 'alarma'=>, 'stock'=>]...] hashmap key: idProducto, value: cantidad
     * Hay que evaluar si con esta funcion no alcanza ya para desde afuera calcular getNecesidadInsumos y otras por el estilo
     */
    public static function getStockPorProd(string $fechaHasta)
    {
        $result=[];
        self::recalcularPlanificados($fechaHasta);
        $movimientos =Movimiento::ultimoStockProdTodos($fechaHasta);
        foreach ($movimientos as $movimiento){
            $arrAux=[];
            $producto=Producto::find($movimiento->producto_id)->get();
            $stock=$movimiento->salgoGlobal;
            $arrAux['alarma']='normal';
            $arrAux['nombre']=$producto->nombre;
            $arrAux['codigo']=$producto->codigoProducto;
            $arrAux['tu']=$producto->tipoUnidad;
            $arrAux['stock']=$stock;
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
        return $result;
    }

    //PRIVADOS


    /**
     * @param Movimiento $movimientoDesde
     */
    private static function recalcularStockReal(Movimiento $movimientoDesde)
    {
        $movimientos = Movimiento::getMovimientosProdDespuesDe($movimientoDesde->getProducto(),$movimientoDesde->getFecha());

        $movAnteriorProd = $movimientoDesde;
        $movAnteriorLote= $movimientoDesde;
        foreach ($movimientos as $movimiento) {

            $debe = $movimiento->getDebe();
            $haber = $movimiento->getHaber();


            //si es movimiento del lote recalculo saldoLote
            if ($movimiento->getLoteIng() == $movimientoDesde->getLoteIng()) {

                $nuevoSaldoLote = $movAnteriorLote->getSaldoLote() + $haber - $debe;
                $movimiento->setSaldoLote($nuevoSaldoLote);
                //actualizo para la próxima iteración
                $movAnteriorLote = $movimiento;
            }

            $nuevoSaldoGlobal = $movAnteriorProd->getSaldoGlobal() + $haber - $debe;
            $movimiento->setSaldoGlobal($nuevoSaldoGlobal);
            //guardo
            $movimiento->persistChanges();
            //actualizo para la próxima iteración
            $movAnteriorProd = $movimiento;
        }
    }

    private static function recalcularPlanificados($fechaHasta)
    {

        //Guardo el ultimo mov de cada producto, ya que el recalculo se hará por cada producto
        $movimientosInicialesProducto = Movimiento::ultimoStockProdTodos($fechaHasta);
        //Por cada producto
        foreach ($movimientosInicialesProducto as $ultMovRealProd){
            //Tomo el ultimo movimiento
            $producto = $ultMovRealProd->getProducto();
            $movAnteriorProd =$ultMovRealProd;
            $planificacionesProd = Movimiento::getPlanificadosProd($producto,$fechaHasta);
            //itero para todas las planificaciones de este producto
            foreach ($planificacionesProd as $planif){

                //si la planificacion es anterior al ultimo mov debo darla como Incumplido
                if($planif->getFecha()<$movAnteriorProd->getFecha()) {
                    $planif->setTipo(TipoMovimiento::incumplidoDe($planif->getTipo()));
                } else {
                    //sino recalculo
                    $debe = $planif->getDebe();
                    $haber = $planif->getHaber();
                    $nuevoSaldoG = $movAnteriorProd->getSaldoGlobal() + $haber - $debe;
                    $planif->setSaldoGlobal($nuevoSaldoG);
                }
                $planif->persistChanges();
                //actualizo para la proxima iteracion
                $movAnteriorProd = $planif;
            }

        }


    }












}