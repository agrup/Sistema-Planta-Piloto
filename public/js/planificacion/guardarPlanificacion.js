$(document).ready(function(){

	$('body').on('click','.guardar',function(){
		var tr = $(this).closest('tr');
		tr.each(function(){
			$(this).find('input').each(function(){
					//console.log($(this).val());
					var value=$(this).val(); //guardo el valor del input y escribo el td
					var td=$(this).closest('td');
					td.text(value);
					$(this).remove();
			});
			$(this).find('select').each(function(){
					//console.log($(this).val());
					var value=$(this).val(); //guardo el valor del select y escribo el td
					var td=$(this).closest('td');
					td.text(value);
					$(this).remove();
			});

		});
	//borro el guardar y su padre (el td que lo contiene) y agrego el editar y borrar
		//console.log($(this));
		$(this).parent('td').remove();
		//$(this).find('img').remove();
		
		var tdimg1=document.createElement('td');
		var tdimg2=document.createElement('td');
		
		//editar
		var img1=document.createElement('img');
		img1.src = $('img#iHModificar').attr('src');
		img1.setAttribute('width','20px');
		img1.setAttribute('height','20px');
		img1.setAttribute('class','modificar');
		/*var img1 = $('img#iHModificar').clone();
		img1.show();*/
		tdimg1.appendChild(img1);
		//borrar
		var img2=document.createElement('img');
		img2.src = $('img#iHBorrar').attr('src');
		img2.setAttribute('width','30px');
		img2.setAttribute('height','30px');
		img2.setAttribute('class','borrar');
/*		var img2 = $('img#iHBorrar').clone();
		img2.show();*/
		tdimg2.appendChild(img2);

		tr.append(tdimg1,tdimg2);
		
		


})
					});


