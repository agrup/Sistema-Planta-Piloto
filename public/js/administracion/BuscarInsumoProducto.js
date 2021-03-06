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
			    //$(tbody).clear();
			    //table = $('table#tablaBase').DataTable();
    			//table.clear();
			    
			    //remove(tbody);
			    console.log(data);
			    data.forEach(function(item, index){
		    	
			    	console.log(item);
			    	var tr=document.createElement("tr");
			    	tr.setAttribute("data", "normal");
			    	tr.setAttribute("role", "row");
			    	
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
						imgMod.setAttribute("class", "btnModificar");
			    		td.appendChild(imgMod);
			    		tr.appendChild(td); 

			    		var td=document.createElement("td");	    			
			    		var imgEliminar = document.createElement("img");							    			
			    		var src1 = $('img#iHBorrar').attr('src');						
						imgEliminar.setAttribute("src", src1);
						imgEliminar.setAttribute("width", "20");
						imgEliminar.setAttribute("height", "20");
						imgEliminar.setAttribute("style", "cursor: pointer");
						imgEliminar.setAttribute("class", "btnEliminar");
			    		td.appendChild(imgEliminar);			    		
			    		tr.appendChild(td); 


		        	tbody.append(tr);

		        	//
		        	

			    });		
			    $('.btnEliminar').on('click', function(){
						var r=confirm("¿Está seguro que desea borrar este Producto?");
						if(r){
							var tr = $(this).closest('tr');
							var cod = tr.find('td:first-child').text();
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
						 			if(data.success){
								    	alert('Se ha eliminado el producto');
								    	$(this).closest('tr').hide();
								    }
								}).fail(function(){
									alert('Ha ocurrido un error al eliminar el producto');
						  			console.log('Error');
							  	}
						  	);
						}
						
					});
			    if ( $.fn.dataTable.isDataTable('table#tablaInsumoProducto') ) {
    				
    				table = $('table#insumoProducto').dataTable();
				}
				else {
    				table = $('table#tablaInsumoProducto').dataTable( {
        				"bPaginate": false,
					    "bLengthChange": false,
					    "bFilter": false,
					    "aaSorting": [[ 2, "desc" ]],
						"bInfo": false,
						"bAutoWidth": true,
						"scrollY":        "14.5rem",
						"scrollCollapse": true,
						"oLanguage": {"sZeroRecords": "", "sEmptyTable": ""},
						"columnDefs": [
							{ "width": "16%", "targets": 0 }
						],
    				} );
    				//table.clear();
				}		    	

			}).fail(function(){
	  			console.log('Error');
		  	}
	  	);

	});
		
});