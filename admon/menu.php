<?php
	/*
	GENERACION DEL MENÚ
	Descripción: Presenta el menú para el usuario que ha ingresado al sistema de acuerdo al roll que este desempeña.
	Requerimiento: variable codroll
	Autor: Galo Fabian Muñoz Espín
	Fecha de creación: 01-12-2010
	Ultima modificación:
	*/
	session_start();
	if (!session_is_registered('Usuario'))
	{
?>
	<script language="Javascript">
		window.alert('Acceso no autorizado');
		window.location='index.php';
	</script>
<?php
	}
	require('funciones/conexion.inc.php');
	$codroll=$_SESSION['CodRoll'];
	//presentacion de los menus
	$cadenaSQL='select codigo, opcion, descripcion';
	$cadenaSQL.=' from admon_opciones';
	$cadenaSQL.=" where codigo in (select padre from admon_opciones, admon_rollesopciones where admon_opciones.codigo=admon_rollesopciones.codopcion and codroll=$codroll)";
	//echo $cadenaSQL;
	$menus=pg_query($conexion,$cadenaSQL);
	for ($i=0;$i<pg_num_rows($menus);$i++)
	{
		$Codigo=pg_result($menus,$i,'codigo');
		$Descripcion=pg_result($menus,$i,'descripcion');
		$Opcion=pg_result($menus,$i,'opcion');
		//echo "<li><a href=principal.php?archivo=$ruta title='$descripcion'>$opcion</a></li>";
		echo "<li><a href='#' class='menutrg'>$Opcion</a><ul>";
		//presentacion las opciones del menu
		$cadenaSQL='select opcion, descripcion, ruta';
		$cadenaSQL.=' from admon_opciones, admon_rollesopciones';
		$cadenaSQL.=' where admon_opciones.codigo = admon_rollesopciones.codopcion';
		$cadenaSQL.=" and padre=$Codigo and codroll=$codroll";
		$opciones=pg_query($conexion,$cadenaSQL);
		for ($j=0;$j<pg_num_rows($opciones);$j++)
		{
			$Ruta=pg_result($opciones,$j,'ruta');
			$Descripcion=pg_result($opciones,$j,'descripcion');
			$Opcion=pg_result($opciones,$j,'opcion');
			//echo "<li><a href=principal.php?archivo=$ruta title='$descripcion'>$opcion</a></li>";
			echo "<li><a href=principal.php?archivo=$Ruta>$Opcion</a></li>";
		}
		echo '</ul></li>';
	}
	//presentación de las opciones que están por fuera de los menus
	$cadenaSQL='select opcion, descripcion, ruta';
	$cadenaSQL.=' from admon_opciones, admon_rollesopciones';
	$cadenaSQL.=' where admon_opciones.codigo = admon_rollesopciones.codopcion';
	$cadenaSQL.=" and codroll=$codroll and padre is null";
	//echo $cadenaSQL;
	$consulta=pg_query($conexion,$cadenaSQL);
	for ($i=0;$i<pg_num_rows($consulta);$i++)
	{
		$Ruta=pg_result($consulta,$i,'ruta');
		$Descripcion=pg_result($consulta,$i,'descripcion');
		$Opcion=pg_result($consulta,$i,'opcion');
		//echo "<li><a href=principal.php?archivo=$ruta title='$descripcion'>$opcion</a></li>";
		echo "<li><a href=principal.php?archivo=$Ruta>$Opcion</a></li>";
	}
	pg_close($conexion);
?>