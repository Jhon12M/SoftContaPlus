<?php	
	
	$BaseDeDatos='SoftContaPlus';
	$UsuarioBD='jonathan';
	$conexion=pg_connect("dbname=$BaseDeDatos user=$UsuarioBD password=123");
	if(!$conexion) 
	{
		echo "No se puede conectar con la base de datos";
		die();
	}
?>