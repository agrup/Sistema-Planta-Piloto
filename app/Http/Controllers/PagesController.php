<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
    	$fechasSemana= array('20/7','21/7','22/7','23/7','24/7');
    	$semana=array();
    	for ($i=0; $i < 5 ; $i++) {     		
    		$semana[$i]['lunes'] = 'Helado';
            $semana[$i]['martes'] = 'Yogurt';
            $semana[$i]['miercoles'] = 'Mascarpone';
            $semana[$i]['jueves'] ='Yogurt';
            $semana[$i]['viernes'] ='Helado';
    	} 

        $hola='holaaa';
    	return view('programaProduccionSemanal.programaProduccionSemanal',compact('fechasSemana','semana'));
    }

    public function calendario(){
    	$fechasSemana= array('20/7','21/7','22/7','23/7','24/7');
    	$hola='holaaa';
    	return view('programaProduccionSemanal.programaProduccionSemanal',compact('hola'));
    	//return view('programaProduccionSemanal.tablasProduccionSemanal'->with('semana',$fechasSemana));
    }
    public function sumarizacion(){
    	return view('informes.sumatoriaDeNecesidadDeInsumos');
    }

}
