<?php
/*
	REPORTE INDICADOR DE CORRECCIONES Y SUGERENCIAS DE MEJORA
	Presenta la cantidad de correcciones y sugerencias de mejora presentadas por los usuarios del sistemas de información.
	Autor: Galo Fabián Muñoz Espín
	Fecha de creación: 02-2011
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
	include('funciones/conexion.inc.php');
	$cadenaSQL="select case when tipo='C' then 'Correcciones' else 'Sugerencia' end, count(*) as cantidad from admon_registrospqr group by tipo order by tipo";
	$consulta=pg_query($conexion,$cadenaSQL);
?>
<table>
<h3>INDICADOR DE CORRECCIONES Y SUGERENCIAS DE MEJORA</h3>
<table border="1">
<tr><TD>Tipo</TD><TD>Cantidad</TD></tr>
<?php
	for ($i=0;$i<pg_num_rows($consulta);$i++)
	{
		echo '<tr>';
		for ($j=0;$j<pg_num_fields($consulta);$j++) 
		{
			echo '<td>' . pg_result($consulta,$i,$j) . '</td>';
		}
		if ($i==0) $datos=pg_result($consulta,$i,'cantidad');
		else $datos.=',' . pg_result($consulta,$i,'cantidad');
		echo '</tr>';
	}
	pg_close($conexion);
?>
</table>
<img src="funciones/graphpico/graphbarras.php?dat=<?php echo $datos;?>">
</center>