<div class="divAlert">
	@include('elementosComunes.aperturaTitulo')
		Alarmas
	@include('elementosComunes.cierreTitulo')

	@include('elementosComunes.aperturaTabla')
		<thead>
			<tr><th>Nombre</th><th>Cantidad</th><th>Alarma</th></tr>
		</thead>
		@foreach($alarmas as $producto)
		<tbody>
			<tr><td>{{ $producto['nombre'] }}</td><td>{{ $producto['cantidad'] }}</td><td>{{ $producto['alarmaActiva'] }}</td></tr>
		</tbody>
		@endforeach

	@include('elementosComunes.cierreTabla')
	

</div>