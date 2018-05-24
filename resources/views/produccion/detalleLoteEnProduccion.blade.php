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
					<td>{{ $lote['producto'][0] }}</td>
					<td>{{ $lote['cantidad']}}{{ $lote['tipoUnidad'] }}</td>
					<td>{{ $lote['estado'] }}</td>
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
			<tbody>
			@foreach ($formulacion as $insumo)
									
					<tr>
						<td>{{$insumo['nombre']}}</td>
						<td>{{$insumo['cantidad']}}{{ $insumo['tipoUnidad'] }}</td>
					</tr>
				
			@endforeach
			</tbody>
		@include('elementosComunes.cierreTabla')    

@endsection

