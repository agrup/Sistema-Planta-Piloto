@extends('layouts.layoutPrincipal' )

@section('section')
		@include('elementosComunes.aperturaTitulo')
			Lote en Producción
		@include('elementosComunes.cierreTitulo')

		@include('elementosComunes.aperturaTabla')    
			<thead><tr><th>Lote</th> 
						<th>Producto</th> 
						<th>Cantidad</th> 
						<th>Estado</th> 						
						<th></th>
					</tr>
			</thead>	
			<tbody>
				<tr>
					<td>{{ $lote['id'] }}</td>
					<td>{{ $lote['nombre'] }}</td>
					<td>{{ $lote['cantidad']}}{{ $lote['tipoUnidad'] }}</td>
					<td>{{ $lote['lote'] }}</td>
				</tr>		
			</tbody>		

		@include('elementosComunes.cierreTabla')    


		@include('elementosComunes.aperturaTitulo')
			Formulación
		@include('elementosComunes.cierreTitulo')

		@include('elementosComunes.aperturaTabla')    
			<thead><tr><th>Insumo</th> 
						<th>Cantidad</th> 
					</tr>
			</thead>
			@foreach ($formulacion as $insumo)
					
				<tbody>
					<tr>
						
					</tr>
				</tbody>

			@endforeach
		@include('elementosComunes.cierreTabla')    

@endsection

