<?php
require_once "../modelos/rutas.php";
require_once "../modelos/carrito.modelo.php";
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
class Paypal{
	static public function mdlPagoPaypal($datos){
		require __DIR__ . '/bootstrap.php';

		$tituloArray = explode(",",$datos["tituloArray"]);
		$cantidadArray = explode(",",$datos["cantidadArray"]);
		$valorItemArray = explode(",",$datos["valorItemArray"]);
		$idProductos = str_replace(",","-", $datos["idProductoArray"]);
		$cantidadProductos = str_replace(",","-", $datos["cantidadArray"]);
		$pagoProductos = str_replace(",","-", $datos["valorItemArray"]);


		# SELECCIONAR EL METODO DE PAYPAL
		$payer = new Payer();
		$payer->setPaymentMethod("paypal");

		$item = array();
		$variosItem = array();

		for($i=0; $i<count($tituloArray); $i++){
			$item[$i] = new Item();
			$item[$i]->setName($tituloArray[$i])
   				  ->setCurrency($datos["divisa"])
    			  ->setQuantity($cantidadArray[$i])
    			  ->setPrice($valorItemArray[$i]/$cantidadArray[$i]);

    			 array_push($variosItem, $item[$i]);
		}

		# Agrupamos los items en una lista de Items
		$itemList = new ItemList();
		$itemList->setItems($variosItem);

		#Agregamos los detalles del pago: impuestos, envio, etc...
		$details = new Details();
		$details->setShipping($datos["envio"])
    	->setTax($datos["impuesto"])
    	->setSubtotal($datos["subtotal"]);

    	# definimos el pago total con sus detalles
    	$amount = new Amount();
		$amount->setCurrency($datos["divisa"])
    	->setTotal($datos["total"])
    	->setDetails($details);

    	# Agregamos las caracteristicas de la transacción
    	$transaction = new Transaction();
		$transaction->setAmount($amount)
    	->setItemList($itemList)
    	->setDescription("Descripción del pago")
    	->setInvoiceNumber(uniqid());


    	// ### Redirect urls
		// Set the urls that the buyer must be redirected to after
		// payment approval/ cancellation.

    	$url = Ruta::ctrRuta();
    	//$pago =$datos["subtotal"];
		$redirectUrls = new RedirectUrls();
		// pagina que retorna cuando el pago sea exitoso
		$redirectUrls->setReturnUrl("$url"."index.php?ruta=finalizar-compra&paypal=true&productos=".$idProductos."&cantidad=".$cantidadProductos."&pago=".$pagoProductos)
   		->setCancelUrl("$url"."carrito-de-compras");

   		// agregar caracteristicas de pago//
   		$payment = new Payment();
		$payment->setIntent("sale")
    			->setPayer($payer)
    			->setRedirectUrls($redirectUrls)
    			->setTransactions(array($transaction));

    	# TRATAR DE EJECUTAR UN PROCESO Y SI FALLA EJECUTAR UNA RUTINA DE ERROR
    	try {
    		$payment->create($apiContext);
		}catch(Paypal\Exception\PayPalConnectionException $ex){
			echo $ex->getCode();
			echo $ex->getData();
			die($ex);
			return "$url/error";
		}

		# utilizamos un foreach para iterar sobre $payment, utilizamos el método llamado getLinks() para obtener todos los enlaces que aparecen en el array $payment y caso de que $Link->getRel() coincida con 'approval_url' extraemos dicho enlace, finalmente enviamos al usuario a esa dirección que guardamos en la variable $redirectUrl on el método getHref();
		foreach ($payment->getLinks() as $link) {
			if($link->getRel() == "approval_url"){
				$redirectUrl = $link->getHref();
			}
		}
		return $redirectUrl;

	}
}

