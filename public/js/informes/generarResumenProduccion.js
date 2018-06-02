$(document).ready(function() {

	//$('#divRes').hide();

	remove = function(div){
		while (div.firstChild) {
 		   div.removeChild(div.firstChild);
		}		
	};
	$('botonGenerarResumenProduccion').on('click', function(){
		console.log($("#fechaDesde").val());
		console.log($("#fechaHasta").val());
		var desde = $("#fechaDesde").val();
	    var hasta = $("#fechaHasta").val();
	    $.ajax({
	  		url: "/Informes/ResumenProduccion",
	  		data: {
	    		fechaDesde: desde,
	        	fechaHasta: hasta
	  		},
	  		
	  	}).done(
	  		function(data, i) {	  				
	  			if(data)
	  				$('#divRes').show();

	  			console.log(data);			    
			    var tbody = document.getElementById("#tbodyResumen");
			    remove(tbody);

			    data.forEach(function(index, item){
			    	onsole.log(item);
			    	console.log(index);	

			    	var tr=document.createElement("tr");
			    	var td=document.createElement("td");	    			
			    		td.innerHTML = item.codigo;
			    		tr.appendChild(td);   

			    	var td=document.createElement("td");	    			
			    		td.innerHTML = item.nombre;
			    		tr.appendChild(td);        			   
			    	var td=document.createElement("td");	    			
			    		td.innerHTML = item.cantidad;
			    		tr.appendChild(td);        		
			    	var td=document.createElement("td");	    			
			    		td.innerHTML = item.costoUnitario;
			    		tr.appendChild(td);        			  

			    	var td=document.createElement("td");	    			
			    		td.innerHTML = item.categoria;
			    		tr.appendChild(td);        			  
			    });


			}).fail(function(){
	  			console.log('Error');
		  	}
	  	);

	});


});