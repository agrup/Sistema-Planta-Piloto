$(document).ready(function(){
	$('#botonCargarContinuar').on('click', function(){
		var lote = $('#lote_id').val();
		var cantidad = $('#cantidadObservada').val();
		var tipo = $('#tipoUnidad').val();

		$.ajax({
	  		url: "/stock/controlExistencias",
	  		headers: {
        		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    		},
	  		data: {
	    		lote_id: lote,
	        	cantidadObservada: cantidad,
	        	tipoUnidad: tipo
	  		},
	  		type: "POST"
	  		
	  	}).done(function(data) {	  					    
			//var tbody = $('tbody');
			var tbody = document.getElementsByTagName("tbody")[0];
			//$(tbody).empty();									
			var tr=document.createElement("tr");			    	
			    	var td=document.createElement("td");	    			
			    		td.innerHTML = $('#fecha').val();
			    		tr.appendChild(td);   
			    	var td=document.createElement("td");	    			
			    		td.innerHTML = lote;
			    		tr.appendChild(td);
			    	var td=document.createElement("td");	    			
			    		td.innerHTML = cantidad;
			    		tr.appendChild(td);    
			    	var td=document.createElement("td");	    			
			    		td.innerHTML = data.lote;
			    		tr.appendChild(td);    
			    	var td=document.createElement("td");	    			
			    		td.innerHTML = tipo;
			    		tr.appendChild(td);   


			tbody.appendChild(tr)
			    		

					
		}).fail(function(){
	  		alert('Error, Lote No Encontrado');		  
		});
	});

	$('#botonCargarTerminar').on('click', function(){
		var lote = $('#lote_id').val();
		var cantidad = $('#cantidadObservada').val();
		var tipo = $('#tipoUnidad').val();

		$.ajax({
	  		url: "/stock/controlExistencias",
	  		data: {
	    		lote_id: lote,
	        	cantidadObservada: cantidad,
	        	tipoUnidad: tipo
	  		},
	  		headers: {
        		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    		},
	  		type:'post',
	  		
	  	}).done(function(data, i) {	  					    	    		
	  		alert('El control se ha cargado');
	  		window.location.replace("/")
	  		 
					
		}).fail(function(){
	  		alert('Error, Lote No Encontrado');		  
		});



	});
});