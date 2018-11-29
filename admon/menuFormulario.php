<?php
	/*
	ADICIÓN O MODIFICACIÓN DE MENÚ
	Descripción: Presenta un formulario que permite adicionar o modificar un menú de un sistema de información.
	Requerimientos:
	$accion: Adicionar o Modificar que determinará la acción a ralizar sobre la base de datos
	$codsistema: Requerido para presenar el nombre del sistema de información del cual se está adicionando o modificando el menú.
	$codigo: para modificar se requiere de esta variable para presenar los datos del menú que se desea modificar
	Autor: Galo Fabian Muñoz Espín
	Fecha de creación: 01-12-2010
	Ultima modificación: 03-03-2011: Validación del formulario
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
		$cadenaSQL='select opcion, descripcion from admon_opciones';
		$cadenaSQL.=" where codigo=$codigo";
		$consulta=pg_query($conexion,$cadenaSQL);
		$opcion=pg_result($consulta,0,'opcion');
		$descripcion=pg_result($consulta,0,'descripcion');
	}
	else
	{
		$opcion='';
		$descripcion='';
	}
	$cadenaSQL="select nombre from admon_si where codigo=$codsistema";
	$consulta=pg_query($conexion,$cadenaSQL);
	$sistema=pg_result($consulta,0,'nombre');
	pg_close($conexion);
?>
<script language=javascript>
	function validar()
	{
		if (validarNoVacio(window.document.menus.opcion,"el nombre del menú")) window.document.menus.submit();
	}
</script>
	<center>
	<h3>ADICIÓN DE MENÚS</h3>
	<form name=menus action="principal.php?archivo=admon/opcionesactualizar.php&codsi=<?php echo $codsistema;?>" method="POST">
	<table border="1">
	<tr><td>Sistema</td><td><?php echo $sistema?></td></tr>
<?php
	if ($accion=='Modificar')
	{
?>
	<tr><td>Código</td><td><input type=text name=codigo value="<?php echo $codigo;?>" readonly="true"></td></tr>	
<?php
	}
?>
	<tr><td>Menú (*)</td><td><input type=text name=opcion maxlength="50" size="50" value="<?php echo $opcion;?>"></td></tr>
	<tr><td>Descripción</td><td><textarea name=descripcion cols="50" rows="3"><?php echo $descripcion;?></textarea></td></tr>
	</table>
	<input type="hidden" name="accion" value=<?php echo $accion;?>_Menu>
	<input type="button" name="accion" value=<?php echo $accion;?>_Menu onclick="validar();">
	</form>
	</center>
