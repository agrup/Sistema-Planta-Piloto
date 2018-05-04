<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
    	$tittle='este es un titulo';
    	return view('pages.index',compact('tittle'));
    }
    public function produccion(){
    	
        return view('pages.Produccion');	
    }
    public function calendario(){
    	return view('programaProduccionSemanal.programaProduccionSemanal');
    }
}
