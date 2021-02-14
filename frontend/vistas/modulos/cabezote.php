<!--=====================================
TOP
======================================-->
<?php
	$servidor = Ruta::ctrRutaServidor();
	$url = Ruta::ctrRuta();

/*=============================================
INICIO DE SESIÓN USUARIO
=============================================*/

if(isset($_SESSION["validarSesion"])){

  if($_SESSION["validarSesion"] == "ok"){

    echo '<script>

      localStorage.setItem("usuario","'.$_SESSION["id"].'");

    </script>';

  }

}

  /* =======================================================
  CREAR EL OBJETO DE LA API DE GOOGLE
  =======================================================*/

$cliente = new Google_Client();
$cliente->setAuthConfig('modelos/client_secret.json');
$cliente->setAccessType("offline");
$cliente->setScopes(['profile','email']);

  /*=============================================================
  RUTA PARA EL LOGIN DE GOOGLE
  ============================================================*/
  $rutaGoogle = $cliente->createAuthUrl();

  /*==============================================================
  RECIBIMOS LA VARIABLE GET DE GOOGLE LLAMADA CODE
  ===============================================================*/
if(isset($_GET["code"])){

  $token = $cliente->authenticate($_GET["code"]);

  $_SESSION['id_token_google'] = $token;

  $cliente->setAccessToken($token);

}

  /*====================================================================
  RECIBIMOS LOS DATOS CIFRADOS DE GOOGLE EN UN ARRAY
  =====================================================================*/
  if($cliente->getAccessToken()){

  $item = $cliente->verifyIdToken();



 $datos = array("nombre"=>$item["name"],
           "email"=>$item["email"],
           "foto"=>$item["picture"],
           "password"=>"null",
           "modo"=>"google",
           "verificacion"=>0,
           "emailEncriptado"=>"null");


  $respuesta = ControladorUsuarios::ctrRegistroRedesSociales($datos);

 echo '<script>

  setTimeout(function(){

    window.location = localStorage.getItem("rutaActual");

  },1000);

  </script>';

}
?>



<div class="container-fluid barraSuperior" id="top">

	<div class="container">

		<div class="row">

			<!--=====================================
			SOCIAL
			======================================-->

			<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 social">

				<ul>
					<?php
					$social = ControladorPlantilla::ctrEstiloPlantilla();

					$jsonRedesSociales = json_decode($social["redesSociales"],true);

					foreach ($jsonRedesSociales as $key => $value) {
            if($value["activo"] != 0){
						echo '<li>
								<a href="'.$value["url"].'" target="_blank">
									<i class="fa '.$value["red"].' '.$value["estilo"].' redSocial"></i>
								</a>
							</li>';
            }
					}
					?>



				</ul>

			</div>

			<!--=====================================
			REGISTRO
			======================================-->

			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 registro">

				<ul>
					<?php
						if(isset($_SESSION["validarSesion"])){
							if($_SESSION["validarSesion"] == "ok"){
								if($_SESSION["modo"] == "directo"){
									if($_SESSION["foto"] != ""){
										echo '<li>
											<img class="img-circle" src="'.$url.$_SESSION["foto"].'" width="10%">
										</li>';
									}else{
										echo '<li>
											<img class="img-circle" src="'.$servidor.'vistas/img/usuarios/default/anonymous.png" width="10%">
										</li>';
									}
                  echo '<li>|</li>
                    <li><a href="'.$url.'perfil">Ver perfil</a></li>
                    <li>|</li>
                    <li><a href="'.$url.'salir">Salir</a></li>';

								}if($_SESSION["modo"] == "facebook"){
                  echo '<li>
                      <img class="img-circle" src="'.$_SESSION["foto"].'" width="10%">
                    </li>
                    <li>|</li>
                    <li><a href="'.$url.'perfil">Ver perfil</a></li>
                    <li>|</li>
                    <li><a href="'.$url.'salir" class="salir">Salir</a></li>';
                }if($_SESSION["modo"] == "google"){
                  echo '<li>
                      <img class="img-circle" src="'.$_SESSION["foto"].'" width="10%">
                    </li>
                    <li>|</li>
                    <li><a href="'.$url.'perfil">Ver perfil</a></li>
                    <li>|</li>
                    <li><a href="'.$url.'salir">Salir</a></li>';
                }
}

						}else{
							echo '<li><a class="btnIngresar" href="#modalIngreso" data-toggle="modal">Ingresar</a></li>
								  <li>|</li>
								  <li><a class="btnRegistrarse" href="#modalRegistro" data-toggle="modal">Crear una cuenta</a></li>';
						}
					?>
				</ul>

			</div>

		</div>

	</div>

</div>

<!--=====================================
HEADER
======================================-->

