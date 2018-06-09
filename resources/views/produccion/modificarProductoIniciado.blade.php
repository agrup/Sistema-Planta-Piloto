@extends('layouts.layoutPrincipal' )
@section('section')
    @include('elementosComunes.aperturaTitulo')
    Modificar Producto Iniciado
    @include('elementosComunes.cierreTitulo')
    @include('elementosComunes.aperturaTabla')
    <thead>
    <tr>
        <th>Lote</th>
        <th>Código</th>
        <th>Producto</th>
    </tr>
    </thead>
    <tbody>
    <tr><td>{{$lote['id']}}</td>
        <td>{{$producto['codigo']}}</td>
        <td>{{$producto['nombre']}}</td>
    </tr>
    </tbody>
    @include('elementosComunes.cierreTabla')
            <form class="formu" id="myform" action="">
                @csrf
                <input type="hidden" value="{{$lote['id']}}" name="loteID">
                <div class="form-group">
                    <label>Fecha Inicio</label>
                    @if(Auth::user()->hasAnyRole('administrador'))
                        <input type="date" id="fecha" class="form-control" value="{{$lote['fecha']}}">
                    @else
                        <input type="date" id="fecha" class="form-control" value="{{$lote['fecha']}}" disabled="true">
                     @endif
                </div>
                <div class="row">
                    <div class="col">
                        <label>Cantidad Actual</label>
                        @if(Auth::user()->hasAnyRole('administrador'))
                            <input type="text" id="cantidad" class="form-control" value="{{$lote['cantidad']}}">
                        @else
                            <input type="text" id="cantidad" class="form-control" value="{{$lote['cantidad']}}" disabled="true">
                        @endif
                    </div>
                    <div class="col">
                        <label for="exampleInputEmail1">Unidad</label>
                        <input type="text" class="form-control"  id="inlineFormInput" disabled="true" value="{{$producto['tipoUnidad']}}"> </div>
                </div>

        {{--<div class="col-md-6">
            <form class="formu" action="">
                <div class="form-group" id="#divselect">
                    <label>Trabajo Práctico</label>

                    @if($lote['tipoTp']==true)
                        <select class="form-control" id="selectTP">
                            <option value="true" selected>SI</option>
                            <option value="false" >NO</option>
                            <div class="form-group">
                                <label id="asignatura">Asignatura</label>
                                <input id="inputasignatura" type="text" class="form-control" placeholder="Asignatura Actual: {{$lote['asignatura']}}"> </div>
                        </select>
                    @else
                        <select class="form-control" id="selectTP">
                            <option value="true">SI</option>
                            <option value="false" selected>NO</option>
                        </select>
                        <label>Asignatura</label>
                        <input id="inputasignatura" type="text" class="form-control" disabled="true" />


                @endif


            </form>
        </div>--}}



        @include('elementosComunes.aperturaTabla')
        <div class="row"></div>
        <div class="col"></div>

        <h4 class="">
            <b>Formulación:</b>
        </h4>
        <table id="tformulacion" class="table">
            <thead>
            <tr>
                <th style="width:15% ">Insumo</th>
                <th style="width:15% ">Lote&nbsp;</th>
                <th style="width:15% ">Cantidad Utilizada</th>
                <th style="width:15% ">Tipo Unidad</th>
                <th style="width:15% ">Stock</th>
                <th style="width:15% "> </th>
            </tr>
            </thead>
            <tbody id="tbodyformulacion">

            @foreach($formulacion as $insumo)
                <?php
                $arrayTrazabilidad=array();
                ?>
                @for ($i = 0; $i < count($trazabilidad); $i++)
                    @if ($trazabilidad[$i]['nombre']==$insumo['nombre'])
                        <?php   array_push($arrayTrazabilidad,$i); //guardo los i de las trazabilidades
                        ?>
                    @endif
                @endfor

                @if(empty($arrayTrazabilidad))

                    <tr class="trConsumo">
                        <input type="hidden" value="{{$insumo['id']}}" class="interes">
                        <td>{{$insumo['nombre']}}</td>

                        <td><select class="interes" id="selectLote">
                                <option disabled="true" selected="true">--Seleccionar Lote--</option>
                                @foreach($insumo['lotes'] as $lote)
                                    <option value="{{$lote['id']}}" name="{{$lote['stock']}}">{{$lote['id']}}</option>
                                @endforeach
                            </select></td>
                        <td><input type=""  placeholder="Teorica total:{{$insumo['cantidad']}}" class="interes"></td>
                        <td> {{$insumo['tipoUnidad']}}</td>
                        <td id="tdstock"></td>
                        <td> <button type="button" value="agregarLote" class="btn btn-primary">Agregar Lote</button></td>

                    </tr>

                @else
                    @for ($i = 0; $i < count($arrayTrazabilidad); $i++)
                        <tr class="trConsumo">
                            <input type="hidden" value="{{$insumo['id']}}" class="interes">
                            <td>{{$insumo['nombre']}}</td>
                            <td>
                                <select class="interes" id="selectLote">
                                    @foreach($insumo['lotes'] as $lote)
                                        @if($lote['id']==$trazabilidad[$arrayTrazabilidad[$i]]['lote_id'])
                                            <option value="{{$lote['id']}}" name="{{$lote['stock']}}" selected="true">
                                                {{$lote['id']}}</option>
                                        @else
                                            <option value="{{$lote['id']}}" data-stock="{{$lote['stock']}}">
                                                {{$lote['id']}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="text" name="" class="interes"
                                       value="{{$trazabilidad[$arrayTrazabilidad[$i]]['cantidad']}}">
                            </td>
                            <td>{{ $insumo['tipoUnidad'] }}</td>
                            <td id="tdstock"></td>
                            @if($i==count($arrayTrazabilidad)-1)
                            <td> <button type="button" value="agregarLote" class="btn btn-primary">Agregar Lote</button></td>
                        </tr>
                        @else
                                <td></td>
                        </tr>
                        @endif
                    @endfor

                @endif
            @endforeach


            </tbody>
        </table>

        <button id="guardar" type="submit" class="btn btn-primary">Guardar</button>


        </div>
        </div>
        @include('elementosComunes.cierreTabla')
    </form>
    <div>
        <a href="/" class="btn btn-secondary">Volver al Menú</a>


    </div>

@endsection
@section('script')
    {{--<script type="text/javascript" src="{{asset('js/produccion/addAsignatura.js')}}"></script>--}}
    <script type="text/javascript" src="{{asset('js/produccion/addRowLote.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/produccion/postLote.js')}}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            PostLote.init("/produccion/modificarIniciado/{{$lote['id']}}");
        });
    </script>

@endsection