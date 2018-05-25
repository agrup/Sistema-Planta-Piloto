$(document).ready(function(){
	$('#alert').hide();
	var id=$("#cantidad").attr('id');
	var producto=$("#producto").attr('value');

	$("#btnformulacion").click(function(){
  		 $.get("/produccion/formulacion",{id,producto}, function(result){
  		 	$("#alert").show();
            $("#alert").html(result);});

		});

		
});