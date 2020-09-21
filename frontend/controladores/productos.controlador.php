<?php
	class ProductoControlador{
		/*=============================================
		MOSTRAR CATEGORIAS
		==============================================*/
		static public function ctrMostrarCategorias($item, $valor){
			$tabla = "categorias";

			$categorias = ModeloProducto::mdlMostrarCategorias($tabla, $item, $valor);
			return $categorias;
		}

		/*=================================================
		MOSTRAR SUBCATEGORIAS
		=================================================*/
		static public function ctrMostrarSubCategorias($item,$valor){
			$tabla = "subcategorias";

			$subcategorias = ModeloProducto::mdlMostrarSubCategorias($tabla,$item,$valor);
			return $subcategorias;
		}

		/*=================================================
		MOSTRAR PRODUCTOS
		=================================================*/
		public function ctrMostrarProductos($ordenar, $item, $valor){
			$tabla = "productos";
			$respuesta = ModeloProducto::mdlMostrarProductos($tabla, $ordenar,$item, $valor);
			return $respuesta;
		}

		/*=================================================
		MOSTRAR INFOPRODUCTOS
		=================================================*/
		public function ctrMostrarInfoProducto($item, $valor){
			$tabla = "productos";
			$respuesta = ModeloProducto::mdlMostrarInfoProducto($tabla, $item, $valor);
			return $respuesta;
		}
	}
