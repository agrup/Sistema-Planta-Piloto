<?php

namespace App\Http\Controllers;

use App\Movimiento;
use Illuminate\Http\Request;
use App\Movimientos;
use App\GestorStock;
use Carbon\Carbon;

class StockController extends Controller
{
    public function show()
    {

    	if ((request()->input('fecha'))==null){
    		$fecha=Carbon::createFromFormat('Y-m-d H:i:s',Movimiento::getFechaUltimoReal())->format('Y-m-d');

    	}else
    	{

    		$fecha=(request()->input('fecha'));
    		
    	}
        $mostarPlanificados = (request()->input('mostarPlanificados'));


        if($mostarPlanificados){
            
            $mostarPlanificados=true;
        }else{
            $mostarPlanificados=false;
        }

    	/*$fecha=Carbon::createFromFormat('Y-m-d',$fecha);
    	$fechaString=$fecha->format('Y-m-d H:i:s');*/
    	$fechaString = $fecha . ' ' . '23:59:59';
    	$stock=GestorStock::getStockPorProd($fechaString,$mostarPlanificados);
    	return view('informes.stock')
                                    ->with('fecha',$fecha)
                                    ->with(compact('mostarPlanificados'))
                                    ->with(compact('stock'));	
    }
}
