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
     <th class="text-center">Codigo</th>
     <th class="text-center">Detalle</th>
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
   $equipos = $pdo->query("SELECT * FROM sgmemape");
   if($equipos->rowCount() == 0){
     echo "<tr><td colspan='4' class='text-center'>No hay pedidos</td></tr>";
   }
   else{
   while ($rows = $equipos->fetch()) {
     $count++;
   ?>
   <tr>
     <td class=""><?= $count; ?></td>
     <td class=""><?= $rows["eped_cod_eped"]; ?></td>
     <td class="">Pedido el <?= $rows["eped_fec_eped"]; ?></td>
     <td class="space-around">
      <button class="btn btn-raised center derecha button__little pedido btn-primary"
           data-id="<?= $rows["eped_cod_eped"]; ?>">
        <i class="fa fa-plane text-medium" aria-hidden="true"></i>
      </button>
      <button class="btn btn-raised center derecha button__little reporte btn-primary"
          data-id="<?= $rows["eped_cod_eped"]; ?>">
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
