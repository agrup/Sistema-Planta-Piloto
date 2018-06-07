
<?php

Route::get('/','MainController@index');


//INFORMES

//informes stock
Route::get('/stock', 'StockController@show')->middleware('checkRoles:administrador,produccion,jefeProduccion');
Route::post('/stock', 'StockController@show')->middleware('checkRoles:administrador,produccion,jefeProduccion');
//informes produccion
Route::get('/Informes/ResumenProduccion','ProduccionController@show')->middleware('checkRoles:administrador,produccion,jefeProduccion');
Route::post('/Informes/ResumenProduccion','ProduccionController@informeProduccion')->middleware('checkRoles:administrador,produccion,jefeProduccion');

//lotes 
Route::get('/verLotes', 'LotesController@show')->middleware('checkRoles:administrador,produccion,jefeProduccion');
Route::get('/detalleLote', 'LotesController@showDetalle')->middleware('checkRoles:administrador,produccion,jefeProduccion');

//Planificacion
Route::get('/planificacion', 'PlanificacionController@index')->middleware('checkRoles:administrador,produccion,jefeProduccion');
Route::post('/planificacion','PlanificacionController@show')->middleware('checkRoles:administrador,produccion,jefeProduccion');
Route::get('/calendarioSig','PlanificacionController@calendarioSig')->middleware('checkRoles:administrador,produccion,jefeProduccion'); //flechita << >>
Route::get('/calendarioAnt','PlanificacionController@calendarioAnt')->middleware('checkRoles:administrador,produccion,jefeProduccion');
Route::get('/sumarizacion','PlanificacionController@verNecesidadInsumos')->middleware('checkRoles:administrador,produccion,jefeProduccion');
//Dia
Route::get('/planificacion/planificacionDia','PlanificacionController@PlanificacionDia')->middleware('checkRoles:administrador,produccion,jefeProduccion')->middleware('checkRoles:administrador,produccion,jefeProduccion');
Route::post('/planificacion/planificacionDia','PlanificacionController@postPlanificacionDia')->middleware('checkRoles:administrador,produccion,jefeProduccion')->middleware('checkRoles:administrador,produccion,jefeProduccion');

//Alta de planificacion
Route::post('/planificacion/agregarProducto','PlanificacionController@agregarProducto')->middleware('checkRoles:administrador,produccion,jefeProduccion');
Route::post('/planificacion/agregarInsumo','PlanificacionController@agregarInsumo')->middleware('checkRoles:administrador,produccion,jefeProduccion');
Route::post('/planificacion/eliminar','PlanificacionController@eliminar')->middleware('checkRoles:administrador,produccion,jefeProduccion');
Route::post('/planificacion/modificar', 'PlanificacionController@modificar')->middleware('checkRoles:administrador,produccion,jefeProduccion');


//Produccion

Route::get('/produccion','ProduccionController@index')->middleware('checkRoles:administrador,produccion,jefeProduccion');
Route::post('/produccion','ProduccionController@show')->middleware('checkRoles:administrador,produccion,jefeProduccion');
Route::get('/produccion/loteEnProduccion/{id}','ProduccionController@loteEnProduccion')->middleware('checkRoles:administrador,produccion,jefeProduccion');
Route::get('/produccion/iniciarPlanificado/{id}','ProduccionController@iniciarPlanificado')->middleware('checkRoles:administrador,jefeProduccion');
Route::post('/produccion/iniciarPlanificado/','ProduccionController@postIniciarPlanificado')->middleware('checkRoles:administrador,jefeProduccion');;
Route::get('/produccion/loteNoPlanificado', 'ProduccionController@indexLoteNoPlanificado')->middleware('checkRoles:administrador,jefeProduccion');;
Route::post('/produccion/loteNoPlanificado', 'ProduccionController@newLoteNoPlanificado')->middleware('checkRoles:administrador,jefeProduccion');;
Route::get('/produccion/formulacion','ProduccionController@getFormulacion')->middleware('checkRoles:administrador,produccion,jefeProduccion');
Route::get('/produccion/loteEnProduccion/{id}' ,'ProduccionController@showLoteInProd')->middleware('checkRoles:administrador,produccion,jefeProduccion');
Route::get('/produccion/modificarIniciado/{id}','ProduccionController@showModificarIniciado')->middleware('checkRoles:administrador,produccion,jefeProduccion');
Route::post('/produccion/modificarIniciado/{id}', 'ProduccionController@postModificarIniciado')->middleware('checkRoles:administrador,produccion,jefeProduccion');
Route::post('/produccion/postMaduracion/{id}','ProduccionController@postMaduracion')->middleware('checkRoles:administrador,produccion,jefeProduccion');
Route::post('/produccion/postFinalizarLote/{id}','ProduccionController@postFinalizarLote')->middleware('checkRoles:administrador,produccion,jefeProduccion');

