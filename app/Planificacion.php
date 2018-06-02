<?php

namespace App;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Exception;

/**
 * Planificacion
 * @mixin Eloquent
 *
 * */

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
     * @return array
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
            $lote = Lote::find($mov->idLoteConsumidor);
            $estado = 'pendiente';
            $producto=Producto::find($mov->producto_id);
            $arrProd['id']=$producto->id;
            $arrProd['nombre']=$producto->nombre;

            $arrProd['codigo']=$producto->codigo;
            $arrProd['cantidad']=$mov->haber;
            $arrProd['tipoUnidad']=$producto->tipoUnidad;
            /*if($mov->tipo == TipoMovimiento::TIPO_MOV_ENTRADA_PRODUCTO_PLANIF_CUMPLIDO){
                $estado = 'cumplida';
            }*/
            /*//Si alguno de sus consumos fue cumplido, considero la planificacion cumplida para que no pueda editarse ni borrarse
            if(Movimiento::where('idLoteConsumidor','=',$mov->idLoteConsumidor)
                ->where('tipo','=',TipoMovimiento::TIPO_MOV_CONSUMO_PLANIF_CUMPLIDO)->first() !=null) {
                $estado = 'cumplida';
            }*/
            //si el lote se inicio considero la planificacion cumplida para que no pueda editarse ni borrarse
            if($lote->tipoLote != TipoLote::PLANIFICACION){
                $estado = 'cumplida';
            }
            if($mov->tipo == TipoMovimiento::TIPO_MOV_ENTRADA_PRODUCTO_PLANIF_INCUMPLIDO){
                $estado = 'incumplida';
            }
            $arrProd['estado']=$estado;
            $arrProd['movimiento_id']=$mov->id;
            $arrProd['tipoTP']=$lote->tipoTP;
            $arrProd['asignatura']=$lote->asignatura;
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
            $estado = 'pendiente';
            $producto=Producto::find($mov->producto_id);
            $arrProd['nombre']=$producto->nombre;
            $arrProd['id']=$producto->id;
            $arrProd['codigo']=$producto->codigo;
            $arrProd['cantidad']=$mov->haber;
            $arrProd['tipoUnidad']=$producto->tipoUnidad;
            if($mov->tipo == TipoMovimiento::TIPO_MOV_ENTRADA_INSUMO_PLANIF_CUMPLIDO){
                $estado = 'cumplida';
            }
            if($mov->tipo == TipoMovimiento::TIPO_MOV_ENTRADA_INSUMO_PLANIF_INCUMPLIDO){
                $estado = 'incumplida';
            }
            $arrProd['estado']=$estado;
            $arrProd['movimiento_id']=$mov->id;
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

    /**
     * agrega un producto a una planificacion
     * @param int $codigo
     * @param float $cantidad
     * @param bool $tipoTP
     * @param string $asignatura
     * @param string $fecha
     * @return int movimiento_id
     */
    public function agregarProducto (int $codigo, double $cantidad, bool $tipoTP=false, string $asignatura=null, string $fecha  )
    {

        $producto = Producto::where('codigo','=',$codigo)->first();
        //crear el lote
        $datosLote = [
            'producto_id'=>$producto->id,
            'tipoLote'=>TipoLote::PLANIFICACION,
            'fechaInicio'=>$this->fecha,
            'cantidadElaborada'=>$cantidad,
            'tipoTP'=>$tipoTP,
            'asignatura'=>$asignatura
        ];
        $lote = Lote::create($datosLote);
        // se concatena la horasminseg del momento a la fecha para crear el timestamp que requieren los movimientos
        $H_i_s = date('H:i:s');
        $fechaStamp = $fecha . " ". $H_i_s;
        //crear el movimiento entrada de producto planif asociado a la planificacion y se crearán subsecuentemente
        // los consumos planificados correspondientes
        $mov = GestorStock::entradaProductoPlanificado($lote->id,$producto->id,$cantidad,$fechaStamp,$this->id);
        return $mov->id;
    }

    /**
     * agrega un insumo a una planificacion
     */
    public function agregarInsumo(int $codigo, double $cantidad, string $fecha)
    {
        $producto = Producto::where('codigo','=',$codigo)->first();
        // se concatena la horasminseg del momento a la fecha para crear el timestamp que requieren los movimientos
        $H_i_s = date('H:i:s');
        $fechaStamp = $fecha . " ". $H_i_s;

        //crear el movimiento entrada de insumo planif asociado a la planificacion
        $mov = GestorStock::entradaInsumoPlanificado($producto->id,$cantidad,$fechaStamp,$this->id);
        return $mov->id;
    }

    /**
     * Elimina un insumo o producto planificado de la planificacion
     * @param int $movimiento_id
     * @return \Illuminate\Http\JsonResponse
     * @throws Exception
     */
    public  function eliminarInsPro(int $movimiento_id)
    {
        $movimiento = Movimiento::find($movimiento_id);
        if($movimiento==null){
            throw new Exception('Movimiento NUll');
        }
        if($movimiento->tipo == TipoMovimiento::TIPO_MOV_ENTRADA_INSUMO_PLANIF){
            $movimiento->delete();
        } else {
            if($movimiento->tipo == TipoMovimiento::TIPO_MOV_ENTRADA_PRODUCTO_PLANIF){
                //Elimino los movimientos
                GestorStock::eliminarEntradaProductoPlanificado($movimiento_id);
                //Elimino el lote
                Lote::eliminarLote($movimiento->idLoteConsumidor);
            } else {
                return response()->json('ERROR: el movimiento no es de un tipo eliminable');
            }
        }
        return response()->json('OK');
    }

    /**Modifica un Insumo o Producto planificado de la planificacion
     * Solo se puede editar la cantidad
     * @param int $movimiento_id
     * @param float $cantidad
     * @return \Illuminate\Http\JsonResponse
     * @throws Exception
     */
    public function modificarInsPro(int $movimiento_id, double $cantidad)
    {
        $movimiento = Movimiento::find($movimiento_id);
        if($movimiento==null){
            throw new Exception('Movimiento NULL');
        }
        if($movimiento->tipo == TipoMovimiento::TIPO_MOV_ENTRADA_INSUMO_PLANIF){
            GestorStock::modificarEntradaInsumoPlanif($movimiento_id,$cantidad);
        } elseif ($movimiento->tipo == TipoMovimiento::TIPO_MOV_ENTRADA_PRODUCTO_PLANIF){
            GestorStock::modificarEntradaProductoPlanif($movimiento_id,$cantidad);
        } else {
            return response()->json('ERROR: el movimiento no es de un tipo editable');
        }
        return response()->json('OK');
    }

    /**
     * Actualiza los productos e insumos planificados para ese dia
     * @param array $productos
     * @param array $insumos
     */
    public function actualizar( $productos,  $insumos){
        //borro los lotes planificados
        Lote::eliminarLotesPlanificados($this->fecha);
        //borro los movimientos planificados asociados a la planificacion
        Movimiento::eliminarMovsPlanificados($this->id);
        //creo lotes y mov planificados para los productos
        foreach ($productos as $producto){
            if(count($producto)>=3) {
                $productoID = $producto[0];
                $cantidad = $producto[1];
                $tipoTP = ($producto[2] == 'Si') ? true : false;
                //creo los lotes planificados
                $datosLote = [
                    'producto_id' => $productoID,
                    'tipoLote' => TipoLote::PLANIFICACION,
                    'fechaInicio' => $this->fecha,
                    'cantidadElaborada' => $cantidad,
                    'tipoTP' => $tipoTP
                ];
                $lote = Lote::create($datosLote);
                //doy de alta los movimientos
                // se concatena la horasminseg del momento a la fecha para crear el timestamp que requieren los movimientos
                $H_i_s = date('H:i:s');
                $fechaStamp = $this->fecha . " " . $H_i_s;
                GestorStock::entradaProductoPlanificado($lote->id, $productoID, $cantidad, $fechaStamp, $this->id);
            }
        }
        //creo movimientos planificados para los insumos
        foreach ($insumos as $insumo){
            if(count($insumo)>=2){
                $productoID = $insumo[0];
                $cantidad = $insumo[1];
                //doy de alta movimiento
                // se concatena la horasminseg del momento a la fecha para crear el timestamp que requieren los movimientos
                $H_i_s = date('H:i:s');
                $fechaStamp = $this->fecha . " " . $H_i_s;
                GestorStock::entradaInsumoPlanificado($productoID,$cantidad,$fechaStamp,$this->id);
            }
        }
    }

    public static function dameArrProd(){
        $arr=[];
        array_push($arr,['1','200','No']);
        array_push($arr,['6','100','Si']);
        return $arr;
    }

    public static function dameArrInsm(){
        $arr=[];
        array_push($arr,[]);
        array_push($arr,[]);
        array_push($arr,[]);
        array_push($arr,[]);
        array_push($arr,['2','1000']);
        array_push($arr,['3','5000']);
        array_push($arr,['4','1500']);

        return $arr;
    }

}