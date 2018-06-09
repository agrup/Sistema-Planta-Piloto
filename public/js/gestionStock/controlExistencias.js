$(document).ready(function(){
	var tbody = document.getElementsByTagName("tbody")[0];
			$(tbody).empty();									
	$('#botonCargarContinuar').click(function(e){
		e.preventDefault();
		var lote = $('#lote_id').val();
		var cantidad = $('#cantidadObservada').val();
		var tipo = $('#tipoUnidad').val();
		var fecha=$('#fecha').val();

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
	  		type: "post"
	  		
	  	}).done(function(data, i) {	  					    
			//var tbody = $('tbody');
            let tbody = document.getElementsByTagName("tbody")[0];
            //$(tbody).empty();
            let tr = document.createElement("tr");
            //Creo los td
            let tdFecha = document.createElement("td");
            let tdLote   = document.createElement("td");
            let tdNombre = document.createElement("td");
            let tdCantidadObs = document.createElement("td");
            let tdTU = document.createElement("td");
            //Asigno los valores
            tdFecha.innerHTML = fecha;
            tdLote.innerHTML = lote;
            tdNombre.innerHTML = data.nombreProducto;
            tdCantidadObs.innerHTML = cantidad;
            tdTU.innerHTML = tipo;
		    // Agrego los td a la row y la row a la table
            tr.appendChild(tdFecha);
            tr.appendChild(tdLote);
            tr.appendChild(tdNombre);
            tr.appendChild(tdCantidadObs);
            tr.appendChild(tdTU);
            tbody.appendChild(tr);

		}).fail(function(){
	  		alert('Error, Lote No Encontrado');		  
		});
	});

	$('#botonCargarTerminar').click(function(e){
        e.preventDefault();
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