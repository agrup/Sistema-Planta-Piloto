@extends('layouts.layoutPrincipal' )

@section('section')
	<?php 
		setlocale(LC_TIME, 'spanish');
		Carbon\Carbon::setUtf8(true);

		$fechaC = Carbon\Carbon::createFromFormat('Y-m-d',$lote["fecha"]);
		$fechaActual=$fechaC->formatLocalized('%A %d de %B de %Y');
	?>

		@include('elementosComunes.aperturaTitulo')
			Lote en Producción {{$fechaActual}}
		@include('elementosComunes.cierreTitulo')

		@include('elementosComunes.aperturaTablaSinOrdenar')
			<thead>
				<tr>
					<th>Lote</th>
					<th>Nombre</th>
					<th>Cantidad</th>
					<th>Tipo</th>
				</tr>
			</thead>	
			<tbody>
				<tr>
					<td>{{ $lote['id'] }}</td>
					<td>{{ $producto['nombre'] }}</td>
					<td>{{ $lote['cantidad']}} {{ $producto['tipoUnidad'] }}</td>
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
					<th>Cantidad Teórica Total</th>
				</tr>
			</thead>
			<tbody>
            {{-- Versión fallida , se refactorizó con la intencion de fusionar las celdas de cant teoricas para las row del mismo insumo --}}
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
            {{-- Impresión de los consumos--}}
            @foreach($insumos as $insumo)
                {{-- si no posee un consumo imprimo una sola row con cant utilizada 0 y lote '-' --}}
                @if(count($insumo['consumos'])==0)
                    <tr>
                        <td>{{$insumo['nombre']}}</td>
                        <td> 0 {{ $insumo['tipoUnidad']}}</td>
                        <td> - </td>
                        <td> {{$insumo['cantTeorica']}} {{ $insumo['tipoUnidad']}} </td>
                    </tr>
                @else {{-- Si posee consumos --}}
                    @foreach($insumo['consumos'] as $consumo)
                        <tr>
                            <td>{{$insumo['nombre']}}</td>
                            <td> {{$consumo['cantidadConsumida']}} {{ $insumo['tipoUnidad']}}</td>
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
				<div class="rowFlex">

				    <form action="/produccion/modificarIniciado/{{$lote['id']}}" method="get" class="col-md-4">
				{{ csrf_field() }}
					    <button type="submit" class="btn btn-primary">Modificar</button>
				    </form>
				<form action="" method="post">
					{{ csrf_field() }}
				@include('produccion.registrarMaduracion')
				</form>

				<form action="" method="post">
					{{ csrf_field() }}
					@include('produccion.finalizarLote')
				</form>

                </div>
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
				<div class="alert alert-danger">
					<span>Este es un lote de Insumo</span>
				</div>
		    @endswitch
	<div>
		<a href="/" class="btn btn-secondary">Volver al Menú</a>


	</div>
@endsection
		