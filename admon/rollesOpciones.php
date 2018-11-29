<?php
/*
	Configuración a rolles para accesos a opciones del sistema de información
	Presenta el listado de todos los sistemas de información registrados en el administrador con todos los menús con sus correspondientes opciones, al frente de cada opción se presenta un cuadro de chequeo para marcar las opciones a las que el roll tiene acceso.
	Parámetros de entrada:
	$codroll=Código del roll que sirve para marcar las opciones a las que tiene acceso. Viene de rolles.php
	Autor: Galo Fabián Muñoz Espín
	Fecha de creación: 12-2010
	Ultima modificación: 
*/

	function colocarOpciones($cadenaSQL,$conexion,$codroll)
	{
		$registros=pg_query($conexion,$cadenaSQL);
		for ($k=0;$k<pg_num_rows($registros);$k++)
		{
			$codopcion=pg_result($registros,$k,'codigo');
			$opcion=pg_result($registros,$k,'opcion');
			$descripcion=pg_result($registros,$k,'descripcion');
			$cadenaSQL="select codigo from admon_rollesopciones where codroll=$codroll and codopcion=$codopcion";
			$consulta=pg_query($conexion,$cadenaSQL);
			if (pg_num_rows($consulta)>0) $seleccionado='checked=true';
			else $seleccionado='';
			echo '<tr>';
			echo "<td align=center><input type=checkbox name=codopcion_$codopcion $seleccionado></td>";
			echo "<td>$opcion</td>";
			echo "<td>$descripcion&nbsp</td>";
			echo "</tr>\n";
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
	include('funciones/conexion.inc.php');
	$codroll=$_GET['codroll'];
	$cadenaSQL="select roll, descripcion from admon_rolles where codigo=$codroll";
	$consulta=pg_query($conexion,$cadenaSQL);
	$roll=pg_result($consulta,0,'roll');
	$descripcion=pg_result($consulta,0,'descripcion');
?>
<div id="categorias">
<h3>GESTIÓN DE PERMISOS DE ROLL</h3>
</div>
<form name="rollesopciones" method="POST" action="principal.php?archivo=admon/rollesOpcionesActualizar.php&codroll=<?php echo $codroll;?>">
<div id='sistemarolles'>
<table border=0>
<TR><TD>Roll</TD><td><?php echo $roll;?></td></TR>
<TR><TD>Descripcion</TD><td><?php echo $descripcion;?></td></TR>
</table>
</div>
<?php
	$cadenaSQL='select * from admon_si';
	$consulta=pg_query($conexion,$cadenaSQL);
	for ($i=0;$i<pg_num_rows($consulta);$i++)
	{
		$codsi=pg_result($consulta,$i,'codigo');
		$si=pg_result($consulta,$i,'nombre');
		echo "<p><div id='sistemarolles'><b>Sistema de información:</b> $si</div>";
		$cadenaSQL="select codigo, opcion from admon_opciones where codsi=$codsi and ruta is null and padre is null";
		$consultaMenus=pg_query($conexion,$cadenaSQL);
		for ($j=0;$j<pg_num_rows($consultaMenus);$j++)
		{
			$codmenu=pg_result($consultaMenus,$j,'codigo');
			$menu=pg_result($consultaMenus,$j,'opcion');
			echo "<br><div id='sistemarolles'><b>Menú: <b/> $menu</div>";
			echo '<table border=0 class="tabla">';
			echo '<tr><th>Opción</th><th>Descripción</th><th>Accesos</th></tr>';
			$cadenaSQL="select codigo, opcion, descripcion from admon_opciones where padre=$codmenu";
			colocarOpciones($cadenaSQL,$conexion,$codroll);
			echo '</table>';
		}//del for para los menus
		echo "<br><b><div id='sistemarolles'>Opciones por fuera de los menús: <b/></div>";
		echo '<table border=0 class="tabla">';
		echo '<tr><th>Accesos</th><th>Opción</th><th>Descripción</th></tr>';
		$cadenaSQL="select codigo, opcion, descripcion from admon_opciones where padre is null and ruta is not null and codsi=$codsi";
		colocarOpciones($cadenaSQL,$conexion,$codroll);
		echo '</table>';
	}
?>
<p><p>
<div id="sistemarolles"><input type="submit" value=Actualizar></div>
</form>