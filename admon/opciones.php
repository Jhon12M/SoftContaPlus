<?php
	/*
	LISTA DE MENÚS Y OPCIONES DEL SISTEMA DE INFORMACIÓN
	Descripción: Presenta los menús de un sistema de información con sus correspondientes opciones.
	Requerimiento: variable codsistema 
	Autor: Galo Fabian Muñoz Espín
	Fecha de creación: 01-12-2010
	Ultima modificación:
	*/

	function imprimirOpciones($consulta,$codsistema)
	{
		for ($i=0;$i<pg_num_rows($consulta);$i++)
		{
			$codigo=pg_result($consulta,$i,'codigo');
			$opcion=pg_result($consulta,$i,'opcion');
			$descripcion=pg_result($consulta,$i,'descripcion');
			$ruta=pg_result($consulta,$i,'ruta');
			echo "<tr><td>$codigo</td><td>$opcion</td><td>$descripcion&nbsp;</td><td>$ruta</td><td><a href=principal.php?archivo=admon/opcionesFormulario.php&codigo=$codigo&codsistema=$codsistema&accion=Modificar>/</a> <a href=principal.php?archivo=admon/opcionesactualizar.php&codigo=$codigo&codsi=$codsistema&accion=Eliminar>X</a></td></tr>";
		}
	}
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
	$cadenaSQL="select nombre from admon_si where codigo=$codsistema";
	$consulta=pg_query($conexion,$cadenaSQL);
	$sistema=pg_result($consulta,0,'nombre');
?>
<center>
<h3><?php echo $sistema?></h3>
</center>
<?php
	//consulta de los menus
	$cadenaSQL="select codigo, opcion, descripcion from admon_opciones where ruta is null and codsi=$codsistema order by codigo";
	$consulta=pg_query($conexion,$cadenaSQL);
	for ($h=0;$h<pg_num_rows($consulta);$h++)
	{
		$codmenu=pg_result($consulta,$h,'codigo');
		$menu=pg_result($consulta,$h,'opcion');
		$descripcion=pg_result($consulta,$h,'descripcion');
		echo "<table class=tabla><tr><td>MENU: $menu <a href=principal.php?archivo=admon/menuFormulario.php&codigo=$codmenu&codsistema=$codsistema&accion=Modificar>/</a> <a href=principal.php?archivo=admon/opcionesactualizar.php&codigo=$codmenu&codsi=$codsistema&accion=Eliminar>X</a></td></tr></table>";
		$cadenaSQL='select codigo, opcion, descripcion, ruta';
		$cadenaSQL.=" from admon_opciones where ruta is not null and padre=$codmenu";
		$cadenaSQL.=" and codsi=$codsistema  order by codigo";
		$consulta=pg_query($conexion,$cadenaSQL);
		echo '<table border=0 class="tabla">';
		echo "<tr><th>Código</th><th>Opción</th><th>Descripción</th><th>Ruta</th><th><a href=principal.php?archivo=admon/opcionesFormulario.php&codsistema=$codsistema&padre=$codmenu&accion=Adicionar>+</a></th></tr>";
		imprimirOpciones($consulta,$codsistema);
		echo '</table>';

	}
	//opciones por fuera de los menus
	echo '<table class="tabla"><tr><td>Opciones por fuera de los menus</td></tr></table>';
	$cadenaSQL='select codigo, opcion, descripcion, ruta';
	$cadenaSQL.=' from admon_opciones where ruta is not null and padre is null';
	$cadenaSQL.=" and codsi=$codsistema  order by codigo";
	$consulta=pg_query($conexion,$cadenaSQL);
	echo '<table border=0 class="tabla">';
	echo "<tr><th>Código</th><th>Opción</th><th>Descripción</th><th>Ruta</th><th><a href=principal.php?archivo=admon/opcionesFormulario.php&codsistema=$codsistema&accion=Adicionar>+</a></th></tr>";
	imprimirOpciones($consulta,$codsistema);
	echo '</table>';
	pg_close($conexion);
	echo "<table class=tabla><tr><td><a href=principal.php?archivo=admon/menuFormulario.php&codsistema=$codsistema&accion=Adicionar>Adicionar menu</a></td></tr></table>";
?>
