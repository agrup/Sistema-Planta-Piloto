/*function pintarAlarmas(){
	tabla = document.getElementsByTagName("table")[0];
	for (var i = 1; i < tabla.rows.length; i++){		
		if(tabla.rows[i].getAttributeNode("data").value == "roja"){
			tabla.rows[i].cells[2].style.color = "red";
			//console.log('1111111111111');    
		}else{
			if(tabla.rows[i].getAttributeNode("data").value == "amarilla"){
				tabla.rows[i].cells[2].style.color = "yellow";
			//	console.log('22222222222222222');    
			}		
		}		
	}
}

$(document).ready(function(evt){
	pintarAlarmas();

});*/

/*$(document).ready(function(evt){
	//EVENTO DOBLE CLICK EN UNA FILA
	$("#table").on('dblclick','tr td', function(evt){
	   var target,codigo,valorSeleccionado;
	   target = $(event.target);
	   codigo = target.parent().data('codigo');
	   getLotes(codigo);	   
	});

	//EVENTOS QUE PINTAN LAS FILAS DE LA TABLA
	$("#table").on('mouseenter','tr td', function(evt){
		target = $(event.target);
		target.parent().css("background-color", "#20B2AA");

	});
	$("#table").on('mouseleave','tr td', function(evt){
		target = $(event.target);
		target.parent().css("background-color", "white");

	});
});

function getStock(){
	f = $('#inputDate').val();
	console.log(f);
	
	$.ajax({
	  url: "/stockHasta",
	  data: {
	    fecha: f
	  },
	  success: function( result ) {
	  	actualizarTabla(document.getElementsByTagName("table")[0], result);	  	
	    alert(result);
		console.log(result);    
	  }
	});		
}

	
function actualizarTabla(tabla, result){	
	//ELIMINO LAS CELDAS DE LA TABLA
	cantidad = 	tabla.rows.length;
	for (var i = 1; i < cantidad; i++) {		
		tabla.deleteRow(1);
	}
	
	for(var i = 0; i < result.length; i++) {
              $('#table').append('<tr data-codigo="'+result[i]['codigo']+'">'+
              							'<td>'+result[i]['codigo']+'</td>'+
                                        '<td>'+result[i]['nombre']+'</td>'+
                                        '<td>'+result[i]['cantidad']+'</td>'+                                        
                                       '</tr>'
                                      );
          }	
}

function getLotes(cod){
	$.get({
	  url: "/verLotes",
	  data: {
	    codigo: cod
	  },

	  success: function( result ) {
	  	//document.load(result);	  	

	  	//
	  	//actualizarTabla(document.getElementsByTagName("table")[0], result);	  	
	    alert(result);
		console.log(result);    
	  }
	});		
}*/