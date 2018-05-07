@extends('layouts.layoutPrincipal' )

@section('section')

		@include('elementosComunes.aperturaTitulo')
			Stock
		@include('elementosComunes.cierreTitulo')

		{{-- FORM PARA STOCK A FUTURO --}}
		@include('elementosComunes.aperturaFormInline')

			<input type="date" class="form-control" placeholder="Fecha" id='inputDate'> 
			<a class="btn btn-primary" onclick="getStock()"> Actualizar</a>

	    @include('elementosComunes.cierreFormInline')

	    {{-- TABLA STOCK --}}
		@include('elementosComunes.aperturaTabla')    

			<thead ><tr><th>Código</th> <th>Insumo/Producto</th> <th>Cantidad en Stock</th></tr></thead>			
	        <tbody >
	        @foreach ($stock as $s)	        	
	        	<tr  data-codigo={{ $s['codigo'] }}><td>{{ $s['codigo'] }}</td> <td>{{ $s['nombre'] }}</td> <td> {{ $s['cantidad'] }}</td></tr> 
	        @endforeach
	        </tbody>
	        
        @include('elementosComunes.cierreTabla')

@endsection
