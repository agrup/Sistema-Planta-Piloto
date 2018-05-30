$(document).ready(function(){
			
			$("#selectTP").change(function(){
				
				if($(this).val()=="true"){
					$("#inputasignatura").prop('disabled',false);
				}else{
					//$("#asignatura").hide();
					$("#inputasignatura").prop('disabled',true);
				}
			});
});