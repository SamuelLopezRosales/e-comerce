<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">



	<?php
		session_start();
		$servidor = Ruta::ctrRutaServidor();
		$icono = ControladorPlantilla::ctrEstiloPlantilla();
		echo '<link rel="icon" href="'.$servidor.$icono["icono"].'">';

		/*==============================================================================
		MANTENER LA RUTA FIJA DEL PROYECTO
		==============================================================================*/
		$url = Ruta::ctrRuta();

		/*==================================================================================
		MARCADO DE CABECERAS
		==================================================================================*/
		$rutas = array();
		if(isset($_GET["ruta"])){
			$rutas = explode("/", $_GET["ruta"]);
			$ruta = $rutas[0];
		}else{
			$ruta = "inicio";
		}

		$cabeceras = ControladorPlantilla::ctrTraerCabeceras($ruta);
		if(!$cabeceras["ruta"]){
			$ruta = "inicio";
			$cabeceras = ControladorPlantilla::ctrTraerCabeceras($ruta);
		}


	?>

	<!-- ===================================================================================
		CABECERAS MARCADO HTML5
	========================================================================================-->
	<meta name="title" content="<?php echo $cabeceras['titulo']; ?>">
	<meta name="description" content="<?php echo $cabeceras['descripcion']; ?>">
	<meta name="keyword" content="<?php echo $cabeceras['palabrasClaves']; ?>">
	<title><?php echo $cabeceras['titulo']; ?></title>
	<!-- ==================================
	MARCADO FACEBOOK OPEN GRAPH
	=====================================-->
	<meta property="og:title" content="<?php echo $cabeceras['titulo']; ?>">
	<meta property="og:url" content="<?php echo $url.$cabeceras['ruta']; ?>">
	<meta property="og:description" content="<?php echo $cabeceras['descripcion']; ?>">
	<meta property="og:image" content="<?php echo $cabeceras['portada']; ?>">
	<meta property="og:type" content="website">
	<meta property="og:site_name" content="Tienda Virtual Samuel">
	<meta property="og:locale" content="es_CO">

	<!-- ==================================
	MARCADO ESTRUCTURAL PARA GOOGLE
	=====================================-->
	<meta itemprop="name" content="<?php echo $cabeceras['titulo']; ?>">
	<meta itemprop="url" content="<?php echo $url.$cabeceras['ruta']; ?>">
	<meta itemprop="description" content="<?php echo $cabeceras['descripcion']; ?>">
	<meta itemprop="image" content="<?php echo $cabeceras['portada']; ?>">

	<!-- ==================================
	MARCADO ESTRUCTURAL PARA twitter
	=====================================-->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="<?php echo $cabeceras['titulo']; ?>">
	<meta name="twitter:url" content="<?php echo $url.$cabeceras['ruta']; ?>">
	<meta name="twitter:description" content="<?php echo $cabeceras['descripcion']; ?>">
	<meta name="twitter:image" content="<?php echo $cabeceras['portada']; ?>">
	<meta name="twitter:site" content="@tu_usuario">


	<!-- ============================================================================
		PLUGIN CSS
	===============================================================================-->

	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/plugins/bootstrap.min.css">

	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/plugins/font-awesome.min.css">

	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/plugins/flexslider.css">

	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/plugins/sweetalert.css">

	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/plugins/dscountdown.css">

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

	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/perfil.css">

	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/carrito-de-compras.css">

	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/ofertas.css">

	<!-- ============================================================================
		PLUGIN JQUERY
	===============================================================================-->

	<script src="<?php echo $url; ?>vistas/js/plugins/jquery.min.js"></script>

	<script src="<?php echo $url; ?>vistas/js/plugins/bootstrap.min.js"></script>

	<script src="<?php echo $url; ?>vistas/js/plugins/jquery.easing.js"></script>

	<script src="<?php echo $url; ?>vistas/js/plugins/jquery.scrollUp.js"></script>

	<script src="<?php echo $url; ?>vistas/js/plugins/jquery.flexslider.js"></script>

	<script src="<?php echo $url; ?>vistas/js/plugins/sweetalert.min.js"></script>

	<script src="<?php echo $url; ?>vistas/js/plugins/dscountdown.min.js"></script>

	<script src="https://apis.google.com/js/platform.js" async defer></script>
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
			}else if($rutas[0] == "buscador" || $rutas[0] == "verificar" || $rutas[0] == "salir" || $rutas[0] == "perfil" || $rutas[0] == "carrito-de-compras" || $rutas[0] == "error" || $rutas[0] == "finalizar-compra" || $rutas[0] == "curso" || $rutas[0] == "ofertas"){
				include_once "modulos/".$rutas[0].".php";
			}else if($rutas[0] == "inicio"){
				include_once "modulos/slide.php";
			// productos destacados
				include_once "modulos/destacados.php";
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
	<script src="<?php echo $url; ?>vistas/js/registroFacebook.js"></script>
	<script src="<?php echo $url; ?>vistas/js/carrito-de-compras.js"></script>

	<script>
  		window.fbAsyncInit = function() {
   		 FB.init({
      	 appId      : '2697070643886512',
      	cookie     : true,
      	xfbml      : true,
      	version    : 'v8.0'
    	});

    	FB.AppEvents.logPageView();

  		};

  		(function(d, s, id){
    	 var js, fjs = d.getElementsByTagName(s)[0];
     	if (d.getElementById(id)) {return;}
     	js = d.createElement(s); js.id = id;
    	js.src = "https://connect.facebook.net/en_US/sdk.js";
     	fjs.parentNode.insertBefore(js, fjs);
   		}(document, 'script', 'facebook-jssdk'));

   		/*============================================
   		COMPARTIR EN FACEBOOK
   		============================================*/
   		$(".btnFacebook").click(function(){
   			FB.ui({
   				method: 'share',
   				display: 'popup',
   				href: '<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>',
   			}, function(response){});
   		});

   		$(".btnGoogle").click(function(){
   			window.open(
   				'https://plus.google.com/share?url=<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>',
   				'',
   				'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=400'
   				);
   			return false;
   		});
		</script>
</body>
</html>