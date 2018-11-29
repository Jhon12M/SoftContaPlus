<?php
/*
	Actualización del registro de empresas
	Permite actualizar la información de empresas en la base de datos..
	Para adicionar y modificar viene de empresasFormulario.php y para eliminar viene de empresas.php. 
	Parámetros de entrada:
	$accion=Adicionar, Mofificar o Eliminar de acuerdo a lo que se quiere que haga este archivo. El método de envío puede ser post o get.
	$nit= nit de la empresa que se va a adicionar, modificar o eliminar
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
	include('funciones/conexion.inc.php');
	include('funciones/funciones.inc.php');
	switch($accion)
	{
		case 'Adicionar':
			adicionar('admon_empresas','nit',$conexion);
			break;
		case 'Modificar':
			modificar('admon_empresas','nit, razonsocial, direccion, telefono, email, url'," where nit='$nitanterior'",$conexion);
			break;
		case 'Eliminar':
			eliminar('admon_empresas'," where nit='$nit'",$conexion);
			break;
	}
	pg_close($conexion);
	echo header("Location: principal.php?archivo=admon/empresas.php");
?>
