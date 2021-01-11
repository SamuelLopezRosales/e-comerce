<?php
  // evitar que me reporte el error
  error_reporting(0);
  $ventas = ControladorVentas::ctrMostrarVentas();
  /* Traer el total de ventas */
  $totalVentas = ControladorVentas::ctrMostrarTotalVentas();
  $arrayFechas = array();
  $arrayFechasPago = array();
  $totalPaypal = 0;
  $porcentajePaypal = 0;
  $totalPayu = 0;
  $porcentajePayu = 0;
  foreach ($ventas as $key => $value) {
    /* ===================================================
    SUMAR TOTAL COMPRADO CON PAYPAL
    ===================================================*/
    if($value["metodo"] == "paypal"){

      $totalPaypal += $value["pago"];
      $porcentajePaypal = $totalPaypal * 100 /  $totalVentas["total"];
    }

    /* ===================================================
    SUMAR TOTAL COMPRADO CON PAYPAL
    ===================================================*/
    if($value["metodo"] == "payu"){

      $totalPayu += $value["pago"];
      $porcentajePayu = $totalPayu * 100 /  $totalVentas["total"];
    }

    /*=================================================
    GRAFICA DE LINEAS
    =================================================*/
    if($value["metodo"] != "gratis"){
      $fecha = substr($value["fecha"], 0,7);
      array_push($arrayFechas, $fecha);
      /* poner las fechas y los pagos en un mismo array */
      $arrayFechasPago = array($fecha => $value["pago"]);
      // sumamos los pagos que ocurrieron el mismo mes
      foreach ($arrayFechasPago as $key => $value) {
        #  cuando te encuentres un indice repetido incrementa su valor
        $sumaPagoMes[$key] += $value;
      }
    }
  }




  // evitar que se repitan fechas
  $noRepetirFechas = array_unique($arrayFechas);
 ?>
<!-- SOLID SALES GRAPH -->
<div class="box box-solid bg-teal-gradient">
	<!-- box-header -->
	<div class="box-header">
		 <i class="fa fa-th"></i>
		  <h3 class="box-title">Gráfico de ventas</h3>

		  <div class="box-tools pull-right">
		  	 <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
		  </div>
	</div>
	<!-- termina box -header -->

	<!-- box body -->
	<div class="box-body border-radius-none">
        <div class="chart" id="line-chart" style="height: 250px;"></div>
     </div>
	<!-- Termina el box-body -->

	<!-- Box-footer -->
	<div class="box-footer no-border">
		<div class="row">
                <div class="col-xs-6 text-center" style="border-right: 1px solid #f4f4f4">
                  <input type="text" class="knob" data-readonly="true" value="<?php echo round($porcentajePaypal); ?>" data-width="60" data-height="60"
                         data-fgColor="#39CCCC">

                  <div class="knob-label">Paypal</div>
                </div>
                <!-- ./col -->
                <div class="col-xs-6 text-center" style="border-right: 1px solid #f4f4f4">
                  <input type="text" class="knob" data-readonly="true" value="<?php echo round($porcentajePayu); ?>" data-width="60" data-height="60"
                         data-fgColor="#39CCCC">

                  <div class="knob-label">Payu</div>
                </div>
                <!-- ./col -->
                <!-- ./col -->
              </div>
              <!-- /.row -->
	</div>
	<!-- Termina el box-footer -->
</div>

<script>
	var line = new Morris.Line({
    element          : 'line-chart',
    resize           : true,
    data             : [
      <?php
        foreach ($noRepetirFechas as $value) {
          # code...
          echo "{ y: '".$value."', ventas: ".$sumaPagoMes[$value]." },";
        }
        echo "{ y: '".$value."', ventas: ".$sumaPagoMes[$value]." }";
      ?>
    ],
    xkey             : 'y',
    ykeys            : ['ventas'],
    labels           : ['ventas'],
    lineColors       : ['#efefef'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    preUnits         : '$',
    gridTextSize     : 10
  });
</script>