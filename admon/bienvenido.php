
<center>
<h3>BIENVENIDO AL SISTEMAS DE INFORMACION SOFTCONTAPLUS</h3>
</center>


<div id="contabilidad" >

<h3>
| CUENTAS POR PAGAR  | 	 
</h3>	

<?php
		include('funciones/conexion.inc.php');
		foreach($_POST as $variable => $valor) ${$variable}=$valor;//recupera variables enviadas por post
		foreach($_GET as $variable => $valor) ${$variable}=$valor;//recupera variables enviadas por get	
		$cadenaSQL='select compras_detalles.id_detalle, cod_compras,  producto, compras_detalles.cantidad, vr_compra, estado';
		$cadenaSQL.=' from compras_detalles, compras, inventario';
		$cadenaSQL.=' where compras_detalles.cod_compras=compras.id_compra';
		$cadenaSQL.=' and compras_detalles.cod_producto=inventario.id_producto ';
		//$cadenaSQL.=" and compras.id_compra=$cod_compras order by  id_detalle ";
		$consulta=pg_query($conexion,$cadenaSQL);
		for ($i=0; $i<pg_num_rows($consulta);$i++)
		{
			$id_detalle=pg_result($consulta,$i,'id_detalle');
			$cod_compras=pg_result($consulta,$i,'cod_compras');
			$producto=pg_result($consulta,$i,'producto');
			$cantidad=pg_result($consulta,$i,'cantidad');
			$vr_compra=pg_result($consulta,$i,'vr_compra');
			$estado=pg_result($consulta,$i,'estado');
			$total=$vr_compra*$cantidad;
		    $VrTotal=$VrTotal+$total;
			$apagos=$VrTotal/3;
		}
		pg_close($conexion);
	?>
	
	
	
	<?php
		include('funciones/conexion.inc.php');
		foreach($_POST as $variable => $valor) ${$variable}=$valor;//recupera variables enviadas por post
		foreach($_GET as $variable => $valor) ${$variable}=$valor;//recupera variables enviadas por get	
		$cadenaSQL='select compras_detalles.id_detalle, producto, compras_detalles.cantidad, vr_compra, saldo_pago';
		$cadenaSQL.=' from compras_detalles, inventario, cuentas_pagar, compras';
		$cadenaSQL.=' where compras_detalles.cod_producto=inventario.id_producto';
		$cadenaSQL.=" and cuentas_pagar.cod_detalle=compras_detalles.id_detalle and compras_detalles.cod_compras=compras.id_compra";
		//$cadenaSQL.=" and compras.id_compra=$cod_compras order by  id_detalle ";
		$consulta=pg_query($conexion,$cadenaSQL);
		for ($i=0; $i<pg_num_rows($consulta);$i++)
		{
			
			$id_detalle=pg_result($consulta,$i,'id_detalle');
			$cantidad=pg_result($consulta,$i,'cantidad');
			$vr_compra=pg_result($consulta,$i,'vr_compra');
			$saldo_pago=pg_result($consulta,$i,'saldo_pago');
			$SaldoPago=$VrTotal-$saldo_pago;
			
			
		}
		pg_close($conexion);
	?>
