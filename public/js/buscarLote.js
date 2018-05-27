//buscar lote en la vista de produccion

$(document).ready(function() {
	 $("#buscarLote").click(function() {
	 		var idlote=$("#lote").val(); //este es el lote que busco
	 		
	 		window.location.href='/produccion/loteEnProduccion/'+idlote;
	 });
});