<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\TipoMovimiento;
use App\Producto;

class Planificacion extends Model
{

    protected $guarded=[];

    /**
     * @param string $fecha
     * @return Planificacion[]
     */
    public static function crearSemana($fecha)
    {
        $arrResult=[];

        setlocale(LC_TIME, 'spanish');
        Carbon::setUtf8(true);

        for ($i=0; $i<5;$i++){
            //la paso a carbon para preguntar el dia y poderle sumar un dia
            $fechaC = Carbon::createFromFormat('Y-m-d',$fecha);
            $diaSemana = $fechaC->formatLocalized('%A'); //devuelve lunes o miércoles, etc
            //creo la planificacion y la agrego al array resultado
            array_push($arrResult,self::create(['fecha'=>$fecha, 'diaSemana'=>$diaSemana]));
            //agrego un dia y vuelvo al formato normal para la proxima iteracion
            $fechaC = $fechaC->addDay();
            $fecha= $fechaC->format('Y-m-d');
        }
        return $arrResult;


    }

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