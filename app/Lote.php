<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use App\Producto;
use Exception;

/**
 * Lote
 * @mixin Eloquent
 *
 * */

class Lote extends Model
{

    const FORMATO_FECHA = 'Y-m-d';
    protected $guarded=[];



    /**
     * @param array $datos
     * @return $this|Model
     */



    public function producto(){
		return $this->belongsTo('App\Producto','producto_id')->first();
	}


    public function getNameProd()
    {
        return (Producto::find($this->producto_id))->nombre;
    }
	public function toArray()
	{

        $producto = Producto::find($this->producto_id);
		return[
            'numeroLote'=>$this->id,//
            'cantidad'=>GestorStock::getSaldoLote($this->id), //
            'vencimiento'=>$this->fechaVencimiento, //
            'fechaInicio'=>$this->fechaInicio,//
            'nombreProducto'=>$producto->nombre,//
            'tipoUnidad'=>$producto->tipoUnidad,//
            'cantidadElaborada'=>$this->cantidadElaborada,//
            'costoUnitario'=>$this->costounitario,//
            'inicioMaduracion'=>$this->fechaInicioMaduracion,//
            'finalizacion'=>$this->fechaFinalizacion,//
            'cantidadFinal'=>$this->cantidadFinal,//
            'tipoLote'=>TipoLote::toString($this->tipoLote),
            'proveedor'=>null,//
            'tipoTp'=>$this->tipoTP,//
            'codigo'=>$producto->codigo,//
            'asignatura'=>null//
            ];

	}

    public static function crearLoteNoPlanificado(array $datos)
    {
        $datosLote=[
            'producto_id'=>$datos['producto_id'],
            'tipoLote'=>TipoLote::INICIADO,
            'fechaInicio'=>$datos['fechaInicio'],
            'cantidadElaborada'=>$datos['cantidadElaborada'],
            'tipoTP'=>$datos['tipoTP'],
        ];
        if($datos['tipoTP']){
            $datosLote['asignatura'] = $datos['asignatura'];
        }
        return Lote::create($datosLote);
    }

    /**
     * Elimina un lote
     * @param int $idLote
     */
    public static function eliminarLote(int $idLote)
    {
        $lote=null;
        if(($lote=Lote::find($idLote))!=null){
            $lote->delete();
        }

    }

    public function actualizarConsumos($consumosArrVista){

        $consumos = []; // armaré un array de consumos como lo necesita el gestor de stock
        for($i=0;$i<count($consumosArrVista);$i+=3){
            $arrAux=[];
            $prodIngId=$consumosArrVista[$i];
            $loteIngId=$consumosArrVista[$i+1];
            $cantidadIng = $consumosArrVista[$i+2];
            //La vista devuelve 'idInsumo',',' para los insumos que no han sido cargados (no se cargo el consumo)
            //Porlo que solo agregare al array de consumos los que correspondan
            if(isset($loteIngId) && trim($loteIngId)!=='' && isset($cantidadIng) && trim($cantidadIng)!=='' && $cantidadIng>0){
                //GestorStock::actualizarConsumo($lote->id, $loteIngId,$prodIngId,floatval($cantidadIng),$fechaStamp);
                $arrAux['producto_id']=$prodIngId;
                $arrAux['lote_id']=$loteIngId;
                $arrAux['cantidad']=floatval($cantidadIng);
                array_push($consumos,$arrAux);
            }
        }
        switch ($this->tipoLote) {
            case TipoLote::INICIADO: {
                /*//actualizar datos del lote

                //actualizo los consumos
                $producto=Producto::find($this->producto_id);
                $trazabilidad = GestorLote::getTrazabilidadLote($this->id);
                //por cada consumo de la modificacion
                foreach ($consumos as $consumo){
                    $banderaMatch = false;
                    $consumoViejoMatched = null;
                    //busco si ya fue cargado el consumo de ese producto
                    foreach ($trazabilidad as $consumoViejo) {
                        if ($consumo['producto_id'] === $consumoViejo['producto_id']) {
                            $banderaMatch = true;
                            $consumoViejoMatched = $consumoViejo;
                            break;
                        }
                    }
                    if($banderaMatch){ // si matcheo hay que actualizar, modificando lo que estaba previamente cargado
                        //GestorStock::modificarConsumo($this->id,$);

                    } else { //sino se da de alta un nuevo consumo
                        GestorStock::altaConsumo($this->id,$consumo['idLote'],$consumo['producto_id'],$consumo['cantidad'],$fecha);

                    }*/

                //Elimino los consumos del lote
                $fecha = $this->fechaInicio . ' ' . date('H:i:s');
                GestorStock::actualizarConsumos($this->id,$consumos,$this->fechaInicio);
                //guardo los cambios
                break;
            }
            default : {
                return null;
            }
        }
    }

