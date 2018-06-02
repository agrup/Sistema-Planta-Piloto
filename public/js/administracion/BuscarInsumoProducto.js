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
		//$("#tbodyResultados").remove();
		console.log($("#codigo").val());
		console.log($("#nombre").val());
		console.log($("#categoria").val());
		console.log($("#alarma").val());
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
	
	  			console.log("------------------------");
		    
			    var tbody = document.getElementById("tbodyResultados");
			    remove(tbody);
			    var array = ["codigo", "nombre", "descripcion", "unidad", "alarmaActiva", "alarmaAmarilla",	"alarmaRoja", "categoria", "estado"];


			    data.forEach(function(item, index){
			    	console.log(item);
			    	console.log(index);			    	

			    	var tr=document.createElement("tr");
			    	var td=document.createElement("td");	    			
			    		td.innerHTML = item.codigo;
			    		tr.appendChild(td);   

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

			    		   		   		   	   			   
			    	/*var td=document.createElement("td");	    			

			    		td.innerHTML = item.codigo;
			    		tr.appendChild(td);        			   
		        	$.each(item, function(i,item1){
		        		var td=document.createElement("td");	    			
			    		td.innerHTML = item[i];
			    		tr.appendChild(td);        
		        	});*/
		        	tbody.appendChild(tr);
			    });				 
			}).fail(function(){
	  			console.log('Error');
		  	}
	  	);
	});
		
});