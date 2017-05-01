<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title text-center">Registrar nueva lista de tarea</h3>
  </div>
  <div class="panel-body">
    <!-- Form -->
    <form class="form-horizontal" id="areaGeneralForm">
      <input type="hidden" name="id" id="idCode">
      <input type="hidden" name="newGeneral" id="newGeneral">
      <div class="col-xs-9">
        <div class="form-group">
          <label for="general" class="col-md-4 control-label">Sub area</label>
          <div class="col-md-8">
            <select class="form-control" name="general" id="general">
              <option value="">Selecione el sub area</option>
              <?php
              $subarea = $pdo->query("SELECT * FROM sgmesuba");
              while ($row = $subarea->fetch()) {
              ?>
              <option value="<?=$row["subare_cod_subare"]?>">
                <?=$row["subare_det_subare"]?>
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
              placeholder="Cambio de Aceite" onkeypress="txNombres()" maxlength="80">
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
