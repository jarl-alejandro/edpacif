<?php include "../conexion/conexion.php";?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Equipo de baja | Edpacif</title>
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
            <h2 class="text-center no-margin title">Equipo de baja</h2>
            <div class="panel panel-site-traffic">
              <div class="table-responsive">
                <section class="tabla-contianer"></section>
              </div><!-- table-responsive -->
            </div><!-- panel aqui-->

          </div><!-- col-md-9 -->
          <?php require "../asider.php" ?>
        </div><!-- col-md-12 -->
      </div><!-- col-md-12 -->
    </div><!-- row -->
  </section>

  <section id="form-conatiner" class="none">
  </section>
  <?php
    require "../templates/alert.php";
    require "../templates/info.php";
    require "../scripts.php";
  ?>
</body>
</html>
