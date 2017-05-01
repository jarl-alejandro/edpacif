<?php 
session_start();
include "../../conexion/conexion.php";
$id = $_SESSION["3188768e18a5c00164bbe22d1749a30e4626a114"];
?>
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
    $ordenes = $pdo->query("SELECT * FROM sgmeorin WHERE 
        (eorin_est_eorin='asignado' OR eorin_est_eorin='visto' OR eorin_est_eorin='autorizado'
        OR eorin_est_eorin='proceso') 
        AND eorin_emp_eorin='$id'");
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
      <td class="space-around middle">
        <?php if($rows["eorin_est_eorin"] == "asignado") {?>
           <button class="btn btn-raised center review button__little ordenTrabajo"
            data-id="<?= $rows["eorin_cod_eorin"]; ?>">
            <img src="../assets/iconos/email-icon.png" width='31px'>
          </button>
        <?php } else if($rows["eorin_est_eorin"] == "visto") {?>
           <button class="btn btn-raised center review button__little ordenTrabajo"
            data-id="<?= $rows["eorin_cod_eorin"]; ?>">
            <img src="../assets/iconos/mail-open-flat.png" width='31px'>            
          </button>
        <?php } else if($rows["eorin_est_eorin"] == "autorizado") {?>
           <button class="btn btn-raised center review button__little ordenTrabajoAutorizado"
            data-id="<?= $rows["eorin_cod_eorin"]; ?>">
            <i class="fa fa-bug text-medium"></i>
          </button>
          <?php } else if($rows["eorin_est_eorin"] == "proceso") {?>
           <button class="btn btn-raised center review button__little ordenTrabajo"
            data-id="<?= $rows["eorin_cod_eorin"]; ?>">
            <img src="../assets/iconos/proceso.png" width='31px'>            
          </button>
        <?php }else { ?>
          <button class="btn btn-raised center review button__little ordenTrabajo"
            data-id="<?= $rows["eorin_cod_eorin"]; ?>">
            <i class="fa fa-paper-plane text-medium"></i>
          </button>
        <?php } ?>
          <button class="btn btn-raised center button__little reporte btn-warning"
            data-id="<?= $rows["eorin_cod_eorin"]; ?>">
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
