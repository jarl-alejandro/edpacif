<?php include "../../conexion/conexion.php";?>
<div class="input-group space-padding">
  <span class="input-group-addon" id="buscadorInput">
    <i class="fa fa-search black-text" aria-hidden="true"></i>
  </span>
  <input type="text" id="searchTerm" class="form-control"
    placeholder="Escribe lo que andas buscando" aria-describedby="buscadorInput" />
</div>
<div class="col-xs-12">
  <button class="btn btn-raised btn-primary center derecha" id="print">
    <i class="fa fa-print" aria-hidden="true"></i>
  </button>
</div>
<?php
$equipos = $pdo->query("SELECT * FROM smgeequi WHERE eequi_baja_eequi='0'");

if($equipos->rowCount() == 0){
  echo "<h2 class='text-center'>No hay equipos</h2>";
}
else{ ?>
<section id="Tab_Filter" class="space-around">
  <article></article>
  <?php
  while ($rows = $equipos->fetch()) {
  ?>
  <article class="card__equipo center middle"
    style="background-image: url(../media/equipos/<?= $rows["eequi_ima_eequi"]?>);padding: 1em">
    <h3 class="card__equipo--title"><?= $rows["eequi_det_eequi"] ?></h3>
    <div class="card__equipo--screen">
      <div class="card__equipo--actiions">
        <button class="btn btn-primary editar"
          data-id="<?=$rows['eequi_cod_eequi']?>">
          <i class="fa fa-pencil text-medium"></i>
        </button>
        <button class="btn btn-danger eliminar"
          data-id="<?=$rows['eequi_cod_eequi']?>">
          <i class="fa fa-trash text-medium"></i>
        </button>
        <button class="btn btn-info reporte"
          data-id="<?=$rows['eequi_cod_eequi']?>">
          <i class="fa fa-print text-medium"></i>
        </button>
        <button class="btn btn-warning btn-raised darBaja"
          data-id="<?=$rows['eequi_cod_eequi']?>">
          <i class="fa fa-subway text-medium"></i>
        </button>
      </div>
    </div>
  </article>
  <?php }?>
</section>
<?php }?>
<div class="col-xs-12 center">
  <ul class="pagination" id="NavPosicion_b"></ul>
</div>
<script type="text/javascript" src="app/card.js"></script>
<script type="text/javascript" src="../assets/js/searchArticle.js"></script>
<script type="text/javascript" src="../assets/js/pagingArticle.js"></script>

<script type="text/javascript">
  var pager = new Pager('Tab_Filter', 6, 'equipos', 4);
  pager.init();
  pager.showPageNav('pager', 'NavPosicion_b');
  pager.showPage(1);

  (function() {
    theTable = $("#Tab_Filter");
    $("#searchTerm").keyup(function() {
      $.uiTableFilter(theTable, this.value, 6)
    })
  })()
</script>
