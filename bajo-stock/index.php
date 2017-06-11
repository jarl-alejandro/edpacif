<!DOCTYPE html>
<html lang="es">
<head>
  <title>Bajo Stock | Edpacif</title>
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
            <h2 class="text-center no-margin title">Bajo Stock</h2>
            <a class="btn btn-info btn-fab" id="form-btn">
              <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
            <div class="panel panel-site-traffic">
              <div class="table-responsive">
                <section class="tabla-contianer"></section>
              </div>
            </div>

          </div><!-- col-md-9 -->
          <?php require "../asider.php" ?>
        </div><!-- col-md-12 -->
      </div><!-- col-md-12 -->
    </div><!-- row -->
  </section>

  <section id="form-conatiner" class="none">
    <?php require "template/form.php" ?>
  </section>
  <script type="text/javascript" src='app/detail.js'></script>
  <?php
    require "../templates/alert.php";
    require "../templates/info.php";
    require "../scripts.php";
  ?>
  <script type="text/javascript" src="../mis-ordenes-trabajo-interno/app/buscador.js"></script>
  <script type="text/javascript" src="../assets/js/pagingArticle.js"></script>
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
    })()
  </script>
</body>
</html>
