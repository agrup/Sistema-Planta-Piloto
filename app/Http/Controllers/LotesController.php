<?php

namespace App\Http\Controllers;

use App\Lote;
use App\GestorLote;
use App\Producto;

class LotesController extends Controller
{
    public function index()
    {
    	$lotes= Lote::ALL();
    	 return view('lotes.index',compact('lotes'));
    }

    public function show()
    {
        $codigo=request()->input('codigo');
        $producto=Producto::where('codigo','=',$codigo)->first();
        $lotes=Producto::showLotesByProd($codigo);
        $lote=['producto'=>$producto->nombre,'tu'=>$producto->tipoUnidad,'lotes'=>$lotes];


		return view('informes.verLotes',compact('lote'));
    }

    public function showDetalle()
    {
        $lote=request()->input('lote');
        $detalle=[Lote::find($lote),'detalleElaboracion'=>GestorLote::getTrazabilidadLote($lote)];

        //trar trazabilidad y guardalo en detalleElaboracion
        //y dettale del lote que muestro la trazabilidad
        return view('informes.detalleLote',compact('detalle'));
    }
}
