
<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Planificacion
Route::get('/planificacion', 'PlanificacionController@index');
Route::post('/planificacion','PlanificacionController@show');
Route::get('/planificacionDia','PagesController@calendarioDia');
Route::get('/calendarioSig','PlanificacionController@calendarioSig'); //flechita << >>
Route::get('/calendarioAnt','PlanificacionController@calendarioAnt');
Route::post('/sumarizacion','PagesController@verNecesidadInsumos');



Route::get('/','PagesController@index');
Route::get('/produccion','PagesController@produccion');

Route::get('/lotes', 'LotesController@index') ;
Route::get('/lotes/{id}', 'LotesController@show') ;

Route::get('/trabajador', 'TrabajadorController@index');
Route::get('/trabajador/create', 'TrabajadorController@create');
Route::post('/trabajador', 'TrabajadorController@store');

Route::get('/test', function() {
  	$producto = Producto::find(1)->formulacion;
  	echo ("$producto");
	
});


