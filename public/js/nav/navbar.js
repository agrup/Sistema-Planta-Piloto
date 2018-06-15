$(document).ready(function(){
	var lugar=$("#home").data("place");
	if(lugar=="home"){
		$("#dropdown00").css('color','#ff4d4d');
	}
	//voy poniendo el nombre de la vista donde esto parado
	var nombreAtual=$('#home').text();	
	console.log(nombreAtual);
	var nombreVista=$('#tituloPagina').text();
	console.log(nombreVista);

	$('#home').text(nombreAtual+"->"+nombreVista);
	console.log($('#home').text());
});

