@extends('layouts.layoutPrincipal' )


@section('section')
            <meta name="csrf-token" content="{{ csrf_token() }}">
            @include('elementosComunes.aperturaTitulo')
                Control de Existencias
            @include('elementosComunes.cierreTitulo')            
            
            {{-- form  --}}
            {{-- los old('id..') son para volver a llenar si falla, nose, queria probarlo, capaz no haga nada--}}
            <form >
                @csrf
                {{-- <input type="number" value="{{old('lote_id')}}" name="lote_id"> --}}
                {{-- <input type="number" name="cantidadObservada" value="{{old('cantidadObservada')}}"> --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fecha Control</label>
                            <input type="date" class="form-control" id="fecha" required> 
                        </div>
                        <div class="form-group">
                            <label>Cantidad Observada</label>
                            <input type="text" class="form-control" id="cantidadObservada" name="cantidadObservada" required> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Lote</label>
                            <input type="text" class="form-control" id="lote_id" name="lote_id" required> 
                        </div>
                        <div class="form-group">
                            <label>TipoUnidad</label>
                            <select name="tipoUnidad" class="form-control" id="tipoUnidad" required>
                            @foreach($tipoUnidades as $tu)
                                <option value="{{$tu}}">{{$tu}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
                @include('elementosComunes.aperturaBoton')
                    <button id="botonCargarContinuar" class="btn btn-primary"> Cargar y Continuar </button>

                    <button id="botonCargarTerminar" class="btn btn-primary"> Cargar y Terminar</button>
                    <a href="/" class="btn btn-primary"> Salir </a>
                @include('elementosComunes.cierreBoton')
            </form>

            <div class="py-5"  >
                <div class="container">
                    <div class="row">
                        <div class="col-md-11">
                            <table class="table table-striped" id="tablaExistencias" >

                            <thead>
                    <tr><th>Fecha Control</th><th>Lote</th><th>Producto</th><th>Cantidad Observada</th><th>Tipo Unidad</th></tr>
                </thead>
                <tbody>
                    
                </tbody>

            @include('elementosComunes.cierreTabla')

@endsection

@section('script')
     <script type="text/javascript" src="{{asset('js/gestionStock/controlExistencias.js')}}"></script>

 @endsection