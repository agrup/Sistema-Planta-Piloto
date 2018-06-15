@extends('layouts.layoutPrincipal' )

@section('section')
<?php 
		setlocale(LC_TIME, 'spanish');
		Carbon\Carbon::setUtf8(true);

		$fechaC = Carbon\Carbon::createFromFormat('Y-m-d',$data["fecha"]);
		$fechaActual=$fechaC->formatLocalized('%A %d de %B de %Y');
	?>
		@include('elementosComunes.aperturaTitulo')
			Producción
		@include('elementosComunes.cierreTitulo')

		

		@include('elementosComunes.aperturaFormInline')

			<h4><b>Programa de {{$fechaActual}}</b></h4>        
			
		@include('elementosComunes.cierreFormInline')

		@include('elementosComunes.aperturaTabla')    
			<thead><tr><th>Lote</th> 
						<th>Producto</th> 
						<th>Cantidad</th> 
						<th>Estado</th> 
						{{--<th>Asignatura</th>--}}
						
						<th>Detalles</th></tr>
			</thead>			
			<tbody>
				@foreach ($data['lotes'] as $lote)
					<tr>
		        		<td>{{ $lote['lote'] }}</td> 
		        		<td>{{ $lote['producto'] }}</td>
		        		<td>{{ $lote['cantidad'] }} {{ $lote['tipoUnidad'] }}</td>
		        		<td>{{ $lote['estado'] }}</td>


		        		{{--<td>@if ($lote['asignatura']!= null)						
								{{ $lote['asignatura'] }}
							@endif</td>--}}
		        		<td> <a href="/produccion/loteEnProduccion/{{ $lote['lote'] }}"> <img src="{{asset('img/details.png')}}" style="height: 24px; width: 24px" alt=""></a></td>
		        	</tr> 
		        	
				@endforeach
			</tbody>

		@include('elementosComunes.cierreTabla')    
		<form class="form-inline" id="form" name="form" action="/produccion" method="POST" enctype="multipart/form-data" style="margin-bottom: 5px;">
				{{csrf_field()}}
	           
					<input type="date" style="margin-bottom: 0px" class="form-control" placeholder="Fecha" id='inputDate' name='fecha' value={{ $data['fecha'] }} required>
					<input  type="submit" class="btn btn-primary" value="Ir"> 
				
			</form>
			@include('elementosComunes.aperturaFormInline')
			<div class="row">
				
					<!--<form class="form-inline" id="formBuscarLote" name="form"  method="GET" enctype="multipart/form-data">
						
			          
							<input type="text" class="form-control" placeholder="Número Lote" id='lote' name='lote' required> 
							<button  class="btn btn-primary" id="buscarLote">Buscar Lote</button>
						
					</form>		-->
					<input type="text" class="form-control" style="width: 30%;margin-right: 5px;margin-bottom: 0px" placeholder="Número Lote" id='lote' name='lote' required> 	
					<button  class="btn btn-primary" id="buscarLote">Buscar Lote</button>
			</div>

			<div class="rowFlex" style="margin-top: 10px">
				@if(Auth::user()->hasAnyRole('administrador'))
				<form action="/produccion/loteNoPlanificado/{{$data["fecha"]}}" method="get">
					<button  class="btn btn-primary" id="buscarLote">Nuevo Lote (No Planificado)</button>
				@endif
				</form>

             <form action="/" method="get">
               <button  class="btn btn-secondary" >Volver al Menú</button>  
             </form>
			</div>

		@include('elementosComunes.cierreFormInline')
@endsection
 @section('script')
  <script type="text/javascript" src="{{asset('js/produccion/buscarLote.js')}}"></script>
 @endsection