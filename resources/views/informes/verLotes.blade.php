@extends('layouts.layoutPrincipal' )

@section('section')
		@include('elementosComunes.aperturaTitulo')
			Lotes de Producto/Insumo
		@include('elementosComunes.cierreTitulo')

		
		
		@include('elementosComunes.aperturaTabla')    
		<h4><b>Nombre Producto: {{ $lote['producto'] }}</b></h4>  
			<thead ><tr><th>Nro Lote </th> 
						<th>Fecha de Inicio</th> 
						<th>Vencimiento</th> 
						<th>Cantidad en Stock</th> 
						<th>Tipo Unidad</th>
						<th></th></tr>
			</thead>			
	        <tbody >
	        	@foreach ($lote['lotes'] as $l)	        	
		        	<tr data={{ $l['numeroLote'] }}>
		        		<td>{{ $l['numeroLote'] }}</td> 
		        		<td>{{ $l['fechaInicio'] }}</td> 
		        		<td>{{ $l['vencimiento'] }}</td> 
		        		<td> {{ $l['cantidad'] }}</td> 
		        		<td> {{ $lote['tu'] }}</td>
		        		<td> <a href="detalleLote?lote={{ $l['numeroLote'] }}">Ver Detalles de Lote</a></td>
		        	</tr> 
	        	@endforeach
	        </tbody>
	        
        @include('elementosComunes.cierreTabla')      


@endsection