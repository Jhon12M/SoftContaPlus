<?php
/*
	Formulario de registro de rolles
	Presenta un formulario para el registro o modificación de rolles:
	$accion=Adicionar, Modificar
	$codigo: requerido cuando acción=Modificar y contiene el código del roll a modificar
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
	foreach($_GET as $variable => $valor) ${$variable}=$valor;
	if ($accion=='Modificar')
	{
		include('funciones/conexion.inc.php');
		$cadenaSQL="select roll, descripcion from admon_rolles where codigo=$codigo";
		$consulta=pg_query($conexion,$cadenaSQL);
		$roll=pg_result($consulta,0,'roll');
		$descripcion=pg_result($consulta,0,'descripcion');
		pg_close($conexion);
	}
	else
	{
		$roll='';
		$descripcion='';
	}
?>
<script language=javascript>
	function validar()
	{
		if (validarNoVacio(window.document.rolles.roll,"el nombre del rol")) window.document.rolles.submit();
	}
</script>
<center>
<h3>ADICIÓN DE ROLLES</h3>
<FORM name="rolles" method="POST" action="principal.php?archivo=admon/rollesActualizar.php">
<table border="0">
<?php
	if ($accion=='Modificar') echo "<TR><TD>Codigo</TD><TD><input type=text name=codigo value=$codigo readonly=yes></TD></TR>";
?>
<TR><TD>Roll (*)</TD><TD><input type="text" name=roll maxlength="100" size="50" value="<?php echo $roll;?>"></TD></TR>
<TR><TD colspan="2">Descripción<br><textarea name="descripcion" cols=60 rows=3><?php echo $descripcion;?></textarea></TD></TR>
</table>
<input type=hidden name=accion value="<?php echo $accion?>">
<input type=button name=accion value="<?php echo $accion?>" onclick="validar();">
</FORM>
</center>