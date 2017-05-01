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
      <th>Codigo</th>
      <th class="text-center">Area</th>
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
    $id = 0;
    $departamento = $pdo->query("SELECT * FROM sgmearea ORDER BY earea_cod_earea ASC");
    while ($rows = $departamento->fetch()) {
      $id++;
    ?>
      <tr>
        <td class="principal-cuenta"><?= $rows["earea_cod_earea"]; ?></td>
        <td class="principal-cuenta"><?= $rows["earea_det_earea"]; ?></td>
        <td class="space-around">
          <button class="btn btn-primary editar"
            data-id="<?= $rows["earea_cod_earea"]; ?>">
            <i class="fa fa-pencil text-medium"></i>
          </button>
          <button class="btn btn-danger eliminar"
            data-id="<?= $rows["earea_cod_earea"]; ?>">
            <i class="fa fa-trash text-medium"></i>
          </button>
          <button class="btn btn-info reporte"
            data-id="<?= $rows["earea_cod_earea"]; ?>">
            <i class="fa fa-print text-medium"></i>
          </button>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>

<script type="text/javascript" src="app/app.js"></script>
<script type="text/javascript" src="../assets/js/search.js"></script>
<script type="text/javascript" src="../assets/js/paging.js"></script>
<div class="center">
  <ul class="pagination" id="NavPosicion_b"></ul>
</div>
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
