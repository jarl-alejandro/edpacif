<?php include "../conexion/conexion.php";?>

<!-- Tiempos -->
<div class="panel panel-success panel-tiempos-task">
  <div class="panel-heading">
    <h3 class="panel-title text-center">Tiempo de trabajo realizado</h3>
  </div>
  <div class="panel-body">
    <div class="col-xs-12 space-around middle">
      <h4 class="text-center">INICIO</h4>    
      <button class="btn__flat btn-success showFormTime-task"
        style="font-size: 16px;margin-bottom: 10px;padding: 6px 15px" data-type="inicio">
        <i class="fa fa-clock-o white-text" aria-hidden="true"></i>
      </button>
      <table class="table table-bordered table-default table-striped nomargin">
        <thead>
          <tr>
            <th>Fecha</th>
            <th>Hora</th>
          </tr>
        </thead>
        <tbody id="tableInicioTask">
          <td></td>
          <td></td>
        </tbody>
      </table>
      <button class="btn btn-raised btn-default" id="ordenFormTimeInicioTask">Ingresar tiempos</button>      
    </div>

    <div class="col-xs-12 space-around middle" style="display:none">
      <h4 class="text-center">FIN</h4>
      <button class="btn__flat btn-success showFormTime"
        style="font-size: 16px;margin-bottom: 10px;padding: 6px 15px" data-type="fin">
        <i class="fa fa-clock-o white-text" aria-hidden="true"></i>
      </button>
      <table class="table table-bordered table-default table-striped nomargin">
        <thead>
          <tr>
            <th>Fecha</th>
            <th>Hora</th>
          </tr>
        </thead>
        <tbody id="tablefin">
          <td></td>
          <td></td>
        </tbody>
      </table>
      <button class="btn btn-raised btn-default" id="ordenFormTimeFin">Ingresar tiempos</button>
    </div>

    <div class="col-xs-12 center">
      <button class="btn btn-raised btn-danger" id="panelTiempoAceptar-task">Aceptar</button>
    </div>
  </div>
</div>

<div class="panel panel-primary form__date-time-task">
  <div class="panel-body">
    <div class="col-xs-6 middle">
      <label for="fechaDateTime-task"" class="col-xs-2 control-label">Fecha</label>
      <div class="col-xs-7">
        <input id="fechaDateTime-task"" class="form-control datepicker" placeholder="<?=$fecha?>" />
      </div>
    </div>
    
    <div class="col-xs-6 middle">
      <label for="horaDateTime-task"" class="col-xs-2 control-label">Hora</label>
      <div class="col-xs-7">
        <input id="horaDateTime-task" type="time" class="form-control"  />
      </div>
    </div>
    <div class="col-xs-12 center">
      <button class="btn btn-raised btn-danger" id="cancelDateTime-task">Cancelar</button>
      <button class="btn btn-raised btn-success" id="saveDateTime-task">Aceptar</button>
    </div>
  </div>
</div>
<!-- /Tiempos -->

<!-- Herramientas -->
<div class="panel panel-warning panel-herramienta-task">
  <div class="panel-heading">
    <h3 class="panel-title text-center">Herramientas</h3>
  </div>
  <div class="panel-body">
    <div class="col-xs-12">
      <div class="col-xs-offset-11">
        <button class="btn__flat orange" id="Herramientasadd-task"
          style="font-size: 16px;margin-bottom: 10px;padding: 6px 15px">
          <i class="fa fa-cart-plus white-text" aria-hidden="true"></i>
        </button>
      </div>
    </div>
    <table class="table table-bordered table-default table-striped nomargin">
      <thead>
        <tr>
          <th>Cant</th>
          <th>Detalle</th>
          <th>Valor Unit</th>
          <th>Valor Total</th>
        </tr>
      </thead>
      <tbody id="tableHerramientasTask"></tbody>
    </table>
    <div class="col-xs-12 center">
      <button class="btn btn-raised btn-danger" id="panelHerramAceptar-task">Aceptar</button>
    </div>
  </div>
</div>
<!-- /Herramientas -->

