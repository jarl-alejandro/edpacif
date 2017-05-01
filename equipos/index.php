<!DOCTYPE html>
<html lang="es">
<head>
  <title>Equipos | Edpacif</title>
  <?php 
    require '../head.php'; 
    include "../conexion/conexion.php";
    date_default_timezone_set('America/Guayaquil');
    $fecha = date("Y/m/d");
    $empleado = $_SESSION["f9f011a553550aef31a8ee2690e1d1b5f261c9ff"];
  ?>
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
            <h2 class="text-center no-margin title">Equipos</h2>
            <a class="btn btn-info btn-fab" id="form-btn">
              <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
            <div class="panel panel-site-traffic">
              <div class="table-responsive">
                <section class="cards-container"></section>
              </div><!-- table-responsive -->
            </div><!-- panel aqui-->

          </div><!-- col-md-9 -->
          <?php require "../asider.php" ?>
        </div><!-- col-md-12 -->
      </div><!-- col-md-12 -->
    </div><!-- row -->
  </section>

  <div class="col-xs-10 col-xs-offset-1 col-md-5 col-md-offset-3 panel-baja-equipo">
    <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title text-center">Baja de equipo</h3>
      </div>
      <article class="panel-body">
        <div class="col-xs-12 col-md-6">
          <div class="form-group">
            <label for="fecha" class="col-xs-10 control-label">Fecha</label>
            <div class="col-xs-10">
              <input type="text" class="form-control" id="fecha" disabled value="<?=$fecha?>">
            </div>
          </div>
        </div>
        
        <div class="col-xs-12 col-md-6">
          <div class="form-group">
            <label for="empl" class="col-xs-10 control-label">Elaborado por</label>
            <div class="col-xs-10">
              <input type="text" class="form-control" id="empl" disabled value="<?=$empleado?>">
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-md-6 col-md-offset-4">
          <input type="file" id='baja_pdf' style='display:none' accept="application/pdf">
          <label for="baja_pdf" class="btn btn-raised btn-warning ripple-effect">Subir PDF</label>
        </div>
        <div class="col-xs-12" style='display:flex;justify-content:space-around'>
          <button class="btn btn-raised btn-danger ripple-effect" id='cancelarBaja'>Cancelar</button>
          <button class="btn btn-raised btn-primary ripple-effect" id='aceptarBaja'>Aceptar</button>
        </div>
      </article>
    </div>
  </div>

  <section id="form-quipos" class="none" style="top:6em !important">
    <?php require "template/form.php" ?>
  </section>
  <script type="text/javascript" src="app/utils.js"></script>
  <?php
  require "../templates/alert.php";
  require "../templates/info.php";
  require "../scripts.php";
  ?>
  <!-- <script type="text/javascript" src="../assets/js/searchArticle.js"></script> -->
  <script type="text/javascript" src="../assets/js/pagingArticle.js"></script>
  <script type="text/javascript" src="app/buscador.js"></script>  

  <script type="text/javascript">
    var pagerInve = new Pager('Tab_FilterInventario', 3, 'inventario', 4);
    pagerInve.init();
    pagerInve.showPageNav('pagerInve', 'NavPosicionInventario');
    pagerInve.showPage(1);

    (function() {
      theTableInve = $("#Tab_FilterInventario");
      $("#searchInven").keyup(function() {
        $.articleBuscador(theTableInve, this.value, 4)
      })

      // theTableInve = $("#Tab_FilterInventario");
      // $("#searchInven").keyup(function() {
      //   $.articleBuscador(theTableInve, this.value, 4)
      // })

    })()
  </script>
</body>
</html>
