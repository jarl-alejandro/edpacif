<?php
  include "../conexion/conexion.php";
  date_default_timezone_set('America/Guayaquil');
  $hoy = date("Y/m/d");

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Reporte de ordenes de trabajo interno por fecha | Edpacif</title>
  <?php require '../head.php'; ?>
</head>

<body>
  <input type="hidden" value="<?= $hoy ?>" id="DateMin">
  <header>
    <?php include '../header.php'; ?>
  </header>
  <section>
    <div class="mainpanel">
      <div class="contentpanel">
        <div class="row">
          <div class="col-md-9 col-lg-8 dash-left">
            <h2 class="text-center no-margin title">Reporte de ordenes de trabajo interno por fecha</h2>
            <a class="btn btn-info btn-fab btn-raised center middle" id="form-btn">
              <i class="fa fa-clock-o" aria-hidden="true"></i>
            </a>
            <!-- panel-->
            <div class="panel panel-site-traffic">
              <div class="table-responsive" id="tableLayout">
                <section class="tabla-contianer"></section>
              </div>
              <!-- Formulario -->
            </div>
            <!-- /panel-->

          </div>
          <?php require "../asider.php" ?>
        </div>
      </div>
    </div>
  </section>

  <div class="panel panel-success col-xs-6" id="panel-orden-fecha">
    <div class="panel-heading">
      <h3 class="panel-title text-center">Ordenes por fecha y empleado</h3>
    </div>
    <div class="panel-body">
      <form>
        <div class="col-xs-10 col-md-6">
          <input type="text" class="form-control datepicker" id="inicio-fecha" 
                placeholder="Ingrese el inicio de fecha">
        </div>
        <div class="col-xs-12 col-md-6">
          <input type="text" class="form-control datepicker" id="fin-fecha" 
            placeholder="Ingrese el final de fecha">
        </div>

        <div class="col-xs-12 col-md-6 col-md-offset-3">
          <select class="form-control" id="employee-fecha">
            <option value="">Ingrese el empleado</option>
            <?php
            $empleados = $pdo->query("SELECT * FROM sgmeempl");
            while($empleado = $empleados->fetch()){ ?>
            <option value="<?=$empleado["eempl_ced_eempl"]?>">
             <?= $empleado["eempl_nom_eempl"]." ".$empleado["eempl_ape_eempl"] ?>
            </option>
          <?php } ?>
          <select>
        </div>
     
        <div class="col-xs-12 center">
          <button class="btn btn-raised btn-danger" style="magin-rigth:4px;" id="cerrar-fecha">Cerrar</button>
          <button class="btn btn-raised btn-success" id="acept-fecha">Aceptar</button>
        </div>
      </form>
    </div>
  </div>

  <?php
  require "../templates/alert.php";
  require "../templates/info.php";
  require "../scripts.php";
  ?>
</body>
</html>