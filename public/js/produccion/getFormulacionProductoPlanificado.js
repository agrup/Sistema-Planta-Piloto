$(document).ready(function(){


	$("#btnformulacion").click(function(){
		
		$("#tbodyformulacion").remove();
		
	var id=$("#producto").attr("value");
	var cantidad=$("#cantidad").val();
		//para pedir la formulacion
  		 $.getJSON("/produccion/formulacion",{id,cantidad},function(result){

			
            	let formulacion=result;
            	console.log(formulacion);

            	formulacion.forEach(function(ing,index) { //trato al json como un array enumerado por index
            		
            		//creo la tabla
            		var tbody=document.createElement("tbody");
-            			tbody.setAttribute("id","tbodyformulacion");
            		var tr=document.createElement("tr");
            			tr.setAttribute("id","trformulacion");
                    	tr.setAttribute('class','trConsumo');
            		var td1=document.createElement("td");
            		//tiene el id
            		var inputID= $('<input>').attr({type:'hidden',value: ing['id'],id:"idInsumo"}).appendTo(tr);//tiene el id
					inputID.addClass('interes');
            		var td2=document.createElement("td");
            		          	 	
            		var selectLote=$('<select></select>').attr({id:"selectLote"}).appendTo(td2);
                    $('<option selected="selected" disabled></option>').text("-Selecccione un Lote-").appendTo(selectLote);
					selectLote.addClass('interes');
            		var td3=document.createElement("td");
            		var inputCant =$('<input>').attr({type:'text',placeholder:"Teorica Total: "+ing['cantidad'],id:"cantidad"}).appendTo(td3);            	inputCant.addClass('interes');
            		var td4=document.createElement("td");            		
            		td1.setAttribute("id",ing['codigo']);//producto
                    var td5=document.createElement("td");                       
                   
                    var tdStock=document.createElement("td");   
                    tdStock.setAttribute('id','tdstock');
                     var agregarLote=$("<button>").attr({type:"button",value:"agregarLote"}).appendTo(td5);
                    agregarLote.addClass("btn btn-primary");
                    agregarLote.text("Agregar Lote");

            		$(td2).attr("id",index+"l");//lote
            		$(td3).attr("id",index+"c");//cantidad
            		$(td3).attr("name","cantidad");
            		
            		td4.setAttribute("id",ing['tipoUnidad']+index);//tu
            		tr.append(td1,td2,td3,td4,tdStock,td5);	
-            		tbody.append(tr);
            		
            	
					$("#tformulacion").append(tbody);
            		$("#tbodyformulacion").append(tr);
		  			$("#"+ing['codigo']).html(ing['nombre']);
					$("#"+ing['tipoUnidad']+index).html(ing['tipoUnidad']);

                    //Agrego las opciones al select de lotes
                    ing['lotes'].forEach(function(lote,index) {
                        var option=$('<option></option>').text(lote['id']);
                        option.attr("value",lote['id']);
                        // se guarda en data-stock la cantidad en stock para ser mostrada luego de seleccionar el lote

                        option.attr('name',lote['stock']);
                        selectLote.append(option);  
                    });
		  			
		  		});
            	//$("#alert").html(insumo.codigo);
            });
  		 
		  		
		});


	$("#selectProducto").change(function(){   //cambiar el tipo de Unidad dependiendo el producto
		//$('option:selected', this).attr('mytag');
		var tu=$('option:selected', this).attr("name");
		//console.log(tu);
		$("#tipoUnidad").attr({value:tu});	

	});


		
});// post a /produccion/lotenoplanificado