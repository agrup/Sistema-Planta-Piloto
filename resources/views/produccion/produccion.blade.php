@extends('layouts.layoutPrincipal' )

@section('section')
		@include('elementosComunes.aperturaTitulo')
			Producción
		@include('elementosComunes.cierreTitulo')

		

		@include('elementosComunes.aperturaFormInline')
			<h4><b>Programa de {{$data['fecha']}}</b></h4>        
			
		@include('elementosComunes.cierreFormInline')

		@include('elementosComunes.aperturaTabla')    
			<thead><tr><th>Lote</th> 
						<th>Producto</th> 
						<th>Cantidad</th> 
						<th>Estado</th> 
						<th>Asignatura</th>
						<th>Iniciar</th>
						<th></th></tr>
			</thead>			
			<tbody>
				@foreach ($data['lotes'] as $lote)
					<tr>
		        		<td>{{ $lote['lote'] }}</td> 
		        		<td>{{ $lote['producto'] }}</td>
		        		<td>{{ $lote['cantidad'] }} {{ $lote['tu'] }}</td>
		        		<td>{{ $lote['estado'] }}</td>
		        		<td></td>
		        		<td>@if ($lote['estado']=="planificacion")
		        		  <a href="/iniciarPlanificado/2"><img src="img/iniciar.png" width="40" height="40"></a>
		        		@endif</td>

		        		<td>@if ($lote['asignatura']!= null)						
								{{ $lote['asignatura'] }}
							@endif</td>
		        		<td> <a href="/loteEnProduccion/{{ $lote['lote'] }}">Detalles</a></td>
		        	</tr> 
		        	
				@endforeach
			</tbody>

		@include('elementosComunes.cierreTabla')    
		<form class="form-inline" id="form" name="form" action="./produccion" method="POST" enctype="multipart/form-data">
				{{csrf_field()}}
	           
					<input type="date" class="form-control" placeholder="Fecha" id='inputDate' name='fecha' value={{ $data['fecha'] }} required>
					<input  type="submit" class="btn btn-primary" value="Ir"> 
				
			</form>
			@include('elementosComunes.aperturaFormInline')
			<div class="row">
				
					<form class="form-inline" id="form" name="form" action="./loteEnProduccion" method="GET" enctype="multipart/form-data">
						{{csrf_field()}}
			          
							<input type="text" class="form-control" placeholder="Número Lote" id='lote' name='lote' required> 
							<input  type="submit" class="btn btn-primary" value="Buscar Lote"> 
						
					</form>				
				
				<div class="col">
					<a href="loteNoPlanificado" class="btn btn-primary">Nuevo Lote</a>
				</div>
			</div>

		@include('elementosComunes.cierreFormInline')
@endsection