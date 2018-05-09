<?php
namespace App;
/**
 * Created by PhpStorm.
 * User: brujua
 * Date: 1/5/2018
 * Time: 12:01 AM
 */


class TipoMovimiento

{
    const __default = self::SIN_TIPO;

    const SIN_TIPO=-1;
    const TIPO_MOV_ENTRADA_INSUMO=1;
    const TIPO_MOV_SALIDA_VENTAS=2;
    const TIPO_MOV_SALIDA_EXCEP=3;
    const TIPO_MOV_SALIDA_DECOMISO = 4;
    const TIPO_MOV_CONSUMO=5;
    const TIPO_MOV_CONTROL_EXISTENCIAS = 6;
    const TIPO_MOV_ENTRADA_INSUMO_PLANIF=7;
    const TIPO_MOV_ENTRADA_PRODUCTO_PLANIF=8;
    const TIPO_MOV_CONSUMO_PLANIF=9;
    const TIPO_MOV_ENTRADA_INSUMO_PLANIF_CUMPLIDO=10;
    const TIPO_MOV_ENTRADA_PRODUCTO_PLANIF_CUMPLIDO=11;
    const TIPO_MOV_CONSUMO_PLANIF_CUMPLIDO=12;
    const TIPO_MOV_ENTRADA_INSUMO_PLANIF_INCUMPLIDO=13;
    const TIPO_MOV_ENTRADA_PRODUCTO_PLANIF_INCUMPLIDO=14;
    const TIPO_MOV_CONSUMO_PLANIF_INCUMPLIDO=15;

    /**
     * @param int $tipo
     * @return int
     */
    public static function cumplidoDe(int $tipo)
    {
        switch ($tipo){
            case self::TIPO_MOV_CONSUMO_PLANIF :
                return self::TIPO_MOV_CONSUMO_PLANIF_CUMPLIDO;
            case self::TIPO_MOV_ENTRADA_INSUMO_PLANIF:
                return self::TIPO_MOV_ENTRADA_INSUMO_PLANIF_CUMPLIDO;
            case self::TIPO_MOV_ENTRADA_PRODUCTO_PLANIF:
                return self::TIPO_MOV_ENTRADA_PRODUCTO_PLANIF_CUMPLIDO;
            default:
                return null;
        }
    }

    /**
     * @param int $tipo
     * @return int
     */
    public static function incumplidoDe(int $tipo)
    {
        switch ($tipo){
            case self::TIPO_MOV_CONSUMO_PLANIF :
                return self::TIPO_MOV_CONSUMO_PLANIF_INCUMPLIDO;
            case self::TIPO_MOV_ENTRADA_INSUMO_PLANIF:
                return self::TIPO_MOV_ENTRADA_INSUMO_PLANIF_INCUMPLIDO;
            case self::TIPO_MOV_ENTRADA_PRODUCTO_PLANIF:
                return self::TIPO_MOV_ENTRADA_PRODUCTO_PLANIF_INCUMPLIDO;
            default:
                return null;
        }
    }

}

