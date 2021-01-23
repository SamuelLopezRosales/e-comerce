<?php
	class ControladorComercio{
		/*======================================================0
		SELECCINAR PLANTILLA
		=========================================================*/
		static public function ctrSeleccionarPlantilla(){
			$tabla = "plantilla";
			$respuesta = ModeloComercio::mdlSeleccionarPlantilla($tabla);
			return $respuesta;
		}

		/*======================================================0
		CAMBIAR ICONO LOGO
		=========================================================*/
		static public function ctrActualizarLogoIcono($item,$valor){
			$tabla = "plantilla";
			$id = 1;
			$plantilla = ModeloComercio::mdlSeleccionarPlantilla($tabla);
			/*==================================================================
			CAMBIAR LOGOTIPO o icono
			====================================================================*/
			$valorNuevo = $valor;
			if(isset($valor["tmp_name"])){
				/*=====================================================
				CAPTURO EL ANCHO Y EL LARGO DE LA IMAGEN QUE VIENE
				======================================================*/
				list($ancho,$alto) = getimagesize($valor["tmp_name"]);
				/*===================================================
				CAMBIANDO LOGOTIPO
				====================================================*/
				if($item == "logo"){
					// elimino el logo actual
					unlink("../".$plantilla["logo"]);
					$nuevoAncho = 500;
					$nuevoAlto = 100;
					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
					if($valor["type"]  == "image/jpeg"){
						$ruta = "../vistas/img/plantilla/logo.jpg";
						$origen = imagecreatefromjpeg($valor["tmp_name"]);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino,$ruta);
					}
					if($valor["type"]  == "image/png"){
						$ruta = "../vistas/img/plantilla/logo.png";
						$origen = imagecreatefrompng($valor["tmp_name"]);
						imagealphablending($destino, FALSE);
						imagesavealpha($destino, TRUE);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagepng($destino,$ruta);
					}
				}

				/*===================================================
				CAMBIANDO ICONO
				====================================================*/
				if($item == "icono"){
					// elimino el logo actual
					unlink("../".$plantilla["icono"]);
					$nuevoAncho = 100;
					$nuevoAlto = 100;
					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
					if($valor["type"]  == "image/jpeg"){
						$ruta = "../vistas/img/plantilla/icono.jpg";
						$origen = imagecreatefromjpeg($valor["tmp_name"]);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino,$ruta);
					}
					if($valor["type"]  == "image/png"){
						$ruta = "../vistas/img/plantilla/icono.png";
						$origen = imagecreatefrompng($valor["tmp_name"]);
						imagealphablending($destino, FALSE);
						imagesavealpha($destino, TRUE);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagepng($destino,$ruta);
					}

				}

				// eliminar los dos puntos y el slash a la ruta
				$valorNuevo = substr($ruta, 3);
			}
			$respuesta = ModeloComercio::mdlActualizarLogoIcono($tabla, $id, $item,$valorNuevo);
			return $respuesta;

		}
		/*============================================================================
		CAMBIAR COLORES
		===========================================================================*/

		static public function ctrActualizarColores($datos){
			$tabla = "plantilla";
			$id = 1;
			$respuesta = ModeloComercio::mdlActualizarColores($tabla, $id, $datos);
			return $respuesta;
		}

		/*============================================================================
		CAMBIAR SCRIPTS
		===========================================================================*/
		static public function ctrActualizarScript($datos){
			$tabla = "plantilla";
			$id = 1;
			$respuesta = ModeloComercio::mdlActualizarScript($tabla,$id,$datos);
			return $respuesta;
		}

		/*======================================================0
		SELECCINAR COMERCIO
		=========================================================*/
		static public function ctrSeleccionarComercio(){
			$tabla = "comercio";
			$respuesta = ModeloComercio::mdlSeleccionarComercio($tabla);
			return $respuesta;
		}

		/*======================================================0
		ACTUALIZAR INFORMACION
		=========================================================*/
		static public function ctrActualizarInformacion($datos){
			$tabla = "comercio";
			$id = 1;

			$respuesta = ModeloComercio::mdlActualizarInformacion($tabla, $id, $datos);
			return $respuesta;
		}
	}