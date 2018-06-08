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
							<form action="/productos/altaProducto" class="" method="POST" id="myForm" novalidate>
						@elseif ($insumoProducto=='insumo')
							<form action="/productos/altaInsumo" class="" method="POST" id="myForm" novalidate>
						@endif					    
							@csrf
					    	<div class="row">
						    	<div class="col-md-6">
						    		<div class="form-group">
						              	<label for="exampleInputEmail1">Código</label>
						              	<input type="text" name="codigo" class="form-control" required>
									</div>
						            <div class="form-group">
						              <label>Nombre</label>
						              <input type="text" name="nombre" class="form-control" required> </div>
						            <div class="form-group">
						              <label>Descripcion</label>
						              <input type="text" name="descripcion" class="form-control" required> </div>
						            <div class="form-group">
						              <label for="exampleInputEmail1">Categoría</label>
						              <input type="text" name="categoria" class="form-control" required> </div>								    
						        </div>
						        <div class="col-md-6">
						            <div class="form-group">
						              <label>Tipo de Unidad</label>
						              <input type="text" name="tipoUnidad" id="inputTipoUnidad" class="form-control" required> </div>
						            <div class="form-group">
						              <label>Alarma (Activa o Inactiva)</label>
						              <select name="alarmaActiva" class="form-control" id="alarma" required>
	  										<option value="true">Activa</option>
	  										<option value="false">Inactiva</option>  					
									</select>
						            <div class="form-group">
						              <label> Cantidad para aviso de falta de stock</label>
						              <input type="text" name="alarmaAmarilla" class="form-control" required> </div>
						            <div class="form-group">
						              <label> Cantidad para aviso de falta de stock crítica</label>
						              <input type="text" name="alarmaRoja" class="form-control" required> </div>
						        </div>
					        </div>
					        
						        
						        	
					        @if ($insumoProducto=='producto')
						        @include('administracion.agregarFormulacion')			        	
					        @endif							         

						    @include('elementosComunes.aperturaBoton')

						    		<button type="submit" name="alta"  href="" class="btn btn-primary" value="Guardar"> Guardar</button>
								@if ($insumoProducto=='producto')
							          <a class="btn btn-primary" href="/productos/administracionProductos">Cancelar</a>
							          
								@elseif ($insumoProducto=='insumo')		 					 
							          <a class="btn btn-primary" href="/productos/administracionInsumos">Cancelar</a>
								@endif							         
							@include('elementosComunes.cierreBoton')				  

							<input type="hidden" name="formulacion" value="" id="inputHidden"/>        

						</form>
					




@endsection
		@include('layouts.errors')
@section('script')
	@if ($insumoProducto=='producto')
		<script type="text/javascript" src="{{asset('js/administracion/agregarFormulacion.js')}}"></script>
		@endif
@endsection