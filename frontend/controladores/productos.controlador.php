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
	}
