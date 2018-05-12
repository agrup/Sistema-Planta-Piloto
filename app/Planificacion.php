<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\TipoMovimiento;
use App\Producto;

class Planificacion extends Model
{

    const DIAS_SEMANA_LABORABLES = 5;
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

        for ($i=0; $i<self::DIAS_SEMANA_LABORABLES;$i++){
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

    /**
     * @param string $fecha
     * @return
     */
    public static function getSemana($fecha)
    {
        $arrayResult=[];

        //la paso a carbon para ir al principio de la semana y determinar el tope
        $fechaC = Carbon::createFromFormat('Y-m-d',$fecha);
        $fechaC = $fechaC->startOfWeek();
        $fecha = $fechaC->format('Y-m-d');
        $fechaTope = $fechaC->addDays((self::DIAS_SEMANA_LABORABLES - 1))->format('Y-m-d');
       $planificaciones = Planificacion::where('fecha','>=',$fecha)
            ->where('fecha','<=',$fechaTope)->get();
       //si no estan creadas las creo
       if($planificaciones->isEmpty()){
           $planificaciones = self::crearSemana($fecha);
       }
       foreach ($planificaciones as $planificacion){
           array_push($arrayResult,$planificacion->toArray());
       }
       return $arrayResult;
    }

    public function trabajadors(){
        return $this->belongsToMany('App\Trabajador');
    }

    public function arrayTrabajadors(){
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
            $producto=Producto::find($mov->producto_id);
            $arrProd['nombre']=$producto->nombre;
            $arrProd['codigo']=$producto->codigo;
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
            $producto=Producto::find($mov->producto_id);
            $arrProd['nombre']=$producto->nombre;
            $arrProd['codigo']=$producto->codigo;
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

        }

        return $arrayResult;

    }
    //


    public function toArray()
    {
        $arrResult=[];
        $arrResult['fecha']=$this->fecha;
        $arrResult['diaSemana']= $this->diaSemana;
        $arrResult['trabajadores']= $this->arrayTrabajadors();
        $arrResult['productos']= $this->productos();
        $arrResult['insumos']=$this->insumos();

        return $arrResult;


    }
}