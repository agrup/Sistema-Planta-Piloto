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
						<td>{{$insumo['nombre']}}</td>

						<td>{{$insumo['cantidad']}} {{ $insumo['tipoUnidad'] }}</td>
						@for ($i = 0; $i < count($trazabilidad); $i++)
							@if ($trazabilidad[i]['nombreProducto']==$insumo['nombre'])
								<td>{{ $trazabilidad[i]['cantidad'] }} {{ $insumo['tipoUnidad'] }}</td>		
							@endif
						@endfor
						

					</tr>
				
			@endforeach
			</tbody>
		@include('elementosComunes.cierreTabla')    

		<form>
			@switch($lote['tipoLote'])
				@case('planificacion')
					<button class="btn btn-primary" formaction="/produccion/iniciarPlanificado/{{ $lote['id'] }}">Iniciar</button>
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
	       </form>



		@endswitch
@endsection
		