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
              <div class="col-xs-12">
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
  <script type="text/javascript">
  $('.tareas-asigado-home').on('click', taskView)
  function taskView (e) {
    var id = e.currentTarget.dataset.id
    $("#id-task-work").val(id)
    $.ajax({
      type: "POST",
      data: { id },
      url: "../tareas/service/visto.php",
      dataType: "JSON"
    })
    .done(function(snap) {
      renderTemplate(snap)
      alertaInfo("Ha visto la tarea empieza a trabajar")
      $("#TareasAll").load("../task_table.php")
    })
  }
  function renderTemplate (snap) {
    $("#subareaContainerTask").load(`../tareas/template/subtask.php?id=${snap.subare_are_subare}`,
    function () {
      $("#subareaTask").val(snap.subare_cod_subare)
    })

    $("#tareasContainerTask").load(`../tareas/template/detalleTask.php?id=${snap.subare_cod_subare}`,
    function () {
      $("#detalleTask").val(snap.ltare_cod_ltare)
    })

    $("#equipoTask").val(snap.eequi_cod_eequi)
    $("#areaTask").val(snap.subare_are_subare)
    $("#empleadoTask").val(snap.eempl_ced_eempl)
    $("#fechaTask").val(snap.etare_fet_etare)
    document.querySelector(`input[value="${snap.etare_col_etare}_${snap.etare_pri_etare}_task"]`).checked = true
    $("#FormTareaTrabajar").slideDown()
  }
  </script>

</body>
</html>
