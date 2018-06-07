<?php
/**
 * Created by PhpStorm.
 * User: brujua
 * Date: 6/6/2018
 * Time: 6:53 PM
 */

namespace App;


class RolesAux
{
    const ROL_ADMIN = 1;
    const ROL_JEFE_PRODUCCION = 2;
    const ROL_ADMINISTRACION = 3;


    public static function toString(int $rol)
    {
        switch ($rol) {
            case self::ROL_ADMIN:
                return 'Administrador';
            case self::ROL_JEFE_PRODUCCION:
                return 'Jefe de Producción';
            case self::ROL_ADMINISTRACION:
                return 'Empleado de Administracion';
        }
    }
}