<header class="container-fluid">

	<div class="container">

		<div class="row" id="cabezote">

			<!--=====================================
			LOGOTIPO
			======================================-->

			<div class="col-lg-3 col-md-3 col-sm-2 col-xs-12" id="logotipo">

				<a href="<?php echo $url; ?>">

					<img src="<?php echo $servidor.$social["logo"]; ?>" class="img-responsive">

				</a>

			</div>

			<!--=====================================
			BLOQUE CATEGORÍAS Y BUSCADOR
			======================================-->

			<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">

				<!--=====================================
				BOTÓN CATEGORÍAS
				======================================-->

				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 backColor" id="btnCategorias">

					<p>CATEGORÍAS

						<span class="pull-right">
							<i class="fa fa-bars" aria-hidden="true"></i>
						</span>

					</p>

				</div>

				<!--=====================================
				BUSCADOR
				======================================-->

				<div class="input-group col-lg-8 col-md-8 col-sm-8 col-xs-12" id="buscador">

					<input type="search" name="buscar" class="form-control input-lg" placeholder="Buscar...">

					<span class="input-group-btn">

						<a href="<?php echo $url; ?>buscador/1/recientes">

							<button class="btn btn-default backColor" type="submit">

								<i class="fa fa-search"></i>

							</button>

						</a>

					</span>

				</div>

			</div>

			<!--=====================================
			CARRITO DE COMPRAS
			======================================-->

			<div class="col-lg-3 col-md-3 col-sm-2 col-xs-12" id="carrito">

				<a href="<?php echo $url.'carrito-de-compras' ?>">

					<button class="btn btn-default pull-left backColor">

						<i class="fa fa-shopping-cart" aria-hidden="true"></i>

					</button>

				</a>

				<p>TU CESTA <span class="cantidadCesta"></span> <br> USD $ <span class="sumaCesta"></span></p>

			</div>

		</div>

		<!--=====================================
		CATEGORÍAS
		======================================-->

		<div class="col-xs-12 backColor" id="categorias">
			<?php

					$item = null;
					$valor = null;
					$categorias = ProductoControlador::ctrMostrarCategorias($item,$valor);
					foreach ($categorias as $key => $value) {
            if($value["estado"] != 0){
						# code...
						echo '<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
						<h4>
							<a href="'.$url.$value["ruta"].'" class="pixelCategorias">'.$value["categoria"].'</a>
						</h4>

				<hr>

				<ul>';

				$item = "id_categoria";
				$valor = $value["id"];

				$subCategorias = ProductoControlador::ctrMostrarSubCategorias($item,$valor);

				foreach ($subCategorias as $key => $value) {
          if($value["estado"] != 0){
					echo '<li><a href="'.$url.$value["ruta"].'" class="pixelSubCategorias">'.$value["subcategoria"].'</a></li>';
          }
				}


				echo '
				</ul>

			</div>';
    }

					}

				?>

		</div>

	</div>

</header>


<!-- =================================================================
	MODAL REGISTRO
=====================================================================-->
 <!-- The Modal -->
  <div class="modal fade modalFormulario" id="modalRegistro">
    <div class="modal-dialog modal-content">

        <!-- Modal body -->
        <div class="modal-body modalTitulo">
          <h3 class="backColor">REGISTRARSE</h3>
          <button type="button" class="close" data-dismiss="modal">×</button>

          <!-- =============================================================
          	REGISTRO FACEBOOK
          =================================================================-->
          <div class="col-sm-6 col-xs-12 facebook">
          	<p>
          		<i class="fa fa-facebook"></i>
          		Registro con Facebook
          	</p>
          </div>

          <!-- =============================================================
          	REGISTRO GOOGLE
          =================================================================-->
          <a href="<?php echo $rutaGoogle; ?>">
          <div class="col-sm-6 col-xs-12 google">
          	<p>
          		<i class="fa fa-google"></i>
          		Registro con Google
          	</p>
          </div>
          </a>

           <!-- =============================================================
          	REGISTRO DIRECTO
          =================================================================-->
          <!-- onsubmit="return registroUsuario()"-->
          <form method="POST" onsubmit="return registroUsuario()">
          	<hr>
          	<div class="form-group">
          		<div class="input-group">
          			<span class="input-group-addon">
          				<i class="glyphicon glyphicon-user"></i>
          			</span>
          			<input type="text" class="form-control input-lg" id="regUsuario" name="regUsuario" placeholder="Nombre completo" required>
          		</div>
          	</div>

          		<div class="form-group">
          			<div class="input-group">
          			<span class="input-group-addon">
          				<i class="glyphicon glyphicon-envelope"></i>
          			</span>
          			<input type="email" class="form-control input-lg" id="regEmail" name="regEmail" placeholder="Correo Electrónico" required>
          		</div>
          	</div>

          	<div class="form-group">
          			<div class="input-group">
          			<span class="input-group-addon">
          				<i class="glyphicon glyphicon-lock"></i>
          			</span>
          			<input type="password" class="form-control input-lg" id="regPassword" name="regPassword" placeholder="Contraseña" required>
          		</div>
          	</div>

          	<div class="checkBox">
          	<label>
          		<input id="regPoliticas" type="checkbox">
          		<small>

          			Al registrarse, usted acepta nuestras condiciones de uso y políticas de privacidad
          			<br>

          			<a href="https://www.iubenda.com/privacy-policy/14529324" class="iubenda-white iubenda-embed" title="Condiciones de uso y politicas de privacidad.">Leer más</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>

          		</small>
          	</label>
          </div>
          <?php
          	 $usuarioControlador = new ControladorUsuarios();
          	 $usuarioControlador->ctrRegistroUsuario();

          ?>
          <input type="submit" class="btn btn-default backColor btn-block" value="ENVIAR">
          </form>



        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <!--<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>-->
          ¿Ya tienes una cuenta registrada? | <strong><a href="#modalIngreso" data-dismiss="modal" data-toggle="modal">Ingresar</a></strong>
        </div>
    </div>
  </div>



