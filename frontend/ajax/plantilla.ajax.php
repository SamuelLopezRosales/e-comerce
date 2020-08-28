<?php
	require "../controladores/plantilla.controlador.php";
	require "../modelos/plantilla.modelo.php";

	class AjaxPlantilla{
		public function ajaxEstiloPlantilla(){
			$respuesta = ControladorPlantilla::ctrEstiloPlantilla();
			echo json_encode($respuesta);
		}
	}

	$objeto = new AjaxPlantilla();
	$objeto->ajaxEstiloPlantilla();
?>