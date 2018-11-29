<?php
/*
	GENERACIÓN DE BACKUPS
	Genera el backup de la base de datos de acuerdo a la configuración especificada en el archivo conexion.inc.php
	En la versión para windows es necesario que los comandos de postgres sean accesibles desde cualquier lugar en la consola, para esto hay que añadir pg_dump.exe al path. De igual manera hay que crear la variable de entorno denominada pgpassword especificando la clave del usuario propietario de la base de datos
	Autor: Galo Fabián Muñoz Espín
	Fecha de creación: 02-2011
	Ultima modificación: 01-03-2011
	
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
<center>
<h3>GENERACIÓN DE BACKUPS</h3>
<?php
	$archivo=$BaseDeDatos . date('YmdHis') . '.sql';
	//$comando="pg_dump -U $UsuarioBD $BaseDeDatos > datos/backups/$archivo";//version linux
	$comando="pg_dump -i -U $UsuarioBD -b -O -f datos/backups/$archivo $BaseDeDatos&"; 
	echo "$comando<br>";
	exec($comando);
?>
Backup generado con éxito, haga clic <a href=datos/backups/<?php echo $archivo?>>aqui</a> para proceder a la descarga.
</center>