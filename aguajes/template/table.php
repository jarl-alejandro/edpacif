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
      <th class="text-center">Inicio</th>
      <th class="text-center">Fin</th>
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
    $aguajes = $pdo->query("SELECT * FROM sgmeagua");

    if($aguajes->rowCount() == 0){
      echo '<tr><td></td><td></td><td>No hay aguajes</td><td></td></tr>';
    }
    else {
      foreach ($aguajes as $rows) {
        $count++;
        ?>
        <tr>
          <td><?= $count; ?></td>
          <td><?= $rows["eagua_ini_eagua"]; ?></td>
          <td><?= $rows["eagua_fin_eagua"]; ?></td>
          <td class="space-around">
            <button class="btn btn-primary editar"
              data-id="<?= $rows["eagua_cod_eagua"] ?>">
              <i class="fa fa-pencil text-medium"></i>
            </button>
            <button class="btn btn-danger eliminar"
              data-id="<?= $rows["eagua_cod_eagua"] ?>">
              <i class="fa fa-trash text-medium"></i>
            </button>
            <button class="btn btn-info reporte"
              data-id="<?= $rows["eagua_cod_eagua"] ?>">
              <i class="fa fa-print text-medium"></i>
            </button>
          </td>
        </tr>
        <?php }
      }?>
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