<!-- materiales -->
<div class="panel panel-success panel-materiales-task">
  <div class="panel-heading">
    <h3 class="panel-title text-center">Materiales</h3>
  </div>
  <div class="panel-body">
    <div class="col-xs-12">
      <div class="col-xs-offset-11">
        <button class="btn__flat orange" id="materialesAdd-task"
          style="font-size: 16px;margin-bottom: 10px;padding: 6px 15px">
          <i class="fa fa-cart-plus white-text" aria-hidden="true"></i>
        </button>
      </div>
    </div>
    <table class="table table-bordered table-default table-striped nomargin">
      <thead>
        <tr>
          <th>Cant</th>
          <th>Detalle</th>
          <th>Valor Unit</th>
          <th>Valor Total</th>
        </tr>
      </thead>
      <tbody id="tablemateriales-task"></tbody>
    </table>
    <div class="col-xs-12 center">
      <button class="btn btn-raised btn-danger" id="panelMaterAceptar-task">Aceptar</button>
    </div>
  </div>
</div>
<!-- /materiales -->

<!-- Listado de Herramientas -->
<div class="panel panel-danger panel-listadoHerramientas-task none" style="top:-5em">
  <div class="panel-heading">
    <h3 class="panel-title text-center">Listado de herramienta</h3>
  </div>
  <div class="input-group space-padding">
    <span class="input-group-addon" id="searchHerrListTask">
      <i class="fa fa-search black-text" aria-hidden="true"></i>
    </span>
    <input type="text" id="searchHerrTask" class="form-control"
      placeholder="Escribe lo que andas buscando" aria-describedby="searchHerrList" />
  </div>
  <section class="panel-body" id="Tab_FilterHermientaTask">
    <article></article>  
    <?php
    $herramientasTask = $pdo->query("SELECT * FROM sgmeherr ORDER BY eherr_cod_eherr ASC");
    while ($row = $herramientasTask->fetch()) {
    ?>
    <article class="row">
      <h5 class="col-xs-4"><?= $row["eherr_det_eherr"] ?></h5>
      <div class="form-group col-xs-6">
        <div class="col-md-12">
          <input type="text" class="form-control cant-input"
              id="cant<?= $row["eherr_cod_eherr"]?>"
              placeholder="Cant" maxlength="8"
              onkeypress="ValidaSoloNumeros()">
        </div>
      </div>
      <div class="col-xs-2">
        <button class="btn__flat orange add-herr-task"
          data-id="<?= $row["eherr_cod_eherr"]?>"
          data-producto="<?= $row["eherr_det_eherr"]?>"
          data-price="<?= $row["eherr_cos_eherr"]?>"
          >
          <i class="fa fa-cart-plus white-text" aria-hidden="true"></i>
        </button>
      </div>
    </article>
    <?php } ?>
  </section>
  <div class="col-xs-12 center">
    <ul class="pagination" id="NavPosicionHerramientasTask"></ul>
  </div>
  <div class="col-xs-12 center" style="margin-bottom: 1em;">
    <button class="btn__flat red text-minun close--her-task">Cerrar</button>
  </div>
</div>
<!-- /Listado de Herramientas -->

