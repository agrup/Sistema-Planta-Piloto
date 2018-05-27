@extends('layouts.layoutPrincipal' )

@section('section')
		@include('elementosComunes.aperturaTitulo')
			Iniciar Lote Planificado
		@include('elementosComunes.cierreTitulo')

		
    @include('elementosComunes.aperturaTabla')
            <thead>
              <tr>
                <th>Lote</th>
                <th>Producto</th>
                <th>Cantidad a Elaborar</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>{{ $lote['id'] }}</td>
                <td>{{ $lote['nombre'] }}</td>
                <td>{{ $lote['cantidadElaborada'] }}</td>
              </tr>
              <tr></tr>
              <tr></tr>
            </tbody>
    @include('elementosComunes.cierreTabla')
    @include('elementosComunes.aperturaTabla')
      <thead>
              <tr>
                <th>Lote</th>
                <th>Producto</th>
                <th>Cantidad a Elaborar</th>
              </tr>
      </thead>
            <tbody>
              <tr>
                <td>{{ $lote['id'] }}</td>
                <td>{{ $lote['nombre'] }}</td>
                <td>{{ $lote['cantidadElaborada'] }}</td>
              </tr>
              <tr></tr>
              <tr></tr>
            </tbody>
    @include('elementosComunes.cierreTabla')
      <div class="row">
        <div class="col-md-6">
          <form class="formu" action="">
                <div class="form-group">
                  <label>Fecha Inicio</label>
                  <input type="date" class="form-control" placeholder=""> </div>
                <div class="row">
                  <div class="col">
                    <label>Cantidad Elaborada</label>
                    <input type="text" class="form-control" placeholder="100"> </div>
                  <div class="col">
                    <label for="exampleInputEmail1">Unidad</label>
                    <input type="text" class="form-control" placeholder="Kg" id="inlineFormInput"> </div>
                </div>
              <!--</form>-->
            </div>
            <div class="col-md-6">
              <!--<form class="formu" action="">-->
                <div class="form-group">
                  <label>Trabajo Práctico</label>
                  <input type="email" class="form-control" placeholder="Si"> </div>
                <div class="form-group">
                  <label>Asignatura</label>
                  <input type="text" class="form-control" placeholder=""> </div>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <form>
            <h4 class="">
              <b>Formulación:</b>
            </h4>
            <table class="table">
              <thead>
                <tr>
                  <th>Insumo</th>
                  <th>Lote&nbsp;</th>
                  <th>Cantidad Utilizada</th>
                  <th>Tipo Unidad</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Leche</td>
                  <td>
                    <input type="text" class="form-control" placeholder="12032018"> </td>
                  <td>
                    <input type="text" class="form-control" placeholder="1000"> </td>
                  <td>
                    <input type="text" class="form-control" placeholder="Litros"> </td>
                </tr>
                <tr>
                  <td>Azucar</td>
                  <td>
                    <input type="text" class="form-control" placeholder="12032018"> </td>
                  <td>
                    <input type="text" class="form-control" placeholder="1000"> </td>
                  <td>
                    <input type="text" class="form-control" placeholder="Litros"> </td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>
                    <input type="text" class="form-control" placeholder="12032018"> </td>
                  <td>
                    <input type="text" class="form-control" placeholder="1000"> </td>
                  <td>
                    <input type="text" class="form-control" placeholder="Litros"> </td>
                </tr>
              </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection