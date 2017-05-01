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
  $(document).ready(function() {
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
					text: 'Estadistica stock de inventario'
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
								$aguajes = $pdo->query("SELECT * FROM sgmeinve");
								foreach ($aguajes as $row) { ?>
									{
										name: '<?=$row["einven_pro_einven"]?>',
										y: <?=$row["einven_cant_einven"]?>,
										sliced: true,
										selected: true
									},
								<?php  } ?>
						]

			}]
		});
	});
  
  </script>
</body>