<!-- Listado de Materiales -->
<div class="panel panel-danger panel-inventario-task none" style="top:-5em">
  <div class="panel-heading">
    <h3 class="panel-title text-center">Inventario</h3>
  </div>
  <div class="input-group space-padding">
    <span class="input-group-addon" id="searchInventartioTask">
      <i class="fa fa-search black-text" aria-hidden="true"></i>
    </span>
    <input type="text" id="searchInvenTask" class="form-control"
      placeholder="Escribe lo que andas buscando" aria-describedby="searchInventartio" />
  </div>
  <section class="panel-body" id="Tab_FilterInventarioTask">
    <article></article>  
    <?php
    $inventario = $pdo->query("SELECT * FROM sgmeinve
                    ORDER BY einven_cod_einven ASC");
    while ($row = $inventario->fetch()) {
    ?>
    <article class="row">
      <h5 class="col-xs-4"><?= $row["einven_pro_einven"] ?></h5>
      <div class="form-group col-xs-6">
        <div class="col-md-12">
          <input type="text" class="form-control cant-input"
              id="cant<?= $row["einven_cod_einven"]?>"
              placeholder="Cant" maxlength="8"
              onkeypress="ValidaSoloNumeros()">
        </div>
      </div>
      <div class="col-xs-2">
        <button class="btn__flat orange add-inve-task"
          data-id="<?= $row["einven_cod_einven"]?>"
          data-producto="<?= $row["einven_pro_einven"]?>"
          data-price="<?= $row["einven_cos_einven"]?>"
          >
          <i class="fa fa-cart-plus white-text" aria-hidden="true"></i>
        </button>
      </div>
    </article>
    <?php } ?>
  </section>
  <div class="col-xs-12 center">
    <ul class="pagination" id="NavPosicionInventarioTask"></ul>
  </div>
  <div class="col-xs-12 center" style="margin-bottom: 1em;">
    <button class="btn__flat red text-minun close--inven-task">Cerrar</button>
  </div>
</div>
<input type="hidden" id="id-task-work">
<!-- /Listado de Materiales -->

<script>

</script>


<!-- <script src="../lib/jquery-ui/jquery-ui.js"></script> -->

<!-- <script src="../lib/morrisjs/morris.js"></script> -->
<!-- <script src="../lib/raphael/raphael.js"></script> -->

<!-- <script src="../lib/flot/jquery.flot.js"></script> -->
<!-- <script src="../lib/flot/jquery.flot.resize.js"></script> -->
<!-- <script src="../lib/flot-spline/jquery.flot.spline.js"></script> -->

<!-- <script src="../lib/jquery-knob/jquery.knob.js"></script> -->
<!-- <script src="../js/dashboard.js"></script> -->

<script src="../assets/js/jquery.js"></script>
<script>
  $('.btn-fab').addClass('btn-circle')
</script>
<script src="../assets/js/bootstrap.js"></script>
<script src="../lib/jquery-toggles/toggles.js"></script>
<script src="../assets/js/highcharts.js"></script>
<script src="../assets/js/highcharts-3d.js"></script>
<script src="../assets/js/theme.js"></script>
<script src="../assets/js/exporting.js"></script>

<script src="../assets/js/quirk.js"></script>

<script src="../assets/js/picker.js"></script>
<script src="../assets/js/picker.date.js"></script>
<script src="../assets/js/legacy.js"></script>
<!-- <script src="../assets/js/picker.time.js"></script> -->

<script src="../assets/js/material.min.js"></script>
<script src="../assets/js/ripples.min.js"></script>

<script src="../assets/js/validaciones.js"></script>
<script src="../assets/js/form_object.js"></script>
<script src="../assets/js/app.js"></script>

<script type="text/javascript" src="../assets/js/pagingArticle.js"></script>
<script type="text/javascript" src="../mis-ordenes-trabajo-interno/app/buscador.js"></script>

<script type="text/javascript">
  var pagerInveTask = new Pager('Tab_FilterInventarioTask', 3, 'inventario', 4);
  pagerInveTask.init();
  pagerInveTask.showPageNav('pagerInveTask', 'NavPosicionInventarioTask');
  pagerInveTask.showPage(1);

  var pagerHerraTask = new Pager('Tab_FilterHermientaTask', 3, 'herramienta', 4);
  pagerHerraTask.init();
  pagerHerraTask.showPageNav('pagerHerraTask', 'NavPosicionHerramientasTask');
  pagerHerraTask.showPage(1);

  (function() {
    theTableInveTask = $("#Tab_FilterInventarioTask");
    $("#searchInvenTask").keyup(function() {
      $.articleBuscador(theTableInveTask, this.value, 4)
    })

    theTableHerrTask = $("#Tab_FilterHermientaTask");
    $("#searchHerrTask").keyup(function() {
      $.articleBuscador(theTableHerrTask, this.value, 4)
    })

  })()
</script>

<script type="text/javascript">
  $.material.init()
</script>
<script type="text/javascript" src="app/index.js"></script>
