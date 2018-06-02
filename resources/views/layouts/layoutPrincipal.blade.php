<!DOCTYPE html>
<html>

<head>
<title>Planta Piloto</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
<script src="{{ asset('jquery/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('jquery/datatables.min.js') }}"></script> 
<script src="{{ asset('js/dataTable.js') }}"></script>
<script type="text/javascript" src="{{asset('js/nav/navbar.js')}}"></script>

<link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.bootstrap4.css') }}">
  <script type="text/javascript" src="{{asset('ajax/sendNombreProducto.js')}}"></script>
  @yield('script')

  <link href="{{ asset('css/programa.produccion.semanal.css') }}" rel="stylesheet" type="text/css">


  <!--
    estilos para navBar
  -->
  

  <!--

  -->
  <link rel="stylesheet" href="{{ asset('css/stock.css') }}" type="text/css">


  <div class="fixed-top">
@include('nav.navbar')
  </div>

   </head>


<main role="main">
<body class="container jumbotron">

<?php $url= url()->current(); 
  $url=str_replace("http://127.0.0.1:8000","Home",$url);
  $arregloNav=explode("/",$url);
  ?>
    @foreach( $arregloNav as $nav )
    <a href="#" data-place="home" id="home" class="navegadora" >->{{$nav}}</a>
   
    @endforeach

	
  @yield('section')

 
  <!--REFERENCIA A ARCHIVO CON SCRIPTS JS-->
  
  
  
  <!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
  <script src="{{asset('jquery/popper.min.js')}}" ></script>
  <script src="{{asset('jquery/bootstrap.min.js')}}" ></script>

</body>
</main>
</html>