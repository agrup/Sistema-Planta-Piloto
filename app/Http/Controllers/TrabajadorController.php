<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trabajador;

class TrabajadorController extends Controller
{
    public function index(){
    	$trabajadores= Trabajador::ALL();
    	 return view('trabajadores.index');
    }
    public function store() 
    {
    	dd(request()->all());
    }
       
    public function create() 
    {
    	return view('trabajadores.create');
    }

}
