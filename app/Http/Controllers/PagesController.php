<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){

    	$planificaciones = [
     [
    'diaSemana'=>'lunes',
    'fecha'=> '2018-05-07',
    'productos'=> [
       [ 'codigo'=>'pl001', 'nombre'=>'Queso Sardo', 'cantidad'=> 10, 'tipoUnidad'=> 'kg'] ,
       [ 'codigo'=>'pl021', 'nombre'=>'Ricota', 'cantidad'=> 3, 'tipoUnidad'=> 'kg' ]
    ],

    'insumos'=> [
        ['codigo'=>'i001', 'nombre'=>'Sal', 'cantidad'=> 10000, 'tipoUnidad'=> 'gr' ],
        ['codigo'=>'i002', 'nombre'=>'Fermento', 'cantidad'=> 5000, 'tipoUnidad'=> 'gr' ]
    ],

    'trabajadores' => [ 'Tito', 'Darío']

    ], //1

    [
        'diaSemana'=>'martes',
        'fecha'=> '2018-05-08',
        'productos'=> [
            ['codigo'=>'pl001', 'nombre'=>'Queso Sardo', 'cantidad'=> 10, 'tipoUnidad'=> 'kg' ],
        ],

        'insumos'=> [
            ['codigo'=>'i002', 'nombre'=>'Fermento', 'cantidad'=> 5000, 'tipoUnidad'=> 'gr' ]
        ],

        'trabajadores' => [ 'Tito', 'Darío']

    ], //2

    [
        'diaSemana'=>'miercoles',
        'fecha'=> '2018-05-09',
        'productos'=> [
            
        ],

        'insumos'=> [
        ],

        'trabajadores' => [ 'Tito', 'Darío']

    ], //3

    [
        'diaSemana'=>'jueves',
        'fecha'=> '2018-05-10',
        'productos'=> [ 
            ['codigo'=>'pl001', 'nombre'=>'Queso Sardo', 'cantidad'=> 10, 'tipoUnidad'=> 'kg' ],
        ],

        'insumos'=> [
            ['codigo'=>'pl002', 'nombre'=>'Leche', 'cantidad'=> 100, 'tipoUnidad'=> 'l' ],

        ],

        'trabajadores' => [ 'Tito', 'Darío']

    ], //4

    [
        'diaSemana'=>'viernes',
        'fecha'=> '2018-05-11',
        'productos'=> [
            ['codigo'=>'pl001', 'nombre'=>'Queso Sardo', 'cantidad'=> 10, 'tipoUnidad'=> 'kg' ],
        ],

        'insumos'=> [

        ],

        'trabajadores' => [ 'Tito', 'Darío']

    ]//5


];

       
    	return view('programaProduccionSemanal.programaProduccionSemanal',compact('planificaciones'));
    }

    public function calendarioAnt(){
    	   $fechasSemana= array('13/7','14/7','15/7','16/7','17/7');
        $semana=array();
        for ($i=0; $i < 5 ; $i++) {             
            $semana[$i]['lunes'] = 'Helado';
            $semana[$i]['martes'] = 'Yogurt';
            $semana[$i]['miercoles'] = 'Mascarpone';
            $semana[$i]['jueves'] ='Yogurt';
            $semana[$i]['viernes'] ='Helado';
        } 

       
        return view('programaProduccionSemanal.programaProduccionSemanal',compact('fechasSemana','semana'));

    }
    public function calendarioSig(){
           $fechasSemana= array('27/7','28/7','29/7','30/7','31/7');
        $semana=array();
        for ($i=0; $i < 5 ; $i++) {             
            $semana[$i]['lunes'] = 'Helado';
            $semana[$i]['martes'] = 'Yogurt';
            $semana[$i]['miercoles'] = 'Mascarpone';
            $semana[$i]['jueves'] ='Yogurt';
            $semana[$i]['viernes'] ='Helado';
        } 

       
        return view('programaProduccionSemanal.programaProduccionSemanal',compact('fechasSemana','semana'));
    }
    public function calendarioDia(){
      $planificaciones = [
     [
    'diaSemana'=>'lunes',
    'fecha'=> '2018-05-07',
    'productos'=> [
       [ 'codigo'=>'pl001', 'nombre'=>'Queso Sardo', 'cantidad'=> 10, 'tipoUnidad'=> 'kg'] ,
       [ 'codigo'=>'pl021', 'nombre'=>'Ricota', 'cantidad'=> 3, 'tipoUnidad'=> 'kg' ]
    ],

    'insumos'=> [
        ['codigo'=>'i001', 'nombre'=>'Sal', 'cantidad'=> 10000, 'tipoUnidad'=> 'gr' ],
        ['codigo'=>'i002', 'nombre'=>'Fermento', 'cantidad'=> 5000, 'tipoUnidad'=> 'gr' ]
    ],

    'trabajadores' => [ 'Tito', 'Darío']

    ], //1

    [
        'diaSemana'=>'martes',
        'fecha'=> '2018-05-08',
        'productos'=> [
            ['codigo'=>'pl001', 'nombre'=>'Queso Sardo', 'cantidad'=> 10, 'tipoUnidad'=> 'kg' ],
        ],

        'insumos'=> [
            ['codigo'=>'i002', 'nombre'=>'Fermento', 'cantidad'=> 5000, 'tipoUnidad'=> 'gr' ]
        ],

        'trabajadores' => [ 'Tito', 'Darío']

    ], //2

    [
        'diaSemana'=>'miercoles',
        'fecha'=> '2018-05-09',
        'productos'=> [
            
        ],

        'insumos'=> [
        ],

        'trabajadores' => [ 'Tito', 'Darío']

    ], //3

    [
        'diaSemana'=>'jueves',
        'fecha'=> '2018-05-10',
        'productos'=> [ 
            ['codigo'=>'pl001', 'nombre'=>'Queso Sardo', 'cantidad'=> 10, 'tipoUnidad'=> 'kg' ],
        ],

        'insumos'=> [
            ['codigo'=>'pl002', 'nombre'=>'Leche', 'cantidad'=> 100, 'tipoUnidad'=> 'l' ],

        ],

        'trabajadores' => [ 'Tito', 'Darío']

    ], //4

    [
        'diaSemana'=>'viernes',
        'fecha'=> '2018-05-11',
        'productos'=> [
            ['codigo'=>'pl001', 'nombre'=>'Queso Sardo', 'cantidad'=> 10, 'tipoUnidad'=> 'kg' ],
        ],

        'insumos'=> [

        ],

        'trabajadores' => [ 'Tito', 'Darío']

    ]//5


];  
       
       
        return view('programaProduccionSemanal.planificacionProductosEInsumos',compact('planificaciones'));
    }
    public function sumarizacion(){
    	return view('informes.sumatoriaDeNecesidadDeInsumos');
    }

}
