<?php
include "../conexion/conexion.php";

$equipo = $_GET["equipo"];
$inicio = $_GET["inicio"];
$fin = $_GET["fin"];

$equipos = $pdo->query("SELECT * FROM sgmeorex WHERE eorex_equ_eorex='$equipo'
      AND eorex_fet_eorex BETWEEN '$inicio' AND '$fin'");

$query = $pdo->query("SELECT * FROM smgeequi WHERE eequi_cod_eequi='$equipo'");
$fetch = $query->fetch();

$meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
$dias = array('Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo');

?>
<div id="container"
    style="min-width: 310px; height: 400px; margin: 0 auto">
</div>
<div class="col-xs-12 center">
  <button class="btn btn-raised-btn-danger" style="background:#E53935;color:white;" id="closeEstadistica">Cerrar</button>
</div>
<script>
// Create the chart
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Mantenimiento'
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
                format: 'Mantenimiento {point.y}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: Mantenimiento <b>{point.y}</b><br/>'
    },

    series: [{
        name: 'Aguaje',
        colorByPoint: true,
        data: [
        <?php
        $index = 0;
        while($equipo = $equipos->fetch()) {
          $index++;
          $mesStart = date("n", strtotime($equipo["eorex_fet_eorex"])) - 1;
          $dayStart = date("d", strtotime($equipo["eorex_fet_eorex"]));
          $dayNameStart = date("N", strtotime($equipo["eorex_fet_eorex"])) - 1;
          $yearStart = date("y", strtotime($equipo["eorex_fet_eorex"]));

          $dateStart = $dias[$dayNameStart] ." ". $dayStart ." de ". $meses[$mesStart] ." del ". $yearStart;
        ?>
          {
            name: 'Fecha <?= $dateStart ?>',
            y: <?= $index ?>,
            drilldown: 'Mantenimiento'
          },
        <?php } ?>
        ]
    }]
});
</script>
