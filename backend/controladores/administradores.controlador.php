<?php
class ControladorAdministrador{
	/*==================================================
	INGRESO ADMINISTRADOR
	==================================================*/
	public function ctrIngresoAdministrador(){
		// nO SE EJECUTA ESTE METODO HASTA QUE LLEGUEN DATOS
		if(isset($_POST["ingEmail"])){
			// filtrar los datos
			if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["ingEmail"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){
				#$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$tabla = "administradores";
				$item = "email";
				$valor = $_POST["ingEmail"];

				$respuesta = ModeloAdministradores::mdlMostrarAdministradores($tabla, $item, $valor);
				if($_POST["ingEmail"] == $respuesta["email"] && $_POST["ingPassword"] == $respuesta["password"]){
					$_SESSION["validarSesionBackend"] = "ok";
					$_SESSION["id"] = $respuesta["id"];
					$_SESSION["nombre"] = $respuesta["nombre"];
					$_SESSION["foto"] = $respuesta["foto"];
					$_SESSION["email"] = $respuesta["email"];
					$_SESSION["password"] = $respuesta["password"];
					$_SESSION["perfil"] = $respuesta["perfil"];
					echo '<script>
						window.location = "inicio";
					</script>';
				}else{
					echo '<br>
					<div class="alert alert-danger">Error al ingresar vuelve a intentarlo</div>';
				}
			}
		}
	}
}