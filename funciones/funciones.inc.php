<?php

	function adicionar($tabla,$llave,$conexion)
	{
		//Adiciona un registro en la base de datos
		//validar que la llave no se repita
		global ${$llave};
		$cadena="select $llave from $tabla where $llave='${$llave}'";
		$resultado=pg_query($cadena);
		if (pg_num_rows($resultado)>0)
		{
			//la clave primaria se ha repetido
			$error='No se puede repetir la llave primaria';
		} else {
			//averiguacion de los nombres de los campos que componen la tabla
			$cadena="select * from $tabla limit 1";
			//echo $cadena;
			$resultado=pg_query($cadena);
			$cadena="insert into $tabla";
			$campos='';
			$valores='';
			for ($i=0;$i<pg_num_fields($resultado);$i++) 
			{
				global ${pg_field_name($resultado,$i)};
				if ($campos!='') $campos.=', ';
				$campos.=pg_field_name($resultado,$i);
				if ($valores!='') $valores.=', ';
				if (!isset(${pg_field_name($resultado,$i)}) or ${pg_field_name($resultado,$i)}=='') $valores.="NULL";
				else $valores.="'" . ${pg_field_name($resultado,$i)} . "'";
			}
			$cadena.=" ($campos) values ($valores)";
			//echo $cadena;
			pg_query($cadena);
			if ($_SESSION['NivelAuditoria']>1) registrarauditoria($conexion,$_SESSION['Usuario'],'3',addslashes($cadena),NULL);
			$error='';
		}
		if ($error!='') echo "<script language=javascript>alert('Error: $error');</script>";
	}

	function consecutivo($tabla,$llave,$conexion)
	{
		$cadenaSQL="select max($llave) from $tabla";
		$consulta=pg_query($conexion,$cadenaSQL);
		return(pg_result($consulta,0,0)+1);
	}

	function consultar($tabla,$campos,$filtro,$conexion)
	{
		/*Consulta un registro de la base de datos y devuelve sus campos como variables*/
		$cadena="select $campos from $tabla $filtro";
		//echo $cadena;
		$resultado=pg_query($cadena);
		if (pg_num_rows($resultado)>0)
		{
			for ($i=0;$i<pg_num_fields($resultado);$i++) //ciclo para los atributos
			{
				global ${pg_field_name($resultado,$i)};//generacion de una variable global
				${pg_field_name($resultado,$i)}=pg_result($resultado,0,$i);
			}
		}
		//echo $cadena;
	}

	function eliminar($tabla,$filtro,$conexion)
	{
		$cadena="select * from $tabla $filtro";
		$resultado=pg_query($cadena);
		$cadenaanterior='';
		for ($i=0;$i<pg_num_rows($resultado);$i++)
		{
			$cadenaanterior.="insert into $tabla values (";
			for ($j=0;$j<pg_num_fields($resultado);$j++)	
			{
				if ($j>0) $cadenaanterior.=", ";
				$cadenaanterior.="'" . pg_result($resultado,$i,$j) . "'";
			}
			$cadenaanterior.=");";
		}
		//echo "<br><br><br><br>" . $cadenaanterior;
		$cadena="delete from $tabla $filtro";
		//echo $cadena;
		pg_query($cadena);
		if ($_SESSION['NivelAuditoria']>1) registrarauditoria($conexion,$_SESSION['Usuario'],'5',addslashes($cadena),addslashes($cadenaanterior));
	}

	function modificar($tabla,$campos,$filtro,$conexion)
	{
		$cadena="select $campos from $tabla $filtro"; echo "<br>";
		$resultado=pg_query($cadena);
		$cadenaanterior='';
		for ($i=0;$i<pg_num_rows($resultado);$i++)
		{
			//if ($i>0) $cadenaanterior.=";";
			$cadenaanterior.="update $tabla set ";
			for ($j=0;$j<pg_num_fields($resultado);$j++)	
			{
				if ($j>0) $cadenaanterior.=", ";
				$cadenaanterior.=pg_field_name($resultado,$j) . "='" . pg_result($resultado,$i,$j) . "'";
			}
			$cadenaanterior.=" $filtro;";
		}
		//echo "<br><br><br><br>" . $cadenaanterior;
		$cadena="update $tabla set";
		$campos=explode(',',$campos);
		foreach ($campos as $variable) 
		{
			global ${trim($variable)};
			$cadena.=" $variable='" . ${trim($variable)} . "',";
		}
		$cadena=substr($cadena,0,strlen($cadena)-1);//borra la coma final
		$cadena.=" $filtro";
		//echo "<br>$cadena";
		pg_query($cadena);
		if ($_SESSION['NivelAuditoria']>1) registrarauditoria($conexion,$_SESSION['Usuario'],'4',addslashes($cadena),addslashes($cadenaanterior));
	}

	function registrarauditoria($conexion,$usuario,$suceso,$detalle,$registroanterior)
	{
		$codigo=consecutivo('admon_bitacoraauditoria','codigo',$conexion);
		if ($suceso=='1') $_SESSION["Id"]=$codigo;
		$fechahora=date('Y-m-d H:i:s');
		//$hora=date('H:i:s');
		$cadenaSQL='insert into admon_bitacoraauditoria';
		$cadenaCampos=' (codigo,fechahora,suceso,usuario';
		$cadenaValores=" values ('$codigo', '$fechahora', '$suceso', '$usuario'";
		if(session_is_registered('Id')) 
		{
			$cadenaCampos.=',sesion';
			$cadenaValores.=",'" . $_SESSION['Id'] . "'";
		}
		if($detalle!='') 
		{
			$cadenaCampos.=',detalle';
			$cadenaValores.=",'$detalle'";
		}
		if($registroanterior!='') 
		{
			$cadenaCampos.=',registroanterior';
			$cadenaValores.=",'$registroanterior'";
		}
		$cadenaCampos.=')';
		$cadenaValores.=')';
		$cadenaSQL.=$cadenaCampos . $cadenaValores;

		//echo "<br>$cadenaSQL";
		pg_query($conexion,$cadenaSQL);
	}
	
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
?>