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
    	$trabajador = new Trabajador;

        $trabajador->sector = request('sector');

        $trabajador->puesto = request('puesto');

        $trabajador->legajo = request('legajo');

        $trabajador->seudonimo = request('seudonimo');

        $trabajador->save();

        return redirect('/');

    }
       
    public function create() 
    {
    	return view('trabajadores.create');
    }

}
