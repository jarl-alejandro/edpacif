<?php
  include "../conexion/conexion.php";
  $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
  $dias = array('Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo');
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
// Create the chart
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Aguajes'
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
                format: 'dias {point.y}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: dias <b>{point.y}</b><br/>'
    },

    series: [{
        name: 'Aguaje',
        colorByPoint: true,
        data: [
        <?php
        $qs = $pdo->query("SELECT * FROM sgmeagua");
        while($aguaje = $qs->fetch()) {
          $mesStart = date("n", strtotime($aguaje["eagua_ini_eagua"])) - 1;
          $dayStart = date("d", strtotime($aguaje["eagua_ini_eagua"]));
          $dayNameStart = date("N", strtotime($aguaje["eagua_ini_eagua"])) - 1;
          $yearStart = date("y", strtotime($aguaje["eagua_ini_eagua"]));

          $mesEnd = date("n", strtotime($aguaje["eagua_fin_eagua"])) - 1;
          $dayEnd = date("d", strtotime($aguaje["eagua_fin_eagua"]));
          $dayNameEnd = date("N", strtotime($aguaje["eagua_fin_eagua"])) - 1;
          $yearEnd = date("y", strtotime($aguaje["eagua_fin_eagua"]));

          $dateStart = $dias[$dayNameStart] ." ". $dayStart ." de ". $meses[$mesStart] ." del ". $yearStart;
          $dateEnd = $dias[$dayNameEnd] ." ". $dayEnd ." de ". $meses[$mesEnd] ." del ". $yearEnd;
          $inicio = new DateTime($aguaje["eagua_ini_eagua"]);
          $fin = new DateTime($aguaje["eagua_fin_eagua"]);

          $interval = $inicio->diff($fin);
          $total = $interval->format('%a');
        ?>
          {
            name: 'Desde <?= $dateStart ?>, Hasta <?= $dateEnd ?>',
            y: <?= $total ?>,
            drilldown: 'Aguaje'
          },
        <?php } ?>
        ]
    }]
});
</script>
</body>
