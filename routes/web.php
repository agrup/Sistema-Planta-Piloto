
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

//Route::get('/', function () {
  //  return view('welcome');
//});
//un Ejemplo

//
//Route::get('/hola', function () {
  //  return 'HOLA';
//});
//Route::get('/planta',function(){
//	return view('pages.Produccion');
//});

//devolver el id del 
//Route::get('/users/{id}',function($id){
//	return 'este es el user '.$id;
//});

Route::get('/','PagesController@index');
Route::get('/produccion','PagesController@produccion');
Route::post('/calendarioSig','PagesController@calendarioSig'); //flechita << >>
Route::post('/calendarioAnt','PagesController@calendarioAnt');
//Route::get('/sumarizacion','PagesController@sumarizacion');
Route::post('/sumarizacion','PagesController@sumarizacion');
Route::post('/calendarioDia','PagesController@calendarioDia');

Route::get('/planificacion', 'Planificacioncontroller@verCalendario($id)' );
Route::get('/lotes', 'LotesController@index') ;
Route::get('/lotes/{id}', 'LotesController@show') ;

Route::get('/trabajador', 'TrabajadorController@index');
Route::get('/trabajador/create', 'TrabajadorController@create');
Route::post('/trabajador', 'TrabajadorController@store');

Route::get('/test', function() {
  	$producto = Producto::find(1)->formulacion;
  	echo ("$producto");
	
});


