<?php

class ControladorCarrito{
	public function ctrMostrarTarifas(){
		$tabla = "comercio";
		$respuesta = ModeloCarrito::mdlMostrarTarifas($tabla);
		return $respuesta;
	}

	/* ===================================================
	NUEVAS COMPRAS
	=====================================================*/
	static public function ctrNuevasCompras($datos){
		$tabla = "compras";
		$respuesta = ModeloCarrito::mdlNuevasCompras($tabla, $datos);
		if($respuesta == "ok"){
			$tabla = "comentarios";
			ModeloUsuarios::mdlIngresoComentarios($tabla, $datos);
		}
		return $respuesta;
	}

	/* ===============================================================
	VERIFICAR QUE EL PRODUCTO NO ESTE ADQUIRIDO
	===============================================================*/
	static public function ctrVerificarProducto($datos){
		$tabla = "compras";
		$respuesta = ModeloCarrito::mdlVerificarProducto($tabla, $datos);
		return $respuesta;
	}

}