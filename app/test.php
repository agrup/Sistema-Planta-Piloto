<?php 
	namespace App;
	use App\Producto;

	$producto = App\Producto::find(1);
foreach($producto->formulacion as $ing){
echo $ing->pivot->cantidad;
}