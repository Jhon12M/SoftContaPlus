<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
/*
	Archivo principal del administrador de sistemas de información
	Este archivo es la plataforma para la presentación de los diferentes sistemas de información ante los usuarios; se presenta despues de haber superado el archivo validar.php
	Parámetros de entrada
	$Archivo=Ruta del archivo que se debe presentar al usuario
	Autor: Galo Fabián Muñoz Espín
	Fecha de creación: 12-2010
	Ultima modificación: 07-03-2011
*/
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es"> 
	<head>
		
		<link href="presentacion/css/tabla.css" rel="stylesheet" type="text/css" />
		<link href="presentacion/css/estilo2.css" rel="stylesheet" type="text/css" />
		<title>Administrador de sistemas de información</title>
		<script type="text/javascript" src="funciones/menu/menu.js"></script>
		<link href="funciones/menu/menu.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="funciones/funciones.js"></script>
		<!-- Lo requerido para el funcionamiento del calendario -->
		<script type="text/javascript" src="funciones/jscal/js/jscal2.js"></script>
		<script type="text/javascript" src="funciones/jscal/js/lang/es.js"></script>
		<link type="text/css" rel="stylesheet" href="funciones/jscal/css/jscal2.css" />
		<link type="text/css" rel="stylesheet" href="funciones/jscal/css/border-radius.css" />
		<link rel="stylesheet" type="text/css" href="funciones/jscal/css/steel/steel.css" />	
		<link rel="stylesheet" type="text/css" href="funciones/jscal/css/reduce-spacing.css" />
		
		<script>
			var cal = Calendar.setup({
			firstDayOfWeek: 0,
			onSelect: function(cal) { cal.hide() }
			});
		</script>	
		<STYLE type="text/css">
		A:link {text-decoration:none;color:#006666;}
		A:visited {text-decoration:none;color:#006666;}
		A:active {text-decoration:none;color:#006666;}
		A:hover {text-decoration:underline;color:#009999;}
		</STYLE>
	</head>
	<body onLoad="menu_init(0,12,1,-20,10)">
	<div id="wrapper">
	<div id="container">
	<div id="content">
		
		<div id="nuvearib2">
		
		</div>
		
		<div id="soft">
		<img src="./presentacion/imagenes/soft.jpg">
		</div>
		
	    <div id="ayuda">
		<table>
		<tr>
		<th><img src="./presentacion/imagenes/help.png"></th><th>|</th><th> <a href="index.php">Salir</a></th>
		</tr>
		</table>
		</div>
		
		<div id="menu2">
		Menu<hr>
		</div>
		
		<div id="menu">
			
			<div id="sidebar">
				<ul id="menunav">
					<?php 
						include('admon/menu.php');
					?>
					
					<li><a href="index.php">Salir</a></li>
				</ul>
			</div>
		</div>
		
			<?php
				include($_GET['archivo']);
			?>
			
			
		<div id="cielobajo2">
		<a href=principal.php?archivo=admon/registropqrFormulario.php&accion=Adicionar&rutaarchivo=<?php echo $_GET['archivo'];?> >Reportar sugerencia de mejora o error</a>
		</div>
	</div>

</div>
</div>	
	</body>
</html>