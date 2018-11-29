<?php
/*
	Listado de los usuarios registrados en el administrador de sistemas de información
	Presenta un listado de los usuarios registrados en el administrador de sistemas de información con la posibilidad de adicionar, modificar, eliminar. Estas acciones modifican las tablas admon_personas y admon_usuarios
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
<h3>USUARIOS</h3>
</div>


<table border="0" class="tabla">
<tr><th>Identificación</th><th>Nombres</th><th>Apellidos</th><th>Correo electrónico</th><th><center>Roll</center></th><th>Usuario</th><th>Activo</th><th><a href=principal.php?archivo=admon/usuariosFormulario.php&accion=Adicionar>+</a></th></tr>
<?php
	include('funciones/conexion.inc.php');
	$cadenaSQL='select admon_personas.codigo, numide, nombres, apellidos, email, roll, usuario, activo';
	$cadenaSQL.=' from admon_personas, admon_usuarios, admon_rolles';
	$cadenaSQL.=' where admon_personas.codigo=admon_usuarios.codpersona';
	$cadenaSQL.=' and admon_usuarios.codroll=admon_rolles.codigo';
	$cadenaSQL.=' order by roll, apellidos, nombres';
	$consulta=pg_query($conexion,$cadenaSQL);
	for ($i=0; $i<pg_num_rows($consulta);$i++)
	{
		$codpersona=pg_result($consulta,$i,'codigo');
		$numide=pg_result($consulta,$i,'numide');
		$nombres=pg_result($consulta,$i,'nombres');
		$apellidos=pg_result($consulta,$i,'apellidos');
		$email=pg_result($consulta,$i,'email');
		$roll=pg_result($consulta,$i,'roll');
		$usuario=pg_result($consulta,$i,'usuario');
		if(pg_result($consulta,$i,'activo')=='t') $activo='SI';
		else $activo='NO';
		echo "<TR class='modo1' onMouseOver=this.style.backgroundColor='#CCFFFF'; onMouseOut=this.style.backgroundColor='#e2ebef'><td>$numide&nbsp;</td><TD>$nombres</TD><TD>$apellidos&nbsp;</TD><TD>$email&nbsp;</TD><TD>$roll&nbsp;</TD><TD>$usuario&nbsp;</TD><TD>$activo&nbsp;</TD><td><a href=principal.php?archivo=admon/usuariosFormulario.php&accion=Modificar&codpersona=$codpersona> / </a> <a href=principal.php?archivo=admon/usuariosActualizar.php&accion=Inactivar&codpersona=$codpersona>I</a></td></TR>";	
	}
	pg_close($conexion);
?>
</table>



