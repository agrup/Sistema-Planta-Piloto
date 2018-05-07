@extends('layouts.layoutPrincipal' )
@section('section')
  
  @include('elementosComunes.aperturaTitulo')
   <h1 class="display-4">
            <b>Programa de Producción Semanal</b>
    </h1>
  @include('elementosComunes.cierreTitulo') 
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
            @include('elementosComunes.aperturaTabla')
                            <thead>
                   <tr>
                                <td>
                                  <b>Producción</b>
                                </td>
                                <th>Lunes</th>
                                <th>Martes</th>
                                <th>Miercoles</th>
                                <th>Jueves</th>
                                <th>Viernes</th>
                              </tr>
                              <tr>
                                <th>2018</th>
                                @foreach($fechasSemana as $fecha )
                                  <th>{{$fecha}}</th>
                                @endforeach
                              </tr>
                              
                                @foreach($semana as $i => $s )
                                  <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$s['lunes']}}</td>
                                    <td>{{$s['martes']}}</td>
                                    <td>{{$s['miercoles']}}</td>
                                    <td>{{$s['jueves']}}</td>
                                    <td>{{$s['viernes']}}</td>
                                  </tr>
                                @endforeach

                </thead>
                <tbody>

                </tbody>

           @include('elementosComunes.cierreTabla')
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
          <form action="/laravel5.4/blog/public/sumarizacion" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
        <div class="col-md-6">
          <input type="submit" value="Ver necesidad de Insumos" class="btn btn-primary" >
        </div>
      </form>
      </div>
    </div>
  </div>
@endsection