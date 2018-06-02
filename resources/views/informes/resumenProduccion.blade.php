@extends('layouts.layoutPrincipal' )

@section('section')
	@include('elementosComunes.aperturaTitulo')
		Resumen de Producción
	@include('elementosComunes.cierreTitulo')

	<form>
		<div class="row">
				<div class="col-md-6">
					<div class="form-group">
			        	<label>Fecha Desde</label>
			           	<input type="date" class="form-control" id="fechaDesde" required> 
			        </div>
			        <div class="form-group">
			            <label>Fecha Hasta</label>
			            <input type="date" class="form-control" id="fechaHasta" required> 
			        </div>
		    	</div>
		</div>
		@include('elementosComunes.aperturaBoton')
		    <button type="button" class="btn btn-primary" id="botonGenerarResumenProduccion">Buscar</button>
	    @include('elementosComunes.cierreBoton')
			

	</form>

	 @include('elementosComunes.aperturaTabla')
    	<thead>
    		<tr>
    			<th>Código</th> <th>Nombre Producto</th> <th>Cantidad</th>
    			<th>Costo Unitario</th><th>Categoría</th>
    		</tr>
    	</thead>
    	<div id="divRes">
	    	<tbody id="tbodyResumen">	    		

	    	</tbody>		
    	</div>
    @include('elementosComunes.cierreTabla')

@endsection

 @section('script')
	 <script type="text/javascript" src="{{asset('js/informes/generarResumenProduccion.js')}}"></script>

 @endsection