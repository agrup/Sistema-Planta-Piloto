<?php
/**
 * @author brujua
 * @version 1.0
 * @created 22-abr.-2018 3:19:32 a. m.
 */

namespace App;

class DetalleSalida
{

    protected $guarded=[];


    const MOTIVO_DECOMISO = 'decomiso';
    const MOTIVO_VENTAS = 'ventas';

    /**
     * SalidaExcep constructor.
     * @param array $datos
     */function __construct($datos)
{
}
    /**
     * @param string $fechaDesde
     * @param string $fechaHasta
     * @return DetalleSalida[]
     */
    public static function getSalidas(string $fechaDesde, string $fechaHasta)
    {
        //TODO
    }
    function __destruct()
    {
    }
    public function persist()
    {
    }
    public function getcantidad()
    {
        return $this->cantidad;
    }
    public function getdetalle()
    {
        return $this->detalle;
    }
    public function getfecha()
    {
        return $this->fecha;
    }
    public function getidLote()
    {
        return $this->idLote;
    }
    public function getMotivo()
    {
        return $this->motivo;
    }
    /**
     *
     */
    public function getIdMov()
    {
        return $this->idMov;
    }
}