<table border="0" width="650">
	<tr class="conta1"><th>Fecha Compra</th><th>Proveedor</th><th>Factura</th><th>Descripcion</th> <th>Fecha Pago</th> </tr>
	
	<?php
	$diaAct=date('d');
	$mesAct=date('m');
	$anioAct=date('Y');
	
	$fechaActu=date('Y-m-d');
	
	include('funciones/conexion.inc.php');
	foreach($_POST as $variable => $valor) ${$variable}=$valor;//recupera variables enviadas por post
	foreach($_GET as $variable => $valor) ${$variable}=$valor;//recupera variables enviadas por get	
	$cadenaSQL="select compras_detalles.id_detalle, id_compra,  fecha, empresa, factura_no, descripcion, fecha_pago1, 
	date_part('day', fecha_pago2) as dia2, date_part('month', fecha_pago2) as mes2, 
	date_part('day', fecha_pago3) as dia3, date_part('month', fecha_pago3) as mes3, tiempo ";
	$cadenaSQL.=' from compras, expedientes_proveedores, compras_detalles, cuentas_pagar, inventario';
	$cadenaSQL.=" where  compras_detalles.cod_compras=compras.id_compra 
	and cuentas_pagar.cod_detalle=compras_detalles.id_detalle 
	and compras.cod_proveedor=expedientes_proveedores.id_proveedor 
	and compras_detalles.cod_producto=inventario.id_producto order by  id_detalle desc";
	//$cadenaSQL.=" and ('$fechaactual'-fecha_pago2)/30>=(select (tiempo) from cuentas_pagar )";
	//echo $cadenaSQL;
	$consulta=pg_query($conexion,$cadenaSQL);
	for ($i=0;$i<pg_num_rows($consulta);$i++)
	{
		$id_detalle=pg_result($consulta,$i,'id_detalle');
		$id_compra=pg_result($consulta,$i,'id_compra');
		$fecha=pg_result($consulta,$i,'fecha');
		$empresa=pg_result($consulta,$i,'empresa');
		$factura_no=pg_result($consulta,$i,'factura_no');
		$descripcion=pg_result($consulta,$i,'descripcion');
		$fecha_pago1=pg_result($consulta,$i,'fecha_pago1');
		$dia2=pg_result($consulta,$i,'dia2');
		$mes2=pg_result($consulta,$i,'mes2');
		$dia3=pg_result($consulta,$i,'dia3');
		$mes3=pg_result($consulta,$i,'mes3');
		
	if($mes2==$mesAct)
	{
		if($dia2==$diaAct)
		{
			echo "<tr class='conta2'>
		<td Bgcolor='#CCCCFF'>$fecha&nbsp;</td><td Bgcolor='#CCCCFF'>$empresa&nbsp;</td>
		<td Bgcolor='#CCCCFF'>$factura_no</td>
		<td Bgcolor='#CCCCFF'>$descripcion</td><td Bgcolor='red'>$fechaActu</td>
		<td Bgcolor='#CCCCFF'><a href='principal.php?archivo=softcontaplus/comprasRealizarpagoFechas2.php&accion=Modificar&cod_compras=$id_compra&cod_detalle=$id_detalle'><img src='./presentacion/imagenes/alerta3.png'  title='Realizar Pago De La Factura' height='20' width='20'></a></td>";
		 " </tr>"; 
		}
		else
		{
			
			
		}
	}
	else
	{
	
	
	}
					
	if($mes3==$mesAct)
	{
		if($dia3==$diaAct)
		{
				echo "<tr class='conta2'>
		<td Bgcolor='#CCCCFF'>$fecha&nbsp;</td><td Bgcolor='#CCCCFF'>$empresa&nbsp;</td>
		<td Bgcolor='#CCCCFF'>$factura_no</td>
		<td Bgcolor='#CCCCFF'>$descripcion</td><td Bgcolor='red'>$fechaActu</td>
		<td Bgcolor='#CCCCFF'><a href='principal.php?archivo=softcontaplus/comprasRealizarpagoFechas2.php&accion=Modificar&cod_compras=$id_compra&cod_detalle=$id_detalle'><img src='./presentacion/imagenes/alerta3.png'  title='Realizar Pago De La Factura' height='20' width='20'></a></td>";
		 " </tr>"; 
		}
		else
		{
			
			
		}
	}
	else
	{
	
	
	}
		
	
	}
	pg_close($conexion);
	
