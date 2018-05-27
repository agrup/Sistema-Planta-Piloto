$(document).ready(function() {
	 $("#buscarLote").click(function() {
	 		var idlote=$("#lote").val();
	 		
	 		window.location.href='/produccion/loteEnProduccion/'+idlote;
	 });
});