<?php
/*
	Actualización de estado del reporte de errores y sugerencias de mejora
	Actualiza el estado de un reporte de error o sugerencia de mejrora en la base de datos.
	Parámetros de entrada:
	$accion=No viable, cambiar a desarrollo o atendido
	$codigo= Código del reporte de error o sugerencia de mejora
	Este procedimiento es llamado desde pqr.php
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
		case 'noViable':
			$estado='2';
			$fecha_respuesta=date('Y-m-d H:i:s');
			modificar('admon_registrospqr','estado, respuesta, fecha_respuesta'," where codigo='$codigo'",$conexion);
			break;
		case 'cambiarADesarrollo':
			$estado='3';
			modificar('admon_registrospqr','estado'," where codigo='$codigo'",$conexion);
			break;
		case 'cambiarAAtendido':
			$estado='4';
			$fecha_respuesta=date('Y-m-d H:i:s');
			modificar('admon_registrospqr','estado, respuesta, fecha_respuesta'," where codigo='$codigo'",$conexion);
			break;
	}
	pg_close($conexion);
	echo header("Location: principal.php?archivo=admon/pqr.php");
?>
