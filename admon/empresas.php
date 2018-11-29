<?php
/*
	Listado de empresas
	Presenta el listado de las empresas con la que se contrata o se ha contratado el uso del software.
	**Este componente no está en funcionamiento porque hace falta asignar el sistema de información.
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
<script language="javascript">
	function enviar(accion)
	{
		var nit;
		window.document.empresas.accion.value=accion;
		switch(accion)
		{
			case 'Adicionar':
				window.document.empresas.action='principal.php?archivo=admon/empresasFormulario.php';
				window.document.empresas.submit();
				//alert(window.document.empresas.action);
				break;
			case 'Modificar':
				nit=window.document.empresas.nit.value;
				//alert(window.document.empresas.nit.value);
				/*if (!window.document.empresas.nit.checked) alert('Por favor seleccione una empresa');
				else 
				{*/
					window.document.empresas.action='principal.php?archivo=admon/empresasFormulario.php';
					window.document.empresas.submit();
					//alert(window.document.empresas.action);
				//}
				break;
			case 'Eliminar': 
				window.document.empresas.action='principal.php?archivo=admon/empresasActualizar.php';
				window.document.empresas.submit();
				//alert(window.document.empresas.action);
				break;
			case 'Listar': 
				break;
		}
	}
</script>

Empresas<p>

<a href="#" onclick="enviar('Adicionar');">Adicionar</a>\&nbsp;
<a href="#" onclick="enviar('Modificar');">Modigicar</a>\&nbsp;
<a href="#" onclick="enviar('Eliminar');">Eliminar</a>\&nbsp;
<a href="#" onclick="enviar('ListarSistemas');">S</a><br>____________________________________________________________________________________________________________________________________
<form name=empresas method="POST">
<table border="0" class="tabla">
<tr><Th>Seleccione</Th><Th>Nit</Th><Th>Razón social</Th><Th>Dirección</Th><Th>Teléfono</Th><Th>Correo electrónico</Th><Th>Contacto</Th><Th>Sitio web</Th></tr>
<?php
	include('funciones/conexion.inc.php');
	$cadenaSQL='select * from admon_empresas';
	$consulta=pg_query($conexion,$cadenaSQL);
	for ($i=0;$i<pg_num_rows($consulta);$i++)
	{
		if ($i==0) $chequeado=' checked=true';
		else $chequeado='';
		echo "<tr class='modo1' onMouseOver=this.style.backgroundColor='#CCFFFF'; onMouseOut=this.style.backgroundColor='#e2ebef'>";
		echo '<td><input type=radio name=nit value="' . pg_result($consulta,$i,'nit') . '"' . $chequeado . '></td>';
		for ($j=0;$j<pg_num_fields($consulta);$j++) echo '<td>' . pg_result($consulta,$i,$j) . '&nbsp;</td>';
		echo '</tr>';
	}
	pg_close($conexion);
?>
</table>
<input type=hidden name=accion>
</form>
