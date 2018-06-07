$(document).ready(function() {

	/*$('.btnModificar').on('click', function(){


		
	});*/


	/*$('.btnEliminar').on('click', function(){
		var r=confirm("¿Está seguro que desea borrar este Producto?");
		if(r){
			var tr = $(this).closest('tr');
			var cod = $(this).closest('tr').firstChild.innerHTML;
			console.log("Codigo: "+cod);
			$.ajax({
		  		url: "/productos/eliminarProducto",
		  		data: {
		    		codigo: cod,	        	
		  		},
		  		type:'get',
		  		
		  	}).done(		
		 		function(data, i) {
		 			console.log('Datos recibidos: '+data);
		 			if(data==true){
				    	alert('Se ha eliminado el producto');
				    	$(this).closest('tr').hide();
				    }
				}).fail(function(){
					alert('Ha ocurrido un error al eliminar el producto');
		  			console.log('Error');
			  	}
		  	);
		}

	});*/

});