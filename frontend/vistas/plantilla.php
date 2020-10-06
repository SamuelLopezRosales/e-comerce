<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="title" content="Tienda Virtual">
	<meta name="description" content="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam accusantium enim esse eos officiis sit officia">
	<meta name="keyword" content="Lorem ipsum, dolor sit amet, consectetur, adipisicing, elit, Quisquam, accusantium, enim, esse">
	<title>Tienda Virtual</title>

	<?php
		session_start();
		$servidor = Ruta::ctrRutaServidor();
		$icono = ControladorPlantilla::ctrEstiloPlantilla();
		echo '<link rel="icon" href="'.$servidor.$icono["icono"].'">';

		/*==============================================================================
		MANTENER LA RUTA FIJA DEL PROYECTO
		==============================================================================*/
		$url = Ruta::ctrRuta();

	?>

	<!-- ============================================================================
		PLUGIN CSS
	===============================================================================-->

	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/plugins/bootstrap.min.css">

	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/plugins/font-awesome.min.css">

	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/plugins/flexslider.css">

	<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Ubuntu|Ubuntu+Condensed" rel="stylesheet">

	<!-- ============================================================================
		CSS PERSONALIZADO
	===============================================================================-->

	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/plantilla.css">

	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/cabezote.css">

	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/slide.css">

	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/productos.css">

	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/infoproducto.css">

	<!-- ============================================================================
		PLUGIN JQUERY
	===============================================================================-->

	<script src="<?php echo $url; ?>vistas/js/plugins/jquery.min.js"></script>

	<script src="<?php echo $url; ?>vistas/js/plugins/bootstrap.min.js"></script>

	<script src="<?php echo $url; ?>vistas/js/plugins/jquery.easing.js"></script>

	<script src="<?php echo $url; ?>vistas/js/plugins/jquery.scrollUp.js"></script>

	<script src="<?php echo $url; ?>vistas/js/plugins/jquery.flexslider.js"></script>
</head>
<body>
	<?php
		/*=============================================
		CABEZOTE
		=============================================*/
		include "modulos/cabezote.php";

		/*=============================================
		CONTENIDO DINAMICO
		=============================================*/
		$rutas = array();
		$ruta = null;
		$infoProducto = null;
		if(isset($_GET["ruta"])){
			$rutas = explode("/", $_GET["ruta"]);
			$item = "ruta";
			$valor = $rutas[0];

			/*=============================================
			URL'S AMIGABLES DE CATEGORIAS
			=============================================*/
			$rutaCategorias = ProductoControlador::ctrMostrarCategorias($item,$valor);
			if($valor == $rutaCategorias["ruta"]){
				$ruta = $valor;
			}

			/*=============================================
			URL'S AMIGABLES DE SUBCATEGORIAS
			=============================================*/
			$rutaSubCategorias = ProductoControlador::ctrMostrarSubCategorias($item,$valor);

			foreach ($rutaSubCategorias as $key => $value) {
				if($valor == $value["ruta"]){
				$ruta = $valor;
				}
			}

			/*=============================================
			URL'S AMIGABLES DE PRODUCTOS
			=============================================*/
			$rutaProductos = ProductoControlador::ctrMostrarInfoProducto($item, $valor);
			if($rutas[0] == $rutaProductos["ruta"]){
				$infoProducto = $rutas[0];
			}
			/*=============================================
			LISTA BLANCA DE URL'S AMIGABLES
			=============================================*/
			if($ruta != null || $rutas[0] == "articulos-gratis" || $rutas[0] == "lo-mas-vendidos" || $rutas[0] == "lo-mas-vistos"){
				include_once "modulos/productos.php";
			}else if($infoProducto != null){
				include_once "modulos/infoproducto.php";
			}else if($rutas[0] == "buscador"){
				include_once "modulos/buscador.php";
			}else{
				include_once "modulos/error404.php";
			}
		}else{
			include_once "modulos/slide.php";
			// productos destacados
			include_once "modulos/destacados.php";

		}
	?>
	<input type="hidden" value="<?php echo $url; ?>" id="rutaOculta">

	<script src="<?php echo $url; ?>vistas/js/cabezote.js"></script>
	<script src="<?php echo $url; ?>vistas/js/plantilla.js"></script>
	<script src="<?php echo $url; ?>vistas/js/slide.js"></script>
	<script src="<?php echo $url; ?>vistas/js/buscador.js"></script>
	<script src="<?php echo $url; ?>vistas/js/infoproducto.js"></script>
	<script src="<?php echo $url; ?>vistas/js/usuarios.js"></script>
</body>
</html>