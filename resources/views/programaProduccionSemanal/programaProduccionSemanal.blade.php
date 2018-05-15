@extends('layouts.layoutPrincipal' )
@section('section')

    @include('elementosComunes.aperturaTitulo')
    <h2 class="display-4">
        <b>Programa de Producción Semanal</b>
    </h2>
    @include('elementosComunes.cierreTitulo')

    <div class="py-5">
        <div class="container">
            <div class="row">
                @foreach($planificaciones as $value  )
                    @if($value['diaSemana']=="lunes")

                        <form action="calendarioAnt{{--?fecha={{$value["fecha"]}}--}}" method="GET" enctype="multipart/form-data" class="col-md-11"> {{csrf_field()}}
                            <input   type="hidden" name="fecha" value="{{$value["fecha"]}}">
                            <input type="submit" class="btn btn-primary"  value="<<">

                        </form>
                    @endif
                @endforeach

                @foreach($planificaciones as $value  )
                    @if($value['diaSemana']=="lunes")

                        <form action="calendarioSig" method="GET" enctype="multipart/form-data"  class="col-md-1">

                            {{csrf_field()}}
                            <input   type="hidden" name="fecha" value="{{$value["fecha"]}}">
                            <input type="submit" class="btn btn-primary" value=">>">

                        </form>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="py-5">
        <div class="container">
            <div class="row">
                <form action="planificacion" method="POST" enctype="multipart/form-data"  class="col-md-5">
                    {{csrf_field()}}
                    <input type="date" name="fecha" value="{{$planificaciones[0]['fecha']}}" >
                    <input  class="btn btn-secondary"  type="submit" value="Ir a semana">
                </form>
            </div>
        </div>
    </div>


    @include('elementosComunes.aperturaTabla')
    <thead>
    <tr>
        <th>
            <b>Producción</b>
        </th>

        @foreach($planificaciones as $value  )


            <form action="planificacionDia" method="get" enctype="multipart/form-data" class="col-md-11">
                {{csrf_field()}}
                <th> <input type="submit" class="btn btn-primary" name="fecha" value={{$value["fecha"]}}></th>
            </form>



        @endforeach

    </tr>
    <tr>
        <th>2018</th>
        @foreach($planificaciones as $value )
            <th>{{$value["diaSemana"]}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($planificaciones as  $value)
        <?php $mayor=0;?>
        <?php $dia=$value["diaSemana"]; ?>
        @foreach($value["productos"] as $v)

            @if ($dia=="lunes")
                <?php $lunes[]=$v["nombre"];?>

            @endif
            @if ($dia=="martes")
                <?php $martes[]=$v["nombre"];?>

            @endif
            @if ($dia=="miercoles")
                <?php $miercoles[]=$v["nombre"];?>

            @endif
            @if ($dia=="jueves")
                <?php $jueves[]=$v["nombre"];?>

            @endif
            @if ($dia=="viernes")
                <?php $viernes[]=$v["nombre"];?>

            @endif
        @endforeach
    @endforeach
    <?php
    //script para reducir rows al pedo
    if (isset($lunes)) {
        if(count($lunes)>$mayor){
            $mayor=count($lunes);
        }
    }elseif(isset($martes)) {
        if(count($martes)>$mayor){
            $mayor=count($martes);
        }
    }
    elseif(isset($miercoles)) {
        if(count($miercoles)>$mayor){
            $mayor=count($miercoles);
        }
    }
    elseif(isset($jueves)) {
        if(count($jueves)>$mayor){
            $mayor=count($jueves);
        }
    }
    elseif(isset($viernes)) {
        if(count($viernes)>$mayor){
            $mayor=count($viernes);
        }
    }
    ?>
    @for($k=0;$k<$mayor ; $k++)
        <tr>
            <td><?=$k; ?></td>
            @if(isset($lunes[$k]))
                <td><?= $lunes[$k];?> </td>
            @else
                <td><?= "" ?> </td>
            @endif

            @if(isset($martes[$k]))
                <td><?= $martes[$k]; ?> </td>
            @else
                <td><?= "" ?> </td>
            @endif
            @if(isset($miercoles[$k]))
                <td><?= $miercoles[$k]; ?> </td>
            @else
                <td><?= "" ?> </td>
            @endif
            @if(isset($jueves[$k]) )
                <td><?=$jueves[$k] ;?> </td>
            @else
                <td><?= "" ?> </td>
            @endif
            @if(isset($viernes[$k]))
                <td><?= $viernes[$k]; ?> </td>
            @else
                <td><?= "" ?> </td>
            @endif
        </tr>
    @endfor




    </tbody>

    @include('elementosComunes.cierreTabla')
    @include('elementosComunes.aperturaTabla')
    <tr>
        <th>
            <b>Trabajadores</b>
        </th>

        @foreach($planificaciones as $value )
            <th>{{$value["diaSemana"]}}</th>
        @endforeach
    </tr>
    </thead>

    </thead>
    <tbody>
    <?php unset($lunes);unset($martes);unset($miercoles);unset($jueves);unset($viernes);?>

    @foreach($planificaciones as $k=> $value  )
        <?php $dia=$value["diaSemana"]; ?>
        @foreach($value["trabajadores"] as $v)

            @if ($dia=="lunes")
                <?php $lunes[]=$v;?>

            @endif
            @if ($dia=="martes")
                <?php $martes[]=$v;?>

            @endif
            @if ($dia=="miercoles")
                <?php $miercoles[]=$v;?>

            @endif
            @if ($dia=="jueves")
                <?php $jueves[]=$v;?>

            @endif
            @if ($dia=="viernes")
                <?php $viernes[]=$v;?>

            @endif
        @endforeach
    @endforeach
    <?php
    //script para reducir rows al pedo
    if (isset($lunes)) {
        if(count($lunes)>$mayor){
            $mayor=count($lunes);
        }
    }elseif(isset($martes)) {
        if(count($martes)>$mayor){
            $mayor=count($martes);
        }
    }
    elseif(isset($miercoles)) {
        if(count($miercoles)>$mayor){
            $mayor=count($miercoles);
        }
    }
    elseif(isset($jueves)) {
        if(count($jueves)>$mayor){
            $mayor=count($jueves);
        }
    }
    elseif(isset($viernes)) {
        if(count($viernes)>$mayor){
            $mayor=count($viernes);
        }
    }
    ?>
    @for($k=0;$k<$mayor ; $k++)
        <tr>
            <td>{{$k}}</td>
            @if(isset($lunes[$k]))
                <td><?= $lunes[$k];?> </td>

            @endif

            @if(isset($martes[$k]))
                <td><?= $martes[$k]; ?> </td>

            @endif
            @if(isset($miercoles[$k]))
                <td><?= $miercoles[$k]; ?> </td>

            @endif
            @if(isset($jueves[$k]) )
                <td><?=$jueves[$k] ;?> </td>

            @endif
            @if(isset($viernes[$k]))
                <td><?= $viernes[$k]; ?> </td>

            @endif
        </tr>
    @endfor
    </tbody>

    @include('elementosComunes.cierreTabla')
    @include('elementosComunes.aperturaTabla')
    <thead>
    <tr>
        <th>
            <b>Llegada de Insumos</b>
        </th>

        @foreach($planificaciones as $value )
            <th>{{$value["diaSemana"]}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    <?php unset($lunes);unset($martes);unset($miercoles);unset($jueves);unset($viernes);?>

    @foreach($planificaciones as $k=> $value  )
        <?php $dia=$value["diaSemana"]; ?>
        @foreach($value["insumos"] as $v)

            @if ($dia=="lunes")
                <?php $lunes[]=$v["nombre"];?>

            @endif
            @if ($dia=="martes")
                <?php $martes[]=$v["nombre"];?>

            @endif
            @if ($dia=="miercoles")
                <?php $miercoles[]=$v["nombre"];?>

            @endif
            @if ($dia=="jueves")
                <?php $jueves[]=$v["nombre"];?>

            @endif
            @if ($dia=="viernes")
                <?php $viernes[]=$v["nombre"];?>

            @endif
        @endforeach
    @endforeach
    <?php
    //script para reducir rows al pedo
    if (isset($lunes)) {
        if(count($lunes)>$mayor){
            $mayor=count($lunes);
        }
    }elseif(isset($martes)) {
        if(count($martes)>$mayor){
            $mayor=count($martes);
        }
    }
    elseif(isset($miercoles)) {
        if(count($miercoles)>$mayor){
            $mayor=count($miercoles);
        }
    }
    elseif(isset($jueves)) {
        if(count($jueves)>$mayor){
            $mayor=count($jueves);
        }
    }
    elseif(isset($viernes)) {
        if(count($viernes)>$mayor){
            $mayor=count($viernes);
        }
    }
    ?>
    @for($k=0;$k<$mayor ; $k++)
        <tr>
            <td>{{$k}}</td>
            @if(isset($lunes[$k]))
                <td><?= $lunes[$k];?> </td>

            @endif

            @if(isset($martes[$k]))
                <td><?= $martes[$k]; ?> </td>

            @endif
            @if(isset($miercoles[$k]))
                <td><?= $miercoles[$k]; ?> </td>

            @endif
            @if(isset($jueves[$k]) )
                <td><?=$jueves[$k] ;?> </td>

            @endif
            @if(isset($viernes[$k]))
                <td><?= $viernes[$k]; ?> </td>

            @endif
        </tr>
    @endfor
    </tbody>



    @include('elementosComunes.cierreTabla')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="">Fecha Hasta</h4  >
                </div>
            </div>

            <div class="py-5">
                <div class="container">
                    <div class="row">


                        <div>
                            <form action="sumarizacion" method="get" enctype="multipart/form-data">

                                {{csrf_field()}}
                                <input type="date" name='fecha' value="{{$planificaciones[4]["fecha"]}}" class="form-control"></div>

                        <input type="submit" value="Ver necesidad de Insumos" class="btn btn-primary" required>


                        </form>

                    </div>
                </div>
            </div>
            <br>
            <br>
@endsection