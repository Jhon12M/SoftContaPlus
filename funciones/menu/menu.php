<div id="sidebar">
<ul id="menunav">
<?php
include('admon/conexion.inc.php');
//generacion del menu
//consulta de los menús
$codroll=$_SESSION['CodRoll'];

//opciones por fuera de los menus
$cadena="select codigo, nombre, descripcion,ruta
	from admon_opciones, admon_accesossi
	where codigo=codopcion
	and ruta is not null
	and padre is null
	and codroll='$codroll'
	order by codigo";
$resultado=mysql_query($cadena);
for ($i=0;$i<mysql_num_rows($resultado);$i++)
{
	$codigo=mysql_result($resultado,$i,'codigo');
	$ruta=mysql_result($resultado,$i,'ruta');
	$nombre=mysql_result($resultado,$i,'nombre');
	$descripcion=mysql_result($resultado,$i,'descripcion');
	echo "<li><a href='admon.php?Archivo=$ruta' title='$descripcion'>$nombre</a></li>";
}


$cadena="select codigo, nombre, descripcion
from admon_opciones
where ruta is null
and padre is null
and codigo in (
  select padre
  from admon_opciones,admon_accesossi
  where codigo=codopcion
  and codroll='$codroll')
order by nombre desc";
//echo $cadena;
$menus=mysql_query($cadena);
for ($h=0;$h<mysql_num_rows($menus);$h++)
{
	$codmenu=mysql_result($menus,$h,'codigo');
	$nombre=mysql_result($menus,$h,'nombre');
	$descripcion=mysql_result($menus,$h,'descripcion');
	echo "<li><a href='#' class='menutrg' title='$descripcion'>$nombre</a>";
	//opciones del menu
	$cadena="select codigo, nombre, descripcion,ruta
	from admon_opciones, admon_accesossi
	where codigo=codopcion
	and padre='$codmenu'
	and codroll='$codroll'
	order by codigo";
	//echo $cadena;
	$resultado=mysql_query($cadena);
	echo '<ul>';
	for ($i=0;$i<mysql_num_rows($resultado);$i++)
	{
		$codigo=mysql_result($resultado,$i,'codigo');
		$ruta=mysql_result($resultado,$i,'ruta');
		$nombre=mysql_result($resultado,$i,'nombre');
		$descripcion=mysql_result($resultado,$i,'descripcion');
		echo "<li><a href='admon.php?Archivo=$ruta' title='$descripcion'>$nombre</a></li>";
	}	
	echo '</ul>';
}//de la presentacion de los menus


mysql_close($conexion);
?>
<li><a href="index.php">Salir</a></li>
</ul>
</div>