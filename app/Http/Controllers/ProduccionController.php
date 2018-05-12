<?php

namespace App\Http\Controllers;

use App\GestorLote;
use App\Movimiento;
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

            $producto = $lote->producto();
            $arrAux=[];
            $arrAux['lote']=$lote->id; //TODO Hay que hacer el codigo del lote, no esta en la migration
           $arrAux['producto']=$producto->nombre;
           $arrAux['tu']=$producto->tipoUnidad;
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
        } //end foreach lotes
        return $arrayLotes;
    }

    public static function loteEnProduccion(){

    }
}