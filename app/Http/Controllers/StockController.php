<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movimientos;
use App\GestorStock;
use Carbon\Carbon;

class StockController extends Controller
{
    public function show()
    {

    	if ((request()->input('fecha'))==null){
    		$fecha=Carbon::now()->format('Y-m-d');

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

    	$fecha=Carbon::createFromFormat('Y-m-d',$fecha);
    	$fechaString=$fecha->format('Y-m-d H:i:s');
    	$stock=GestorStock::getStockPorProd($fechaString,$mostarPlanificados);
    	return view('informes.stock')
                                    ->with('fecha',$fecha->format('Y-m-d'))
                                    ->with($mostarPlanificados)
                                    ->with(compact('stock'));	
    }
}
