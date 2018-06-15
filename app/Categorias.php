<?php
/**
 * Created by PhpStorm.
 * User: brujua
 * Date: 14/6/2018
 * Time: 1:24 PM
 */

namespace App;


class Categorias
{
    const categorias = ['Cárnico','Lácteo','Panificado','Conserva','Insumo'];

    public function all(){
        return self::categorias;
    }

    public static function productos(){
        return ['Cárnico','Lácteo','Panificado','Conserva'];
    }

    public static function insumos(){
        return ['Insumo'];
    }
}