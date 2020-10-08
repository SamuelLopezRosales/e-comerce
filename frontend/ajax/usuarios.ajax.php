<?php
	require_once "../controladores/usuario.controlador.php";
	require_once "../modelos/usuario.modelo.php";

	class AjaxUsuarios {
		public $validarEmail;
		public function ajaxValidarEmail(){
			$datos = $this->validarEmail;
			$respuesta = ControladorUsuarios::ctrMostrarUsuario("email", $datos);
			echo json_encode($respuesta);
		}
	}

	/*=========================================================
	VALIDAR EMAIL EXISTENTE
	==========================================================*/
	if(isset($_POST["validarEmail"])){
		$valEmail = new AjaxUsuarios();
		$valEmail->validarEmail = $_POST["validarEmail"];
		$valEmail->ajaxValidarEmail();
	}