@extends('layouts.layoutPrincipal' )

@section('section')
	
					@include('elementosComunes.aperturaTitulo')
						@if ($insumoProducto=='producto')			
							Alta de Producto
						@elseif ($insumoProducto=='insumo')
							Alta de Insumo
						@endif
					@include('elementosComunes.cierreTitulo')

					@if ($insumoProducto=='producto')			
						<form action="/productos/altaProducto" class="" method="POST" id="myForm" >
							{{csrf_field()}}
					@elseif ($insumoProducto=='insumo')
						<form action="/productos/altaInsumo" class="" method="POST" id="myForm" >
							{{csrf_field()}}
					@endif					    

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
										<label for="categoria">Categoría</label>
										@if ($insumoProducto=='producto')
											<select name="categoria" class="form-control" required>
												@foreach(\App\Categorias::productos() as $categ)
													<option value="{{$categ}}">{{$categ}}</option>
												@endforeach
											</select>
										@elseif ($insumoProducto=='insumo')
											<input type="text" value="Insumo" name="categoria" class="form-control" disabled>
										@endif
									</div>
								</div>
						        <div class="col-md-6">
						            <div class="form-group">
							            <label>Tipo de Unidad</label>
							            <input type="text" name="tipoUnidad" id="inputTipoUnidad" class="form-control" required> 
						          	</div>
						            <div class="form-group">
							            <label>Alarma (Activa o Inactiva)</label>
							            <select name="alarmaActiva" class="form-control" id="alarma" required>
		  									<option value="1">Activa</option>
		  									<option value="0">Inactiva</option>
										</select>
									</div>
						            <div class="form-group">
						            	<label> Cantidad para aviso de falta de stock</label>
						            	<input type="text" name="alarmaAmarilla" id="alarmaAmarilla" class="form-control" required> 
						            </div>
						            <div class="form-group">
						              	<label> Cantidad para aviso de falta de stock crítica</label>
						              	<input type="text" name="alarmaRoja" id="alarmaRoja" class="form-control" required> 
						              	
						          	</div>
						        </div>
					        </div>   
						        
						    
					        @if ($insumoProducto=='producto')
					        	<input type="hidden" name="formulacion" value="" id="inputHidden"/>
						        @include('administracion.agregarFormulacion')				         
					        @endif							         
					     
						    @include('elementosComunes.aperturaBoton')
						    	<input type="submit" name="action" class="btn btn-primary" value="Guardar">						    	
						    @include('elementosComunes.cierreBoton')			
						
						</form>

						
								
								@if ($insumoProducto=='producto')
									<form action="/productos/administracionProductos" method="GET">
									  	<button class="btn btn-secondary" type="submit">Volver</button>	
									  </form>
							          {{-- <a class="btn btn-primary" href="/productos/administracionProductos">Volver</a> --}}
							          
								@elseif ($insumoProducto=='insumo')		 					 
									<form action="/productos/administracionInsumos" method="GET">
										<button class="btn btn-secondary" type="submit">Volver</button>
							        	{{-- <a class="btn btn-primary" href="/productos/administracionInsumos">Volver</a> --}}
							        </form>
								@endif		        
							
						
					
					


				

@endsection



@section('script')

	<script type="text/javascript" src="{{asset('js/administracion/inhabilitarInputsCriticos.js')}}"></script>
	
	@if ($insumoProducto=='producto')
		<script type="text/javascript" src="{{asset('js/administracion/agregarFormulacion.js')}}"></script>
	@endif
@endsection