<?php
  $usuarios = ControladorUsuarios::ctrMostrarTotalUsuarios("fecha");
  $ruta = Ruta::ctrRuta();
  $rutaServidor = Ruta::ctrRutaServidor();
?>
<div class="box box-danger">
	<div class="box-header with-border">
		<h3 class="box-title">Últimos usuarios registrados</h3>
		<div class="box box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		</div>
	</div>
	<div class="box-body no-padding">
		<ul class="users-list clearfix">
        <?php
          $totalUsuarios = 8;
        if(count($usuarios) > 8){
          $totalUsuarios = 8;
        }else{
          $totalUsuarios = count($usuarios);
        }
          for($i=0; $i<$totalUsuarios; $i++){
            if($usuarios[$i]["modo"] != "directo"){
              echo '<li>
                      <img src="'.$usuarios[$i]["foto"].'" alt="User Image" style="width:70%;">
                      <a class="users-list-name" href="">'.$usuarios[$i]["nombre"].'</a>
                      <span class="users-list-date">'.$usuarios[$i]["fecha"].'</span>
                    </li>';

            }else{
                if($usuarios[$i]["foto"] != ""){
                  echo '<li>
                      <img src="'.$ruta.$usuarios[$i]["foto"].'" alt="User Image" style="width:70%;">
                      <a class="users-list-name" href="">'.$usuarios[$i]["nombre"].'</a>
                      <span class="users-list-date">'.$usuarios[$i]["fecha"].'</span>
                    </li>';
                }else{
                  echo '<li>
                      <img src="'.$rutaServidor.'vistas/img/usuarios/default/anonymous.png" alt="User Image" style="width:70%;">
                      <a class="users-list-name" href="">'.$usuarios[$i]["nombre"].'</a>
                      <span class="users-list-date">'.$usuarios[$i]["fecha"].'</span>
                    </li>';
                }
            }
          }
        ?>

                  </ul>
                  <!-- /.users-list -->
	</div>
	<!-- termina box-body -->
	<div class="box-footer text-center">
		<a href="javasript:void(0)" class="uppercase">Ver todos los usuarios</a>
	</div>
</div>