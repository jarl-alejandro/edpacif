<?php
 include "../conexion/conexion.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Estadistica de tareas | EdPacif</title>
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
            <h2 class="text-center no-margin title">Estadistica de tareas</h2>
            <div class="panel panel-site-traffic" id="estadistica-container"></div>
              <div class="panel panel-success" id="estadistica-form">
                <div class="panel-heading">
                  <h3 class="panel-title text-center">Estadistica de tareas</h3>
                </div>
                <div class="panel-body">
                  <form>
                    <div class="col-xs-12">
                      <select class="form-control" id="equipo-select">
                        <option value="" select>Ingrese el equipo</option>
                        <?php
                        $equipos = $pdo->query("SELECT * FROM smgeequi");
                        while($row = $equipos->fetch()){ ?>
                        <option value="<?=$row['eequi_cod_eequi'];?>"><?=$row["eequi_det_eequi"]?></option>
                        <?php } ?>
                      </select>
                    </div>

                    <div class="col-xs-10 col-md-6">
                      <input type="text" class="form-control datepicker" id="inicio-fecha"
                            placeholder="Ingrese el inicio de fecha">
                    </div>
                    <div class="col-xs-12 col-md-6">
                      <input type="text" class="form-control datepicker" id="fin-fecha"
                        placeholder="Ingrese el final de fecha">
                    </div>

                    <div class="col-xs-12 center">
                      <button class="btn btn-raised btn-danger" style="margin-right:.5em;" id="cerrar-fecha">Cerrar</button>
                      <button class="btn btn-raised btn-success" id="acept-fecha">Aceptar</button>
                    </div>
                  </form>
                </div>
              </div>
          </div>
          <?php require "../asider.php" ?>
        </div>
      </div>
    </div>
  </section>
  <?php
    require "../templates/alert.php";
    require "../templates/info.php";
    require "../scripts.php";
  ?>
</body>
