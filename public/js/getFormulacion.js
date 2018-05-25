$(document).ready(function(){
	
	

	$("#btnformulacion").click(function(){
		var cantidad=$("#cantidad").val();
		var id=$(":selected").attr('value');
  		 $.getJSON("/produccion/formulacion",{id,cantidad},function(result){
  		 	console.log(result);
  		 	$("#alert").show();

            $("#alert").html(result[0].codigo);});

		});

		
}); post a /produccion/lotenoplanificado