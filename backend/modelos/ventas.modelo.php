<?php
	require_once "conexion.php";
	class ModeloVentas{
		/*=============================================
		METODO PARA MOSTRAR EL TOTAL DE VENTA S
		==============================================*/
		static public function mdlMostrarTotalVentas($tabla){
			$stmt = Conexion::conectar()->prepare("SELECT SUM(pago) as total FROM $tabla");
			$stmt->execute();
			return $stmt->fetch();
			$stmt->close();
			$stmt = null;
		}
		/*=============================================
		METODO PARA MOSTRAR VENTA S
		==============================================*/
		static public function mdlMostrarVentas($tabla){
			$stmt = Conexion::conectar()->prepare("SELECT *FROM $tabla");
			$stmt->execute();
			return $stmt->fetchAll();
			$stmt->close();
			$stmt = null;
		}
	}