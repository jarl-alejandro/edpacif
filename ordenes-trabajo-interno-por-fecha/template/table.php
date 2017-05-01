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
      <th class="text-center">Detalle</th>
      <th class="text-center">Equipo</th>
      <th class="text-center space-around middle" colspan="3">Accion
        <button class="btn btn-raised center derecha" id="print">
          <i class="fa fa-print" aria-hidden="true"></i>
        </button>
      </th>
    </tr>
  </thead>
  <tbody>
    <?php
    $count = 0;
    $ordenes = $pdo->query("SELECT * FROM v_orden_interna");
    if($ordenes->rowCount() == 0){
      echo "<tr><td colspan='4' class='text-center'>No hay ordenes de trabajo</td></tr>";
    }
    else{
    while ($rows = $ordenes->fetch()) {
      $count++;
    ?>
    <tr>
      <td class=""><?= $count; ?></td>
      <td class=""><?= $rows["eorin_det_eorin"]; ?></td>
      <td class=""><?= $rows["eequi_det_eequi"]; ?></td>
      <td class="space-around middle">
        <button class="btn btn-raised btn-warning print-report"
          data-id="<?= $rows["eorin_cod_eorin"]; ?>">
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
