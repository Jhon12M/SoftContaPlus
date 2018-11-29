<?php
/*
	Almacenamiento en bd de un reporte de error o sugerencia de mejora
	Almacena un reporte de error o sugerencia de mejora en la base de datos
	Parámetros de entrada:
	$accion=Adicionar
	Autor: Galo Fabián Muñoz Espín
	Fecha de creación: 02-2011
	Ultima modificación: 
*/

	if (!session_is_registered('Usuario'))
	{
?>
	<script language="Javascript">
		window.alert('Acceso no autorizado');
		window.location='index.php';
	</script>
<?php
	}
	foreach($_POST as $variable => $valor) ${$variable}=$valor;
	foreach($_GET as $variable => $valor) ${$variable}=$valor;
	include('funciones/conexion.inc.php');
	include('funciones/funciones.inc.php');
	switch($accion)
	{
		case 'Adicionar':
			$estado='1';
			$usuario=$_SESSION['Usuario'];
			//echo $_SERVER['HTTP_USER_AGENT'] . "<p>";
			$navegador=explode(' ',$_SERVER['HTTP_USER_AGENT']);
			$so=$navegador[8];
			$navegador=$navegador[9];
			$codigo=consecutivo('admon_registrospqr','codigo',$conexion);
			adicionar('admon_registrospqr','codigo',$conexion);
			echo "<script language=javascript>alert('Su petición ha sido grabada con el código $codigo')</script>";
			break;
		case 'Modificar':
			/*$cadenaSQL="update admon_personas set numide='$numide', nombres='$nombres', apellidos='$apellidos', email='$email', movil='$movil', fecha_nacimiento='$fecha_nacimiento' where codigo=$codigo";
			//echo $cadenaSQL;
			pg_query($conexion,$cadenaSQL);
			if (isset($activo)) $activo='true';
			else $activo='false';
			if (strlen($clave)>10) $cadenaSQL="update admon_usuarios set codroll=$codroll, activo=$activo where usuario='$usuario'";
			else $cadenaSQL="update admon_usuarios set clave=md5('$clave'), codroll=$codroll, activo=$activo where usuario='$usuario'";
			//echo $cadenaSQL;
			pg_query($conexion,$cadenaSQL);*/
			break;
		case 'Inactivar':
			/*$cadenaSQL="update admon_usuarios set activo=false where codpersona=$codpersona";
			//echo $cadenaSQL;
			pg_query($conexion,$cadenaSQL);*/
			break;
	}
	pg_close($conexion);
	echo header("Location: principal.php?archivo=$rutaarchivo");
?>
