<?php include "../../conexion/conexion.php";?>
<div class="input-group space-padding">
 <span class="input-group-addon" id="buscadorInput" style="position: relative;top: -1em;">
   <i class="fa fa-search black-text" aria-hidden="true"></i>
 </span>
 <input type="text" id="searchTerm" class="form-control"
   placeholder="Escribe lo que andas buscando" aria-describedby="buscadorInput" />

  <div class="col-xs-10 col-md-5">
    <input type="text" class="form-control datepicker" id="inicio-fecha" 
          placeholder="Ingrese el inicio de fecha">
  </div>
  <div class="col-xs-12 col-md-5">
    <input type="text" class="form-control datepicker" id="fin-fecha" 
      placeholder="Ingrese el final de fecha">
  </div>
  <button class="btn btn-raised btn-success" id="acept-fecha">Aceptar</button>
</div>

 <table class="table table-bordered table-default table-striped nomargin"
        id="Tab_Filter">
  <thead class="success">
    <tr>
      <th>#</th>
      <th class="text-center">Codigo</th>
      <th class="text-center">Detalle</th>
      <th class="text-center space-around middle" colspan="3">
        <span>Acciones</span>
        <button class="btn btn-raised center derecha" id="print">
          <i class="fa fa-print" aria-hidden="true"></i>
        </button>
      </th>
    </tr>
  </thead>
  <tbody>
    <?php
    $count = 0;
    $tareas = $pdo->query("SELECT * FROM v_tarea");
    if($tareas->rowCount() == 0){
      echo "<tr><td colspan='4' class='text-center'>No hay tareas</td></tr>";
    }
    else{
    while ($rows = $tareas->fetch()) {
      $count++;
    ?>
    <tr>
      <td class=""><?= $count; ?></td>
      <td class=""><?= $rows["etare_cod_etare"]; ?></td>
      <td class=""><?= $rows["ltare_det_ltare"]; ?></td>
      <td class="space-around">
    <?php
    if($rows["etare_est_etare"] == "visto"){?>
      <button class="btn btn-raised center visto button__little orden_visto"
        data-id="<?= $rows["etare_cod_etare"]; ?>">
        <i class="fa fa-check text-medium"></i>
        <i class="fa fa-check text-medium"></i>
      </button>
    <?php } if($rows["etare_est_etare"] == "asginado") {?>
      <p style="background: #009688;color: white;padding: 10px 4px;display: flex;align-items: center;">Tarea Asignada</p>
    <?php } if($rows["etare_est_etare"] == "pedido") {?>
      <button class="btn btn-raised btn-warning center review button__little task-pedido"
        data-id="<?= $rows["etare_cod_etare"]; ?>">
        <i class="fa fa-flag-checkered text-medium"></i>
      </button>
    <?php } if($rows["etare_est_etare"] == "revisar" || $rows["etare_est_etare"] == "fechaFin") {?>
      <button class="btn btn-raised center review button__little task_visto"
        data-id="<?= $rows["etare_cod_etare"]; ?>">
        <i class="fa fa-flag-checkered text-medium"></i>
      </button>
    <?php } if($rows["etare_est_etare"] == "aprobado") {?>
        <p style="background: #009688;color: white;padding: 10px 4px;display: flex;align-items: center;">Aprobado</p>
    <?php } if($rows["etare_est_etare"] == "finalizado") {?>
      <   <p style="background: #009688;color: white;padding: 10px 4px;display: flex;align-items: center;">Ha finalizado con exito la tarea</p>
      </button>
    <?php } ?>
      <button class="btn btn-raised center reporte visto button__little orden_visto"
        data-id="<?= $rows["etare_cod_etare"]; ?>">
        <i class="fa fa-print text-medium"></i>
      </button>
      </td>
    </tr>
    <?php }
    }
    ?>
  </tbody>
</table>
<div class="center">
  <ul class="pagination" id="NavPosicion_b"></ul>
</div>
<script type="text/javascript" src="app/tarea.js"></script>
<script type="text/javascript" src="app/pedidos.js"></script>
<script type="text/javascript" src="../assets/js/search.js"></script>
<script type="text/javascript" src="../assets/js/paging.js"></script>

<script type="text/javascript">
  var pager = new Pager('Tab_Filter', 4);
  pager.init();
  pager.showPageNav('pager', 'NavPosicion_b');
  pager.showPage(1);

  (function() {
    theTable = $("#Tab_Filter");
    $("#searchTerm").keyup(function() {
      $.uiTableFilter(theTable, this.value)
    })
  })()
</script>
