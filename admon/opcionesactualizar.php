<?php
/*
	Actualización de menus y opciones de menu
	Permite actualizar la información de menús y opciones de menu en la base de datos..
	Para adicionar y modificar viene de menuFormulario.php u opcionesFormulario y para eliminar viene de opciones.php. 
	Parámetros de entrada:
	$accion=Adicionar, Mofificar o Eliminar de acuerdo a lo que se quiere que haga este archivo. El método de envío puede ser post o get.
	$codigo= Código del menú u opción que se va a modificar o eliminar
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
			$codigo=consecutivo('admon_opciones','codigo',$conexion);
			adicionar('admon_opciones','codigo',$conexion);
			/*$cadenaSQL='insert into admon_opciones';
			$cadenaSQL.=' (codigo, opcion, descripcion, ruta, padre, codsi)';
			$cadenaSQL.=" values ($codigo, '$opcion', '$descripcion', '$ruta', $padre, '$codsi')";
			//echo $cadenaSQL;
			pg_query($conexion,$cadenaSQL);*/
			break;
		case 'Modificar':
			if ($padre!='') modificar('admon_opciones','opcion, descripcion, ruta, padre'," where codigo='$codigo'",$conexion);
			else modificar('admon_opciones','opcion, descripcion, ruta'," where codigo='$codigo'",$conexion);
			/*$cadenaSQL='update admon_opciones';
			$cadenaSQL.=" set opcion='$opcion', descripcion='$descripcion', ruta='$ruta', padre=$padre";
			$cadenaSQL.=" where codigo='$codigo'";
			//echo $cadenaSQL;
			pg_query($conexion,$cadenaSQL);*/
			break;
		case 'Eliminar':
			eliminar('admon_opciones'," where codigo='$codigo'",$conexion);
			/*$cadenaSQL="delete from admon_opciones where codigo=$codigo";
			echo $cadenaSQL;
			pg_query($conexion,$cadenaSQL);*/
			//echo "archivo borrado";
			break;
		case 'Adicionar_Menu':
			$codigo=consecutivo('admon_opciones','codigo',$conexion);
			/*$cadenaSQL='select max(codigo) as codigo from admon_opciones';
			$consulta=pg_query($conexion,$cadenaSQL);
			if (pg_result($consulta,0,'codigo')==0) $codigo=1;
			else $codigo=pg_result($consulta,0,'codigo')+1;*/
			adicionar('admon_opciones','codigo',$conexion);
			/*$cadenaSQL='insert into admon_opciones';
			$cadenaSQL.=' (codigo, opcion, descripcion, codsi)';
			$cadenaSQL.=" values ($codigo, '$opcion', '$descripcion', '$codsi')";
			//echo $cadenaSQL;
			pg_query($conexion,$cadenaSQL);*/
			break;
		case 'Modificar_Menu':
			modificar('admon_opciones','opcion, descripcion'," where codigo='$codigo'",$conexion);
			/*$cadenaSQL='update admon_opciones';
			$cadenaSQL.=" set opcion='$opcion', descripcion='$descripcion'";
			$cadenaSQL.=" where codigo='$codigo'";
			//echo $cadenaSQL;
			pg_query($conexion,$cadenaSQL);*/
			break;
	}
	pg_close($conexion);
	echo header("Location: principal.php?archivo=admon/opciones.php&codsistema=$codsi");
?>
