<?php
/*
	Actualización de usuarios
	Permite actualizar la información de los usuarios de los diferentes sistemas de información en la base de datos. 
	Parámetros de entrada:
	$accion: Adicionar, Modificar, Inactivar
	$usuario= Nombre del usuario requerido cuando se va a  modificar
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
	foreach($_POST as $variable => $valor) ${$variable}=$valor;
	foreach($_GET as $variable => $valor) ${$variable}=$valor;
	include('funciones/conexion.inc.php');
	include('funciones/funciones.inc.php');
	switch($accion)
	{
		case 'Adicionar':
			$codigo=consecutivo('admon_personas','codigo',$conexion);
			adicionar('admon_personas','codigo',$conexion);
			if (isset($activo)) $activo='true';
			else $activo='false';
			$clave=md5($clave);
			$codpersona=$codigo;
			adicionar('admon_usuarios','usuario',$conexion);
			break;
		case 'Modificar':
			modificar('admon_personas','numide, nombres, apellidos, email, movil, fecha_nacimiento'," where codigo='$codigo'",$conexion);
			if (isset($activo)) $activo='true';
			else $activo='false';
			if (strlen($clave)>10) modificar('admon_usuarios','codroll, activo'," where usuario='$usuario'",$conexion);
			else 
			{
				$clave=md5($clave);
				modificar('admon_usuarios','clave, codroll, activo'," where usuario='$usuario'",$conexion);
			}
			pg_query($conexion,$cadenaSQL);
			break;
		case 'Inactivar':
			$activo='false';
			modificar('admon_usuarios','activo'," where usuario='$usuario'",$conexion);
			break;
	}
	pg_close($conexion);
	echo header("Location: principal.php?archivo=admon/usuarios.php");
?>
