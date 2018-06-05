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
			<thead>
				<tr>
					<th>Insumo</th>
					<th>Cantidad Utilizada</th>
					<th>Nro de Lote</th>
					<th>Cantidad Teórica</th>
				</tr>
			</thead>
			<tbody>
            {{-- Calculo de los datos de los consumos--}}
			@php
                //generare un array con los valores necesarios para llenar la tabla
				$insumos=[];
				    //para cada insumo
					foreach($formulacion as $insumo){
					    //tendré un array con sus datos, entre ellos un array de consumos
					    $arrInsumoAux=[];
						$arrInsumoAux['nombre'] = $insumo['nombre'];
						$arrInsumoAux['cantTeorica'] = $insumo['cantidad'];
						$arrInsumoAux['tipoUnidad']= $insumo['tipoUnidad'];
						$arrInsumoAux['consumos']=[];
						foreach ($trazabilidad as $consumo){
						    $rowAux = [];
						    //por cada consumo en la trazabilidad que coincida con el insumo agrego sus datos al array de consumos del insumo
						    if($consumo['nombre']==$insumo['nombre']){
						        $rowAux['cantidadConsumida'] = $consumo['cantidad'];
						        $rowAux['lote_id'] = $consumo['lote_id'];
						        array_push($arrInsumoAux['consumos'],$rowAux);
						    }
						}
						//agrego el array del insumo al array de todos los insumos, incluso si no hay ningun consumo cargado para el mismo
						array_push($insumos,$arrInsumoAux);
					}

			@endphp
            @foreach($insumos as $insumo)
                {{-- si no posee un consumo imprimo una sola row con cant utilizada 0 y lote '-' --}}
                @if(count($insumo['consumos'])==0)
                    <tr>
                        <td>{{$insumo['nombre']}}</td>
                        <td> 0 {{ $insumo['tipoUnidad']}}</td>
                        <td> - </td>
                        <td> {{$insumo['cantTeorica']}} </td>
                    </tr>
                @else
                    @foreach($insumo['consumos'] as $consumo)
                        <tr>
                            <td>{{$insumo['nombre']}}</td>
                            <td> {{$consumo['cantidad']}} {{ $insumo['tipoUnidad']}}</td>
                            <td> {{$consumo['lote_id']}} </td>
                            <td> {{$insumo['cantTeorica']}} {{ $insumo['tipoUnidad']}} </td>
                        </tr>
                    @endforeach
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

				@case('iniciado')
				<form action="/produccion/modificarIniciado/{{$lote['id']}}" method="get" class="col-md-4">
				{{ csrf_field() }}
					<button type="submit" class="btn btn-primary">Modificar</button>
				</form>
				<form action="" method="post" class="col-md-4">
					{{ csrf_field() }}
				@include('produccion.registrarMaduracion')
				</form>

				<form action="" method="post" class="col-md-4">
					{{ csrf_field() }}
					@include('produccion.finalizarLote')
				</form>
					

					@break

				@case('maduracion')
                <form action="" method="post" class="col-md-4">
                    {{ csrf_field() }}
                    @include('produccion.finalizarLote')
                </form>
					@break


				@case('finalizado')
					<button class="btn btn-primary">Modificar Finalizado</button>
					@break


				 @default
	        		<span>Something went wrong, please try again</span>
		    @endswitch
@endsection
		