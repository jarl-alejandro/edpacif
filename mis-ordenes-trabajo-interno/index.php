<?php
  include "../conexion/conexion.php";
  date_default_timezone_set('America/Guayaquil');
  $hoy = date("Y/m/d");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Mis ordenes de trabajo interno | Edpacif</title>
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
            <h2 class="text-center no-margin title">Mis ordenes de trabajo interno</h2>
            <!-- panel-->
            <div class="panel panel-site-traffic">
              <div class="table-responsive" id="tableLayout">
                <section class="tabla-contianer"></section>
              </div>
              <div class="none form__layout">
                <?php require "template/form.php" ?>
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
  <script type="text/javascript" src="app/ordenesTrabajo.js"></script>
  <script type="text/javascript" src="app/buscador.js"></script>

  <!-- <script type="text/javascript" src="../assets/js/searchArticle.js"></script> -->
  <script type="text/javascript" src="../assets/js/pagingArticle.js"></script>

  <script type="text/javascript">
    var pagerInve = new Pager('Tab_FilterInventario', 3, 'inventario', 4);
    pagerInve.init();
    pagerInve.showPageNav('pagerInve', 'NavPosicionInventario');
    pagerInve.showPage(1);

    var pagerHerra = new Pager('Tab_FilterHermienta', 3, 'herramienta', 4);
    pagerHerra.init();
    pagerHerra.showPageNav('pagerHerra', 'NavPosicionHerramientas');
    pagerHerra.showPage(1);

    (function() {
      theTableInve = $("#Tab_FilterInventario");
      $("#searchInven").keyup(function() {
        $.articleBuscador(theTableInve, this.value, 4)
      })

      theTableHerr = $("#Tab_FilterHermienta");
      $("#searchHerr").keyup(function() {
        $.articleBuscador(theTableHerr, this.value, 4)
      })

    })()
  </script>
</body>
</html>
