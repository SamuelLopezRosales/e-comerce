 <!-- MODULO HEADER -->
 <header class="main-header">
 	<!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="vistas/img/plantilla/icono.png" class="img-responsive" style="padding: 10px; filter: contrast(200%);"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="vistas/img/plantilla/logo.png" class="img-responsive" style="padding: 10px 30px; filter: contrast(200%);"></span>
    </a>
    <!-- Logo -->

     <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
    	<!-- Sidebar toggle button-->
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <!-- navbar custonmenu -->
       <div class="navbar-custom-menu">
       		<ul class="nav navbar-nav">
       			<?php
       				include "cabezote/notificaciones.php";
       				include "cabezote/usuario.php";
       			?>
       		</ul>
       </div>
    </nav>
 </header>
 <!-- FIN DEL MODULO DE HEADER -->