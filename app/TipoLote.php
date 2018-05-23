<?php
/**
 * Created by PhpStorm.
 * User: brujua
 * Date: 12/5/2018
 * Time: 4:47 AM
 */

namespace App;


class TipoLote
{
    const INICIADO = 1;
    const MADURACION = 2;
    const FINALIZADO = 3;
    const PLANIFICACION = 4;

    public static function toString(int $tipo){
        switch ($tipo){
            case 1:
                return 'iniciado';
            case 2:
                return 'maduracion';
            case 3:
                return 'finalizado';
            case 4:
                return 'planificacion';
        }
    }

}