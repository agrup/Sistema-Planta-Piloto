@extends('layouts.layoutPrincipal' )

@section('section')
	
					@include('elementosComunes.aperturaTitulo')
						@if ($insumoProducto=='producto')			
							Administración de Productos--> Agregar Producto
						@elseif ($insumoProducto=='insumo')
							Administración de Insumos--> Agregar Insumo
						@endif
					@include('elementosComunes.cierreTitulo')

						@if ($insumoProducto=='producto')			
							<form action="/productos/altaProducto" class="" method="POST">
						@elseif ($insumoProducto=='insumo')
							<form action="/productos/altaInsumo" class="" method="POST">
						@endif					    
							@csrf
					    	<div class="row">
						    	<div class="col-md-6">
						    		<div class="form-group">
						              	<label for="exampleInputEmail1">Código</label>
						              	<input type="text" name="codigo" class="form-control">
									 </div>
						            <div class="form-group">
						              <label>Nombre</label>
						              <input type="text" name="nombre" class="form-control"> </div>
						            <div class="form-group">
						              <label>Descripcion</label>
						              <input type="text" name="descripcion" class="form-control"> </div>
						            <div class="form-group">
						              <label for="exampleInputEmail1">Categoría</label>
						              <input type="text" name="categoria" class="form-control"> </div>								    
						        </div>
						        <div class="col-md-6">
						            <div class="form-group">
						              <label for="exampleInputEmail1">Tipo de Unidad</label>
						              <input type="text" name="tipoUnidad" class="form-control"> </div>
						            <div class="form-group">
						              <label for="exampleInputEmail1">Alarma (Activa o Inactiva)</label>
						              <select name="alarma" class="form-control" id="alarma">
	  										<option value="true">Activa</option>
	  										<option value="false">Inactiva</option>  					
									</select>
						            <div class="form-group">
						              <label for="exampleInputEmail1"> Cantidad para aviso de falta de stock</label>
						              <input type="text" name="alarmaAmarilla" class="form-control"> </div>
						            <div class="form-group">
						              <label for="exampleInputEmail1"> Cantidad para aviso de falta de stock crítica</label>
						              <input type="text" name="alarmaRoja" class="form-control"> </div>
						        </div>
					        </div>

						    @include('elementosComunes.aperturaBoton')
						    		<input type="submit" name="alta" value="Guardar">
								@if ($insumoProducto=='producto')
							          <a class="btn btn-primary" href="/productos/administracionProductos">Cancelar</a>
								@elseif ($insumoProducto=='insumo')		 					 
							          <a class="btn btn-primary" href="/productos/administracionInsumos">Cancelar</a>
								@endif							         
							@include('elementosComunes.cierreBoton')				              
						</form>
					

@endsection