<?php
/*
	VALIDADOR DE INICIOS DE SESION
	Valida que el nombre de usuario y la contraseña estén registrados para ortorgar el ingreso al sistema de información pasando al archivo principal.php; en caso de que los datos sean incorrectos lo regresa al formulario de inicio de sesión: index.php. En caso de que no existan usuarios registrados en la base de datos, si el usuario es adsi y la clave es utilizar, este programa generará el usuario admin que es el administrador de sistemas de información
	Parámetros de entrada
	$usuario=Nombre del usuario que desea ingresar al sistema de información
	$clave: Clave o contraseña de ingreso del usuario.
	Autor: Galo Fabián Muñoz Espín
	Fecha de creación: 12-2010
	Ultima modificación: 
*/
	session_start();
	function iniciarSesion($usuario,$nombres,$apellidos,$codroll,$nivelAuditoria)
	{
		global $conexion;
		//variables de sessión que estarán disponibles en los diferentes archivos que componen el sistema de información
		$_SESSION['Id']=session_id();
		$_SESSION['Usuario']=$usuario;
		$_SESSION['NombresUsuario']=$nombres;
		$_SESSION['ApellidosUsuario']=$apellidos;
		$_SESSION['CodRoll']=$codroll;
		$_SESSION['NivelAuditoria']=$nivelAuditoria;
		if ($nivelAuditoria>0) registrarauditoria($conexion,$usuario,'1','','');
		echo header("Location: ../principal.php?archivo=admon/bienvenido.php&codsistema=$codsi");
	}
	include('../funciones/funciones.inc.php');
	$usuario=$_POST['usuario'];
	$clave=md5($_POST['clave']);
	//echo "$usuario $clave";
	require('../funciones/conexion.inc.php');
	$cadenaSQL="select codnivelauditoria from admon_si where int2(codnivelauditoria)>0";
	$consulta=pg_query($conexion,$cadenaSQL);
	if (pg_num_rows($consulta)>0) $nivelAuditoria=pg_result($consulta,0,0);
	else $nivelAuditoria=0;
	$cadenaSQL='select nombres, apellidos, codroll';
	$cadenaSQL.=' from admon_personas, admon_usuarios';
	$cadenaSQL.=' where admon_personas.codigo=admon_usuarios.codpersona'; 
	$cadenaSQL.= " and usuario='$usuario' and clave='$clave' and activo=true";
	$consulta=pg_query($conexion,$cadenaSQL);
	if (pg_num_rows($consulta)==1)
	{
		//usuario o contraseña existe
		iniciarSesion($usuario, pg_result($consulta,0,'nombres'), pg_result($consulta,0,'apellidos'), pg_result($consulta,0,'codroll'), $nivelAuditoria);
	}
	else
	{
		$cadenaSQL='select count(*) as cantidad from admon_usuarios';
		$consulta=pg_query($conexion,$cadenaSQL);
		if ((pg_result($consulta,0,'cantidad')==0) and ($usuario=='adsi' and $clave==md5('utilizar')))
		{
			//la tabla usuarios está vacía y se supera la clave inicial
			$cadenaSQL="insert into admon_rolles (codigo, roll) values (0,'Administrador del sistema')";
			pg_query($conexion,$cadenaSQL);
			$cadenaSQL="insert into admon_personas (codigo, nombres, apellidos) values (0,'Administrador','del Sistema')";
			pg_query($conexion,$cadenaSQL);
			$cadenaSQL="insert into admon_usuarios (usuario, clave, codpersona, codroll, activo) values ('admin',md5('utilizar'),0,0,true)";
			pg_query($conexion,$cadenaSQL);
			//configuramos el primer sistema de informacion
			$cadenaSQL="insert into admon_si (codigo, nombre, css) values (0,'Administrador de sistemas de informacion','estilo.css')";
			pg_query($conexion,$cadenaSQL);
			$cadenaSQL="insert into admon_opciones (codigo, opcion, ruta, codsi) values (1,'Sistemas','admon/si.php',0)";
			pg_query($conexion,$cadenaSQL);
			$cadenaSQL="insert into admon_opciones (codigo, opcion, ruta, codsi) values (2,'Empresas','admon/empresas.php',0)";
			pg_query($conexion,$cadenaSQL);
			$cadenaSQL="insert into admon_opciones (codigo, opcion, ruta, codsi) values (3,'Roles','admon/rolles.php',0)";
			pg_query($conexion,$cadenaSQL);
			$cadenaSQL="insert into admon_opciones (codigo, opcion, ruta, codsi) values (4,'Usuarios','admon/usuarios.php',0)";
			pg_query($conexion,$cadenaSQL);
			$cadenaSQL="insert into admon_opciones (codigo, opcion, ruta, codsi) values (5,'Auditoria','admon/auditoria.php',0)";
			pg_query($conexion,$cadenaSQL);
			$cadenaSQL="insert into admon_opciones (codigo, opcion, ruta, codsi) values (6,'PQRs','admon/pqr.php',0)";
			pg_query($conexion,$cadenaSQL);
			$cadenaSQL="insert into admon_opciones (codigo, opcion, ruta, codsi) values (7,'Backups','admon/backups.php',0)";
			pg_query($conexion,$cadenaSQL);
			$cadenaSQL="insert into admon_rollesopciones (codigo, codroll, codopcion) values (1,0,1)";
			pg_query($conexion,$cadenaSQL);
			$cadenaSQL="insert into admon_rollesopciones (codigo, codroll, codopcion) values (2,0,2)";
			pg_query($conexion,$cadenaSQL);
			$cadenaSQL="insert into admon_rollesopciones (codigo, codroll, codopcion) values (3,0,3)";
			pg_query($conexion,$cadenaSQL);
			$cadenaSQL="insert into admon_rollesopciones (codigo, codroll, codopcion) values (4,0,4)";
			pg_query($conexion,$cadenaSQL);
			$cadenaSQL="insert into admon_rollesopciones (codigo, codroll, codopcion) values (5,0,5)";
			pg_query($conexion,$cadenaSQL);
			$cadenaSQL="insert into admon_rollesopciones (codigo, codroll, codopcion) values (6,0,6)";
			pg_query($conexion,$cadenaSQL);
			$cadenaSQL="insert into admon_rollesopciones (codigo, codroll, codopcion) values (7,0,7)";
			pg_query($conexion,$cadenaSQL);
			iniciarSesion('admin', 'Administrador', ' del Sistema', 0,1);
		}
		else
		{
			//usuario no existe
			if ($nivelAuditoria>0) registrarauditoria($conexion,$usuario,'2','','');
			echo "<script language=javascript>";
			echo "alert('El nombre de usuario o la contraseña no existe!');";
			echo "window.location='../index.php';";
			echo "</script>";
		}
	}
	pg_close($conexion);
?>