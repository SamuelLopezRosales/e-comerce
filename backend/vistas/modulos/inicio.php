 <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tablero
        <small>Panel de control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Tablero</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- PRIMERA FILA CAJAS SUPERIORES  -->
      <div class="row">
        <?php
          include "inicio/cajas-superiores.php";
        ?>
      </div>
      <!-- SEGUNDA FILA -->
      <div class="row">
        <!-- GRAFICOS  y ventas -->
        <div class="col-lg-6">
          <?php
            include "inicio/grafico-ventas.php";
            include "inicio/productos-mas-vendidos.php";
          ?>
        </div>
        <!-- MAPA -->
        <div class="col-lg-6">
          <?php
            include "inicio/grafico-visitas.php";
            include "inicio/ultimos-usuarios.php";
          ?>
        </div>
        <!-- FILA PRODUCTOS MAS RECIENTES -->
        <div class="col-lg-12">
          <?php
            include "inicio/productos-recientes.php";
          ?>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

