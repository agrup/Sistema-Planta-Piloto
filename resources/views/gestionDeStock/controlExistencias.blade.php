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
    <button type="submit" name="submit" value="continue"> Cargar y Continuar </button>
    <button type="submit" name="submit" value="end"> Cargar y Terminar</button>
    <button type="submit" name="submit" value="exit"> Salir </button>
</form>