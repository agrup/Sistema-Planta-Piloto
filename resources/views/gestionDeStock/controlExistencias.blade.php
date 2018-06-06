{{-- form  --}}
{{-- los old('id..') son para volver a llenar si falla, nose, queria probarlo, capaz no haga nada--}}
<form action="/stock/controlExistencias" method="post">
    <input type="number" value="{{old('lote_id')}}" name="lote_id">
    <input type="number" name="cantidadObservada" value="{{old('cantidadObservada')}}">
    <select name="tipoUnidad">
        @foreach($tipoUnidades as $tu)
            <option value="{{$tu}}">{{$tu}}</option>
        @endforeach
    </select>
    <button> Cargar y Continuar </button>
    <button> Cargar y Terminar</button>
    <button> Salir </button>
</form>