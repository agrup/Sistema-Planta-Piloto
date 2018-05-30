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
       /* $fecha =Carbon::createFromFormat('Y-m-d H:i:s',Movimiento::getFechaUltimoReal());
        $fecha = $fecha->format('Y-m-d');*/
       $fecha = '2018-05-04';
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
        $productosAux = Producto::all();
        $productos =[];
        foreach ($productosAux as $producto){
            $arrAux=[];
            //chequeo que el producto no sea un insumo
            if(!empty($producto->getIngredientes())){
                $arrAux = $producto->toArray();
                array_push($productos,$arrAux);
            }
        }

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

        $producto = $request->input('producto');       
        $consumos = $request->input('consumo');  
        //Parseo los datos de la request
        $dataLoteArr = explode(',',$producto);
        $consumosArr = explode(',',$consumos);
        $data =[]; // variable utilizada para retornar a la nueva vista
        /*var_dump($producto);
        var_dump($consumos);
        var_dump($dataLoteArr);*/

        //Los primeros 4 datos del lote no pueden estar vacios
        for($i=0; $i<4;$i++){
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
            'tipoTP'=>$dataLoteArr[3],
            'asignatura'=>$dataLoteArr[4]
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
        //Datos de la vista
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


}
