<?php
/*
	Actualización de sistemas de información
	Permite actualizar la información de los sistemas de información en la base de datos. 
	Parámetros de entrada:
	$codsi= Código del sistema de información requerido cuando se va a  modificar
	Autor: Galo Fabián Muñoz Espín
	Fecha de creación: 12-2010
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
	foreach($_POST as $variable => $valor) ${$variable}=$valor;//recupera variables enviadas por post
	foreach($_GET as $variable => $valor) ${$variable}=$valor;//recupera variables enviadas por get
	include('funciones/conexion.inc.php');
	include('funciones/funciones.inc.php');
	switch($accion)
	{
		case 'Adicionar':
			$codigo=consecutivo('admon_si','codigo',$conexion);
			adicionar('admon_si','codigo',$conexion);
			break;
		case 'Modificar':
			modificar('admon_si','nombre, descripcion, version, codnivelauditoria, css'," where codigo='$codigo'",$conexion);
			break;
		case 'Eliminar':
			eliminar('admon_si'," where codigo='$codigo'",$conexion);
			break;
	}
	pg_close($conexion);
	echo header('Location: principal.php?archivo=admon/si.php');
?>
