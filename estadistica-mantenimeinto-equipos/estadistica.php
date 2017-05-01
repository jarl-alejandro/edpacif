<?php
include "../conexion/conexion.php";

$equipo = $_GET["equipo"];
$inicio = $_GET["inicio"];
$fin = $_GET["fin"];

$equipos = $pdo->query("SELECT * FROM sgmeorin WHERE eorin_equ_eorin='$equipo' 
      AND eorin_fet_eorin BETWEEN '$inicio' AND '$fin'");

$query = $pdo->query("SELECT * FROM smgeequi WHERE eequi_cod_eequi='$equipo'");
$fetch = $query->fetch();

?>
<div id="container" 
    style="min-width: 310px; height: 400px; margin: 0 auto">
</div>
<div class="col-xs-12 center">
  <button class="btn btn-raised-btn-danger" style="background:#E53935;color:white;" id="closeEstadistica">Cerrar</button>
</div>
<script>
$(document).ready(function() {
    $("#closeEstadistica").on("click", function () {
        $("#estadistica-form").slideDown()
        $("#estadistica-container").slideUp()
    })

  Highcharts.chart('container', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {
        text: 'EQUIPO: <?= $fetch["eequi_det_eequi"] ?>, DESDE: <?=$inicio?> HASTA: <?=$fin?>'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }
    },
    series: [{
        type: 'pie',
        name: 'Equipo',
        data: [
          <?php
          $index = 0;
          while($equipo = $equipos->fetch()){ 
            $index++; ?>
            {
                name: "fecha: <?= $equipo['eorin_fet_eorin'] ?>",
                y: <?= $index ?>,
                sliced: true,
                selected: true
            }

          <?php } ?>
        ]
    }]
	});

})
</script>