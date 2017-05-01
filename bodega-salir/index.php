<?php include "../conexion/conexion.php";?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Bodega | EdPacif</title>
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
            <h2 class="text-center no-margin title">Bodega</h2>
            <a class="btn btn-info btn-fab" id="form-btn">
              <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
            <div class="panel panel-site-traffic">
              <div class="table-responsive">
                <section class="cards-container"></section>

                <div class="center top-space">
                  <button class="btn btn-danger btn-stroke btn-icon">
                    <i class="fa fa-fast-backward" aria-hidden="true"></i>
                  </button>
                  <button class="btn btn-danger btn-stroke btn-icon">
                    <i class="fa fa-fast-forward"></i>
                  </button>
                </div>

              </div><!-- table-responsive -->
            </div><!-- panel aqui-->

          </div><!-- col-md-9 -->
          <?php require "../asider.php" ?>
        </div><!-- col-md-12 -->
      </div><!-- col-md-12 -->
    </div><!-- row -->
  </section>

  <section id="form-quipos" class="none">
    <?php require "template/form.php" ?>
  </section>
  <script type="text/javascript" src="app/utils.js"></script>
  <?php
  require "../templates/alert.php";
  require "../templates/info.php";
  require "../scripts.php";
  ?>
</body>
</html>
