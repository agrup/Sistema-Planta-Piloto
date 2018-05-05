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
}
