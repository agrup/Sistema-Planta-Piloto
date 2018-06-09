@extends('layouts.layoutPrincipal' )

@section('section')
		<img  src="{{asset('img/modificar.png') }}" width="20" height="20" class="modificar" id="iHModificar" style="display: none; cursor: pointer">
	    <img src="{{asset('img/borrar.png') }}" width="30" height="30" style="display: none; cursor: pointer" class="borrar" id="iHBorrar" hidden />
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
			            	<option value="no">No Filtrar</option>
	  						<option value="True">Activa</option>
	  						<option value="False">Inactiva</option>  						
						</select>
			        </div>
		    	</div>
		    	</div>

		    	@include('elementosComunes.aperturaBoton')
		    		<button data-insumoProducto="{{ $insumoProducto }}" type="button" class="btn btn-primary" id="btnBuscar"> Buscar</button>
	          	@include('elementosComunes.cierreBoton')
		    </form>
	    @include('elementosComunes.aperturaTabla')
	    	<thead>
	    		<tr>
	    			<th>Código</th> 
	    			<th>Nombre</th>
	    			<th>Descripción</th>
	    			<th>Unidad</th>
	    			<th>Alarma</th>
	    			<th>Alarma Amarilla</th>
	    			<th>Alarma Roja</th>
	    			<th>Categoría</th>
	    			<th></th>
	    			<th></th>
	    		</tr>
	    	</thead>	    	
	    	<tbody>	    		

	    	</tbody>		
        @include('elementosComunes.cierreTabla')
		<div class="btn-group">
			
        @if ($insumoProducto=='producto')
        	@include('elementosComunes.aperturaBoton')        		
				<a href="/productos/altaProducto" class="btn btn-primary">Agregar Producto</a>	        		
	        @include('elementosComunes.cierreBoton')
	    @elseif ($insumoProducto=='insumo')
	    	@include('elementosComunes.aperturaBoton')
					<a href="/productos/altaInsumo" class="btn btn-primary">Agregar Insumo</a>
	        @include('elementosComunes.cierreBoton')
        @endif

       	@include('elementosComunes.aperturaBoton')
					<a href="/" class="btn btn-primary">Volver</a>
	    @include('elementosComunes.cierreBoton')

       <input type="hidden" name="" id="alertConfirm" value="{{ $succes }}">
		</div>
@endsection

 @section('script')
	 <script type="text/javascript" src="{{asset('js/administracion/BuscarInsumoProducto.js')}}"></script>

 @endsection