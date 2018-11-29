<?php
/*
	Listado de sistemas de información
	Presenta un listado de los sistemas de información registrados en el administrador de sistemas de información con la posibilidad de adicionar, modificar, eliminar y configurar los menús para cada sistema
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
?>

<div id="categorias"><h3>LISTA DE SISTEMAS DE INFORMACION | <a href="principal.php?archivo=admon/siformulario.php&accion=Adicionar">Adicionar</a></h3></div>

<table border="0" class="tabla">
<tr><th>Código</th><th><center>Nombre</center></td><TH><center>Descripción</center></TH><TH>Versión</TH><TH>Nivel de Auditoria</TH><TH>Hoja de Estilo</TH></tr>
<?php
	include('funciones/conexion.inc.php');
	$cadenaSQL='select * from admon_si order by codigo';
	$consulta=pg_query($conexion,$cadenaSQL);
	for ($i=0;$i<pg_num_rows($consulta);$i++)
	{
		$codigo=pg_result($consulta,$i,'codigo');
		$nombre=pg_result($consulta,$i,'nombre');
		$descripcion=pg_result($consulta,$i,'descripcion');
		$version=pg_result($consulta,$i,'version');
		$nivelauditoria=pg_result($consulta,$i,'codnivelauditoria');
		switch($nivelauditoria)
		{
			case '0': $nivelauditoria='Sin auditoria';break;
			case '1': $nivelauditoria='Bajo';break;
			case '2': $nivelauditoria='Medio';break;
			case '3': $nivelauditoria='Alto';break;
			default: $nivelauditoria='Indeterminado';break;
		}
		$css=pg_result($consulta,$i,'css');
		echo "<tr class='modo1' onMouseOver=this.style.backgroundColor='#CCFFFF'; onMouseOut=this.style.backgroundColor='#e2ebef'><td>$codigo&nbsp;</td><td>$nombre&nbsp;</td><td>$descripcion&nbsp;</td><td>$version&nbsp;</td><td>$nivelauditoria&nbsp;</td><td>$css&nbsp;</td><td><a href=principal.php?archivo=admon/siformulario.php&accion=Modificar&codigo=$codigo>M</a></td><td> <a href=principal.php?archivo=admon/siactualizar.php&accion=Eliminar&codigo=$codigo>X</a></td><td> <a href=principal.php?archivo=admon/opciones.php&codsistema=$codigo>M</a></td></tr>";
	}
	pg_close($conexion);
?>
</table>
