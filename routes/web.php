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
Route::get('/calendarioSig','PagesController@calendarioSig'); //flechita << >>
Route::get('/calendarioAnt','PagesController@calendarioAnt');
//Route::get('/sumarizacion','PagesController@sumarizacion');
Route::get('/sumarizacion','PagesController@sumarizacion');
Route::get('/planificacionDia','PagesController@planificacionDia');