<?php
	class ControladorVentas{
		/*===========================================
		METODO MOSTRAR TOTAL VENTAS
		===========================================*/
		public function ctrMostrarTotalVentas(){
			$tabla = "compras";
			$ventas = ModeloVentas::mdlMostrarTotalVentas($tabla);
			return $ventas;
		}
		/*===========================================
		METODO MOSTRAR VENTAS
		===========================================*/
		public function ctrMostrarVentas(){
			$tabla = "compras";
			$respuesta = ModeloVentas::mdlMostrarVentas($tabla);
			return $respuesta;
		}
	}