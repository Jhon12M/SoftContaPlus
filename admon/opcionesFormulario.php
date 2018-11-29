<?php
	/*
	ADICIÓN O MODIFICACIÓN DE OPCIONES DE MENU
	Descripción: Presenta un formulario que permite adicionar o modificar opciones de un sistema de información.
	Requerimientos:
	$accion: Adicionar o Modificar que determinará la acción a ralizar sobre la base de datos
	$codsistema: Requerido para presenar el nombre del sistema de información del cual se está adicionando o modificando el menú.
	$codigo: para modificar se requiere de esta variable para presenar los datos de la opción que se desea modificar
	Autor: Galo Fabian Muñoz Espín
	Fecha de creación: 01-12-2010
	Ultima modificación: 03-03-2011 Validaciones del formulario
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
	if($accion=='Modificar')
	{
		$cadenaSQL='select opcion, descripcion, ruta, padre from admon_opciones';
		$cadenaSQL.=" where codigo=$codigo";
		$consulta=pg_query($conexion,$cadenaSQL);
		$opcion=pg_result($consulta,0,'opcion');
		$descripcion=pg_result($consulta,0,'descripcion');
		$ruta=pg_result($consulta,0,'ruta');
		$padre=pg_result($consulta,0,'padre');
	}
	else
	{
		$opcion='';
		$descripcion='';
		$ruta='';
		if(!isset($padre)) $padre='';
	}
	$cadenaSQL="select codigo as codmenu, opcion as menu from admon_opciones where ruta is null and codsi=$codsistema";//consulta de los menus
	$consulta=pg_query($conexion,$cadenaSQL);
	//generacion de las opciones de la lista de seleccion menus
	$menus='';
	for ($i=0;$i<pg_num_rows($consulta);$i++)
	{
		$codmenu=pg_result($consulta,$i,'codmenu');
		$menu=pg_result($consulta,$i,'menu');
		if ($padre == $codmenu) $adicion=' selected';
		else $adicion='';
		$menus.="<option value=$codmenu $adicion>$menu</option>\n";
	}
	$cadenaSQL="select nombre from admon_si where codigo=$codsistema";
	$consulta=pg_query($conexion,$cadenaSQL);
	$sistema=pg_result($consulta,0,'nombre');
	pg_close($conexion);
?>
<script language=javascript>
	function validar()
	{
		if (validarNoVacio(window.document.opciones.opcion,"el nombre de la opción") && validarNoVacio(window.document.opciones.ruta,"la ruta correspondiente al archivo que desarrolla la opción")) window.document.opciones.submit();
	}
</script>
	<center>
	<h3>ADICIÓN DE OPCIONES</h3>
	<form name=opciones action="principal.php?archivo=admon/opcionesactualizar.php&codsi=<?php echo $codsistema;?>" method="POST">
	<table border="1">
	<tr><td>Sistema</td><td><?php echo $sistema?></td></tr>
	<tr><td>Menú (*)</td><td><select name=padre><option value="">Ninguno</option><?php echo $menus;?></select></td></tr>
<?php
	if ($accion=='Modificar')
	{
?>
	<tr><td>Código</td><td><input type=text name=codigo value="<?php echo $codigo;?>" readonly="true"></td></tr>	
<?php
	}
?>
	<tr><td>Opción (*)</td><td><input type=text name=opcion maxlength="50" size="50" value="<?php echo $opcion;?>"></td></tr>
	<tr><td>Descripción</td><td><textarea name=descripcion cols="50" rows="3"><?php echo $descripcion;?></textarea></td></tr>
	<tr><td>Ruta (*)</td><td><input type=text name=ruta maxlength="250" size="50" value="<?php echo $ruta;?>"></td></tr>
	</table>
	<input type="hidden" name="accion" value=<?php echo $accion;?>>
	<input type="button" name="accion" value=<?php echo $accion;?> onclick="validar();">
	</form>
	</center>
