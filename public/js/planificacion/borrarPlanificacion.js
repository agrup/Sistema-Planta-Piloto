$(document).ready(function(){
			$('body').on('click','.borrar',function(){
				var tr=$(this).closest('tr');
				//
				var txt;
				var r=confirm("¿Está seguro que desea borrar esta planificación?");
				if (r == true) {
				   tr.hide();
				   //console.log(tr.is(":visible")); 
				   
					alert(a);
					
				} 
				
			});
});