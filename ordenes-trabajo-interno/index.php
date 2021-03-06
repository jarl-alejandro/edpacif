<?php
  include "../conexion/conexion.php";
  date_default_timezone_set('America/Guayaquil');
  $hoy = date("Y/m/d");
  $fecha = date("d/m/Y");
  if (isset($_GET["open"])) {
    $open = $_GET["open"];
    $codigo = $_GET["codigo"];
  } else{
    $open = 0;
    $codigo = 0;
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Ordenes de trabajo interno | Edpacif</title>
  <?php require '../head.php'; ?>
  <style>
    .scroll{
      overflow-y: scroll;
      height: 20em;
      width: 100%;
    }
  </style>
</head>
<body>
  <input type="hidden" value="<?= $open ?>" id="openedOrdenHome" />
  <input type="hidden" value="<?= $codigo ?>" id="codeOrdenHome" />
  <input type="hidden" id="id_orden">
  <header>
    <?php include '../header.php'; ?>
    <style>
    #Tab_FilterHermienta, #Tab_FilterInventario{
      height: 25em;
      overflow-y: scroll;
    }
    </style>
  </header>
  <section>
    <div class="mainpanel">
      <div class="contentpanel">
        <div class="row">
          <div class="col-md-9 col-lg-8 dash-left">
            <h2 class="text-center no-margin title">Ordenes de trabajo interno</h2>
            <a class="btn btn-info btn-fab" id="form-btn">
              <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
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

  <section class="col-xs-10 col-xs-offset-1 col-md-4 col-md-offset-3 notifications">
    <header class="notifications__header">
      <h3>Tienes pedidos pendientes</h3>
    </header>
    <article class="notifications_body">
      <div class="table-responsive">
        <table class="table table-bordered table-default table-striped nomargin" id="Tab_Filter">
          <thead class="success">
            <tr>
              <th>#</th>
              <th class="text-center">Detalle</th>
              <th class="text-center space-around middle" colspan="3">Accion</th>
            </tr>
          </thead>
          <tbody id='notifications__table'></tbody>
        </table>
      </div>
    </article>
  </section>

  <div class="col-xs-10 col-xs-offset-1 col-md-5 col-md-offset-3"
        style="position: fixed;top: 19em;z-index: 111;display:none" id="observacion-aguaje">
    <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title text-center">OBSERVACION</h3>
        </div>
        <div class="panel-body">
          <p style="font-weight:bold;" class="text-center">ESTAMOS DENTRO DEL AGUAJE DESEAS DAR MANTENIMIENTO AL EQUIPO</p>
          <div class="col-xs-12" style="display:flex;justify-content: space-around;">
            <button class="btn btn-danger btn-raised ripple-effect" id="no-aguaje">NO</button>
            <button class="btn btn-primary btn-raised ripple-effect" id="si-aguaje">SI</button>
          </div>
        </div>
    </div>
  </div>

  <div class="col-xs-10 col-xs-offset-1 col-md-5 col-md-offset-3"
        style="position: fixed;top: 19em;z-index: 111;display:none" id="mantenimiento-aguaje">
    <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title text-center">MOTIVO DE LA ORDEN DE TRABAJO</h3>
        </div>
        <div class="panel-body">
          <div class="col-xs-12">
            <label for="motivo-mante" class="col-xs-12 control-label">DESCRIBA MOTIVO DEL MANTENIMIENTO</label>
            <div class="col-xs-12">
              <textarea type="text" class="form-control" id="motivo-mante"></textarea>
            </div>
          </div>
          <div class="col-xs-12" style="display:flex;justify-content: space-around;">
            <button class="btn btn-primary btn-raised ripple-effect" id="acept-aguaje">Aceptar</button>
          </div>
        </div>
    </div>
  </div>

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
