<?php

namespace App\Http\Controllers;

use App\GestorStock;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $alarmas = GestorStock::getAlarmasActivas();
    	return view('welcome')->with(compact('alarmas'));
    }
}
