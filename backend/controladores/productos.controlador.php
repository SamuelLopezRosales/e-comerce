<?php
class ControladorProductos{
	/*=============================================
	FUNCION PARA TOTOAL PRODUCTOS
	============================================*/
	static public function ctrMostrarTotalProductos($orden){
		$tabla = "productos";
		$respuesta = ModeloProductos::mdlMostrarTotalProductos($tabla, $orden);
		return $respuesta;
	}

	/*=============================================
	FUNCION PARA TOTOAL VENTAS
	============================================*/
	public function ctrMostrarSumaVentas(){
		$tabla = "productos";
		$respuesta = ModeloProductos::mdlMostrarSumaVentas($tabla);
		return $respuesta;
	}
}