<?php
/*
	DETALLES DE LA BITACORA DE AUDITORIA
	Presenta las acciones que se han realizado durante una sesión de un usuario en el sistema de información.
	Viene de auditoria.php y recibe como parámetros:
	$sesion: numero de la sesión en la variable $sesion pasada por get.
	
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
?>
<table>
<h3>SUCESOS DE LA SESIÓN</h3>
<table border="1">
<tr><TD>Código</TD><TD>Fecha y Hora</TD><TD>Usuario</TD><TD>Suceso</TD><TD>Novedad</TD><TD>Información anterior</TD></tr>
<?php
	include('funciones/conexion.inc.php');
	foreach($_GET as $variable => $valor) ${$variable}=$valor;
	$cadenaSQL="select codigo,fechahora, usuario, (case when (suceso='3') then 'Inserción' else ((case when (suceso='4') then 'Modificación' else ((case when (suceso='5') then 'Eliminación' else 'Consulta' end)) end)) end), detalle, registroanterior from admon_bitacoraauditoria where sesion='$sesion' and suceso in ('3','4','5','6') order by fechahora desc";
	$consulta=pg_query($conexion,$cadenaSQL);
	for ($i=0;$i<pg_num_rows($consulta);$i++)
	{
		echo '<tr>';
		for ($j=0;$j<pg_num_fields($consulta);$j++) echo '<td>' . pg_result($consulta,$i,$j) . '</td>';
		echo '</tr>';
	}
	pg_close($conexion);
?>
</table>
</center>