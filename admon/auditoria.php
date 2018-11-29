<?php
/*
	INICIOS DE SESIÓN
	Este programa presenta la lista de los inicios de sesión que se han intentado realizar sobre el sistema de información precisando si el resultado del inicio es exitoso o fallido, también informa la duración de la sesión y el nombre del usuario que intentó acceder.
	Desde este listado se puede acceder a ver las acciones que se hicieron sobre el S.I. en cada sesión (cuando la configuración de auditoria iguala o supera el nivel 2).
	Autor: Galo Fabián Muñoz Espín.
	Recibe como parámetro la variable $registrosaAPresentar que se encuentra en conexion.inc.php y define el número de items que se van a presentar en cada página
	Fecha de creación: 02-2011
	Ultima modificación: 01-03-2011: adición de comentarios
	
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
	foreach($_POST as $variable => $valorVariable) ${$variable}=$valorVariable;//recuperación de variables
	if (!isset($valor)) $valor=''; //se inicializa el valor de búsqueda para que la primera vez no genere errores
	//para paginación de los resultados
	if (!isset($pagina) or ($pagina=='')) $pagina=1;//número de página
	$inicio=($pagina-1)*$registrosAPresentar;//Numero del registro que inicialmente se presenta
	$final=$pagina*$registrosAPresentar-1;
	include('funciones/conexion.inc.php');
	$cadenaSQL="select codigo,fechahora, usuario, (case when (suceso='1') then 'Exito' else 'Fallido' end) as resultado from admon_bitacoraauditoria where (suceso='1' or suceso='2')";
	$criterioUsuario='';
	$criterioFecha='';
	switch(@$criterio)
	{
		case 'usuario':
			$cadenaSQL.=" and usuario like '%$valor%'";
			$criterioUsuario='checked';
			break;
		case 'fecha':
			$cadenaSQL.=" and to_char(fechahora,'YYYY-MM-DD') like '%$valor%'";
			$criterioFecha='checked';
			break;
	}
	//cálculo del número de páginas que se generan
	$consulta=pg_query($conexion,$cadenaSQL);
	$registros=pg_num_rows($consulta);
	$paginas=ceil($registros/$registrosAPresentar);
?>
<script language="JavaScript">
		function enviar(pagina)
		{
			//alert(pagina);
;			window.document.buscar.pagina.value=pagina;
			window.document.buscar.submit();
		}
</script>
<div id="categorias">
<h3>INICIOS DE SESIÓN</h3>
</div>
	
	<div id="buscador">
	<form name=buscar method="POST">
		<table border=0>
			<tr>
				<th><input type=radio name=criterio value=usuario <?php echo $criterioUsuario;?>></th><th>Usuario</th>
					<th><input type=radio name=criterio value=fecha <?php echo $criterioFecha;?>></th><th>Fecha</th>
				<th><input type="text" name=valor value="<?php echo $valor;?>"></th>
					<th><input type=hidden name=pagina value="">
					<input type="submit" value=Buscar></th>
			</tr>
		</table>
	</form>
	</div>
	<div id="paginado">
	<?php
		echo "Pagina $pagina de $paginas<p>";
		$paginaAnterior=$pagina-1;
		$paginaSiguiente=$pagina+1;
		if ($pagina>1) echo "<a href=# onClick=enviar(1);><<</a> <a href=# onClick=enviar($paginaAnterior);><</a>";
		if ($pagina < $paginas) echo "<a href=# onClick=enviar($paginaSiguiente );>></a> <a href=# onClick=enviar($paginas);>>></a>";
	?>
	</div>

<table border="0" class="tabla">
<tr><th>Fecha y Hora</th><th>Usuario</th><th>Resultado</th><th>Finalización</th><th>Duración</th></tr>
<?php
	$cadenaSQL.=" order by fechahora desc limit $registrosAPresentar offset $inicio";
	//echo $cadenaSQL;
	$consulta=pg_query($conexion,$cadenaSQL);
	for ($i=0;$i<pg_num_rows($consulta);$i++)
	{
		echo "<tr class='modo1' onMouseOver=this.style.backgroundColor='#CCFFFF'; onMouseOut=this.style.backgroundColor='#e2ebef'>";
		for ($j=1;$j<pg_num_fields($consulta);$j++) echo '<td>' . pg_result($consulta,$i,$j) . '</td>';
		$codigo=pg_result($consulta,$i,'codigo');
		$resultado=pg_result($consulta,$i,'resultado');
		$inicio=pg_result($consulta,$i,'fechahora');
		if ($resultado=='Fallido') echo '<td align=center>N/A</td><td align=center>N/A</td>';
		else
		{
			$cadenaSQL="select fechahora from admon_bitacoraauditoria where suceso='7' and sesion='$codigo'";
			$registro=pg_query($conexion,$cadenaSQL);
			if (pg_num_rows($registro)==0) echo '<td>Indeterminado</td><td>Indeterminado</td>';
			else 
			{
				$fin=pg_result($registro,0,0);
				$marcaInicio=mktime(substr($inicio,11,2), substr($inicio,14,2), substr($inicio,17,2), substr($inicio,5,2), substr($inicio,8,2), substr($inicio,0,4));
				$marcaFin=mktime(substr($fin,11,2), substr($fin,14,2), substr($fin,17,2), substr($fin,5,2), substr($fin,8,2), substr($fin,0,4));
				$duracion=$marcaFin-$marcaInicio;
				$duracion=gmdate('H:i:s',$duracion);
				echo "<td>$fin</td><td>$duracion</td>";
			}
		}
		if ($resultado!='Fallido') echo "<td><a href=principal.php?archivo=admon/auditoriaDetalles.php&sesion=$codigo>V</a></td>"; 
		echo '</tr>';
	}
	pg_close($conexion);
?>
</table>
