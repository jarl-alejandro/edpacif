<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title text-center titulo">Registrar nueva herramienta</h3>
  </div>
  <div class="panel-body">
    <!-- Form -->
    <form class="form-horizontal" id="herramienta">
      <input type="hidden" name="id" id="idCode">
      <input type="hidden" name="code" id="code">
      <div class="col-xs-9">
        <div class="form-group">
          <label for="detalle" class="col-md-4 control-label">Herramienta</label>
          <div class="col-md-8">
            <input type="text" class="form-control" name="producto" id="producto"
              placeholder="Martillo" maxlength="80">
          </div>
        </div>
      </div>
      <div class="col-xs-9">
        <div class="form-group">
          <label for="unidad" class="col-md-4 control-label">Unidad</label>
          <div class="col-md-8">
            <select name="unidad" id="unidad" class="form-control desabilitar">
              <option value="UN">UN</option>
              <option value="JP">JP</option>
              <option value="PI">PI</option>
              <option value="LT">LT</option>
              <option value="LB">LB</option>
            </select>
          </div>
        </div>
      </div>
      <div class="col-xs-9">
        <div class="form-group">
          <label for="max" class="col-md-4 control-label">Maximo</label>
          <div class="col-md-8">
            <input type="text" class="form-control" name="max"
              id="max" placeholder="900" maxlength="5"
              onkeypress="ValidaSoloNumeros()">
          </div>
        </div>
      </div>
      <div class="col-xs-9">
        <div class="form-group">
          <label for="min" class="col-md-4 control-label">Minimo</label>
          <div class="col-md-8">
            <input type="text" class="form-control" name="min"
              id="min" placeholder="90" maxlength="5"
              onkeypress="ValidaSoloNumeros()">
          </div>
        </div>
      </div>
      <div class="col-xs-9">
        <div class="form-group">
          <label for="cant" class="col-md-4 control-label">Cantidad</label>
          <div class="col-md-8">
            <input type="text" class="form-control" name="cant"
              id="cant" placeholder="500" maxlength="5"
              onkeypress="ValidaSoloNumeros()">
          </div>
        </div>
      </div>

      <div class="col-xs-9">
        <div class="form-group">
          <label for="costo" class="col-md-4 control-label">Costo</label>
          <div class="col-md-8">
            <input type="text" class="form-control" name="costo"
              id="costo" placeholder="costo" maxlength="8" onkeypress="ValidaSoloDecimal()">
          </div>
        </div>
      </div>

      <div class="col-xs-9 top-space-big">
        <div class="form-group">
          <label for="bodega" class="col-md-4 control-label">Bodega</label>
          <div class="col-md-8">
            <select class="form-control" name="bodega" id="bodega">
              <option value="">Selecione bodega</option>
              <?php
              $departamento = $pdo->query("SELECT * FROM sgmebod");
              while ($row = $departamento->fetch()) {
              ?>
              <option value="<?=$row["ebod_cod_ebod"]?>">
                <?=$row["ebod_det_ebod"]?>
              </option>
              <?php } ?>
            </select>
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
