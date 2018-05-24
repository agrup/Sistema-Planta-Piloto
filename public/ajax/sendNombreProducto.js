function getFormulacion(){
	
	var xhttp = new XMLHttpRequest();
	var x;

	 x = document.getElementById("selectProducto").value;
	  
	console.log(x);
	xhttp.open("GET", "/produccion/formulacion/"+x, true);
  	xhttp.responseType = 'json';
  	xhttp.onload = function () {
    if (xhttp.readyState === xhttp.DONE) {
        if (xhttp.status === 200) {
        	console.log("X"+xhttp.response);
        	$.each(	xhttp.response, function(){
        	console.log("X");
        	//var row=document.createElement("tr");
          	//$("#insumo").append(row);
           	
          });
        }
    }
};


  	xhttp.send();
}	