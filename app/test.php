<?php 
require_once \App\Producto::class;

$planificaciones = [
     [
        'diaSemana'=>'lunes',
        'fecha'=> '2018-05-07',
        'productos'=> [
            ['codigo'=>'pl001', 'nombre'=>'Queso Sardo', 'cantidad'=> 10, 'tipoUnidad'=> 'kg' ],
            ['codigo'=>'pl021', 'nombre'=>'Ricota', 'cantidad'=> 3, 'tipoUnidad'=> 'kg' ]
        ],

        'insumos'=> [
            ['codigo'=>'i001', 'nombre'=>'Sal', 'cantidad'=> 10000, 'tipoUnidad'=> 'gr' ],
            ['codigo'=>'i002', 'nombre'=>'Fermento', 'cantidad'=> 5000, 'tipoUnidad'=> 'gr' ]
        ],

        'trabajadores' => [ 'Tito', 'Darío']

    ],

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

    ],

    [
        'diaSemana'=>'miercoles',
        'fecha'=> '2018-05-09',
        'productos'=> [
        ],

        'insumos'=> [
        ],

        'trabajadores' => [ 'Tito', 'Darío']

    ],

    [
        'diaSemana'=>'jueves',
        'fecha'=> '2018-05-10',
        'productos'=> [
        ],

        'insumos'=> [
            ['codigo'=>'pl002', 'nombre'=>'Leche', 'cantidad'=> 100, 'tipoUnidad'=> 'l' ],

        ],

        'trabajadores' => [ 'Tito', 'Darío']

    ],

    [
        'diaSemana'=>'viernes',
        'fecha'=> '2018-05-11',
        'productos'=> [

        ],

        'insumos'=> [

        ],

        'trabajadores' => [ 'Tito', 'Darío']

    ]


];
