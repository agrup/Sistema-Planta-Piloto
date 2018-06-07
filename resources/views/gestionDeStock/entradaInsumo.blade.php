@extends('layouts.layoutPrincipal' )

@section('section')
	
	@include('elementosComunes.aperturaTitulo')
		Entrada Lote de Insumo
	@include('elementosComunes.cierreTitulo')

	<form action="/stock/entradaLoteInsumo" method="POST" >
		@csrf
		<div class="form-group">			
			<label>Insumo</label>
			<select  id="selectInsumo" class="form-control selectInsumo inputFormulacion" name="id" required>
                <option  selected="selected" value="default">--Seleccione un Insumo--</option>
                @foreach ($insumos as $insumo)                           
                  <option  id="producto" data-id="{{$insumo['id']}}" data-unit="{{$insumo['tipoUnidad']}}" value="{{$insumo['id']}}">{{$insumo['nombre']}}
                  </option>
                @endforeach
            </select>

        </div>

		<div class="row">			
			<div class="col-md-6">
				
				<div class="form-group">
					<label for="exampleInputEmail1">Fecha Ingreso</label>
					<input type="date" name="fechaInicio" class="form-control" required>
				</div>

				<div class="form-group">
					<label for="exampleInputEmail1">Fecha Vencimiento</label>
					<input type="date" name="fechaVencimiento" class="form-control" required>
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputEmail1">Costo Unitario</label>
					<input type="text" name="costounitario" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Cantidad</label>
					<input type="text" name="cantidadElaborada" class="form-control" required>
					<label for="exampleInputEmail1">TipoUnidad</label>
				<input type="text" name="" class="form-control" value="" disabled="true" id="tuinsumo">
				</div>
				
			</div>

			<input type="submit" name="entradaInsumo" value="Guardar" class="btn btn-primary">
		</div>

	</form>


@endsection
@section('script')
 <script type="text/javascript" src="{{asset('js/gestionStock/entradaInsumo.js')}}"></script>
@endsection
