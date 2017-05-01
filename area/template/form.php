<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title text-center titulo">Registrar nueva area</h3>
  </div>
  <div class="panel-body">
    <!-- Form -->
    <form class="form-horizontal" id="areaGeneralForm">
      <input type="hidden" name="id" id="idCode">
      <input type="hidden" name="newGeneral" id="newGeneral">
      <div class="col-xs-9 top-space-big">
        <div class="form-group">
          <label for="general" class="col-md-4 control-label">Area General</label>
          <div class="col-md-8">
            <select class="form-control" name="general" id="general">
              <option value="">Selecione el area general</option>
              <?php
              $departamento = $pdo->query("SELECT * FROM sgmearege");
              while ($row = $departamento->fetch()) {
              ?>
              <option value="<?=$row["earege_cod_earege"]?>">
                <?=$row["earege_det_earege"]?>
              </option>
              <?php } ?>
            </select>
          </div>
        </div>
      </div>
      <div class="col-xs-9">
        <div class="form-group">
          <label for="detalle" class="col-md-4 control-label">Detalle</label>
          <div class="col-md-8">
            <input type="text" class="form-control" name="detalle" id="detalle_name"
              placeholder="PRODUCCIÓN" onkeypress="txNombres()" maxlength="80">
          </div>
        </div>
      </div>
      <div class="col-xs-12 footer-pane top-space center">
        <button class="btn btn-raised btn-danger" id="cancelar">Cancelar</button>
        <button class="btn btn-raised btn-info" id="save">Guardar</button>
      </div>
    </form>
    <!-- /Form -->
  </div>
</div>
