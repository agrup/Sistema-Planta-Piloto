@extends('layouts.layoutPrincipal' )
@section('section') 
	@include("elementosComunes.aperturaTitulo")
		Iniciar Producto No planificado
	@include("elementosComunes.cierreTitulo")
	<div class="p-0">
    <div class="container">
      <form class="form-group">
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Lote Producto</label>
              <input type="text" class="form-control" > </div>
            <div class="form-group">
              <label>Producto</label>
              <select class="form-control">
                
              </select>
            </div>
            <div class="form-group">
              <label contenteditable="true" for="exampleInputEmail1">Cantidad Elaborada</label>
              <input type="text" class="form-control" id="inlineFormInput"> 
          </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Unidad</label>
              <select class="form-control">
                
              </select>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="exampleInputEmail1">Fecha Inicio</label>
              <input type="date" class="form-control" id="inlineFormInput"> </div>
            <div class="form-group">
              <label></label>
              <label for="exampleInputEmail1">Trabajo Práctico</label>
              <select class="form-control">
                <option value="1">Si</option>
                <option value="2">No</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Asignatura</label>
              <input type="text" class="form-control" id="inlineFormInput"> </div>
          </div>
        </div>
        <h4 class="">
          <b>Formulación:</b>
        </h4>
        <div class="row">
          <div class="col-md-12">
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
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </form>
    </div>
  </div>
@endsection