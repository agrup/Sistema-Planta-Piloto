@extends('layouts.layoutPrincipal' )

@section('section') 

	
	@include('elementosComunes.aperturaTitulo')			
			Detalles de Lote:  {{ $detalle['numeroLote'] }}
	@include('elementosComunes.cierreTitulo')

	
		@include('elementosComunes.aperturaTabla')    			
			
			<thead>
				<tr><th>Código</th> 
					<th>Producto </th>
					<th>Fecha Inicio</th> 					
				</tr>
				<tr><td>{{ $detalle['codigo'] }}</td>
					<td>{{ $detalle['nombreProducto'] }}</td>
					<td>{{ $detalle['fechaInicio'] }}</td></tr>
				<tr>
					<th>Cantidad en Stock </th>			
					<th>Costo Unitario</th>
					<th>Vencimiento</th>
				</tr>
				<tr><td>{{ $detalle['cantidad'] }} {{ $detalle['tu'] }}</td>
					<td>{{ $detalle['costoUnitario'] }}</td>
					<td>{{ $detalle['vencimiento'] }}</td>
				</tr>

				<tr><th><h5><b>Detalles de Elaboración:</b></h5></th><th></th><th></th></tr>
				<tr>
					@if ($detalle['cantidadElaborada'] != null)						
						<th>Cantidad Elaborada</th>
					@endif

					@if ($detalle['inicioMaduracion']!= null)						
						<th>Inicio Maduración</th>
					@endif

					@if ($detalle['finalizacion']!= null)						
						<th>Fecha Finalización</th>
					@endif
				</tr>
				<tr>
					@if ($detalle['cantidadElaborada'] != null)						
						<td>{{ $detalle['cantidadElaborada'] }}</td>
					@endif

					@if ($detalle['inicioMaduracion']!= null)						
						<td>{{ $detalle['inicioMaduracion'] }}</td>
					@endif

					@if ($detalle['finalizacion']!= null)						
						<td>{{ $detalle['finalizacion'] }}</td>
					@endif
				</tr>
				<tr>

					@if ($detalle['cantidadFinal']!= null)						
						<th>Cantidad Final</th>
					@endif
					
					@if ($detalle['proveedor']!= null)						
						<th>Proveedor</th>
					@endif

				</tr>	
				<tr>

					@if ($detalle['cantidadFinal']!= null)						
						<td>{{ $detalle['cantidadFinal'] }}</td>
					@endif
					
					@if ($detalle['proveedor']!= null)						
						<td>{{ $detalle['proveedor'] }}</td>
					@endif
					
				</tr>	
				<tr>

					@if ($detalle['tipoTp']!= null)						
						<th>Tipo TP</th>
					@endif
					@if ($detalle['asignatura']!= null)						
						<th>Asignatura</th>
					@endif
				</tr>
				<tr>

					@if ($detalle['tipoTp']!= null)						
						<td>{{ $detalle['tipoTp'] }}</td>
					@endif
					@if ($detalle['asignatura']!= null)						
						<td>{{ $detalle['asignatura'] }}</td>
					@endif
				</tr>


					{{-- 
					@for ($i = 0; $i < 7; $i++)						
						@if ($detalle[$v[$i]] != null)
							<th> {{ $v1[$i] }} :   {{ $detalle[$v[$i]]}}  </th>
						@endif
						
					@endfor
					 --}}

					
				</tr>
			</thead>


		@include('elementosComunes.cierreTabla')    


		@include('elementosComunes.aperturaTabla')    
			<h5><b>Ingredientes de Elaboración:</b></h5>			
			<thead><tr> <th>Numero Lote</th> 
						<th>Insumo</th> 
						<th>Cantidad en Stock</th>  
					</tr>
			</thead>
			@foreach ($detalle['detalleElaboracion'] as $element)
				<tr><td>{{ $element['numeroLote'] }}</td><td>{{ $element['nombreProducto'] }}</td><td>{{ $element['cantidad'] }} {{ $detalle['tu'] }}</td></tr>

			@endforeach
		@include('elementosComunes.cierreTabla')    		
		
	

@endsection