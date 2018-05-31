@extends('layouts.layoutPrincipal' )
@section('section')

    
    <?php $fecha=$planificaciones[0]['fecha'];?>

    @include('elementosComunes.aperturaTitulo')

        Planificación Productos e Insumos
    
    @include('elementosComunes.cierreTitulo')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="classol-md-12">
                    <p class="lead">
                        <b>Fecha Actual: <?= $fecha; ?> </b>
                    </p>
                </div>
            </div>
        </div>
    </div>
    @include('elementosComunes.aperturaTitulo')
    <h3>
        <b>Productos</b>
    </h3>
    @include('elementosComunes.cierreTitulo')
    @include('elementosComunes.aperturaTabla')
    <thead>
    <tr>
        <th>Código</th>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>TP</th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody class="tbodyPlanif">
    @foreach($planificaciones as $value)
        @if($value['fecha']==$fecha)
            @foreach($value["productos"] as $v)
                <?php
                $codigo[]=$v['codigo'];
                $nombre[]=$v['nombre'];
                $cantidad[]=$v['cantidad'].$v['tipoUnidad'];
                $id[]=$v["movimiento_id"];
                ?>
            @endforeach
        @endif
    @endforeach
    @if(isset($codigo))
        @foreach($codigo as $k=>$a)

            <tr>

                <td><?=$codigo[$k];?></td>
                <td><?=$nombre[$k];?></td>
                <td><?=$cantidad[$k];?></td>
                <td></td>
                <td><a href="" ><img class="icono" src="{{asset('img/modificar.png') }}" width="20" height="20" style="cursor: pointer;"   /></a></td>
                <td><a href=""><img src="{{asset('img/borrar.png') }}" width="30" height="30" style="cursor: pointer;" /></a></td>
            </tr>
        @endforeach
        
    @endif
    <tr class="nuevaLineaProducto"> </tr>
     <tr><td><img src="{{asset('img/agregar.png') }}" width="30" height="30" style="cursor: pointer;"class="agregarProducto"/></td></tr>
    </tbody>
    @include('elementosComunes.cierreTabla')
    @include('elementosComunes.aperturaTitulo')
    <h3>
        <b>Llegada de Insumos</b>
    </h3>
    @include('elementosComunes.cierreTitulo')
    @include('elementosComunes.aperturaTabla')
    <thead>
    <tr>
        <th>Código</th>
        <th>Insumo</th>
        <th>Cantidad</th>
        <th></th>
        <th></th>

    </tr>
    <tr></tr>
    </thead>
    <tbody>
    <?php unset($codigo);unset($nombre);unset($cantidad);?>
    @foreach($planificaciones as $value)
        @if($value['fecha']==$fecha)
            @foreach($value["insumos"] as $v)
                <?php
                $codigo[]=$v['codigo'];
                $nombre[]=$v['nombre'];
                $cantidad[]=$v['cantidad'].$v['tipoUnidad'];
                $id[]=$v["movimiento_id"];
                ?>
            @endforeach
        @endif
    @endforeach
    @if(isset($codigo))
        @foreach($codigo as $k=>$a)

            <tr>

                <td><?=$codigo[$k];?></td>
                <td><?=$nombre[$k];?></td>
                <td><?=$cantidad[$k];?></td>
               
                 <td><img src="{{asset('img/modificar.png') }}" width="20" height="20" style="cursor: pointer;" /></td>
                <td><img src="{{asset('img/borrar.png') }}" width="30" height="30" style="cursor: pointer;"/></td>
            </tr>

        @endforeach

    @endif
    <tr><td><img  src="{{asset('img/agregar.png') }}" width="30" height="30" style="cursor: pointer;" class="agregarInsumo" /></td></tr>
     <tr class="nuevaLineaInsumo">
           
        </tr>
    </tbody>
    @include('elementosComunes.cierreTabla')}
    <div id="imgmodificar">
    <img src="{{asset('img/modificar.png') }}" width="20" height="20" style="cursor: pointer;" hidden="true"  />
    </div>
     <div id="imgborrar">
    <img src="{{asset('img/borrar.png') }}" width="30" height="30" style="cursor: pointer;" hidden="true" />
    </div>

    </body>
@endsection
@section('script')
      <script type="text/javascript" src="{{asset('js/planificacion/addPlanificacion.js')}}"></script>
      <script type="text/javascript" src="{{asset('js/planificacion/guardarPlanificacion.js')}}"></script>
@endsection