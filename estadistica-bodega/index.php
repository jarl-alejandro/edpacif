<?php
 include "../conexion/conexion.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Inventario | EdPacif</title>
  <?php require '../head.php'; ?>
</head>

<body>
  <header>
    <?php include '../header.php'; ?>
  </header>
  <section>
    <div class="mainpanel">
      <div class="contentpanel">
        <div class="row">
          <div class="col-md-9 col-lg-8 dash-left">
            <h2 class="text-center no-margin title">Estadistica de Inventario</h2>
            <!-- panel-->
            <div class="panel panel-site-traffic">
              <div id="container"
                style="min-width: 310px; height: 400px; margin: 0 auto">
              </div>
            </div>
            <!-- /panel-->

          </div><!-- col-md-9 -->
          <?php require "../asider.php" ?>
        </div><!-- col-md-12 -->
      </div><!-- col-md-12 -->
    </div><!-- row -->
  </section>

  <?php
  require "../templates/alert.php";
  require "../templates/info.php";
  require "../scripts.php";
  ?>

  <script>
  // Create the chart
  Highcharts.chart('container', {
      chart: {
          type: 'column'
      },
      title: {
          text: 'Inventario'
      },
      subtitle: {
          text: ''
      },
      xAxis: {
          type: 'category'
      },
      yAxis: {
          title: {
              text: ''
          }

      },
      legend: {
          enabled: false
      },
      plotOptions: {
          series: {
              borderWidth: 0,
              dataLabels: {
                  enabled: true,
                  format: 'Cantidad {point.y}'
              }
          }
      },

      tooltip: {
          headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
          pointFormat: '<span style="color:{point.color}">{point.name}</span>: cantidad <b>{point.y}</b><br/>'
      },

      series: [{
          name: 'Inventario',
          colorByPoint: true,
          data: [
          <?php
          $qs = $pdo->query("SELECT * FROM v_ba_stock_inventario");
          while($inventario = $qs->fetch()) {
          ?>
            {
              name: '<?= $inventario["einven_pro_einven"] ?>',
              y: <?= $inventario["cant"] ?>,
              drilldown: 'Inventario'
            },
          <?php } ?>
          ]
      }]
  });
  </script>
</body>
