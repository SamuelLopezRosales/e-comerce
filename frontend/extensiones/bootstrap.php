<?php
require __DIR__ . '/vendor/autoload.php';



use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

$tabla = "comercio";
$respuesta = ModeloCarrito::mdlMostrarTarifas($tabla);

// traigo de mi base de datos las credenciales de paypal
$clienteIdPaypal = $respuesta["clienteIdPaypal"];
$llaveSecretaPaypal = $respuesta["llaveSecretaPaypal"];
$modoPaypal = $respuesta["modoPaypal"];

// CREO EL CONTEXTO DE PAYPAL
$apiContext = new ApiContext(
       new OAuthTokenCredential(
            $clienteIdPaypal,
            $llaveSecretaPaypal
        )
  );

// configuraciones Paypal
$apiContext->setConfig(
        array(
            'mode' => $modoPaypal,
            'log.LogEnabled' => true,
            'log.FileName' => '../PayPal.log',
            'log.LogLevel' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
            //'cache.enabled' => true,
            //'cache.FileName' => '/PaypalCache' // for determining paypal cache directory
             'http.CURLOPT_CONNECTTIMEOUT' => 30
        )
    );