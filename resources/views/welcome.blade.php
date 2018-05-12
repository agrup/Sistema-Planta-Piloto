@extends('layouts.layoutPrincipal' )
@section('section') 
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

		 <link href="css/index.css" rel="stylesheet" type="text/css">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        
    </head>
    <body>
        <div class="flex-center position-ref full-height">

 
            <div class="content">
            <img src="{{ asset('img/planta.JPG') }}" alt="Norway" width="1000" height="400">
                <div class="title m-b-md">
                    Bienvenidos a la Planta Piloto
                </div>

            </div>
        </div>
    </body>
</html>

@endsection