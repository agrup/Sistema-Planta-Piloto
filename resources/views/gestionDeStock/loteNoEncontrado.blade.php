El lote {{$lote_id}} no se encuentra cargado.
<form action='/produccion/loteNoPlanificado' method="get">
    <button>desea darlo de alta?</button>
</form>
<form action="/stock/controlExistencias" method="get">
    <button> Volver / volver a control de existencias</button>

    <input type="hidden" name="lote_id" value="{{$lote_id}}">
    <input type="hidden" name="cantidad" value="{{$cantidad}}">
    <input type="hidden" name="tipoUnidad" value="{{$tipoUnidad}}">
</form>

