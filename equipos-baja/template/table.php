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
      <th>Fecha</th>
      <th class="text-center">Equipo</th>
      <th class="text-center">Reportes</th>
      <th class="text-center space-around middle">
        <span>Acciones</span>
        <button class="btn btn-raised center derecha" id="print">
          <i class="fa fa-print" aria-hidden="true"></i>
        </button>
      </th>
    </tr>
  </thead>
  <tbody>
    <?php
    $equip = $pdo->query("SELECT * FROM v_equi_baja
                    ORDER BY eeqbaj_fect_eeqbaj ASC");
    if($equip->rowCount() == 0){
      echo "<tr><td colspan='3' class='text-center'>No hay equipos de baja</td></tr>";
    }
    else{
    while ($rows = $equip->fetch()) {
    ?>
      <tr>
        <td class="principal-cuenta"><?= $rows["eeqbaj_fect_eeqbaj"]; ?></td>
        <td class="principal-cuenta"><?= $rows["eequi_det_eequi"]; ?></td>
        <td class="principal-cuenta">
          <a href="../media/equipos/<?= $rows["eeqbaj_pdf_eeqbaj"]; ?>.pdf" target="_blank"
            class='btn btn-raised ripple-effect btn-warning'>Informe</a>
        </td>
        <td class="space-around">
          <button class="btn btn-raised ripple-effect btn-primary ocupar"
            data-id="<?= $rows["eequi_cod_eequi"]; ?>">
            <i class="fa fa-subway text-medium"></i>
          </button>
          <button class="btn btn-info  btn-raised ripple-effect reporte"
            data-id="<?= $rows["eequi_cod_eequi"]; ?>">
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
