$(document).ready(function() {
	$("#btnBuscar").click(function() {
		console.log($("#codigo").val());
		console.log($("#nombre").val());
		console.log($("#categoria").val());
		console.log($("#alarma").val());
		var cod = $("#codigo").val();
	    var nom = $("#nombre").val();
	    var cat = $("#categoria").val();
		var al = $("#alarma").val();
		$.ajax({
	  		url: "/Administracion/BuscarProducto",
	  		data: {
	    		codigo: cod,
	        	nombre: nom,
	        	categoria: cat, 
	        	alarma: al
	  		},
	  		
	  	}).done(
	  		function(data) {	  				
					console.log(data);
				    var tbody =  $("#tbodyResultados");
				    //tbody.empty();
				    data.forEach(function(item, index){
				    	var tr=document.createElement("tr");
			        	tr.setAttribute("id","tr"+index);
			        	//var i = 
			        	$.each(item, function(i,item1){
			        		var td=document.createElement("td");	    			
				    		td.innerHTML = item[i];
				    		tr.appendChild(td);        			

			        	})
			        	tbody.append(tr);
				    });
				    /*
				    for (var i = 0; i < data.lenght; i++) {
			    		var tr=document.createElement("tr");
			        	tr.setAttribute("id","tr"+i);
				    	for (var j = 0; j < data[i].lenght; j++) {
				    		var td=document.createElement("td");	    			
				    		td.innerHTML = data[i][j];
				    		tr.appendChild(td);        			
				    	}	
				    	tbody.append(tr);
				    }*/
			}
	  	).fail(function(){
	  		console.log('Error');
	  	}
	  	);

	/*	
		$.ajax("/Administracion/BuscarProducto",
    	{
	        codigo: cod,
	        nombre: nom,
	        categoria: cat, 
	        alarma: al
    		  	
    	},

		  		function(data){
		    	console.log(data);
		    	var tbody =  $("#tbodyResultados");

		    	tbody.empty();
		    	for (var i = 0; i < data.lenght; i++) {
	    			var tr=document.createElement("tr");
	        		tr.setAttribute("id","tr"+i);
		    		for (var j = 0; j < data[i].lenght; j++) {
		    			var td=document.createElement("td");	    			
		    			td.innerHTML = data[i][j];
		    			tr.appendChild(td);        			
		    		}	
		    		tbody.append(tr);
		    	}
		        //alert("Data: " + data + "\nStatus: " + status);
		});*/
	});
		
});