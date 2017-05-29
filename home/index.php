<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Inicio | Edpacif</title>
  <?php
    require '../head.php';
    include "../conexion/conexion.php";
    date_default_timezone_set('America/Guayaquil');
		$fecha = date("d/m/Y");

    $empleado = $_SESSION["f9f011a553550aef31a8ee2690e1d1b5f261c9ff"];
  ?>
  <style>
	  .form__layout{
	  	background: white;
	    box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
	    padding: .5em;
	    height: 100%;
	    display: flex;
	    flex-wrap: wrap;
	    align-items: center;
	  }
  </style>
</head>
<body>
  <header>
    <?php include '../header.php'; ?>
    <link rel="stylesheet" href="css/card.css">
  </header>
    <section>
    <div class="mainpanel">
      <div class="contentpanel">
        <div class="row">
          <div class="col-md-9 col-lg-8 dash-left">
            <h2 class="text-center no-margin title">INICIO</h2>
            <!-- panel-->
            <div class="panel panel-site-traffic">
              <div class="LayoutHome col-xs-12">
              	<?php require "cards.php" ?>
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
</body>
</html>