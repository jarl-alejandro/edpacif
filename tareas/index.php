<?php 
include "../conexion/conexion.php";
if(isset($_GET["id"])){
	$id = $_GET["id"];
	$open = $_GET["open"];
}
else {	
	$id = "0";
	$open = "0";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Tareas | Edpacif</title>
  <?php require '../head.php'; ?>
  <style>
    .ocultar{
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0,0,0,0.3);
      z-index: 10;
      display: none;
    }
    .preloader {
      position: absolute;
      top: 50%;
      left: 40%;
      width: 70px;
      height: 70px;
      border: 10px solid #eee;
      border-top: 10px solid #666;
      border-radius: 50%;
      animation-name: girar;
      animation-duration: 2s;
      animation-iteration-count: infinite;
      animation-timing-function: linear;
    }
    @keyframes girar {
      from {
        transform: rotate(0deg);
      }
      to {
        transform: rotate(360deg);
      }
    }
  </style>
</head>

<body>
	<input type="hidden" id="open-is" value="<?=$open?>">
	<input type="hidden" id="open-id" value="<?=$id?>">
  <div class="ocultar">
    <div class="preloader"></div>
  </div>
  <header>
    <?php include '../header.php'; ?>
  </header>
  <section>
    <div class="mainpanel">
      <div class="contentpanel">
        <div class="row">
          <div class="col-md-9 col-lg-8 dash-left">
            <h2 class="text-center no-margin title">Tareas</h2>
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

  <?php
  require "../templates/alert.php";
  require "../templates/info.php";
  require "../scripts.php";
  ?>

  <script type="text/javascript" src="../assets/js/pagingArticle.js"></script>
<script type="text/javascript" src="../mis-ordenes-trabajo-interno/app/buscador.js"></script>

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
