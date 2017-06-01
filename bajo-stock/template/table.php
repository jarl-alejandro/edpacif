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
      <th class="text-center">Inventario</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $doir_query = $pdo->query('SELECT doir_herr_doir, SUM(doir_cant_doir) FROM sgmedoir');
    while ($row = $doir_query->fetch()) {
      print_r($row);
    }
    $invent = $pdo->query("SELECT * FROM sgmeinve ORDER BY einven_cod_einven ASC");
    if($invent->rowCount() == 0){
      echo "<tr><td colspan='3' class='text-center'>No hay inventario</td></tr>";
    }
    else{
    while ($rows = $invent->fetch()) {
    ?>
      <tr>
        <td class="principal-cuenta"><?= $rows["einven_cod_einven"]; ?></td>
        <td class="principal-cuenta"><?= $rows["einven_pro_einven"]; ?></td>
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
