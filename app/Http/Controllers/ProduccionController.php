<?php

namespace App\Http\Controllers;

use App\GestorLote;
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



        return view('produccion.iniciarLotePlanificado')
                                    ->with(compact('lote'))
                                    ->with(compact('formulacion'))
                                    ->with(compact('producto'))                        ;
    }



    public function showLoteInProd ($id){
        //$loteId =request()->input('id');
        //obtemgo el produco de ese lote

        $loteObj = Lote::find($id);
        $producto = Producto::find($loteObj->producto_id);
        if ($loteObj->tipoLote == TipoLote::FINALIZADO) {
            $cantidad=$loteObj->cantidadFinal;
        }else{
            $cantidad=$loteObj->cantidadElaborada;
        }
        $lote= ['id'=>$loteObj->id,
            'cantidad'=>$cantidad,
            'tipoLote'=>TipoLote::toString($loteObj->tipoLote),
        ];
        $formulacion = $producto->getFormulacion($cantidad);
        $trazabilidad = GestorLote::getTrazabilidadLote($id);
        return view('produccion.loteEnProduccion')
            ->with(compact('producto'))
            ->with(compact('formulacion'))
            ->with(compact('lote'))
            ->with(compact('trazabilidad'));

    }

    public static function loteNoPlanificado(){

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

        return view('produccion.iniciarLoteNoPlanificado',['productos'=>$productos]);
    }

    public static function getFormulacion(){
        $id=request()->input('id');
        $cantidad = request()->input('cantidad');
        $producto = Producto::find($id);
        return response()->json($producto->getFormulacion($cantidad));
       // return response("ok");

    }
    public static function newLoteNoPlanificado(Request $request){

        /*$json = $request->input('json');
        var_dump($json);
        return view('welcome');*/

        $data =[];
        $fecha = $request->input('json.fecha');
        //crear el lote
        $datosLote=[
            'producto_id'=>$request->input('json.producto'),
            'fechaInicio'=>$fecha,
            'cantidadElaborada'=>$request->input('json.cantidad'),
            'tipoTP'=>$request->input('json.tipoTP'),
            'asignatura'=>$request->input('json.asignatura'),
        ];


        $lote = Lote::crearLoteNoPlanificado($datosLote);
        //crear los consumos
        // TODO

        $data['lotes']=self::getArrayLotes($fecha);
        $data['fecha']=$fecha;
        return view('produccion.produccion',compact('data'));


    }



}
