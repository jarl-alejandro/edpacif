<?php
 include "../conexion/conexion.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Aguajes | EdPacif</title>
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
            <h2 class="text-center no-margin title">Estadistica de Aguaje</h2>
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
  $(function () {
      Highcharts.chart('container', {
          chart: {
              type: 'spline'
          },
          title: {
              text: 'Aguajes'
          },
          subtitle: {
              text: ''
          },
          xAxis: {
              categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                  'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
          },
          yAxis: {
              title: {
                  text: 'Aguajes'
              },
              labels: {
                  formatter: function () {
                      return this.value + '°';
                  }
              }
          },
          tooltip: {
              crosshairs: true,
              shared: true
          },
          plotOptions: {
              spline: {
                  marker: {
                      radius: 4,
                      lineColor: '#666666',
                      lineWidth: 1
                  }
              }
          },
          series: [{
              name: 'Aguaje',
              marker: {
                  symbol: 'diamond'
              },
              data: [{
                  y: 3.9,
                  marker: {
                      symbol: 'url(https://www.highcharts.com/samples/graphics/snow.png)'
                  }
              }, 
              <?php 
                $aguajes = $pdo->query("SELECT * FROM sgmeagua");
                foreach ($aguajes as $row) {
                  echo $row['eagua_ini_eagua'].",";
                }
              ?>
              ]
          }]
      });
  });   
  </script>
</body>
