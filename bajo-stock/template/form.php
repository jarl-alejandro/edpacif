<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title text-center titulo">Pedido de inventarios</h3>
  </div>
  <div class="panel-body">
    <!-- Form -->
    <form class="form-horizontal" id="areaGeneralForm" style="top: 4em;">
      <input type="hidden" name="id" id="idCode">
      <div class="col-xs-offset-10">
        <button class='btn btn-raised btn-warning' id='showListInventarios'>
          <i class="fa fa-plus" aria-hidden="true"></i>
        </button>
      </div>
      <table class="table table-bordered table-default table-striped nomargin">
        <thead class="success">
          <tr>
            <th>#</th>
            <th>Cant</th>
            <th class="text-center">Inventario</th>
          </tr>
        </thead>
        <tbody id='pedidosStock'>
          <tr>
            <td colspan="3" class='text-center'>Ingrese los pedidos</td>
          </tr>
        </tbody>
      </table>
      <div class="col-xs-12 footer-pane top-space center">
        <button class="btn btn-raised btn-danger cancelar-form-stock">Cancelar</button>
        <button class="btn btn-raised btn-primary save-form">Guardar</button>
      </div>
    </form>
  </div>
</div>
<?php require "template/inventario.php" ?>
