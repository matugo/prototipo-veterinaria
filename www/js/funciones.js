function tomar_sintomas()
{
	var lista=document.getElementById('lista');
	var salida="";
	for (var i = 0; i < lista.length; i++) {
		if (lista.item(i).selected) 
		{
			if (salida=="") {
				salida+= (lista.item(i).value);
			} else{
				salida+= "," +(lista.item(i).value) 

			}
					}
		
	}
	document.getElementById('cont-salida').value=salida
	console.log(salida)
}
