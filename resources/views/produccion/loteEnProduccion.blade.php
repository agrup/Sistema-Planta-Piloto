@extends('layouts.layoutPrincipal' )

@section('section')
		@include('elementosComunes.aperturaTitulo')
			Lote en Producción
		@include('elementosComunes.cierreTitulo')

		@include('elementosComunes.aperturaTabla')    
			<thead><tr><th>Lote</th> 
						<th>Descripción</th> 
						<th>Cantidad</th> 
						<th>Estado</th> 						
						<th></th>
					</tr>
			</thead>	
			<tbody>
				<tr>
					<td>{{ $lote['id'] }}</td>
					<td>{{ $producto['nombre'] }}</td>
					<td>{{ $lote['cantidad']}}{{ $producto['tipoUnidad'] }}</td>
					<td>{{ $lote['tipoLote'] }}</td>
				</tr>		
			</tbody>		

		@include('elementosComunes.cierreTabla')    


		@include('elementosComunes.aperturaTitulo')
			Formulación
		@include('elementosComunes.cierreTitulo')

		@include('elementosComunes.aperturaTabla')    
			<thead><tr><th>Insumo</th> 
						<th>Cantidad Teórica</th> 
						<th>Cantidad Utilizada</th> 
					</tr>
			</thead>
			<tbody>
			@foreach ($formulacion as $insumo)
									
					<tr>
						<td>{{$insumo['nombreProducto']}}</td>
						<td>{{$insumo['cantidad']}} {{ $insumo['tipoUnidad'] }}</td>
						<td>{{$insumo['cantidad']}} {{ $insumo['tipoUnidad'] }}</td>
					</tr>
				
			@endforeach
			</tbody>
		@include('elementosComunes.cierreTabla')    

		@switch($lote['tipoLote'])
			@case('planificacion')
				<button class="btn btn-primary">Iniciar</button>
				@break
			@endcase

			@case('iniciado')
				<button class="btn btn-primary">Modificar</button>
				<button class="btn btn-primary">Maduración</button>
				<button class="btn btn-primary">Finalizar</button>
				@break
			@endcase

			@case('maduracion')
				<button class="btn btn-primary">Modificar</button>
				<button class="btn btn-primary">Finalizar</button>
				@break
			@endcase

			@case('finalizado')
				<button class="btn btn-primary">Modificar Finalizado</button>
				@break
			@endcase

			 @default
        		<span>Something went wrong, please try again</span>



		@endswitch
@endsection

