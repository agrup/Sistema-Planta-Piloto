@extends('layouts.layoutPrincipal' )

@section('section') 

	
	@include('elementosComunes.aperturaTitulo')
			{{-- <h3 style="float: right; ">{{ $detalle['numeroLote'] }}</h3> --}}
			Detalles de Lote:  {{ $detalle['numeroLote'] }}
	@include('elementosComunes.cierreTitulo')

	
		@include('elementosComunes.aperturaTabla')    
			{{-- $v = [];
			$v = array('numeroLote', 'vencimiento', 'cantidad', 'tu', 'cantidadElaborada', 'costoUnitario', 'inicioMaduracion', 'finalización', 'cantidadFinal', 'proveedor', 'tipoTp', 'asignatura'); --}}

			<thead>
				<tr><th>Código: {{ $detalle['cantidad'] }}</th> 
					<th>Producto: {{ $detalle['cantidad'] }}</th>
					<th>Fecha Inicio: {{ $detalle['numeroLote'] }}</th> 
					<th>Vencimiento: {{ $detalle['vencimiento'] }}</th>
				</tr>
				<tr>
					<th>Cantida en Stock: {{ $detalle['cantidad'] }}</th>
					<th>Cantidad Elaborada: {{ $detalle['cantidadElaborada'] }}</th>
					<th>Tipo Unidad: {{ $detalle['tu'] }}</th>
					<th>Costo Unitario: {{ $detalle['costoUnitario'] }}</th>
				</tr>
			
			</thead>


		@include('elementosComunes.cierreTabla')    


		@include('elementosComunes.aperturaTabla')    
			<h4><b>Ingredientes de Elaboración</b></h4>
			<thead><tr><th>Numero Lote</th> <th>Insumo</th> <th>Cantidad en Stock</th> <th>Tipo de Unidad</th> </tr></thead>
			
		@include('elementosComunes.cierreTabla')    		
		
	

@endsection