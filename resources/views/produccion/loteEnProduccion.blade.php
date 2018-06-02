@extends('layouts.layoutPrincipal' )

@section('section')
		@include('elementosComunes.aperturaTitulo')
			Lote en Producción {{ $lote['fecha']}}
		@include('elementosComunes.cierreTitulo')

		@include('elementosComunes.aperturaTabla')    
			<thead><tr><th>Lote</th> 
						<th>Nombre</th> 
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
						<th>Nro de Lote</th>
					</tr>
			</thead>
			<tbody>
		
			@foreach ($formulacion as $insumo)
					<?php $b=false;?>				
					<tr>
						<td>{{$insumo['nombre']}}</td>

						<td>{{$insumo['cantidad']}} {{ $insumo['tipoUnidad'] }}</td>
						<?php $j=0;?>
						@for ($i = 0; $i < count($trazabilidad); $i++)

							@if ($trazabilidad[$i]['nombre']==$insumo['nombre'])
							<?php $b=true;$j++;?>
								

								@if($j>1)
								<tr>
									<td>{{$insumo['nombre']}}</td>
									<td>{{$insumo['cantidad']}} {{ $insumo['tipoUnidad'] }}</td>
									<td>{{ $trazabilidad[$i]['cantidad'] }} {{ $insumo['tipoUnidad'] }}</td>
									<td>{{$trazabilidad[$i]['lote_id']}}</td>
								</tr>	
								@else
									<td>{{ $trazabilidad[$i]['cantidad'] }} {{ $insumo['tipoUnidad'] }}</td>
									<td>{{$trazabilidad[$i]['lote_id']}}</td>

									</tr>
								@endif
							@endif
	
						@endfor
						@if ($b==false)
							<td>0 {{ $insumo['tipoUnidad'] }}</td>
							<td>-</td>

							</tr>
						@endif 
						

				
			@endforeach
			</tbody>
		@include('elementosComunes.cierreTabla')    

		
			@switch($lote['tipoLote'])
				@case('planificacion')
					<form action="/produccion/iniciarPlanificado/{{$lote['id']}}" method="get">
					<button type="submit"  class="btn btn-primary" >Iniciar</button>
					</form>
					@break
				@endcase

				@case('iniciado')
				<form action="/produccion/modificarIniciado/{{$lote['id']}}" method="get">
				{{ csrf_field() }}
					<button type="submit" class="btn btn-primary">Modificar</button>
				</form>
				<form action="" method="post">
					{{ csrf_field() }}
				@include('produccion.registrarMaduracion')
				</form>
				{{ csrf_field() }}
				<form action="" method="post">
					@include('produccion.finalizarLote')
				</form>
					

					@break
				@endcase

				@case('maduracion')
					<button class="btn btn-primary">Modificar</button>
					<button class="btn btn-primary">Finalizar</button>
					@break


				@case('finalizado')
					<button class="btn btn-primary">Modificar Finalizado</button>
					@break


				 @default
	        		<span>Something went wrong, please try again</span>
		    @endswitch
@endsection
		