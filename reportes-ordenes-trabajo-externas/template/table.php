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
      <th class="text-center">Detalle</th>
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
    $ordenes = $pdo->query("SELECT * FROM sgmeorex");
    if($ordenes->rowCount() == 0){
      echo "<tr><td colspan='4' class='text-center'>No hay ordenes de trabajo</td></tr>";
    }
    else{
    while ($rows = $ordenes->fetch()) {
      $count++;
    ?>
    <tr>
      <td class=""><?= $count; ?></td>
      <td class=""><?= $rows["eorex_det_eorex"]; ?></td>
      <td class="space-around middle">
        <?php if($rows["eorex_infor_eorex"] != "") {?>
          <a href="../media/externas/<?= $rows["eorex_infor_eorex"]; ?>" target="_blank"
            class='btn btn-raised ripple-effect btn-warning'>Informe</a>
        <?php } if( $rows["eorex_fact_eorex"] != "") {?>
          <a href="../media/externas/<?= $rows["eorex_fact_eorex"]; ?>" target="_blank"
            class='btn btn-raised ripple-effect btn-primary'>Factura</a>
        <?php }?>
        <button class="btn btn-raised center button__little reporte btn-primary"
          data-id="<?= $rows["eorex_cod_eorex"]; ?>">
          <i class="fa fa-print text-medium" aria-hidden="true"></i>
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
<script type="text/javascript" src="app/index.js"></script>
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
