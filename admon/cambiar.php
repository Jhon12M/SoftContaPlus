<?php
	foreach($_POST as $variable => $valor) ${$variable}=$valor;
	foreach($_GET as $variable => $valor) ${$variable}=$valor;
	require ('./funciones/conexion.inc.php');
	//$clave=$clave1;
	//$clave=$clave2;
	//echo $idepersona;
	$clave=$clave_nueva2;
	$usuario=$_SESSION['Usuario'];
	$cadenaSQL='select nombres, apellidos, codroll';
	$cadenaSQL.=' from admon_personas, admon_usuarios';
	$cadenaSQL.=' where admon_personas.codigo=admon_usuarios.codpersona'; 
	$cadenaSQL.= " and usuario='$usuario' and clave=md5('$clave_actual') and activo=true";
	$consulta=pg_query($conexion,$cadenaSQL);
	//echo $cadenaSQL;
	if (pg_num_rows($consulta)==1)
	{
	//Si la clave actual del usuario coincide con la ingresada cambia de contraseña
	$cadena="update admon_usuarios set clave=md5('$clave') where usuario='$usuario'";
	//echo $cadena;
	pg_query($conexion,$cadena);
?>
	<script language=JavaScript> 
		alert('Su clave ha sido cambiada Satisfactoriamente!!!');
		window.location='principal.php?archivo=admon/bienvenido.php'; 
	</script>
<?php
	}
	else
	{
	//Si la clave actual del usuario no coincide con la ingresada muestra el mensaje de alerta
?>
	<script language=JavaScript> 
		alert('La Clave actual es incorrecta!!!');
		window.location='principal.php?archivo=admon/cambiarClave.php'; 
	</script>
<?php	
	}
?>
