<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TipoMovimiento;

class Planificacion extends Model
{
    public function trabajadors(){
        return $this->belongsToMany('App\Trabajador');
    }


    public function movimientos(){
        return $this->hasMany('App\Movimiento', 'planificacion_id');
    }
    public function productos(){
        return $this->movimientos()->whereRaw(
        									'tipo =' . TipoMovimiento::TIPO_MOV_ENTRADA_PRODUCTO_PLANIF .
                                            'or tipo=' . TipoMovimiento::TIPO_MOV_ENTRADA_PRODUCTO_PLANIF_CUMPLIDO .
                                            'or tipo=' . TipoMovimiento::TIPO_MOV_ENTRADA_PRODUCTO_PLANIF_INCUMPLIDO);
    }

    public function insumos(){
        return $this->movimientos()->whereRaw(
        	'tipo =' . TipoMovimiento::TIPO_MOV_ENTRADA_INSUMO_PLANIF .
            'or tipo=' . TipoMovimiento::TIPO_MOV_ENTRADA_INSUMO_PLANIF_CUMPLIDO .
            'or tipo=' . TipoMovimiento::TIPO_MOV_ENTRADA_INSUMO_PLANIF_INCUMPLIDO);
    }
    //
}