<?php include "../../conexion/conexion.php";?>
<div class="input-group space-padding">
  <span class="input-group-addon" id="buscadorInput">
    <i class="fa fa-search black-text" aria-hidden="true"></i>
  </span>
  <input type="text" id="searchTerm" class="form-control"
    placeholder="Escribe lo que andas buscando" aria-describedby="buscadorInput" />
</div>
<table class="table table-bordered table-default table-striped nomargin"
  id="Tab_Filter">
  <thead class="success">
    <tr>
      <th>#</th>
      <th class="text-center">INFORME</th>
      <th class="text-center">CODIGO</th>
      <th class="text-center">EQUIPO</th>
      <th class="text-center">EMPLEADO</th>
      <th>
        <button class="btn btn-raised center derecha" id="print-all">
          <i class="fa fa-print" aria-hidden="true"></i>
        </button>
      </th>
    </tr>
  </thead>
  <tbody>
    <?php
    $reportes = $pdo->query("SELECT * FROM view_report_faild");
    $index = 0;
    if($reportes->rowCount() == 0){
      echo "<tr><td colspan='3' class='text-center'>No hay reporte de daños</td></tr>";
    }
    else{
    while ($rows = $reportes->fetch()) {
      $index++;
    ?>
      <tr>
        <td class="principal-cuenta"><?= $index ?></td>
        <td class="principal-cuenta"><?= $rows["erepo_det_erepo"]; ?></td>
        <td class="principal-cuenta"><?= $rows["erepo_equi_erepo"]; ?></td>
        <td class="principal-cuenta"><?= $rows["eequi_det_eequi"]; ?></td>
        <td class="principal-cuenta"><?= $rows["empleado"]; ?></td>
        <td class="principal-cuenta"><button class='btn btn-raised btn-info print--faild'
          data-id="<?= $rows["erepo_codi_erepo"]; ?>"><i class="fa fa-print"></i>
        </button>
        </td>
      </tr>
    <?php }
    } ?>
  </tbody>
</table>
<div class="center">
  <ul class="pagination" id="NavPosicion_b"></ul>
</div>
<script type="text/javascript" src="app/app.js"></script>
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