    public function registrarMaduracion(string $fechaInicioMaduracion){
        if($this->tipoLote !=TipoLote::INICIADO){
            throw new Exception('Solo se puede pasar a maduracion un lote que este en estado INICIADO');
        }
        $this->tipoLote = TipoLote::MADURACION;
        $this->fechaInicioMaduracion = $fechaInicioMaduracion;
        $this->save();

    }

    /**
     * Inicia un lote planificado, permitiendo alterarle algunos datos de como fue planificado
     * @param array $datos
     * @throws Exception si no esta en estado planificado
     */
    public function iniciarPlanificado(array $datos) {
        if($this->tipoLote != TipoLote::PLANIFICACION){
            throw new Exception('Intentando iniciar como planificado un lote que no esta en estado PLANIFICACION');
        }
        $this->tipoLote = TipoLote::INICIADO;
        $this->fechaInicio = $datos['fechaInicio'];
        $this->tipoTP = false;
        $this->cantidadElaborada = $datos['cantidadElaborada'];
        $this->save();
    }

    /**
     * Retorna booleano de si esta en estado planificado
     * @return bool
     */
    public function isPlanificado(){
        return ($this->tipoLote == TipoLote::PLANIFICACION);
    }

    public function finalizar(float $cantidadFinal, string $fechaFinalizacion, string $fechaVencimiento){
        if($this->tipoLote !=TipoLote::MADURACION && $this->tipoLote != TipoLote::INICIADO){
            throw new Exception('Solo se puede finalizar un lote que este en estado INICIADO o MADURACION');
        }
        if($fechaVencimiento < $this->fechaInicio || $fechaFinalizacion < $this->fechaInicio) {
            throw new Exception('fechas anteriores a la fecha de inicio');
        }
        if($cantidadFinal < 0){
            throw new Exception('cantidad menor a 0');
        }

        //actualizo los datos del lote
        $this->tipoLote = TipoLote::FINALIZADO;
        $this->fechaFinalizacion = $fechaFinalizacion;
        $this->fechaVencimiento = $fechaVencimiento;
        $this->cantidadFinal = $cantidadFinal;
        //debo calcular el costo unitario
        $consumos = GestorLote::getTrazabilidadLote($this->id);
        $costoTotal = 0;
        foreach ($consumos as $consumo){
            //recorro todos los consumos y sumo el costo de lo consumido al costo total
            $costoTotal += $consumo['cantidad'] * $consumo['costounitario'];
        }
        //costo unitario es igual a lo gastado total dividido la cantidad producida
        $this->costounitario = $costoTotal / $cantidadFinal;
        //fabrico la fecha en formato timestamp para el movimiento
        $H_i_s = date('H:i:s');
        $fechaStamp = $fechaFinalizacion . " ". $H_i_s;
        GestorStock::entradaProducto($this->id,$this->producto_id,$cantidadFinal,$fechaStamp);
        $this->save();
    }

    public static function eliminarLotesPlanificados(string $fecha)
    {
        if($fecha==null){
            throw new Exception('fecha null');
        }
        self::where('fechaInicio','=',$fecha)
            ->where('tipoLote','=',TipoLote::PLANIFICACION)
            ->delete();
    }

    public static function fechaUltimoIniciado(){
        $lote= self::where('tipoLote','=',TipoLote::INICIADO)
            ->orderBy('fechaInicio','desc')
            ->first();
        if($lote==null){
            return null;
        }
        return $lote->fechaInicio;
    }
}
