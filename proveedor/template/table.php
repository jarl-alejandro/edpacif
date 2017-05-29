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
      <th width="5%">#</th>
      <th width="30%">Proveedor</th>
      <th width="25%">Contacto</th>
      <th width="100%" colspan="3" class="text-center space-around middle" colspan="3">
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
    $proveedor = $pdo->query("SELECT * FROM sgmepro");

    if($proveedor->rowCount() == 0){
      echo '<tr><td></td><td>No hay proveedores</td><td></td></tr>';
    }
    else {
      while ($rows = $proveedor->fetch()) {
        $count++;
    ?>
      <tr>
        <td class=""><?= $count; ?></td>
        <td class=""><?= $rows["eprov_nom_eprov"] ?></td>
        <td class=""><?= $rows["eprov_noc_eprov"]; ?></td>
        <td class="space-around">
          <button class="btn btn-primary editar btn-raised"
            data-id="<?=$rows["eprov_cod_eprov"];?>">
            <i class="fa fa-pencil text-medium"></i>
          </button>
          <button class="btn btn-danger eliminar btn-raised"
            data-id="<?=$rows["eprov_cod_eprov"];?>">
            <i class="fa fa-trash text-medium"></i>
          </button>
          <button class="btn btn-info reporte btn-raised"
            data-id="<?=$rows["eprov_cod_eprov"];?>">
            <i class="fa fa-print text-medium"></i>
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
