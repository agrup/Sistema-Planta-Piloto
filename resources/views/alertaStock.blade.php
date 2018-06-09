<div>
	@if(!empty($alarmas)&&Auth::user()->hasAnyRole(['administrador']))
	<div id="mySidenavc" class="sidenav">



				
					<h3>Alarmas</h3>
				

				<table>
					<thead>
						<tr><th>Nombre</th><th>Cantidad</th></tr>
					</thead>
					
					<tbody>
						@foreach($alarmas as $producto)
							@if ( $producto['alarma']=='roja')
								<tr class="alert alert-danger"><td >{{ $producto['nombre'] }}</td><td class="tdNumero">{{ $producto['stock'] }}</td></tr>
							@endif
							@if ( $producto['alarma']=='amarilla')
								<tr class="alert alert-warning"><td >{{ $producto['nombre'] }}</td><td class="tdNumero">{{ $producto['stock'] }}</td></tr>
							@endif

						@endforeach
					</tbody>
					

				</table>

	</div>
	@endif
</div>
