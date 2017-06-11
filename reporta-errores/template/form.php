<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title text-center titulo">Registra daños en el equipo</h3>
  </div>
  <div class="panel-body">
    <!-- Form -->
    <form class="form-horizontal" id="areaGeneralForm" style="top: 4em;">
      <input type="hidden" name="id" id="idCode">
      <div class="col-xs-12 col-md-9">
        <div class="form-group">
          <label for="equipo" class="col-md-4 control-label">Equipo</label>
          <div class="col-xs-12 col-md-8">
            <select id="equipo" class="form-control">
              <option value="">Ingrese el equipo</option>
              <?php
                $equipos = $pdo->query("SELECT * FROM smgeequi WHERE eequi_baja_eequi='0'");
                while ($row = $equipos->fetch()) { ?>
                <option value="<?= $row['eequi_cod_eequi'] ?>"><?= $row['eequi_det_eequi'] ?></option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="detalle" class="col-md-4 control-label">Detalle</label>
          <div class="col-xs-12 col-md-8">
            <textarea class="form-control" id="detalle_name"
              placeholder="Ingrese errores del equipo" ></textarea>
          </div>
        </div>

      </div>
      <div class="col-xs-12 footer-pane top-space center">
        <button class="btn btn-raised btn-info" id="saved-btn">Guardar</button>
      </div>
    </form>
    <!-- /Form -->
  </div>
</div>
