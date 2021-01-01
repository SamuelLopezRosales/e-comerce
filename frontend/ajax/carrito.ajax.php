<?php

require_once "../extensiones/paypal.controlador.php";
require_once "../controladores/carrito.controlador.php";
require_once "../modelos/carrito.modelo.php";

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";


class AjaxCarrito{
	/*=============================================
	METODO PAYPAL
	=============================================*/
	public $divisa;
	public $total;
	public $impuesto;
	public $envio;
	public $subtotal;
	public $tituloArray;
	public $cantidadArray;
	public $valorItemArray;
	public $idProductoArray;

	public function ajaxEnviarPaypal(){
		$datos = array(
			"divisa"=>$this->divisa,
			"total"=>$this->total,
			"impuesto"=>$this->impuesto,
			"envio"=>$this->envio,
			"subtotal"=>$this->subtotal,
			"tituloArray"=>$this->tituloArray,
			"cantidadArray"=>$this->cantidadArray,
			"valorItemArray"=>$this->valorItemArray,
			"idProductoArray"=>$this->idProductoArray
		);

		$respuesta = Paypal::mdlPagoPaypal($datos);
		echo $respuesta;
	}

	/* =====================================================0
	VERIFICAR QUE NO TENGA EL PRODUCTO YA COMPRADO
	=======================================================*/
	public $idProducto;
	public $idUsuario;
	public function ajaxVerificarProducto(){
		$datos = array("idUsuario"=> $this->idUsuario,
						"idProducto"=> $this->idProducto);

		$respuesta = ControladorCarrito::ctrVerificarProducto($datos);

		echo json_encode($respuesta);
	}
}


/* =====================================================0
METODO PARA EJECUTAR
=======================================================*/
if(isset($_POST["divisa"])){
	$paypal = new AjaxCarrito();
	$paypal->divisa = $_POST["divisa"];
	$paypal->total = $_POST["total"];
	$paypal->impuesto= $_POST["impuesto"];
	$paypal->envio= $_POST["envio"];
	$paypal->subtotal = $_POST["subtotal"];
	$paypal->tituloArray= $_POST["tituloArray"];
	$paypal->cantidadArray= $_POST["cantidadArray"];
	$paypal->valorItemArray= $_POST["valorItemArray"];
	$paypal->idProductoArray= $_POST["idProductoArray"];
	$paypal->ajaxEnviarPaypal();
}

/* =====================================================
VERIFICAR QUE NO TENGA EL PRODUCTO ADQUIRIDO
=======================================================*/
if(isset($_POST["idProducto"])){
	$producto = new AjaxCarrito();
	$producto->idProducto = $_POST["idProducto"];
	$producto->idUsuario = $_POST["idUsuario"];
	$producto->ajaxVerificarProducto();
}