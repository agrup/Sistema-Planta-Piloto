@extends('layouts.layoutPrincipal' )
@section('section')
  
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-4">
            <b>Programa de Producción Semanal</b>
          </h1>
        </div>
      </div>
    </div>
  </div>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-11">
          <a class="btn btn-primary" href="#">&lt;&lt;</a>
        </div>
        <div class="col-md-1">
          <a class="btn btn-primary" href="#">&gt;&gt;</a>
        </div>
      </div>
    </div>
  </div>
            @include('elementosComunes.aperturaTabla');
           
            @include('programaProduccionSemanal.tablasProduccionSemanal')
          @include('elementosComunes.cierreTabla');
    <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h5 class="">Fecha Hasta</h5>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
          <input type="email" class="form-control"> </div>
        <div class="col-md-6">
          <a class="btn btn-primary" href="#">Verficar Planificación</a>
        </div>
      </div>
    </div>
  </div>
@endsection