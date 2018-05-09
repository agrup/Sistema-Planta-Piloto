<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TipoMovimiento;
use App\Producto;

class Planificacion extends Model
{
    public function trabajadors(){
        return $this->belongsToMany('App\Trabajador');
    }

    public function arrayTrabjadors(){
        $arrResult = [];
        $trabajadores = $this->trabajadors()->get();
        foreach ($trabajadores as $trabajador){
            $arrResult[]=$trabajador->seudonimo;
        }
        return $arrResult;
    }

    public function movimientos(){
        return $this->hasMany('App\Movimiento', 'planificacion_id');
    }

    //retorna array [['codigo'=> ,'nombre'=> , 'cantidad'=>], .. ]

    /**
     * @return array retorna array [['codigo'=> ,'nombre'=> , 'cantidad'=>, 'tipoUnidad'=>, 'color'=>], .. ]
     */
    public function productos(){
        $arrayResult = [];
        $movs= $this->movimientos()->whereRaw(
        									'tipo =' . TipoMovimiento::TIPO_MOV_ENTRADA_PRODUCTO_PLANIF .
                                            'or tipo=' . TipoMovimiento::TIPO_MOV_ENTRADA_PRODUCTO_PLANIF_CUMPLIDO .
                                            'or tipo=' . TipoMovimiento::TIPO_MOV_ENTRADA_PRODUCTO_PLANIF_INCUMPLIDO)->get();
        foreach ($movs as $mov){
            $arrProd=[];
            $color = 'normal';
            $producto=Producto::where('codigoProducto','=',$mov->codigoProducto)->first();
            $arrProd['nombre']=$producto->nombre;
            $arrProd['codigo']=$mov->codigoProducto;
            $arrProd['cantidad']=$mov->haber;
            $arrProd['tipoUnidad']=$producto->tipoUnidad;
            if($mov->tipo == TipoMovimiento::TIPO_MOV_ENTRADA_PRODUCTO_PLANIF_CUMPLIDO){
                $color = 'verde';
            }
            if($mov->tipo == TipoMovimiento::TIPO_MOV_ENTRADA_PRODUCTO_PLANIF_INCUMPLIDO){
                $color = 'rojo';
            }
            $arrProd['color']=$color;
            array_push($arrayResult,$arrProd);
            print_r($arrProd);
        }

        return $arrayResult;

    }


    /**
     * @return array retorna array [['codigo'=> ,'nombre'=> , 'cantidad'=>, 'tipoUnidad'=>, 'color'=>], .. ]
     */
    public function insumos(){
        $arrayResult = [];
        $movs= $this->movimientos()->whereRaw(
        	'tipo =' . TipoMovimiento::TIPO_MOV_ENTRADA_INSUMO_PLANIF .
            'or tipo=' . TipoMovimiento::TIPO_MOV_ENTRADA_INSUMO_PLANIF_CUMPLIDO .
            'or tipo=' . TipoMovimiento::TIPO_MOV_ENTRADA_INSUMO_PLANIF_INCUMPLIDO)->get();

        foreach ($movs as $mov){
            $arrProd=[];
            $color = 'normal';
            $producto=Producto::where('codigoProducto','=',$mov->codigoProducto)->first();
            $arrProd['nombre']=$producto->nombre;
            $arrProd['codigo']=$mov->codigoProducto;
            $arrProd['cantidad']=$mov->haber;
            $arrProd['tipoUnidad']=$producto->tipoUnidad;
            if($mov->tipo == TipoMovimiento::TIPO_MOV_ENTRADA_INSUMO_PLANIF_CUMPLIDO){
                $color = 'verde';
            }
            if($mov->tipo == TipoMovimiento::TIPO_MOV_ENTRADA_INSUMO_PLANIF_INCUMPLIDO){
                $color = 'rojo';
            }
            $arrProd['color']=$color;
            array_push($arrayResult,$arrProd);
            print_r($arrProd);
        }

        return $arrayResult;

    }
    //


    public function toArray()
    {
        $arrResult=[];
        $arrResult['fecha']=$this->fecha;
        $arrResult['diaSemana']= $this->diaSemana;
        $arrResult['trabajadores']= $this->arrayTrabjadors();
        $arrResult['productos']= $this->productos();
        $arrResult['insumos']=$this->insumos();

        return $arrResult;


    }
}