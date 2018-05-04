<?php 

use App\Lote;

Route::get('/', function () {

	$name = 'Planta Piloto';
	$branch ='branch Agu';

    return view('welcome' ,
    	compact('name','branch')

    	);
});


Route::get('/planificacion', 'Planificacioncontroller@verCalendario($id)' );
Route::get('/lotes', 'LotesController@index') ;
Route::get('/lotes/{id}', 'LotesController@show') ;

Route::get('/trabajador', 'TrabajadorController@index');
Route::get('/trabajador/create', 'TrabajadorController@create');
Route::post('/trabajador', 'TrabajadorController@create');