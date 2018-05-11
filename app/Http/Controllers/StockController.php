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
    	if ((request(['fecha']))==null){
    		$fecha=Carbon::now()->format('Y-m-d');

    	}else
    	{

    		$fecha=array_values(request(['fecha']))[0];
    		
    	}
    	$fecha=Carbon::createFromFormat('Y-m-d',$fecha);
    	$fecha=$fecha->format('Y-m-d H:i:s');
    	$stock=GestorStock::getStockPorProd($fecha);
    	return view('informes.stock', compact('stock'));	
    }
}
