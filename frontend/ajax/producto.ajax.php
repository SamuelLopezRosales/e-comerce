<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class AjaxProductos{

	public $valor;
	public $item;
	public $ruta;

	public function ajaxVistaProducto(){

		$datos = array("valor"=>$this->valor,
					   "ruta"=>$this->ruta);

		$valor1 = $this->valor;
		$item1 = $this->item;
		$valor2 = $this->ruta;
		$item2 = "ruta";

		$respuesta = ProductoControlador::ctrActualizarProducto($item1, $valor1, $item2, $valor2);

		echo $respuesta;

	}


	/*=============================================
	TRAER EL PRODUCTO DE ACUERDO AL ID
	=============================================*/

	public $id;

	public function ajaxTraerProducto(){

		$item = "id";
		$valor = $this->id;

		$respuesta = ProductoControlador::ctrMostrarInfoProducto($item, $valor);

		echo json_encode($respuesta);
	}


}

if(isset($_POST["valor"])){

	$vista = new AjaxProductos();
	$vista -> valor = $_POST["valor"];
	$vista -> item = $_POST["item"];
	$vista -> ruta = $_POST["ruta"];
	$vista -> ajaxVistaProducto();


}


if(isset($_POST["id"])){

	$producto = new AjaxProductos();
	$producto -> id = $_POST["id"];
	$producto -> ajaxTraerProducto();

}