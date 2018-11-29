<?php
/*
	Formulario de registro de errores o sugerencias de mejora del software
	Permite reportar un error o una sugerencia de mejora sobre el software, esto es reportado al administrador del sistema para que a traves de pqr.php le realice el proceso correspondiente.
	Parámetros de entrada:
	$accion=Adicionar
	$rutaarchivo= Ruta del archivo desde donde se reporta el error o sugerencia de mejora del software que se supone que es el archivo que hay que corregir o mejorar.
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
	foreach($_GET as $variable => $valor) ${$variable}=$valor;
	include('funciones/conexion.inc.php');
	/*if ($accion=='Modificar')
	{
		$cadenaSQL="select numide, nombres, apellidos, email, fecha_nacimiento, movil, usuario, clave, codroll, activo from admon_personas, admon_usuarios where admon_personas.codigo=admon_usuarios.codpersona and codpersona=$codpersona";
		$consulta=pg_query($conexion,$cadenaSQL);
		$numide=pg_result($consulta,0,'numide');
		$nombres=pg_result($consulta,0,'nombres');
		$apellidos=pg_result($consulta,0,'apellidos');
		$email=pg_result($consulta,0,'email');
		$fecha_nacimiento=pg_result($consulta,0,'fecha_nacimiento');
		$movil=pg_result($consulta,0,'movil');
		$usuario=pg_result($consulta,0,'usuario');
		$clave=pg_result($consulta,0,'clave');
		$codroll=pg_result($consulta,0,'codroll');
		if (pg_result($consulta,0,'activo')) $activo='checked=true';
		$activo='';
	}
	else
	{
		$numide='';
		$nombres='';
		$apellidos='';
		$email='';
		$fecha_nacimiento='';
		$movil='';
		$usuario='';
		$clave='';
		$codroll='';
		$activo=' checked=true';
	}
	$listarolles=llenarlista($conexion,'roll','codigo',$codroll,'admon_rolles','');
	pg_close($conexion);	*/
?>
<script language=javascript>
	function validar()
	{
		if (validarNoVacio(window.document.registropqr.asunto,"el asunto") && validarNoVacio(window.document.registropqr.descripcion,"la descripción")) window.document.registropqr.submit();
	}
</script>
<center>
<h3>REPORTE DE SUGERENCIA DE MEJORA O ERROR</h3>
<FORM name="registropqr" method="POST" action="principal.php?archivo=admon/registropqrActualizar.php">
<table border="0">
<?php
	//if ($accion=='Modificar') echo "<TR><TD>Codigo</TD><TD><input type=text name=codigo value=$codigo readonly=yes></TD></TR>";
?>
<TR><TD>Fecha y hora (aaaa-mm-dd hh:mm:ss) (*)</TD><TD><input type="text" name=fechahora size="20" value="<?php echo date('Y-m-d H:i:s');?>" readonly="true"></TD></TR>
<TR><TD>Estado (*)</TD><TD><input type="text" name=estado size="13" value="Por analizar" readonly="true"></TD></TR>
<TR><TD>Tipo (*)</TD><TD><select name=tipo><option value=S selected="selected">Sugerencia</option><OPTION value=C>Error de programa</OPTION></select></TD></TR>
<TR><TD>Asunto (*)</TD><TD><input type="text" name=asunto maxlength="250" size="50"></TD></TR>
<TR><TD colspan="2">Descripción (*)<br><textarea name=descripcion cols=50 rows=5 maxlength=2500></textarea></TD></TR>
</table>
<input type=hidden name=rutaarchivo                                value="<?php echo $rutaarchivo?>">
<input type=hidden name=accion value="<?php echo $accion?>">
<input type=button name=accion value="<?php echo $accion?>" onclick="validar();">
</FORM>
</center>