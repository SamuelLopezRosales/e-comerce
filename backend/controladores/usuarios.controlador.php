<?php
class ControladorUsuarios{
	/*=========================================
	METODO MOSTRAR TODOS LOS USUARIOS
	==========================================*/
	static public function ctrMostrarTotalUsuarios($orden){
		$tabla = "usuarios";
		$respuesta = ModeloUsuarios::mdlMostrarTotalUsuarios($tabla, $orden);
		return $respuesta;
	}
}