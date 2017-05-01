<?php
$hoy = date("Y-m-d");
?>
<input type="hidden" id="inputIdPed">
<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title text-center">Pedido</h3>
  </div>
  <div class="panel-body">
    <form class="form-horizontal" id="">
      <input type="hidden" id="ped_id">
      <table class="table table-bordered top-space" id="tablePedi">
        <thead>
          <tr>
            <th>#</th>
            <th>Detalle</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody id="pedidosTabla"></tbody>
      </table>
    </form>
    <div class="footer-pane space-top center">
      <button class="btn btn-raised btn-danger" id="cancelar">Cancelar</button>
      <button class="btn btn-raised btn-info" id="save">Guardar</button>
    </div>
  </div>
</div>
