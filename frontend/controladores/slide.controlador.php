<?php
class ControladorSlide{
	public function ctrMostrarSlide(){
		$tabla = "slide";

		$slide = ModeloSlide::mdlMostrarSlide($tabla);
		return $slide;
	}
}