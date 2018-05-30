$(document).ready(function(){


	$("#btnformulacion").click(function(){
		
		$("#tbodyformulacion").remove();
		
	var id=$("#idlote").attr("value");
	var cantidad=$("#cantidad").val();
    alert(id+cantidad);
    
		//para pedir la formulacion
  		 $.getJSON("/produccion/formulacion",{id,cantidad},function(result){

			
            	resultado=result;
            	console.log(resultado);

            	resultado.forEach(function(item,index) { //trato al json como un array enumerado por index
            		
            		//creo la tabla
            		var tbody=document.createElement("tbody");
-            			tbody.setAttribute("id","tbodyformulacion");
            		var tr=document.createElement("tr");
            			tr.setAttribute("id","trformulacion");
            		var td1=document.createElement("td");
            		//tiene el id
            		var inputID= $('<input>').attr({type:'hidden',value: item['id'],id:"idInsumo"}).appendTo(tr);//tiene el id
					inputID.addClass('interes');
            		var td2=document.createElement("td");
            		          	 	
            		var inputLote=$('<input>').attr({type:'text',id:"lote"}).appendTo(td2);
                    inputLote.addClass('interes');
            		var td3=document.createElement("td");
            		var inputCant =$('<input>').attr({type:'text',placeholder:"Cantidad Teorica: "+item['cantidad'],id:"cantidad"}).appendTo(td3);            	inputCant.addClass('interes');
            		var td4=document.createElement("td");            		
            		td1.setAttribute("id",item['codigo']);//producto
                    var td5=document.createElement("td");                       
                    var agregarLote=$("<button>").attr({type:"button",value:"agregarLote"}).appendTo(td5);
                    agregarLote.addClass("btn btn-primary");
                    agregarLote.text("Agregar Lote");


            		$(td2).attr("id",index+"l");//lote
            		$(td3).attr("id",index+"c");//cantidad
            		$(td3).attr("name","cantidad");
            		
            		td4.setAttribute("id",item['tipoUnidad']+index);//tu
            		tr.append(td1,td2,td3,td4,td5);	
-            		tbody.append(tr);
            		
            	
					$("#tformulacion").append(tbody);
            		$("#tbodyformulacion").append(tr);
		  			$("#"+item['codigo']).html(item['nombre']); 
					$("#"+item['tipoUnidad']+index).html(item['tipoUnidad']); 
		  			
		  		});
            	//$("#alert").html(insumo.codigo);
            });
  		 
		  		
		});


	$("#selectProducto").change(function(){   //cambiar el tipo de Unidad dependiendo el producto
		$('option:selected', this).attr('mytag');
		var tu=$('option:selected', this).attr("name");
		console.log(tu);
		$("#tipoUnidad").attr({value:tu});	

	});
		
});// post a /produccion/lotenoplanificado