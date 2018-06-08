<?php

namespace App\Http\Controllers;

use App\GestorLote;
use App\GestorStock;
use App\Lote;
use App\Movimiento;
use App\Producto;
use App\TipoLote;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class ProduccionController extends Controller
{
    public static function index(){
        $data =[];
        if(($fecha=Lote::fechaUltimoIniciado())==null){
            $fecha = Carbon::now()->format('Y-m-d');
        }

        $data['fecha']=$fecha;
        $data['lotes']=self::getArrayLotes($fecha);
        return view('produccion.produccion',compact('data'));
        
    }

    public static function show()
    {
        $data =[];

        $fecha = request()->input('fecha');
        if($fecha==null){
            throw new Exception('Fecha Inválida');
        }
        $data['fecha']=$fecha;

        $data['lotes']=self::getArrayLotes($fecha);
        return view('produccion.produccion',compact('data'));

    }
    
    private static function getArrayLotes($fecha){
        $arrayLotes = [];
        $lotes = GestorLote::getLotesFecha($fecha);
        // devolver la vista
        foreach ($lotes as $lote){
            if($lote->tipoLote != TipoLote::INSUMO){
                $producto = $lote->producto();
                $arrAux=[];
                $arrAux['lote']=$lote->id; //TODO Hay que hacer el codigo del lote, no esta en la migration
                $arrAux['producto']=$producto->nombre;
                $arrAux['tipoUnidad']=$producto->tipoUnidad;
                $arrAux['estado']=TipoLote::toString($lote->tipoLote);
                switch ($lote->tipoLote){
                    case TipoLote::INICIADO:
                    case TipoLote::MADURACION:
                    case TipoLote::PLANIFICACION:
                        $arrAux['cantidad']=$lote->cantidadElaborada;
                        break;
                    case TipoLote::FINALIZADO:
                        $arrAux['cantidad']=$lote->cantidadFinal;
                        break;
                    default:
                        $arrAux['cantidad']=$lote->cantidadElaborada;
                        break;
                }
                if($lote->tipoTP){
                    $arrAux['asignatura']=$lote->asignatura;
                } else {
                    $arrAux['asignatura']='';
                }
                array_push($arrayLotes,$arrAux);
            }
        } //end foreach lotes
        return $arrayLotes;
    }

    public static function loteEnProduccion(){

    }

    public static function iniciarPlanificado($id){

        $lote = Lote::find($id);
        $producto = Producto::find($lote->producto_id);
        $formulacion = $producto->getFormulacion($lote->cantidadElaborada);
        $fecha = $lote->fechaInicio;

        return view('produccion.iniciarLotePlanificado')
                                    ->with(compact('lote'))
                                    ->with(compact('formulacion'))
                                    ->with(compact('producto'))
                                    ->with(compact('fecha'));
    }

    public static function postIniciarPlanificado(){

        $loteVista = request()->input('lote');
        $consumosVista = request()->input('consumo');
        $loteID = request()->input('loteID');
        //Parseo los datos de la request
        $dataLoteArr = explode(',',$loteVista);
        $consumosArrVista = explode(',',$consumosVista);
        /*var_dump($loteID);
        var_dump($dataLoteArr);
        var_dump($consumosArrVista);
        return view('welcome');*/
        $data =[]; // variable utilizada para retornar a la nueva vista


        //Los primeros 4 datos del lote no pueden estar vacios
        for($i=0; $i<3;$i++){
            if(!isset($dataLoteArr[$i]) || trim($dataLoteArr[$i])===''){
                throw new Exception('Campo que no se permite vacio');
            }
        }

        $fecha = $dataLoteArr[2];
        // se concatena la horasminseg del momento a la fecha para crear el timestamp que requieren los movimientos
        $H_i_s = date('H:i:s');
        $fechaStamp = $fecha . " ". $H_i_s;
        //crear el lote
        $datosLote=[
            'producto_id'=>$dataLoteArr[0],
            'cantidadElaborada'=>$dataLoteArr[1],
            'fechaInicio'=>$fecha,
            'tipoTP'=>false,
        ];
        $lote = Lote::find($loteID);
        if($lote==null){
            throw new Exception('Lote inexistente');
        }
        $lote->iniciarPlanificado($datosLote);

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
                $arrAux['cantidad']=$cantidadIng;
                array_push($consumos,$arrAux);
            }
        }

        GestorStock::actualizarConsumos($loteID,$consumos,$fechaStamp);

        //Retorno a la vista inicial de produccion en la fecha de este lote
        $data['lotes']=self::getArrayLotes($fecha);
        $data['fecha']=$fecha;
        return view('produccion.produccion',compact('data'));
        
    }

    public static function showLoteInProd ($id)
    {
        //obtemgo el produco de ese lote

        $loteObj = Lote::find($id);
        if ($loteObj==null) {
            throw new Exception('Lote inexistente');
        }
        $producto = Producto::find($loteObj->producto_id);
        if ($loteObj->tipoLote == TipoLote::FINALIZADO) {
            $cantidad = $loteObj->cantidadFinal;
        } else {
            $cantidad = $loteObj->cantidadElaborada;
        }
        $lote = ['id' => $loteObj->id,
            'cantidad' => $cantidad,
            'tipoLote' => TipoLote::toString($loteObj->tipoLote),
            'fecha'=>$loteObj->fechaInicio

        ];
        $formulacion = $producto->getFormulacion($cantidad);
        $trazabilidad = GestorLote::getTrazabilidadLote($id);
        return view('produccion.loteEnProduccion')
            ->with(compact('producto'))
            ->with(compact('formulacion'))
            ->with(compact('lote'))
            ->with(compact('trazabilidad'));
    }

    public static function indexLoteNoPlanificado(){
        $fecha = Carbon::now()->format('Y-m-d');
        $productos = Producto::getProductosSinInsumosArr();

        return view('produccion.iniciarLoteNoPlanificado')
            ->with(compact('productos'))
            ->with(compact('fecha'));
    }

    public static function getFormulacion(){
        $id=request()->input('id');
        $cantidad = request()->input('cantidad');
        $producto = Producto::find($id);
        return response()->json($producto->getFormulacion($cantidad));
       // return response("ok");

    }

    //Alta de lote no planificado
    public static function newLoteNoPlanificado(Request $request){

        $loteVista = $request->input('lote');
        $consumos = $request->input('consumo');  
        //Parseo los datos de la request
        $dataLoteArr = explode(',',$loteVista);
        $consumosArr = explode(',',$consumos);
        $data =[]; // variable utilizada para retornar a la nueva vista


        //Los primeros 4 datos del lote no pueden estar vacios
        for($i=0; $i<3;$i++){
            if(!isset($dataLoteArr[$i]) || trim($dataLoteArr[$i])===''){
                throw new Exception('Campo que no se permite vacio');
            }
        }
        
        $fecha = $dataLoteArr[2];
        // se concatena la horasminseg del momento a la fecha para crear el timestamp que requieren los movimientos
        $H_i_s = date('H:i:s');
        $fechaStamp = $fecha . " ". $H_i_s;
        //crear el lote
        $datosLote=[
            'producto_id'=>$dataLoteArr[0],
            'cantidadElaborada'=>$dataLoteArr[1],
            'fechaInicio'=>$fecha,
            'tipoTP'=>false,
        ];
        $lote = Lote::crearLoteNoPlanificado($datosLote);

        //crear los consumos
        for($i=0;$i<count($consumosArr);$i+=3){
            $prodIngId=$consumosArr[$i];
            $loteIngId=$consumosArr[$i+1];
            //La vista devuelve 'idInsumo',',' para los insumos que no han sido cargados (no se cargo el consumo)
            //Porlo que solo doy de alta los que correspondan
            if(isset($loteIngId) && trim($loteIngId)!==''){
                $cantidad=$consumosArr[$i+2];
                GestorStock::altaConsumo($lote->id, $loteIngId,$prodIngId,floatval($cantidad),$fechaStamp);
            }
        }

        //Retorno a la vista inicial de produccion en la fecha de este lote
        $data['lotes']=self::getArrayLotes($fecha);
        $data['fecha']=$fecha;
        return view('produccion.produccion',compact('data'));
    }
    
    public static function showModificarIniciado($id){
          $loteObj = Lote::find($id);
        if ($loteObj==null) {
            throw new Exception('Lote inexistente');
        }
        $producto = Producto::find($loteObj->producto_id);
        if ($loteObj->tipoLote == TipoLote::FINALIZADO) {
            $cantidad=$loteObj->cantidadFinal;
        }else{
            $cantidad=$loteObj->cantidadElaborada;
        }

        $lote= ['id'=>$loteObj->id,
            'cantidad'=>$cantidad,
            'tipoLote'=>TipoLote::toString($loteObj->tipoLote),
            'fecha'=>$loteObj->fechaInicio,
            'tipoTp'=>$loteObj->tipoTP,
            'asignatura'=>$loteObj->asignatura
        ];
        //$lote=$loteObj->toArray();

        $formulacion = $producto->getFormulacion($cantidad);
        $trazabilidad = GestorLote::getTrazabilidadLote($id);
        return view('produccion.modificarProductoIniciado')
            ->with(compact('producto'))
            ->with(compact('formulacion'))
            ->with(compact('lote'))
            ->with(compact('trazabilidad'));

        
    }

    public static function postModificarIniciado($id){


       /* $data['fecha']='2018-06-04';

        $data['lotes']=self::getArrayLotes('2018-06-04');
        return view('produccion.produccion',compact('data'));*/


        //Datos de la vista
        $loteVista = request()->input('lote');
        $consumosVista = request()->input('consumo');
        $loteID = request()->input('loteID');
        //Parseo los datos de la request
        $dataLoteArr = explode(',',$loteVista);
        $consumosArrVista = explode(',',$consumosVista);
        var_dump($loteID);
        var_dump($dataLoteArr);
        var_dump($consumosArrVista);
        return view('welcome');

        $datosLote = [];
        $consumos=[];
        $lote = Lote::find($datosLote['lote_id']);
        $fecha = $lote->fechaInicio;
        //modifico el lote
        $lote->modificarLote($consumos,$fecha);



        //Retorno a la vista inicial de produccion en la fecha de este lote
        $data['lotes']=self::getArrayLotes($fecha);
        $data['fecha']=$fecha;
        return view('produccion.produccion',compact('data'));

    }

    /**
     * Registra la maduracion de un lote iniciado
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws Exception
     */
    public static function postMaduracion($id)
    {

        $fechaInicioMaduracion = request()->input('fechaMaduracion');
        if ($fechaInicioMaduracion == null) {
            throw new Exception('Fecha inválida');
        }
        $lote = Lote::find($id);
        if ($lote == null) {
            throw new Exception('Lote no econtrado');
        }
        $lote->registrarMaduracion($fechaInicioMaduracion);

        //Retorno a la vista principal de produccion con la fecha de inicio del lote
        $data['lotes'] = self::getArrayLotes($lote->fechaInicio);
        $data['fecha'] = $fechaInicioMaduracion;
        return view('produccion.produccion', compact('data'));
    }


    /**
     * Finaliza un lote, calculando su costo y dando de alta en stock para su consumo o salida a ventas
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws Exception
     */
    public static function postFinalizarLote($id){


        $lote = Lote::find($id);
        if($lote==null){
            throw new Exception('lote no encontrado');
        }
        $fechaFinalizacion = request()->input('fechaFinalizacion');
        $fechaVencimiento = request()->input('fechaVencimiento');
        if(request()->exists('cantidad')) {
            $cantidadAlFinalizar = request()->input('cantidad');
        }
        else {
            $cantidadAlFinalizar = $lote->cantidadElaborada;
        }


        if($fechaFinalizacion==null || $fechaVencimiento ==null || $cantidadAlFinalizar ==null || $cantidadAlFinalizar <0 ) {
            throw new Exception('datos inválidos');
        }
        /*var_dump($fechaFinalizacion);
        var_dump($fechaVencimiento);
        var_dump($cantidadAlFinalizar);
        return vi*/

        $lote->finalizar($cantidadAlFinalizar,$fechaFinalizacion,$fechaVencimiento);

        //Re3torno a la vista principal de produccion con la fecha de finalizacion
        $data['lotes']=self::getArrayLotes($fechaFinalizacion);
        $data['fecha']=$fechaFinalizacion;
        return view('produccion.produccion',compact('data'));
    }


}
