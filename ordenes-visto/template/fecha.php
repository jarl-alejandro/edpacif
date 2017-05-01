<?php
 include "../../conexion/conexion.php";
  $inicio = $_GET["inicio"];
  $fin = $_GET["fin"];
?>
<input type="hidden" id="inicio-table" value="<?=$inicio?>">
<input type="hidden" id="fin-table" value="<?=$fin?>">

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
      <th class="text-center space-around middle" colspan="3">Accion
        <button class="btn btn-raised center derecha" id="print-fecha">
          <i class="fa fa-print" aria-hidden="true"></i>
        </button>
      </th>
    </tr>
  </thead>
  <tbody>
    <?php
    $count = 0;
    $equipos = $pdo->query("SELECT * FROM sgmeorin WHERE eorin_est_eorin='visto' 
                              AND eorin_fet_eorin BETWEEN '$inicio' AND '$fin'");

    if($equipos->rowCount() == 0){
      echo "<tr><td colspan='4' class='text-center'>No hay ordenes</td></tr>";
    }
    else{
    while ($rows = $equipos->fetch()) {
      $count++;
    ?>
    <tr>
      <td class=""><?= $count; ?></td>
      <td class=""><?= $rows["eorin_cod_eorin"]; ?></td>
      <td class=""><?= $rows["eorin_det_eorin"]; ?></td>
      <td class="space-around middle">
          <!--<button class="btn btn-raised center review button__little orden_visto"
            data-id="<?= $rows["eorde_cod_eorde"]; ?>">
            <i class="fa fa-paper-plane text-medium"></i>
          </button>-->
          <button class="btn btn-raised center derecha reporte btn-primary"
            data-id="<?= $rows["eorin_cod_eorin"]; ?>">
          <i class="fa fa-print" aria-hidden="true"></i>
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

<div class="col-xs-2 center">
  <button class="btn btn-raised-btn-danger" style="background:#E53935;color:white;"  id="closeFecha">Cerrar</button>
</div>

<script type="text/javascript" src="app/mantenimiento.js"></script>
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
