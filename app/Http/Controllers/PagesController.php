<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GestorStocl;

class PagesController extends Controller
{
    public function index(){

        return view('programaProduccionSemanal.programaProduccionSemanal');

    }
    public function produccion(){    	
        return view('Produccion');	

    }
    
    public function calendario(){
    	return view('programaProduccionSemanal.programaProduccionSemanal');
    }

    	/*
    public function stock()
    {       
        $stock = [];

        if(isset($_POST['inputDate'])){

            //TODO LLAMAR A FUNCION DEL  MODELO CUANDO SE INGRESE UNA FECHA
            //$stock = getStock($_POST['inputDate']);

            //TODO COMENTAR
        	for ($i=0; $i < 30 ; $i++) {     		
        		$stock[$i]['codigo'] = '1234';
                $stock[$i]['nombre'] = 'Azucar';
                $stock[$i]['cantidad'] = '10000';
                $stock[$i]['unidad'] = $_POST['inputDate'];
                $stock[$i]['alarma'] = 'roja';
        	} 
        }else{

            //TODO LLAMAR A FUNCION DEL MODELO CUNADO NO SE INGRESE UNA FECHA
            //$stock = getStock();

            //TODO COMENTAR
            for ($i=0; $i < 30 ; $i++) {            
                $stock[$i]['codigo'] = '1234';
                $stock[$i]['nombre'] = 'Azucar';
                $stock[$i]['cantidad'] = '10000';
                $stock[$i]['unidad'] = 'Kkkkkkk';
                $stock[$i]['alarma'] = 'amarilla';
            }     
            
        }
    	return view('informes.stock', compact('stock'));	
    }*/

    public function verLotes(){
        $lote = [];


        $lote['producto'] = "Leche";
        $lote['tu'] = "Litros";
        $lote['lotes'] = [];
        for ($i=0; $i < 10 ; $i++){
            $lote['lotes'][$i]['numeroLote'] = "1234";
            $lote['lotes'][$i]['fechaInicio'] = "12/12/2018";
            $lote['lotes'][$i]['vencimiento'] = "12/12/2019";
            $lote['lotes'][$i]['cantidad'] = "10000";

        }


        return view('informes.verLotes', compact('lote'));   
    }

    public function detalleLote(){
        $detalle = [];        
        $detalle['detalleElaboracion'] = [];

        //ULTIMOS AGREGADOS NO ACORDADOS
        $detalle['codigo'] = 'PL_1234';
        $detalle['nombreProducto'] = 'Leche';
        $detalle['fechaInicio'] = '12/05/2018';

        //
        $detalle['numeroLote'] = '12122018';
        $detalle['vencimiento'] = '12122018';
        $detalle['cantidad'] = '10000';
        $detalle['tu'] = 'Kg';
        $detalle['cantidadElaborada'] = '20000';
        $detalle['costoUnitario'] = '120';
        $detalle['inicioMaduracion'] = '12122018';
        $detalle['finalizacion'] = '12122018';
        $detalle['cantidadFinal'] = '20000';
        $detalle['proveedor'] = 'ffffff';
        $detalle['tipoTp'] = 'rffffff';
        $detalle['asignatura'] = 'ffffff';

        //ARREGLO DE INGREDIENTES DEL LOTE    
        for ($i=0; $i <10; $i++) { 
            $detalle['detalleElaboracion'][$i]['numeroLote'] = '11111111111111111';
            $detalle['detalleElaboracion'][$i]['insumo'] = '2222222222222222';
            $detalle['detalleElaboracion'][$i]['cantidadStock'] = '333333333333333333';
            $detalle['detalleElaboracion'][$i]['tu'] = '444444444444444444';

        }



        return view('informes.detalleLote', compact('detalle'));   

    }

}