?>
	</table>
	
	
	
	<?php
	//Desde aqui en piesa las cuentas por cobrar 
		include('funciones/conexion.inc.php');
		foreach($_POST as $variable => $valor) ${$variable}=$valor;//recupera variables enviadas por post
		foreach($_GET as $variable => $valor) ${$variable}=$valor;//recupera variables enviadas por get	
		$cadenaSQL='select ventas_detalles.id_detalle, cod_venta,  producto, ventas_detalles.cantidad, vr_venta, estado';
		$cadenaSQL.=' from ventas_detalles, ventas, inventario';
		$cadenaSQL.=' where ventas_detalles.cod_venta=ventas.id_venta';
		$cadenaSQL.=' and ventas_detalles.cod_producto=inventario.id_producto ';
		//$cadenaSQL.=" and ventas.id_venta=$cod_venta order by  id_detalle ";
		$consulta=pg_query($conexion,$cadenaSQL);
		for ($i=0; $i<pg_num_rows($consulta);$i++)
		{
			$id_detalle=pg_result($consulta,$i,'id_detalle');
			$cod_venta=pg_result($consulta,$i,'cod_venta');
			$producto=pg_result($consulta,$i,'producto');
			$cantidad=pg_result($consulta,$i,'cantidad');
			$vr_venta=pg_result($consulta,$i,'vr_venta');
			$estado=pg_result($consulta,$i,'estado');
			$total=$vr_venta*$cantidad;
		    $VrTotal=$VrTotal+$total;
			$valor_pago=$VrTotal/3;
				
		}
		pg_close($conexion);
	?>
	<?php
		include('funciones/conexion.inc.php');
		foreach($_POST as $variable => $valor) ${$variable}=$valor;//recupera variables enviadas por post
		foreach($_GET as $variable => $valor) ${$variable}=$valor;//recupera variables enviadas por get	
		$cadenaSQL='select ventas_detalles.id_detalle, producto, ventas_detalles.cantidad, vr_compra, fecha_pago1, fecha_pago2, fecha_pago3, saldo_pago';
		$cadenaSQL.=' from ventas_detalles, inventario, cuentas_cobrar, ventas';
		$cadenaSQL.=' where ventas_detalles.cod_producto=inventario.id_producto';
		$cadenaSQL.=" and cuentas_cobrar.cod_detalle=ventas_detalles.id_detalle and ventas_detalles.cod_venta=ventas.id_venta ";
		//$cadenaSQL.=" and ventas.id_venta=$cod_venta order by  id_detalle ";
		$consulta=pg_query($conexion,$cadenaSQL);
		for ($i=0; $i<pg_num_rows($consulta);$i++)
		{
			
			$cantidad=pg_result($consulta,$i,'cantidad');
			$vr_compra=pg_result($consulta,$i,'vr_compra');
			$saldo_pago=pg_result($consulta,$i,'saldo_pago');
			$fecha_pago1=pg_result($consulta,$i,'fecha_pago1');
			$fecha_pago2=pg_result($consulta,$i,'fecha_pago2');
			$fecha_pago3=pg_result($consulta,$i,'fecha_pago3');
			$SaldoPago=$VrTotal-$saldo_pago;
			
		}
		pg_close($conexion);
	?>

	
	<h3>
	| CUENTAS POR COBRAR  | 	 
	</h3>	
	<table border="0" width="650">
	<tr class="conta1"><th>Fecha Compra</th><th>Cliente</th><th>Factura</th><th>Descripcion</th> <th>Fecha Pago</th> </tr>
	
	<?php
	$diaAct=date('d');
	$mesAct=date('m');
	$anioAct=date('Y');
	
	$fechaActu=date('Y-m-d');
	
	include('funciones/conexion.inc.php');
	foreach($_POST as $variable => $valor) ${$variable}=$valor;//recupera variables enviadas por post
	foreach($_GET as $variable => $valor) ${$variable}=$valor;//recupera variables enviadas por get	
	$cadenaSQL="select ventas_detalles.id_detalle, id_venta,  fecha, nombres, factura_noventa, descripcion, fecha_pago1, 
	date_part('day', fecha_pago2) as dia2, date_part('month', fecha_pago2) as mes2, 
	date_part('day', fecha_pago3) as dia3, date_part('month', fecha_pago3) as mes3, tiempo ";
	$cadenaSQL.=' from ventas, expedientes_clientes, ventas_detalles, cuentas_cobrar, inventario';
	$cadenaSQL.=" where  ventas_detalles.cod_venta=ventas.id_venta 
	and cuentas_cobrar.cod_detalle=ventas_detalles.id_detalle 
	and ventas.cod_cliente=expedientes_clientes.id_cliente 
	and ventas_detalles.cod_producto=inventario.id_producto order by  id_detalle desc";
	//$cadenaSQL.=" and ('$fechaactual'-fecha_pago2)/30>=(select (tiempo) from cuentas_pagar )";
	//echo $cadenaSQL;
	$consulta=pg_query($conexion,$cadenaSQL);
	for ($i=0;$i<pg_num_rows($consulta);$i++)
	{
		$id_detalle=pg_result($consulta,$i,'id_detalle');
		$id_venta=pg_result($consulta,$i,'id_venta');
		$fecha=pg_result($consulta,$i,'fecha');
		$nombres=pg_result($consulta,$i,'nombres');
		$factura_noventa=pg_result($consulta,$i,'factura_noventa');
		$descripcion=pg_result($consulta,$i,'descripcion');
		$fecha_pago1=pg_result($consulta,$i,'fecha_pago1');
		$dia2=pg_result($consulta,$i,'dia2');
		$mes2=pg_result($consulta,$i,'mes2');
		$dia3=pg_result($consulta,$i,'dia3');
		$mes3=pg_result($consulta,$i,'mes3');
		
	if($mes2==$mesAct)
	{
		if($dia2==$diaAct)
		{
			echo "<tr class='conta2'>
		<td Bgcolor='#CCCCFF'>$fecha&nbsp;</td><td Bgcolor='#CCCCFF'>$nombres&nbsp;</td>
		<td Bgcolor='#CCCCFF'>$factura_noventa</td>
		<td Bgcolor='#CCCCFF'>$descripcion</td><td Bgcolor='red'>$fechaActu</td>
		<td Bgcolor='#CCCCFF'><a href='principal.php?archivo=softcontaplus/ventasRealizarpagoFechas2.php&accion=Modificar&cod_venta=$id_venta&cod_detalle=$id_detalle'><img src='./presentacion/imagenes/alerta3.png'  title='Realizar Pago De La Factura' height='20' width='20'></a></td>";
		 " </tr>"; 
		}
		else
		{
			
			
		}
	}
	else
	{
	
	
	}
					
	if($mes3==$mesAct)
	{
		if($dia3==$diaAct)
		{
				echo "<tr class='conta2'>
		<td Bgcolor='#CCCCFF'>$fecha&nbsp;</td><td Bgcolor='#CCCCFF'>$nombres&nbsp;</td>
		<td Bgcolor='#CCCCFF'>$factura_noventa</td>
		<td Bgcolor='#CCCCFF'>$descripcion</td><td Bgcolor='red'>$fechaActu</td>
		<td Bgcolor='#CCCCFF'><a href='principal.php?archivo=softcontaplus/ventasRealizarpagoFechas2.php&accion=Modificar&cod_venta=$id_venta&cod_detalle=$id_detalle'><img src='./presentacion/imagenes/alerta3.png'  title='Realizar Pago De La Factura' height='20' width='20'></a></td>";
		 " </tr>"; 
		}
		else
		{
			
			
		}
	}
	else
	{
	
	
	}
		
	}
	pg_close($conexion);
	
?>
	</table>
	</div>