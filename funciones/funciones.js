function cambiarCaracter(cadena,caracter1,caracter2)
{
	/*
	Esta función reemplaza el caracter1 por el caracter 2 en la cadena
	*/
	var posicion=0,cadena;
	//alert(cadena+' '+caracter1+' otro'+caracter2+'o');
	while (posicion>=0)
	{
		posicion=cadena.indexOf(caracter1);
		//alert(posicion);
		if (posicion>=0) cadena[posicion]=caracter2;//reemplazo
	}
	//alert(cadena);
	return(cadena);
}

function soloLetras(tecla)
{
	//invocar con el evento onKeyPress="return solonumeros(event)";
	// NOTE: backspace= 8, Enter= 13, 0=48, 9=57
	var nav4=window.Event? true:false;
	var key= nav4? tecla.which:tecla.keyCode;
	return(key<=13||key==32||(key>=65 && key<=90)||(key>=97 && key<=122)); 
}

function soloNumeros(tecla)
{
	//invocar con el evento onKeyPress="return solonumeros(event)";
	// NOTE: backspace= 8, Enter= 13, 0=48, 9=57
	var nav4=window.Event? true:false;
	var key= nav4? tecla.which:tecla.keyCode;
	return(key<=13||(key>=48 && key<=57)); 
}

function validarNoVacio(objeto,mensaje)
{
	var valido=true;
	if (objeto.value=="")
	{
		alert('Debe ingresar ' + mensaje);
		objeto.focus();
		valido=false;
	}
	return(valido);
}
