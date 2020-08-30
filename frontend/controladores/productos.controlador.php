<?php
	class ProductoControlador{
		/*=============================================
		MOSTRAR CATEGORIAS
		==============================================*/
		public function ctrMostrarCategorias(){
			$tabla = "categorias";

			$categorias = ModeloProducto::mdlMostrarCategorias($tabla);
			return $categorias;
		}

		/*=================================================
		MOSTRAR SUBCATEGORIAS
		=================================================*/
		static public function ctrMostrarSubCategorias($id){
			$tabla = "subcategorias";

			$subcategorias = ModeloProducto::mdlMostrarSubCategorias($tabla,$id);
			return $subcategorias;
		}
	}
