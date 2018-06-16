@extends('layouts.layoutPrincipal' )

@section('section')
		@include('elementosComunes.aperturaTitulo')
			Lotes de {{ $lote['nombre'] }}
		@include('elementosComunes.cierreTitulo')

		
		
		@include('elementosComunes.aperturaTabla')    
		
			<thead ><tr><th>Nro Lote </th> 
						<th>Fecha </th>
						<th>Vencimiento</th> 
						<th>Cantidad en Stock</th> 
						<th>Tipo Unidad</th>
						<th>Detalle</th></tr>
			</thead>			
	        <tbody >
	        	@foreach ($lote['lotes'] as $l)	        	
		        	<tr data={{ $l['numeroLote'] }}>
		        		<td>{{ $l['numeroLote'] }}</td> 
		        		<td>{{ $l['fechaInicio'] }}</td> 
		        		<td>{{ $l['vencimiento'] }}</td> 
		        		<td> {{ $l['cantidad'] }}</td> 
		        		<td> {{ $lote['tipoUnidad'] }}</td>
		        		<td> <a href="detalleLote?lote={{ $l['numeroLote'] }}"><img src="{{asset('img/details.png')}}" style="height: 24px; width: 24px" alt=""></a></td>
		        	</tr> 
	        	@endforeach
	        </tbody>
	        
        @include('elementosComunes.cierreTabla')      


@endsection