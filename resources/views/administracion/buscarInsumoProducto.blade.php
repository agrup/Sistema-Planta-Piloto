@extends('layouts.layoutPrincipal' )

@section('section')

		@include('elementosComunes.aperturaTitulo')
			@if ($insumoProducto=='producto')			
				Administración de Productos
			@elseif ($insumoProducto=='insumo')
				Administración de Insumos
			@endif
		@include('elementosComunes.cierreTitulo')
			<form>
				@csrf
				<div class="row">
				<div class="col-md-6">
					<div class="form-group">
			        	<label>Código</label>
			           	<input type="text" class="form-control" id="codigo"> 
			        </div>
			        <div class="form-group">
			            <label>Nombre</label>
			            <input type="text" class="form-control" id="nombre"> 
			        </div>
		    	</div>
		        <div class="col-md-6">
			        <div class="form-group">
			            <label>Categoría</label>
			            <input type="text" class="form-control"" id="categoria"> 
			        </div>
			        <div class="form-group">
			            <label>Alarma</label>
			            <select name="alarma" class="form-control" id="alarma">
	  						<option value="True">Activa</option>
	  						<option value="False">Inactiva</option>  						
						</select>
			        </div>
		    	</div>
		    	</div>

		    	@include('elementosComunes.aperturaBoton')
		    		<button type="button" class="btn btn-primary" id="btnBuscar"> Buscar</button>
	          	@include('elementosComunes.cierreBoton')
		    </form>
	    @include('elementosComunes.aperturaTabla')
	    	<thead>
	    		<tr>
	    			<th>Código</th> <th>Nombre</th> <th>Descripción</th>
	    			<th>Unidad</th><th>Alarma</th><th>Aviso Stock</th>
	    			<th>Aviso Stock Crítico</th><th>Categoría</th><th>Estado</th>
	    		</tr>
	    	</thead>
	    	<div id="divRes">
	    	<tbody id="tbodyResultados">	    		</div>

	    	</tbody>		
        @include('elementosComunes.cierreTabla')

        @if ($insumoProducto=='producto')
        	@include('elementosComunes.aperturaBoton')        		
				<a href="/productos/altaProducto" class="btn btn-primary">Agregar Producto</a>	        
				<a class="btn btn-primary">Modificar Producto</a>
	        
				<a class="btn btn-primary">Eliminar Producto</a>
	        @include('elementosComunes.cierreBoton')
	    @elseif ($insumoProducto=='insumo')
	    	@include('elementosComunes.aperturaBoton')
					<a href="/productos/altaInsumo" class="btn btn-primary">Agregar Insumo</a>
	        
	        
					<a href="" class="btn btn-primary">Modificar Insumo</a>
	        
					<a href="" class="btn btn-primary">Eliminar Insumo</a>

	        @include('elementosComunes.cierreBoton')
        @endif

@endsection

 @section('script')
	 <script type="text/javascript" src="{{asset('js/administracion/BuscarInsumoProducto.js')}}"></script>

 @endsection