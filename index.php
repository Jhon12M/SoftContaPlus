<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
/*
	Formulario de inicio de sesión
	Autor: Galo Fabián Muñoz Espín
	Fecha de creación: 12-2010
	Ultima modificación: 
*/

	session_start();
	if (session_is_registered('Usuario'))
	{
		include('funciones/conexion.inc.php');
		include('funciones/funciones.inc.php');
		if ($_SESSION['NivelAuditoria']>0) registrarauditoria($conexion,$_SESSION['Usuario'],'7','','');
		pg_close($conexion);
		session_unset();
		session_destroy();
	}
?>
<html>
	<head><title>Inicio de sesión</title>
	<link href="presentacion/css/estilo2.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
<div id="wrapper">
	<div id="container">
	<div id="content">
	
		<div id="nuvearib">
		
		</div>
		
		
		<div id="inicio">
		Inicio de sesi&oacute;n
		
		</div>
		
		<div id="inicio2">
		
		<form name="iniciosesion" action="admon/validarsesion.php" method="POST">
		<table border=0>
			<tr><td></td></tr>
			<tr><th>Usuario</th><th><input type="text" name="usuario" maxlength="10" size=11></th>
			<th>Contrase&ntilde;a</th><th><input type="password" name="clave" size=11></th><th><input type="submit" value="Ingresar"></th></tr>
		</table>
		
		</form>
		</div>
		
		<div id="logo">
		<img src="./presentacion/imagenes/logo.jpg" height=130 width=120>
		</div>
		<div id="portada2">
		<embed src="./presentacion/imagenes/portada.swf" wmode="transparent" salign="RT" quality="autolow" bgcolor="#ffffff" allowscriptaccess="SameDomain" id="obj_flash" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" height="80" width="550" align="none">
		</div>
		
		<div id="letrasena">
		Servicio Nacional De Aprendizaje SENA
		</div>
		
		<div id="per">
		<img src="presentacion/imagenes/per2.jpg" height=320 width=310>
		</div>
		
		<div id="sena">
		<img src="presentacion/imagenes/sena.jpg" height=90 width=80>
		</div>
		
		<div id="cielobajo">
		
		</div>
		
		
	</div>

</div>
</div>
	</body>
</html>