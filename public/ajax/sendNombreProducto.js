function getFormulacion(){
	
	var xhttp = new XMLHttpRequest();
	var x;

	 x = document.getElementById("selectProducto").value;
	  
	console.log(x);
	xhttp.open("GET", "/produccion/formulacion/"+x, true);
  	xhttp.send();
}	