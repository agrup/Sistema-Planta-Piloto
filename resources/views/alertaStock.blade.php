<div class="divAlert">
	
		<h3>Alarmas</h3>
	

	<table>
		<thead>
			<tr><th>Nombre</th><th>Cantidad</th><th>Alarma</th></tr>
		</thead>
		
		<tbody>
			@foreach($alarmas as $producto)
			<tr><td>{{ $producto['nombre'] }}</td><td>{{ $producto['stock'] }}</td><td>{{ $producto['alarma'] }}</td></tr>
			@endforeach
		</tbody>
		

	</table>
	

	




</div>