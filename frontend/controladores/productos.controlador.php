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
		public function ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo){
			$tabla = "productos";
			$respuesta = ModeloProducto::mdlMostrarProductos($tabla, $ordenar,$item, $valor, $base, $tope, $modo);
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

		/*=================================================
		LISTAR PRODUCTOS
		=================================================*/
		static public function ctrListarProductos($ordenar, $item2, $valor2){
			$tabla = "productos";
			$respuesta = ModeloProducto::mdlListarProductos($tabla, $ordenar, $item2, $valor2);
			return $respuesta;
		}

		/*=============================================
		MOSTRAR Banner
		==============================================*/
		static public function ctrMostrarBanner($ruta){
			$tabla = "banner";

			$banner = ModeloProducto::mdlMostrarBanner($tabla, $ruta);
			return $banner;
		}

		/*=============================================
	BUSCADOR
	=============================================*/

	static public function ctrBuscarProductos($busqueda, $ordenar, $modo, $base, $tope){

		$tabla = "productos";

		$respuesta = ModeloProducto::mdlBuscarProductos($tabla, $busqueda, $ordenar, $modo, $base, $tope);

		return $respuesta;

	}

	/*=============================================
	LISTAR PRODUCTOS BUSCADOR
	=============================================*/

	static public function ctrListarProductosBusqueda($busqueda){

		$tabla = "productos";

		$respuesta = ModeloProducto::mdlListarProductosBusqueda($tabla, $busqueda);

		return $respuesta;

	}

	/*=============================================
	ACTUALIZAR VISTA PRODUCTO
	=============================================*/

	static public function ctrActualizarVistaProducto($datos, $item){

		$tabla = "productos";

		$respuesta = ModeloProducto::mdlActualizarVistaProducto($tabla, $datos, $item);

		return $respuesta;
	}


	}
