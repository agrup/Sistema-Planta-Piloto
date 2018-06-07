
<?php

Route::get('/','MainController@index');


//INFORMES

//informes stock
Route::get('/stock', 'StockController@show')->middleware('checkRoles:administrador,');;
Route::post('/stock', 'StockController@show')->middleware('checkRoles:administrador,');;
//informes produccion
Route::get('/Informes/ResumenProduccion','ProduccionController@show')->middleware('checkRoles:administrador,');;
Route::post('/Informes/ResumenProduccion','ProduccionController@informeProduccion')->middleware('checkRoles:administrador,');;

//lotes 
Route::get('/verLotes', 'LotesController@show')->middleware('checkRoles:administrador,');;
Route::get('/detalleLote', 'LotesController@showDetalle')->middleware('checkRoles:administrador,');;

//Planificacion
Route::get('/planificacion', 'PlanificacionController@index')->middleware('checkRoles:administrador,');;
Route::post('/planificacion','PlanificacionController@show')->middleware('checkRoles:administrador,');;
Route::get('/calendarioSig','PlanificacionController@calendarioSig')->middleware('checkRoles:administrador,');; //flechita << >>
Route::get('/calendarioAnt','PlanificacionController@calendarioAnt')->middleware('checkRoles:administrador,');;
Route::get('/sumarizacion','PlanificacionController@verNecesidadInsumos')->middleware('checkRoles:administrador,');;
//Dia
Route::get('/planificacion/planificacionDia','PlanificacionController@PlanificacionDia')->middleware('checkRoles:administrador,');;
Route::post('/planificacion/planificacionDia','PlanificacionController@postPlanificacionDia')->middleware('checkRoles:administrador,');;

//Alta de planificacion
Route::post('/planificacion/agregarProducto','PlanificacionController@agregarProducto')->middleware('checkRoles:administrador,');;
Route::post('/planificacion/agregarInsumo','PlanificacionController@agregarInsumo')->middleware('checkRoles:administrador,');;
Route::post('/planificacion/eliminar','PlanificacionController@eliminar')->middleware('checkRoles:administrador,');;
Route::post('/planificacion/modificar', 'PlanificacionController@modificar')->middleware('checkRoles:administrador,');;


//Produccion

Route::get('/produccion','ProduccionController@index')->middleware('checkRoles:administrador,');
Route::post('/produccion','ProduccionController@show')->middleware('checkRoles:administrador,');
Route::get('/produccion/loteEnProduccion/{id}','ProduccionController@loteEnProduccion')->middleware('checkRoles:produccion,');
Route::get('/produccion/iniciarPlanificado/{id}','ProduccionController@iniciarPlanificado')->middleware('checkRoles:porduccion,');
Route::post('/produccion/iniciarPlanificado/','ProduccionController@postIniciarPlanificado')->middleware('checkRoles:produccion,');
Route::get('/produccion/loteNoPlanificado', 'ProduccionController@indexLoteNoPlanificado')->middleware('checkRoles:administrador,');;
Route::post('/produccion/loteNoPlanificado', 'ProduccionController@newLoteNoPlanificado')->middleware('checkRoles:administrador,');;
Route::get('/produccion/formulacion','ProduccionController@getFormulacion')->middleware('checkRoles:administrador,');;
Route::get('/produccion/loteEnProduccion/{id}' ,'ProduccionController@showLoteInProd')->middleware('checkRoles:administrador,');;
Route::get('/produccion/modificarIniciado/{id}','ProduccionController@showModificarIniciado')->middleware('checkRoles:administrador,');;
Route::post('/produccion/modificarIniciado/{id}', 'ProduccionController@postModificarIniciado')->middleware('checkRoles:administrador,');;
Route::post('/produccion/postMaduracion/{id}','ProduccionController@postMaduracion')->middleware('checkRoles:administrador,');;
Route::post('/produccion/postFinalizarLote/{id}','ProduccionController@postFinalizarLote')->middleware('checkRoles:administrador,');;

//Administracion
Route::get('/Administracion/BuscarProducto','ProductoController@search')->middleware('checkRoles:administrador,');;//busca insumos y productos a partir de un array de caracteristicas




Route::get('/productos/administracionProductos', 'ProductoController@administracionProducto')->middleware('checkRoles:administrador,');;
Route::get('/productos/administracionInsumos', 'ProductoController@administracionInsumo')->middleware('checkRoles:administrador,');;


//Alta Producto
Route::get('/productos/altaProducto', 'ProductoController@showAltaProducto')->middleware('checkRoles:administrador,');;
Route::post('/productos/altaProducto', 'ProductoController@altaProducto')->middleware('checkRoles:administrador,');;
//Alta Insumo
Route::get('/productos/altaInsumo', 'ProductoController@showaltaInsumo')->middleware('checkRoles:administrador,');;
Route::post('/productos/altaInsumo', 'ProductoController@altaInsumo')->middleware('checkRoles:administrador,');;

//Modificacion Producto
Route::get('/productos/modificarProducto', 'ProductoController@showModificarProducto')->middleware('checkRoles:administrador,');;
Route::post('/productos/modificarProducto', 'ProductoController@modificarProducto')->middleware('checkRoles:administrador,');;

//Eliminar Producto
Route::get('/productos/eliminarProducto', 'ProductoController@deleteProducto')->middleware('checkRoles:administrador,');;
//Route::post('/productos/eliminarProducto', 'ProductoController@modificarProducto');

//entrada lote insumo
Route::get('/stock/entradaLoteInsumo','LotesController@showentradaLoteInsumo')->middleware('checkRoles:administrador,');;
Route::post('/stock/entradaLoteInsumo','LotesController@alta')->middleware('checkRoles:administrador,');;



//Route fictisio
Route::get('/produccion/detalleLoteEnProduccion/{id}','PruebaController@detalleLoteEnProduccion')->middleware('checkRoles:administrador,');;

	
Route::get('/lotes', 'LotesController@index')->middleware('checkRoles:administrador,'); ;
Route::get('/lotes/{id}', 'LotesController@show')->middleware('checkRoles:administrador,'); ;

Route::get('/trabajador', 'TrabajadorController@index')->middleware('checkRoles:administrador,');;
Route::get('/trabajador/create', 'TrabajadorController@create')->middleware('checkRoles:administrador,');;
Route::post('/trabajador', 'TrabajadorController@store')->middleware('checkRoles:administrador,');;
//Gestion de stock
Route::get('/stock/entradaLoteInsumo','LotesController@showentradaLoteInsumo')->middleware('checkRoles:administrador,');;
Route::post('/stock/entradaLoteInsumo','LotesController@alta')->middleware('checkRoles:administrador,');;
Route::get('/stock/controlExistencias','LotesController@showControlExist')->middleware('checkRoles:administrador,');;
Route::post('/stock/controlExistencias','LotesController@saveControlExist')->middleware('checkRoles:administrador,');;


//Administracion de productoInsumos
//Route::get('/productos/altaProducto', 'ProductoController@altaProducto');
//Route::get('/productos/altaInsumo', 'ProductoController@altaInsumo');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
