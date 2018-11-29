<?php
/*
	Formulario de registro y modificación de usuarios del sistema de información
	Presenta un formulario para el registro o modificación de un usuario de cualquier sistema de información:
	$accion=Adicionar, Modificar
	$usuario: requerido cuando acción=Modificar y contiene el nombre de usuario a modificar
	Autor: Galo Fabián Muñoz Espín
	Fecha de creación: 12-2010
	Ultima modificación: 
*/

	function llenarlista($conexion,$mostrar,$llave,$preseleccion,$tabla,$where)
	{
		$cadenaSQL="select $llave, $mostrar from $tabla $where";
		$consulta=pg_query($conexion,$cadenaSQL);
		$lista='';
		for($i=0;$i<pg_num_rows($consulta);$i++)
		{
			$codigo=pg_result($consulta,$i,"$llave");
			$valor=pg_result($consulta,$i,"$mostrar");
			if ($codigo==$preseleccion) $seleccionado='selected';
			else $seleccionado='';
			$lista.="<option value=$codigo $seleccionado>$valor</option>";
		}
		return($lista);
	}
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
	if ($accion=='Modificar')
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
	pg_close($conexion);	
?>


<div id="categorias">
<h3>ADICIÓN DE USUARIOS</h3>
</div>

<div id="formulario">
<FORM name="usuarios" method="POST" action="principal.php?archivo=admon/usuariosActualizar.php">
<table border="0">
<?php
	if ($accion=='Modificar') echo "<tr class='usi'><td>Codigo</td><td><input type=text name=codigo style='width:120px;height:20px;background-color:#aaccff;color:#241f1c;font-size:10pt; font-family:Verdana;text-align:left;' value=$codpersona readonly=yes></td></tr>";
?>
<tr class="usi"><td>Número de identificación</td><td><input type="text" style="width:120px;height:20px;background-color:#aaccff;color:#241f1c;font-size:10pt; font-family:Verdana;text-align:left;" name=numide maxlength="15" size="16" value="<?php echo $numide;?>"></td></tr>
<tr class="usi"><td>Nombres (*)</td><td><input type="text" name=nombres maxlength="50" size="50" style="width:200px;height:20px;background-color:#aaccff;color:#241f1c;font-size:10pt; font-family:Verdana;text-align:left;" value="<?php echo $nombres;?>"></td></tr>
<tr class="usi"><td>Apellidos (*)</td><td><input type="text" name=apellidos maxlength="50" size="50" style="width:200px;height:20px;background-color:#aaccff;color:#241f1c;font-size:10pt; font-family:Verdana;text-align:left;" value="<?php echo $apellidos;?>"></td></tr>
<tr class="usi"><td>Correo electrónico</td><td><input type="text" name=email maxlength="100" size="50" style="width:180px;height:20px;background-color:#aaccff;color:#241f1c;font-size:10pt; font-family:Verdana;text-align:left;" value="<?php echo $email;?>"></td></tr>
<tr class="usi"><td>Fecha de nacimiento (aaaa-mm-dd)</td><td><input type="text" name=fecha_nacimiento id="fecha_nacimiento" maxlength="10" size="11" style="width:90px;height:20px;background-color:#aaccff;color:#241f1c;font-size:10pt; font-family:Verdana;text-align:left;" value="<?php echo $fecha_nacimiento;?>" readonly="true"> <input type=button id="botonFechaNacimiento" value="..."></td></tr>
<tr class="usi"><td>Celular</td><td><input type="text" name=movil maxlength="10" size="16" style="width:110px;height:20px;background-color:#aaccff;color:#241f1c;font-size:10pt; font-family:Verdana;text-align:left;" value="<?php echo $movil;?>"></td></tr>
<tr class="usi"><td>Celular</td><td><input type="text" name=movil maxlength="10" size="16" style="width:110px;height:20px;background-color:#aaccff;color:#241f1c;font-size:10pt; font-family:Verdana;text-align:left;" value="<?php echo $movil;?>"></td></tr>
<tr class="usi"><td>Roll</td><td><select name=codroll style="width:180px;height:20px;background-color:#aaccff;color:#241f1c;font-size:10pt; font-family:Verdana;text-align:left;"><?php echo $listarolles;?></select></td></tr>
<tr class="usi"><td>Usuario (*)</td><td><input type="text" name=usuario maxlength="10" size="11" style="width:130px;height:20px;background-color:#aaccff;color:#241f1c;font-size:10pt; font-family:Verdana;text-align:left;" value="<?php echo $usuario;?>"></td></tr>
<tr class="usi"><td>Clave (*)</td><td><input type="password" name=clave maxlength="10" size="11" style="width:130px;height:20px;background-color:#aaccff;color:#241f1c;font-size:10pt; font-family:Verdana;text-align:left;" value="<?php echo $clave;?>"></td></tr>
<tr class="usi"><td>Activo</td><td><input type="checkbox" name=activo style="background-color:#aaccff;color:#241f1c;font-size:10pt; font-family:Verdana;text-align:left;" <?php echo $activo;?>></td></tr>
</table><br>
<input type=hidden name=accion value="<?php echo $accion?>">
<input type=button name=accion value="<?php echo $accion?>" onclick="validar();">
</FORM>
</div>

<script language=javascript>
	cal.manageFields("botonFechaNacimiento", "fecha_nacimiento", "%Y-%m-%d");//presentar calendario para la fecha de nacimiento
	function validar()
	{
		if (validarNoVacio(window.document.usuarios.nombres,"los nombres del usuario") && validarNoVacio(window.document.usuarios.apellidos,"los apellidos del usuario") && validarNoVacio(window.document.usuarios.usuario,"el nombre de usuario con el que se ingresará al sistema") && validarNoVacio(window.document.usuarios.clave,"la clave del usuario")) window.document.usuarios.submit();
	}
</script>
