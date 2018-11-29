

<?php

	if (!session_is_registered('Usuario'))
	{
?>
	<script language="Javascript">
		window.alert('Acceso no autorizado');
		window.location='index.php';
	</script>	
<?php
	}
?>

						<h3><center><p>Asistente de Configuraci&oacute;n de Cambio de Clave</p></center></h3>
	
<?php	
	//$user=$_SESSION['Usuario'];
	//echo $user;
	require './funciones/funciones.inc.php';
	
		?>
		<?php	
		if ($clave != $clave_actual)
		{
		?>
			<script language=Javascript>
				window.alert('Su clave_actual es incorrecta');
				window.document.cambiar.clave_actual.focus();
			</script>
		<?php	
		}
?>	
<script>
	function cambiarclave(cambiar)//funcion para validar vacios................
	{
		// se asegurarse de que se ha introducido un nombre
		if(window.document.cambiar.clave_actual.value == "") {
		alert("Por favor introduzca la clave_actual..!");
		window.document.cambiar.clave_actual.focus();
		return false;
		}
		// se asegurarse de que se ha introducido un nombre
		if(window.document.cambiar.clave_nueva1.value == "") {
		alert("Por favor introduzca la clave_nueva!!!");
		window.document.cambiar.clave_nueva1.focus();
		return false;
		}
		// se asegurarse de que se ha introducido un apellido
		if(window.document.cambiar.clave_nueva2.value == "") {
		alert("Por favor Confirme su clave!!!");
		window.document.cambiar.clave_nueva2.focus();
		return false;
		}
		// se asegurarse de que se ha introducido un apellido
		var clave_nueva1=window.document.cambiar.clave_nueva1.value;
		var clave_nueva2=window.document.cambiar.clave_nueva2.value;
		if(clave_nueva1 != clave_nueva2) 
		{
		alert("Las claves nuevas no coiciden!!!");
		window.document.cambiar.clave_nueva1.focus();
		return false;
		}
	}
</script>
<br><br>  
<body onLoad="javascript:document.cambiar.usuario_nombre.focus()">
<center><form name=cambiar method="POST" action="principal.php?archivo=admon/cambiar.php" onsubmit="return cambiarclave(this);">
	<table border=0>
		<tr class="conta1">
			<td >
				Ingrese su contrase&ntilde;a actual:
			</td>
			<td>
				<input type="password" name="clave_actual" maxlength="15" />
			</td>
		</tr>
		<tr class="conta2">
			<td >Ingrese su nueva contrase&ntilde;a:</td>
			<td><input type="password" name="clave_nueva1" maxlength="15" /></td>
		</tr>
	   <tr class="conta2">
		<td >Confirme su nueva contrase&ntilde;a:</td>
		<td><input type="password" name="clave_nueva2" maxlength="15" /></td></tr>
	</table><br>
        <input type="hidden" name="idepersona" value="<?php echo $idepersona?>" />
        <input type="hidden" name="enviar" />
		<input type="submit" name="enviar" value="Cambiar Clave" />
        <input type="reset" value="Borrar" />
</form></center>
<?php
  //echo $user;
?> 