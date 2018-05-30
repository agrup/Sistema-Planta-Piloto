$(document).ready(function(){
			
			$("#selectTP").change(function(){
				alert("dd");
				if($(this).val()=="true"){
					$("#asignatura").show();
					$("#inputasignatura").show();
				}else{
					$("#asignatura").hide();
					$("#inputasignatura").hide();
				}
			});
});