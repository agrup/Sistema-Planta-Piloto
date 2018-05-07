<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        return view('programaProduccionSemanal.programaProduccionSemanal');
    }
    
    public function calendario(){
    	return view('programaProduccionSemanal.programaProduccionSemanal');
    }

    public function stock(){
    	//TODO Llamar a metodo del modelo para recuperar el stock
    	$stock = [];

    	for ($i=0; $i < 30 ; $i++) {     		
    		$stock[$i]['codigo'] = '00000000000';
            $stock[$i]['nombre'] = 'aaaaaaaaaaaaaa';
            $stock[$i]['cantidad'] = '999999999999';
    	} 

    	return view('informes.stock', compact('stock'));	
    }

    //Llamada desde el boton actualizar de la vista stock
    public function stockHasta(){
        //$fecha = $_GET['fecha'];
        $stock = [];
        for ($i=0; $i < 10 ; $i++) {            
            $stock[$i]['codigo'] = '11111111111111';
            $stock[$i]['nombre'] = '22222222222222';
            $stock[$i]['cantidad'] = '333333333333';
        }   
        return $stock;
    }
}

