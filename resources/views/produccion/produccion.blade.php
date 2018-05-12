@extends('layouts.layoutPrincipal' )

@section('section')
		@include('elementosComunes.aperturaTitulo')
			Producción
		@include('elementosComunes.cierreTitulo')

		@include('elementosComunes.aperturaFormInline')
			<div class="row">
				<div class="col">
					<form class="form-inline" id="form" name="form" action="./loteEnProduccion" method="GET" enctype="multipart/form-data">
						{{csrf_field()}}
			           <div class="input-group">
							<input type="text" class="form-control" placeholder="Número Lote" id='lote' name='lote' required> 
							<input  type="submit" class="btn btn-primary" value="Buscar Lote"> 
						</div>
					</form>				
				</div>
				<div class="col">
					<a href="loteNoPlanificado" class="btn btn-primary">Nuevo Lote</a>
				</div>
			</div>

		@include('elementosComunes.cierreFormInline')

		@include('elementosComunes.aperturaFormInline')
			<h4><b>Programa</b></h4>        
			<form class="form-inline" id="form" name="form" action="./produccion" method="POST" enctype="multipart/form-data">
				{{csrf_field()}}
	           <div class="input-group">
					<input type="date" class="form-control" placeholder="Fecha" id='inputDate' name='fecha' value={{ $data['fecha'] }} required>
					<input  type="submit" class="btn btn-primary" value="Ir"> 
				</div>
			</form>
		@include('elementosComunes.cierreFormInline')

		@include('elementosComunes.aperturaTabla')    
			<thead><tr><th>Lote</th> 
						<th>Producto</th> 
						<th>Cantidad</th> 
						<th>Estado</th> 
						<th>Asignatura</th>
						<th></th></tr>
			</thead>			
			<tbody>
				@foreach ($data['lotes'] as $lote)
					<tr>
		        		<td>{{ $lote['lote'] }}</td> 
		        		<td>{{ $lote['producto'] }}</td>
		        		<td> {{ $lote['cantidad'] }} {{ $lote['tu'] }}</td>
		        		<td> {{ $lote['estado'] }}</td>
		        		<td>@if ($lote['asignatura']!= null)						
								{{ $lote['asignatura'] }}
							@endif</td>
		        		<td> <a href="produccion?lote={{ $lote['lote'] }}">Detalles</a></td>
		        	</tr> 
		        	
				@endforeach
			</tbody>

		@include('elementosComunes.cierreTabla')    

@endsection