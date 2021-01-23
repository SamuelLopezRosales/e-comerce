<div class="content-wrapper">
    <section class="content-header">
      <h1>Gestor Comercio</h1>
    </section>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Gestor Comercio</li>
    </ol>

    <section class="content">
      <div class="row">
        <div class="col-md-6 col-xs-12">
          <!--===========================================
            BLOQUE 1
          ===========================================0=-->
          <?php
            /*=============================================
            ADMINISTRAR LOGOTIPO E ICONO
            ==============================================*/
            include "comercio/logotipo.php";
            include "comercio/colores.php";

             /*=============================================
            ADMINISTRAR REDES SOCIALES
            ==============================================*/
            include "comercio/redSocial.php";
          ?>
        </div>
        <div class="col-md-6 col-xs-12">
          <!--===========================================
            BLOQUE 2
          ===========================================0=-->
          <?php
            /*======================================
            ADMINISTRAR SCRIPTS
            ======================================*/
            include "comercio/codigos.php";
               /*======================================
            ADMINISTRAR INFORMACION COMERCIO
            ======================================*/
            include "comercio/informacion.php";
          ?>
        </div>
      </div>
    </section>
</div>