<?php
/*
	Actualización de rolles
	Permite actualizar la información de rolles  en la base de datos..
	Para adicionar y modificar viene de rollesFormulario.php y para eliminar viene de rolles.php. 
	Parámetros de entrada:
	$accion=Adicionar, Mofificar o Eliminar de acuerdo a lo que se quiere que haga este archivo. El método de envío puede ser post o get.
	$codigo= Código del roll que se va a modificar o eliminar
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
			$codigo=consecutivo('admon_rolles','codigo',$conexion);
			/*$cadenaSQL='select max(codigo) as codigo from admon_rolles';
			$consulta=pg_query($conexion,$cadenaSQL);
			$codigo=pg_result($consulta,0,'codigo')+1;*/
			adicionar('admon_rolles','codigo',$conexion);
			/*$cadenaSQL='insert into admon_rolles (codigo, roll, descripcion)';
			$cadenaSQL.=" values ($codigo,'$roll','$descripcion')";
			//echo $cadenaSQL;
			pg_query($conexion,$cadenaSQL);*/
			break;
		case 'Modificar':
			modificar('admon_rolles','roll, descripcion'," where codigo='$codigo'",$conexion);
			/*$cadenaSQL="update admon_rolles set roll='$roll', descripcion='$descripcion' where codigo=$codigo";
			//echo $cadenaSQL;
			pg_query($conexion,$cadenaSQL);*/
			break;
		case 'Eliminar':
			eliminar('admon_rolles'," where codigo='$codigo'",$conexion);
			/*$cadenaSQL="delete from admon_rolles where codigo=$codigo";
			//echo $cadenaSQL;
			pg_query($conexion,$cadenaSQL);*/
			break;
	}
	pg_close($conexion);
	echo header("Location: principal.php?archivo=admon/rolles.php");
?>
