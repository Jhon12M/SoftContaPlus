<?php
/*
	Listado de rolles
	Presenta un listado de los rolles configurados en el sistema de información con la posibilidad de adicionar, modificar, eliminar y configurar los accesos que tiene derecho cada roll
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
<div id="categorias">
<h3>ROLLES</h3>
</div>
<table border="0" class="tabla">
<TR><Th>Código</Th><Th>Roll</Th><Th>Descripción</Th><th><a href=principal.php?archivo=admon/rollesFormulario.php&accion=Adicionar>+</a></th></TR>
<?php
	include('funciones/conexion.inc.php');
	$cadenaSQL='select * from admon_rolles order by codigo';
	$consulta=pg_query($conexion,$cadenaSQL);
	for ($i=0; $i<pg_num_rows($consulta);$i++)
	{
		$codigo=pg_result($consulta,$i,'codigo');
		$roll=pg_result($consulta,$i,'roll');
		$descripcion=pg_result($consulta,$i,'descripcion');
		echo "<TR  class='modo1' onMouseOver=this.style.backgroundColor='#CCFFFF'; onMouseOut=this.style.backgroundColor='#e2ebef'><td>$codigo</td><TD>$roll</TD><TD>$descripcion&nbsp;</TD><td><a href=principal.php?archivo=admon/rollesFormulario.php&accion=Modificar&codigo=$codigo> / </a> <a href=principal.php?archivo=admon/rollesActualizar.php&accion=Eliminar&codigo=$codigo>X</a> <a href=principal.php?archivo=admon/rollesOpciones.php&codroll=$codigo>P</a></td></TR>";	
	}
	pg_close($conexion);
?>
</table>
