<?php
require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";
require_once "../controladores/cabeceras.controlador.php";
require_once "../modelos/cabeceras.modelo.php";
class TablaCategorias{
	/*==============================================================
	mostrar tabla categorias
	=============================================================*/
	public function mostrarTabla(){

		$item = null;
		$valor = null;
		$categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);


		$datosJson = '{
			"data": [ ';
			for($i=0; $i<count($categorias); $i++){
				/*=====================================================================
				REVISION DEL ESTADO
				=====================================================================*/
				if($categorias[$i]["estado"] == "0"){
					$colorEstado = "btn-danger";
					$textoEstado = "Desactivado";
					$estadoCategoria = 1;
				}else{
					$colorEstado = "btn-success";
					$textoEstado = "Activado";
					$estadoCategoria = 0;
				}
			$estado = "<button class='".$colorEstado." btn-xs btnActivar' estadoCategoria='".$estadoCategoria."' idCategoria='".$categorias[$i]["id"]."'>".$textoEstado."</button>";
			/*=============================================
			REVISAR IMAGEN PORTADA
			=============================================*/
			$item = "ruta";
			$valor = $categorias[$i]["ruta"];
			$cabeceras = ControladorCabeceras::ctrMostrarCabeceras($item, $valor);
			if($cabeceras["portada"] != ""){
				 $imgPortada = "<img class='img-thumbnail imgPortadaCategorias' src='".$cabeceras["portada"]."' width='100px'>";
			}else{
				$imgPortada = "<img class='img-thumbnail imgPortadaCategorias' src='vistas/img/cabeceras/default/default.jpg' width='100px'>";
			}
			/*==========================================================
			REVISAR OFERTA
			===========================================================*/
			if($categorias[$i]["oferta"] != 0){
				if($categorias[$i]["precioOferta"] != 0){
					$tipoOferta = "PRECIO";
					$valorOferta = "$".$categorias[$i]["precioOferta"];
				}else{
					$tipoOferta = "DESCUENTO";
					$valorOferta = $categorias[$i]["descuentoOferta"]." %";
				}
			}else{
				$tipoOferta = "No tiene oferta";
				$valorOferta = 0;
			}

			if($categorias[$i]["imgOferta"] != ""){
				 $imgOfertas = "<img class='img-thumbnail imgOfertaCategorias' src='".$categorias[$i]["imgOferta"]."' width='100px'>";
			}else{
				$imgOfertas = "<img class='img-thumbnail imgOfertaCategorias' src='vistas/img/ofertas/default/default.jpg' width='100px'>";
			}
			$acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarCategoria' idCategoria='".$categorias[$i]["id"]."' data-toggle='modal' data-target='#modalEditarCategoria'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarCategoria' idCategoria='".$categorias[$i]["id"]."' imgPortada='".$cabeceras["portada"]."' rutaCabecera='".$categorias[$i]["ruta"]."' imgOferta='".$categorias[$i]["imgOferta"]."'><i class='fa fa-times'></i></button></div>";
		 $datosJson .= '[
					"'.($i+1).'",
					"'.$categorias[$i]["categoria"].'",
					"'.$categorias[$i]["ruta"].'",
					"'.$estado.'",
					"'.$cabeceras["descripcion"].'",
					"'.$cabeceras["palabrasClaves"].'",
					"'.$imgPortada.'",
					"'.$tipoOferta.'",
					"'.$valorOferta.'",
					"'.$imgOfertas.'",
					"'.$categorias[$i]["finOferta"].'",
					"'.$acciones.'"
				],';

			}
			$datosJson = substr($datosJson, 0,-1);
			$datosJson .= ']
		}';
		echo $datosJson;
	}
}

$tabla = new TablaCategorias();
$tabla->mostrarTabla();