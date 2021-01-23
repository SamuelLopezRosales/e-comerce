<?php
	require_once "../controladores/slide.controlador.php";
	require_once "../modelos/slide.modelo.php";

	class AjaxSlide{
		/*============================================
		CREAR SLIDE
		===========================================*/
		public $imgFondo; // imagen antigua
		public $tipoSlide;
		public $estiloTextoSlide;
		public $estiloImgProducto;
		public $titulo1;
		public $titulo2;
		public $titulo3;
		public $boton;
		public $url;
		public $subirFondo; //  el archivo de la imagen nueva
		public $imgProducto;
		public $subirImgProducto;

		public function ajaxCrearSlide(){
			$datos = array(
				"imgFondo"=>$this->imgFondo,
				"tipoSlide"=>$this->tipoSlide,
				"estiloTextoSlide"=>$this->estiloTextoSlide,
				"titulo1"=>$this->titulo1,
				"titulo2"=>$this->titulo2,
				"titulo3"=>$this->titulo3,
				"boton"=>$this->boton,
				"url"=>$this->url);

			$respuesta = ControladorSlide::ctrCrearSlide($datos);
			echo $respuesta;
		}

		/*============================================
		ACTUALIZAR ORDEN SLIDE
		===========================================*/
		public $id;
		public $orden;
		public function ajaxActualizarOrdenSlide(){
			$datos = array(
				"id"=>$this->id,
				"orden"=>$this->orden);
			$respuesta = ControladorSlide::ctrActualizarOrdenSlide($datos);
			echo $respuesta;
		}

		/*============================================
		CAMBIAR SLIDE AJAX
		===========================================*/
		public $nombre;
		public function ajaxCambiarSlide(){
			$datos = array(
				"id"=>$this->id,
				"nombre"=>$this->nombre,
				"tipoSlide"=>$this->tipoSlide,
				"estiloTextoSlide"=>$this->estiloTextoSlide,
				"estiloImgProducto"=>$this->estiloImgProducto,
				"imgFondo"=>$this->imgFondo,
				"subirFondo"=>$this->subirFondo,
				"imgProducto"=>$this->imgProducto,
				"subirImgProducto"=>$this->subirImgProducto,
				"titulo1"=>$this->titulo1,
				"titulo2"=>$this->titulo2,
				"titulo3"=>$this->titulo3,
				"boton"=>$this->boton,
				"url"=>$this->url);


			$respuesta = ControladorSlide::ctrCambiarSlide($datos);
			echo $respuesta;

		}
	}


		/*============================================
		CREAR SLIDE
		===========================================*/
		if(isset($_POST["crearSlide"])){
			$crearSlide = new AjaxSlide();
			$crearSlide->imgFondo = $_POST["imgFondo"];
			$crearSlide->tipoSlide = $_POST["tipoSlide"];
			$crearSlide->estiloTextoSlide = $_POST["estiloTextoSlide"];
			$crearSlide->titulo1 = $_POST["titulo1"];
			$crearSlide->titulo2 = $_POST["titulo2"];
			$crearSlide->titulo3 = $_POST["titulo3"];
			$crearSlide->boton = $_POST["boton"];
			$crearSlide->url = $_POST["url"];
			$crearSlide->ajaxCrearSlide();
		}


	/*============================================
		ACTUALIZAR ORDEN SLIDE
		===========================================*/
		if(isset($_POST["idSlide"])){
			$orden = new AjaxSlide();
			$orden->id = $_POST["idSlide"];
			$orden->orden = $_POST["orden"];
			$orden->ajaxActualizarOrdenSlide();
		}

		/*============================================
		AJAX CAMBIAR SLIDE
		===========================================*/
		if(isset($_POST["id"])){
			$slide = new AjaxSlide();
			$slide->id = $_POST["id"];
			$slide->nombre = $_POST["nombre"];
			$slide->tipoSlide = $_POST["tipoSlide"];
			$slide->estiloTextoSlide = $_POST["estiloTextoSlide"];
			$slide->estiloImgProducto = $_POST["estiloImgProducto"];
			$slide->imgFondo = $_POST["imgFondo"];
			if(isset($_FILES["subirFondo"])){
				$slide->subirFondo = $_FILES["subirFondo"];
			}else{
				$slide->subirFondo = null;
			}
			$slide->imgProducto = $_POST["imgProducto"];
			if(isset($_FILES["subirImgProducto"])){
				$slide->subirImgProducto = $_FILES["subirImgProducto"];
			}else{
				$slide->subirImgProducto = null;
			}
			$slide->titulo1 = $_POST["titulo1"];
			$slide->titulo2 = $_POST["titulo2"];
			$slide->titulo3 = $_POST["titulo3"];
			$slide->boton = $_POST["boton"];
			$slide->url = $_POST["url"];
			$slide->ajaxCambiarSlide();
		}