//Administracion
Route::get('/Administracion/BuscarProducto','ProductoController@search')->middleware('checkRoles:administrador,produccion,jefeProduccion');//busca insumos y productos a partir de un array de caracteristicas




Route::get('/productos/administracionProductos', 'ProductoController@administracionProducto')->middleware('checkRoles:administrador,produccion,jefeProduccion');
Route::get('/productos/administracionInsumos', 'ProductoController@administracionInsumo')->middleware('checkRoles:administrador,produccion,jefeProduccion');


//Alta Producto
Route::get('/productos/altaProducto', 'ProductoController@showAltaProducto')->middleware('checkRoles:administrador,produccion,jefeProduccion');
Route::post('/productos/altaProducto', 'ProductoController@altaProducto')->middleware('checkRoles:administrador,produccion,jefeProduccion');
//Alta Insumo
Route::get('/productos/altaInsumo', 'ProductoController@showaltaInsumo')->middleware('checkRoles:administrador,produccion,jefeProduccion');
Route::post('/productos/altaInsumo', 'ProductoController@altaInsumo')->middleware('checkRoles:administrador,produccion,jefeProduccion');

//Modificacion Producto
Route::get('/productos/modificarProducto', 'ProductoController@showModificarProducto')->middleware('checkRoles:administrador,produccion,jefeProduccion');
Route::post('/productos/modificarProducto', 'ProductoController@modificarProducto')->middleware('checkRoles:administrador,produccion,jefeProduccion');

//Eliminar Producto
Route::get('/productos/eliminarProducto', 'ProductoController@deleteProducto')->middleware('checkRoles:administrador,produccion,jefeProduccion');
//Route::post('/productos/eliminarProducto', 'ProductoController@modificarProducto');

//entrada lote insumo
Route::get('/stock/entradaLoteInsumo','LotesController@showentradaLoteInsumo')->middleware('checkRoles:administrador,produccion,jefeProduccion');
Route::post('/stock/entradaLoteInsumo','LotesController@alta')->middleware('checkRoles:administrador,produccion,jefeProduccion');



//Route fictisio
Route::get('/produccion/detalleLoteEnProduccion/{id}','PruebaController@detalleLoteEnProduccion')->middleware('checkRoles:administrador,produccion,jefeProduccion')->middleware('checkRoles:administrador,produccion,jefeProduccion');

	
Route::get('/lotes', 'LotesController@index')->middleware('checkRoles:administrador,produccion,jefeProduccion') ;
Route::get('/lotes/{id}', 'LotesController@show')->middleware('checkRoles:administrador,produccion,jefeProduccion') ;

Route::get('/trabajador', 'TrabajadorController@index')->middleware('checkRoles:administrador,produccion,jefeProduccion');
Route::get('/trabajador/create', 'TrabajadorController@create')->middleware('checkRoles:administrador,produccion,jefeProduccion');
Route::post('/trabajador', 'TrabajadorController@store')->middleware('checkRoles:administrador,produccion,jefeProduccion');
//Gestion de stock
Route::get('/stock/entradaLoteInsumo','LotesController@showentradaLoteInsumo')->middleware('checkRoles:administrador,produccion,jefeProduccion');
Route::post('/stock/entradaLoteInsumo','LotesController@alta')->middleware('checkRoles:administrador,produccion,jefeProduccion');
Route::get('/stock/controlExistencias','LotesController@showControlExist')->middleware('checkRoles:administrador,produccion,jefeProduccion');
Route::post('/stock/controlExistencias','LotesController@saveControlExist')->middleware('checkRoles:administrador,produccion,jefeProduccion');


//Administracion de productoInsumos
//Route::get('/productos/altaProducto', 'ProductoController@altaProducto');
//Route::get('/productos/altaInsumo', 'ProductoController@altaInsumo');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
