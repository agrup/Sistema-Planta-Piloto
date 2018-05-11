<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movimientos;
use App\GestorStock;

class StockController extends Controller
{
    public function show()
    {
    	if (($fecha=request('fecha'))==null){
    		$fecha=date('Y-m-d');
    	}
    	$stock=GestorStock::getStockPorProd($fecha);
    	return view('informes.stock', compact('$stock'));	
    }
}
