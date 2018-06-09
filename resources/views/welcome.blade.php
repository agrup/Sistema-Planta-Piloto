@extends('layouts.layoutPrincipal' )
@section('section') 
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

		 <link href="css/index.css" rel="stylesheet" type="text/css">
        
    </head>
    <body>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            You are logged in!
        </div>
        <div class="flex-center position-ref full-height">

 
            <div class="content">
            <img src="{{ asset('img/planta.JPG') }}" alt="Norway" width="1000" height="400">
                <div class="title m-b-md">
                    Bienvenido a la Planta Piloto
                </div>
            </div>
        </div>
        
    </body>
</html>

@endsection