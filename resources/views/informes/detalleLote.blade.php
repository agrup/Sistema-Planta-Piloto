@extends('layouts.layoutPrincipal' )

@section('section') 

	
	@include('elementosComunes.aperturaTitulo')			
			Detalles de Lote:  {{ $detalle['numeroLote'] }}
	@include('elementosComunes.cierreTitulo')

	
		@include('elementosComunes.aperturaTabla')    			
			
			<thead>
				<tr><th>Código: {{ $detalle['codigo'] }}</th> 
					<th>Producto: {{ $detalle['nombreProducto'] }}</th>
					<th>Fecha Inicio: {{ $detalle['fechaInicio'] }}</th> 
					
				</tr>
				<tr><th></th><th></th><th></th></tr>
				<tr>
					<th>Cantidad en Stock: {{ $detalle['cantidad'] }} {{ $detalle['tu'] }}</th>			
					<th>Costo Unitario: {{ $detalle['costoUnitario'] }}</th>
					<th>Vencimiento: {{ $detalle['vencimiento'] }}</th>
				</tr>
				<tr><th><h5><b>Detalles de Elaboración:</b></h5></th><th></th><th></th></tr>
				<tr>
					@if ($detalle['cantidadElaborada'] != null)						
						<th>Cantidad Elaborada: {{ $detalle['cantidadElaborada'] }}</th>
					@endif

					@if ($detalle['inicioMaduracion']!= null)						
						<th>Inicio Maduración: {{ $detalle['inicioMaduracion'] }}</th>
					@endif

					@if ($detalle['finalizacion']!= null)						
						<th>Fecha Finalización: {{ $detalle['finalizacion'] }}</th>
					@endif
				</tr>
				<tr>

					@if ($detalle['cantidadFinal']!= null)						
						<th>Cantidad Final: {{ $detalle['cantidadFinal'] }}</th>
					@endif
					
					@if ($detalle['proveedor']!= null)						
						<th>Proveedor: {{ $detalle['proveedor'] }}</th>
					@endif
				<tr>
					@if ($detalle['tipoTp']!= null)						
						<th>Tipo TP: {{ $detalle['tipoTp'] }}</th>
					@endif
					@if ($detalle['asignatura']!= null)						
						<th>Asignatura: {{ $detalle['asignatura'] }}</th>
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
				<tr><td>{{ $element['numeroLote'] }}</td><td>{{ $element['insumo'] }}</td><td>{{ $element['cantidadStock'] }} {{ $detalle['tu'] }}</td></tr>

			@endforeach
		@include('elementosComunes.cierreTabla')    		
		
	

@endsection