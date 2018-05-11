@extends('layouts.layoutPrincipal' )

@section('section')

		@include('elementosComunes.aperturaTitulo')
			Stock 
		@include('elementosComunes.cierreTitulo')
		
		{{-- FORM PARA STOCK A FUTURO --}}
		@include('elementosComunes.aperturaFormInline')

        	<h6 >Fecha Hasta</h6>        
			<form class="form-inline" id="form" name="form" action="stock" method="POST" enctype="multipart/form-data">
				@csrf
	           <div class="input-group">
					<input type="date" class="form-control" placeholder="Fecha" id='inputDate' name='fecha' required> 
					<input  type="submit" class="btn btn-primary" value="Actualizar"> 
				</div>
			</form>

	    @include('elementosComunes.cierreFormInline')

	    {{-- TABLA STOCK --}}
		@include('elementosComunes.aperturaTabla')    
			<thead ><tr><th>Código</th> 
						<th>Insumo/Producto</th> 
						<th>Cantidad en Stock</th> 
						<th>Unidad</th> 
						<th></th></tr>
			</thead>			
	        <tbody >
	        	@foreach ($stock as $s)	        	
		        	<tr data={{ $s['alarma'] }}>
		        		<td>{{ $s['codigo'] }}</td> 
		        		<td>{{ $s['nombre'] }}</td> 
		        		<td> {{ $s['stock'] }}</td> 
		        		<td> {{ $s['tu'] }}</td>
		        		<td> <a href="verLotes?codigo={{ $s['codigo'] }}">Ver Detalles</a></td>
		        	</tr> 
	        	@endforeach
	        </tbody>
	        
        @include('elementosComunes.cierreTabla')

@endsection
