$(document).ready(function(){
			$('body').on('click','.modificar',function(){
				
				//genero inputs con los valores actuales para que sean modificados
				var tr = $(this).closest('tr');
				tr.each(function(){
				$(this).find('td').each(function(){ //por cada td con img, borro el td
				$(this).find('img').parent('td').remove();
			
			});});

				//ahora ponemos los inputs
				tr.each(function(){	
					$(this).find('td').each(function(){
						var valortd=$(this).text(); 
						$(this).text("");
						var input=$('<input>').val(valortd);
						$(this).append(input);	
					});
				});		
				//agrego el boton guardar
				var td5=document.createElement("td");
				var guardar=document.createElement('img');
				guardar.src="img/guardar.png";
				guardar.setAttribute('width','30px');
				guardar.setAttribute('height','30px');
				guardar.setAttribute('class','guardar');
				td5.appendChild(guardar);
				tr.append(td5);
			});
});