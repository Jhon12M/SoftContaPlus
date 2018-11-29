<?php
/*
	Reporte de errores y sugerencias de mejora
	Presenta un listado de las sugerencias de mejora y errores reportados por los usuarios del sistema de información. En esta página es posible hacer los cambios de estados de por analizar a analizados viables o analizados no viables, de analizados viables a desarrollado.
	Autor: Galo Fabián Muñoz Espín
	Fecha de creación: 02-2011
	Ultima modificación: 03-03-2011 Actualización de comentarios
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
	function presentarInformacion($estado)
	{
		//Dependiendo del parámetro de entrada (estado) presenta la lista de errores y sugerencias de mejora en una tabla
		include('funciones/conexion.inc.php');
		$cadenaSQL='select codigo, fechahora, tipo, usuario, asunto, descripcion, so, navegador, fecha_respuesta, respuesta';
		$cadenaSQL.=' from admon_registrospqr';
		$cadenaSQL.=" where estado='$estado'";
		$cadenaSQL.=' order by tipo, fechahora, usuario';
		$consulta=pg_query($conexion,$cadenaSQL);
		for ($i=0; $i<pg_num_rows($consulta);$i++)
		{
			$codigo=pg_result($consulta,$i,'codigo');
			$fechahora=pg_result($consulta,$i,'fechahora');
			if(pg_result($consulta,$i,'tipo')=='C') $tipo='Corrección';
			else $tipo='Sugerencia';
			$usuario=pg_result($consulta,$i,'usuario');
			$asunto=pg_result($consulta,$i,'asunto');
			$descripcion=pg_result($consulta,$i,'descripcion');
			$so=pg_result($consulta,$i,'so');
			$navegador=pg_result($consulta,$i,'navegador');
			$fecha_respuesta=pg_result($consulta,$i,'fecha_respuesta');
			$respuesta=pg_result($consulta,$i,'respuesta');
			echo "<TR class='modo1' onMouseOver=this.style.backgroundColor='#CCFFFF'; onMouseOut=this.style.backgroundColor='#e2ebef'><TD>$codigo&nbsp;</TD><TD>$fechahora</TD><TD>$tipo&nbsp;</TD><TD>$usuario&nbsp;</TD><TD>$asunto&nbsp;</TD><TD>$descripcion&nbsp;</TD><TD>$so&nbsp;</TD><TD>$navegador&nbsp;</TD>";
			switch($estado)
			{
				case '1': //Por analizar: se presenta opciones de cambio de estado a analizado viable (En desarrollo) y analizado no viable
					echo "<td><a href='#' onClick=solicitarRespuesta($codigo,'noViable');> No Viable </a>&nbsp;&nbsp;&nbsp; <a href=principal.php?archivo=admon/pqrActualizar.php&accion=cambiarADesarrollo&codigo=$codigo>Viable</a></td>";	
					break;
				case '3': //En desarrollo: presenta opciones de cambio de estado a atendido o terminado
					echo "<td><a href='#' onClick=solicitarRespuesta($codigo,'cambiarAAtendido');> Atendido </a></td>"; 
					break;
				default: //2 y 4: Analizado no viable y atendido respectivamente. No se presentan ocpiones porque el proceso en estos estados es considerado como terminado
					echo "<td>$fecha_respuesta</td><td>$respuesta</td>"; 
					break;
			}
			echo '</tr>';
		}
		pg_close($conexion);
	}
?>
<script language="JavaScript">
	function solicitarRespuesta(codigo,accion)
	{
		//para los cambios de estados a analizado no viable o desarrollado se solicita la descripción u observaciones que justifican el cambio de estado
		respuesta=prompt('Escriba su respuesta para el cambio de estado');
		direccion='principal.php?archivo=admon/pqrActualizar.php&accion=' + accion + '&codigo=' + codigo +'&respuesta=' + respuesta;
		window.location=direccion;
	}
</script>

<div id="categorias"><h3>LISTA DE SUGERENCIAS DE MEJORA Y REPORTES DE ERRORES</h3></div>

<table border="0" class="tabla">
<tr><td>Por analizar</td></tr>
<TR><Th>Código</Th><Th>Fecha y hora</Th><Th>Tipo</Th><Th>Usuario</Th><Th>Asunto</Th><Th>Descripcion</Th><th>Sistema Operativo</th><th>Navegador</th><th>Opciones</th></TR>
<?php presentarInformacion('1'); ?>
</table>


<table border="0" class="tabla">
<tr><td>En desarrollo</td></tr>
<TR><Th>Código</Th><Th>Fecha y hora</Th><Th>Tipo</Th><Th>Usuario</Th><Th>Asunto</Th><Th>Descripcion</Th><th>Sistema Operativo</th><th>Navegador</th><th>Opciones</th></TR>
<?php presentarInformacion('3'); ?>
</table>

<table border="0" class="tabla">
<tr><td>Analizados no viables</td></tr>
<TR><Th>Código</Th><Th>Fecha y hora</Th><Th>Tipo</Th><Th>Usuario</Th><Th>Asunto</Th><Th>Descripcion</Th><th>Sistema Operativo</th><th>Navegador</th><th>Fecha analisis</th><th>Respuesta</th></TR>
<?php presentarInformacion('2'); ?>
</table>


<table border="0" class="tabla">
<tr><td>Atendidos</td></tr>
<TR><Th>Código</Th><Th>Fecha y hora</Th><Th>Tipo</Th><Th>Usuario</Th><Th>Asunto</Th><Th>Descripcion</Th><th>Sistema Operativo</th><th>Navegador</th><th>Fecha Atención</th><th>Respuesta</th></TR>
<?php presentarInformacion('4'); ?>
</table>
