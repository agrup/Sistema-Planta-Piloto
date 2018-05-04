<?php
/**
 * Created by PhpStorm.
 * User: brujua
 * Date: 30/4/2018
 * Time: 8:47 PM
 */
class Movimiento
{
    private $campos=['id','fecha','tipo','loteconsumidor',
        'loteingrediente','debe','haber','salgoglobal','saldolote', 'estado'
    ];
    // TODO hacer geters y seters
    public function __construct($datos)
    {
    }
    /**
     * @param $producto string
     * @return Movimiento
     */
    public static function ultimoRealProd($producto)
    {
        //TODO
        return null;
    }
    /**
     * @param string $idLote
     * @return Movimiento $mov
     */
    public static function ultimoRealLote($idLote)
    {
        //TODO
    }
    /**
     * @param string $idLote
     * @return Movimiento[]
     */
    public static function getTrazabilidadLote($idLote)
    {
        //recuperar todos los movientos que poseean a ese lote como consumidor y tengan id de lote ingrediente diferente
        // movimientos de tipo consumo real
    }
    /**
     * @param string $idProducto
     * @param string $fechaHasta
     * @return Movimiento[]
     */
    public static function getPlanificadosProd(string $idProducto, string $fechaHasta)
    {
        //Recuperar los movimientos planificados de ese producto hata la fecha indicada
        //IMPORTANTE: solo los que no sean de tipo CUMPLIDO o INCUMPLIDO ver TipoMovimiento
        //Es decir los que posean el tipo:
        //TIPO_MOV_ENTRADA_INSUMO_PLANIF o TIPO_MOV_ENTRADA_PRODUCTO_PLANIF o TIPO_MOV_CONSUMO_PLANIF
        //devolver el array de movimientos Ordenado cronológicamente
    }
    /**
     * @param string $idProducto
     * @param string $fecha
     * @return Movimiento
     */
    public static function getAnteriorProd(string $idProducto, string $fecha)
    {
        //real
    }
    /**
     * @param string $idLoteIngrediente
     * @param string $fecha
     * @return Movimiento
     */
    public static function getAnteriorLote($idLoteIngrediente, $fecha)
    {
        //real
    }
    /**
     * @param $idProducto
     * @param $fechaCambio
     * @return Movimiento[] $movimientos
     */
    public static function getMovimientosProdDespuesDe($idProducto, $fechaCambio)
    {
        //real
        //Ordenados por favooor
    }
    /**
     * @param string $idProducto
     * @param string $fecha
     *
     */
    public static function eliminarEntradaInsumoPlanif($idProducto, $fecha)
    {
    }
    /**
     * @param string $idLote
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
     */
    public static function ultimoStockProdTodos(string $fechaHasta)
    {
        //devolver los ultimos movimientos hasta la fecha para cada producto.
        //incluir planificados
    }
    public function persist()
    {
        // guardar el ID en el atributo del objeto. $this->id = $pdo->lastInsertId();
    }
    /**
     * @return int
     */
    public function getIDMov()
    {
        //return this->$id;
    }
    /**
     * @return string
     */
    public function getIDLoteIngrediente()
    {
    }
    /**
     * @return int
     */
    public function getDebe()
    {
    }
    /**
     * @return int $saldoLote
     */
    /**
     * @return int
     */
    public function getHaber()
    {
    }
    /**
     * @return int
     */
    public function getSaldoGlobal()
    {
    }
    /**
     * @return int
     */
    public function getSaldoLote()
    {
    }
    /**
     * @return string $fecha
     */
    public function getFecha()
    {
    }
    /**
     * @param int $nuevoSaldo
     */
    public function setSaldoGlobal($nuevoSaldo)
    {
    }
    /**
     * @param int $nuevoSaldo
     */
    public function setSaldoLote($nuevoSaldo)
    {
    }
    public function persistChanges()
    {
        //hacer un update con todos los campos
    }
    /**
     * @return string $producto
     */
    public function getProducto()
    {
        //return this->producto;
    }
    /**
     * @return string
     */
    public function getLoteIng(){
    }

    /**
     * @param int $tipo
     */
    public function setTipo(int $tipo)
    {
    }

    /**
     * @return int
     */
    public function getTipo()
    {
    }

