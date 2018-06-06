remove = function(div){
		while (div.firstChild) {
 		   div.removeChild(div.firstChild);
		}		
	};
$(document).ready(function() {
	
		var suc = $('#alertConfirm').val();
		if(suc==1){
			alert('Se ha guardado un producto');
		}	

	$("#btnBuscar").click( function() {		
		var cod = $("#codigo").val();
	    var nom = $("#nombre").val();
	    var cat = $("#categoria").val();
		var al = $("#alarma").val();
		var insProd = $(this).attr("data-insumoProducto");

		$.ajax({
	  		url: "/Administracion/BuscarProducto",
	  		data: {
	    		codigo: cod,
	        	nombre: nom,
	        	categoria: cat, 
	        	alarma: al,
	        	insumoProducto: insProd
	  		},
	  		type:'get',
	  		
	  	}).done(
		
	 		function(data, i) {	  					    
			    var tbody = $("tbody");
			    $(tbody).empty();
			    //remove(tbody);
			    data.forEach(function(item, index){
		    	

			    	var tr=document.createElement("tr");
			    	tr.setAttribute("data", "normal");
			    	tr.setAttribute("role", "row");
			    	/*
			    	if ((index % 2) == 0){
			    		tr.setAttribute("class", "odd");	
			    	}else{
			    		tr.setAttribute("class", "even");
			    	}
			    	*/
			    	var td=document.createElement("td");	    			
			    		td.innerHTML = item.codigo;
			    		tr.appendChild(td);   
			    		//td.setAttribute("class", "sorting_1");

			    	var td=document.createElement("td");	    			
			    		td.innerHTML = item.nombre;
			    		tr.appendChild(td);        			   
			    	var td=document.createElement("td");	    			
			    		td.innerHTML = item.descripcion;
			    		tr.appendChild(td);        		
			    	var td=document.createElement("td");	    			
			    		td.innerHTML = item.tipoUnidad;
			    		tr.appendChild(td);        			   	   
			    	var td=document.createElement("td");	    			
			    		if (item.alarmaActiva)
			    			td.innerHTML = "Si";
			    		else
			    			td.innerHTML = "No";
			    		tr.appendChild(td);        
			    	var td=document.createElement("td");	    			
			    		td.innerHTML = item.alarmaAmarilla;
			    		tr.appendChild(td);        		
			    	var td=document.createElement("td");	    			
			    		td.innerHTML = item.alarmaRoja;
			    		tr.appendChild(td);        	
			    	var td=document.createElement("td");	    			
			    		td.innerHTML = item.categoria;
			    		tr.appendChild(td); 

					var td=document.createElement("td");
					var imgMod = document.createElement("img");							    			
						var src = $('img#iHModificar').attr('src');
						imgMod.setAttribute("src", src);
						imgMod.setAttribute("width", "20");
						imgMod.setAttribute("height", "20");
						imgMod.setAttribute("style", "cursor: pointer");
						imgMod.setAttribute("id", "btnModificar");
			    		td.appendChild(imgMod);
			    		tr.appendChild(td); 

			    		var td=document.createElement("td");	    			
			    		var imgEliminar = document.createElement("img");							    			
			    		var src1 = $('img#iHBorrar').attr('src');						
						imgEliminar.setAttribute("src", src1);
						imgEliminar.setAttribute("width", "20");
						imgEliminar.setAttribute("height", "20");
						imgEliminar.setAttribute("style", "cursor: pointer");
						imgEliminar.setAttribute("id", "btnEliminar");
			    		td.appendChild(imgEliminar);			    		
			    		tr.appendChild(td); 

		        	tbody.append(tr);
			    });		
			}).fail(function(){
	  			console.log('Error');
		  	}
	  	);
	});
		
});