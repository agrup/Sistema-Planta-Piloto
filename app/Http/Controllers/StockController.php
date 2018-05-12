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
    	if ($fecha=(request(['fecha']))==null){
    		$fecha=Carbon::now()->format('Y-m-d');

    	}else
    	{
    		return view('welcome',(['fecha'=>(request(['fecha']))]));
    	}
    	$fecha=Carbon::createFromFormat('Y-m-d',$fecha);
    	$fecha=$fecha->format('Y-m-d H:i:s');
    	$stock=GestorStock::getStockPorProd($fecha);
    	return view('informes.stock', compact('stock'));	
    }
}
