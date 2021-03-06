<?php
/*
	Formulario para la Adición o modificación de empresas
	Presenta un formulario que permite la adición o modificación de un registro de empreas
	Parámetros de entrada:
	$accion= Accion a realizar, Adicionar o Modificar
	$nit= requerido cuando la acción es modificar y sirve para presentar los datos que se van a modificar en el formulario
	Autor: Galo Fabián Muñoz Espín
	Fecha de creación: 12-2010
	Ultima modificación: 03-03-2011: Implementación de las validaciones con js
	
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
	foreach($_POST as $variable => $valor) ${$variable}=$valor;
	if ($accion=='Modificar')
	{
		//recuperar los datos de la base de datos
		include('funciones/conexion.inc.php');
		include('funciones/funciones.inc.php');
		consultar('admon_empresas','razonsocial, direccion, telefono, email, url'," where nit='$nit'",$conexion);
		pg_close($conexion);
	}
	else
	{
		//iniciarlizar variables
		$nit='';
		$razonsocial='';
		$direccion='';
		$telefono='';
		$email='';
		$contacto='';
		$url='';
	}
?>
<script language=javascript>
	function validar()
	{
		if (validarNoVacio(window.document.empresas.nit,"el nit de la empresa") && validarNoVacio(window.document.empresas.razonsocial,"la razón social de la empresa")) window.document.empresas.submit();
	}
</script>
<center>
<h3>ADICION DE EMPRESAS</h3>
<form name="empresas" method="POST" action="principal.php?archivo=admon/empresasActualizar.php">
<table>
	<TR>
		<TD>NIT (*)</TD>
		<td><input type=text name=nit value="<?php echo $nit;?>" maxlength="15" size="16"></td>
	</TR>	
	<TR>
		<TD>Razón social (*)</TD>
		<td><input type=text name=razonsocial maxlength=100 size=50 value="<?php echo $razonsocial;?>"></td>
	</TR>
	<tr>
		<TD>Dirección</TD>
		<td><input type=text name=direccion maxlength=100 size=50 value="<?php echo $direccion;?>"></td>
	</tr>
	<tr>
		<TD>Teléfono</TD>
		<TD><input type=text name=telefono maxlength="10" size="11" value="<?php echo $telefono;?>"></TD>
	</tr>
	<tr>
		<TD>Correo electrónico</TD>
		<TD><input type=text name=email maxlength="100" size="50" value="<?php echo $email;?>"></TD>
	</tr>
<!--	<tr>
		<TD>Contacto</TD>
		<TD><input type=text name=contacto  size="50" value="<?php echo $contacto;?>" readonly="true"></TD>
	</tr>
-->	<tr>
		<TD>Sitio web</TD>
		<TD><input type=text name=url maxlength="100" size="50" value="<?php echo $url;?>"></TD>
	</tr>
</table>
<?php
	if($accion=='Modificar') echo "<input type=hidden name=nitanterior value=$nit>";
	echo "<input type=hidden name=accion value=$accion>";
?>
<input type="button" name=accion value="<?php echo $accion?>" onclick="validar();">
</form>
</center>