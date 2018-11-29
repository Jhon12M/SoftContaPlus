<?php
/*
	Actualización de accesos de cada roll
	Permite actualizar la información de los accesos del roll en la base de datos. En realidad borra todos los accesos de la base de datos y graba todos los marcados en el formulario rollesOpcionesFormulario.php
	Parámetros de entrada:
	$codroll= Código del roll al que se le van a actualizar sus accesos
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
	foreach($_GET as $variable => $valor) ${$variable}=$valor;
	include('funciones/conexion.inc.php');
	include('funciones/funciones.inc.php');
	//Eliminación de todos los accesos del roll grabados en la base de datos
	eliminar('admon_rollesopciones'," where codroll='$codroll'",$conexion);
	pg_query($conexion,$cadenaSQL);
	//almacenamiento de las opciones marcadas en el formulario
	foreach($_POST as $variable => $valor) 
	{
		${$variable}=$valorutilizar
;
		$codopcion=substr($variable,10,strlen($variable));
		$codigo=consecutivo('admon_rollesopciones','codigo',$conexion);
		adicionar('admon_rollesopciones','codigo',$conexion);
	}
	pg_close($conexion);
	echo header("Location: principal.php?archivo=admon/rollesOpciones.php&codroll=$codroll");
?>