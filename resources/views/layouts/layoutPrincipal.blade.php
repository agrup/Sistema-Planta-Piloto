<!DOCTYPE html>
<html>

<head>
<title>Planta Piloto</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <link rel="stylesheet" href="css/programa.produccion.semanal.css" type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!--
  -->
  <link rel="stylesheet" href="css/stock.css" type="text/css">


  <div class="fixed-top">
@include('nav.navbar')
  </div>

   </head>


<main role="main">
<body class="container jumbotron">


	
  @yield('section')

 
  <!--REFERENCIA A ARCHIVO CON SCRIPTS JS-->
  
  
  <script src="jquery/jquery-3.3.1.min.js"></script>
  <!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
  <script src="jquery/popper.min.js" ></script>
  <script src="jquery/bootstrap.min.js" ></script>
  <script src="/js/app.js"></script>
</body>
</main>
</html>