<!-- =================================================================
	MODAL INGRESO
=====================================================================-->
 <!-- The Modal -->
  <div class="modal fade modalFormulario" id="modalIngreso">
    <div class="modal-dialog modal-content">

        <!-- Modal body -->
        <div class="modal-body modalTitulo">
          <h3 class="backColor">INGRESAR</h3>
          <button type="button" class="close" data-dismiss="modal">×</button>

          <!-- =============================================================
          	REGISTRO FACEBOOK
          =================================================================-->
          <div class="col-sm-6 col-xs-12 facebook">
          	<p>
          		<i class="fa fa-facebook"></i>
          		Ingreso con Facebook
          	</p>
          </div>

          <!-- =============================================================
          	REGISTRO GOOGLE
          =================================================================-->
          <a href="<?php echo $rutaGoogle; ?>">
          <div class="col-sm-6 col-xs-12 google">
          	<p>
          		<i class="fa fa-google"></i>
          		Ingreso con Google
          	</p>
          </div>
        </a>

           <!-- =============================================================
          	REGISTRO DIRECTO
          =================================================================-->
          <!-- onsubmit="return registroUsuario()"-->
          <form method="POST">
          	<hr>

          		<div class="form-group">
          			<div class="input-group">
          			<span class="input-group-addon">
          				<i class="glyphicon glyphicon-envelope"></i>
          			</span>
          			<input type="email" class="form-control input-lg" id="ingEmail" name="ingEmail" placeholder="Correo Electrónico" required>
          		</div>
          	</div>

          	<div class="form-group">
          			<div class="input-group">
          			<span class="input-group-addon">
          				<i class="glyphicon glyphicon-lock"></i>
          			</span>
          			<input type="password" class="form-control input-lg" id="ingPassword" name="ingPassword" placeholder="Contraseña" required>
          		</div>
          	</div>
          <?php
          	 $usuarioControlador = new ControladorUsuarios();
          	 $usuarioControlador->ctrIngresoUsuario();

          ?>
          <input type="submit" class="btn btn-default backColor btn-block btnIngreso input-lg" value="ENVIAR">
          <br>
          <center>
            <a href="#modalPassword" data-dismiss="modal" data-toggle="modal">¿Olvidaste tu contraseña?
          </center>
          </form>



        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <!--<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>-->
          ¿No tienes una cuenta? | <strong><a href="#modalRegistro" data-dismiss="modal" data-toggle="modal">Registrate aquí</a></strong>
        </div>
    </div>
  </div>


<!-- =====================================================================
  MODAL RECUPERAR CONTRASEÑA
=========================================================================-->
<!-- The Modal -->
  <div class="modal fade modalFormulario" id="modalPassword">
    <div class="modal-dialog modal-content">

        <!-- Modal body -->
        <div class="modal-body modalTitulo">
          <h3 class="backColor">RECUPERAR CONTRASEÑA</h3>
          <button type="button" class="close" data-dismiss="modal">×</button>


           <!-- =============================================================
            REGISTRO DIRECTO
          =================================================================-->
          <!-- onsubmit="return registroUsuario()"-->
          <form method="POST">
            <label class="text-muted">Escribe tu correo electrónico con que estas registrado y allí te enviaremos una nueva contraseña:</label>


              <div class="form-group">
                <div class="input-group">
                <span class="input-group-addon">
                  <i class="glyphicon glyphicon-envelope"></i>
                </span>
                <input type="email" class="form-control input-lg" id="passEmail" name="passEmail" placeholder="Correo Electrónico" required>
              </div>
            </div>

          <?php
             $usuarioControlador = new ControladorUsuarios();
             $usuarioControlador->ctrOlvidoPassword();

          ?>
          <input type="submit" class="btn btn-default backColor btn-block input-lg" value="ENVIAR">

          </form>



        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <!--<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>-->
          ¿No tienes una cuenta? | <strong><a href="#modalRegistro" data-dismiss="modal" data-toggle="modal">Registrate aquí</a></strong>
        </div>
    </div>
  </div>





