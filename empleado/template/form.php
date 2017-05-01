<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title text-center titulo">Registrar nuevo empleado</h3>
  </div>
  <div class="panel-body">
    <form class="form-horizontal" id="">
      <input type="hidden" id="id_employee" />
      <div class="form-group">
        <label for="cedula" class="col-md-2 control-label">Cedula</label>
        <div class="col-md-10">
          <input type="text" class="form-control" id="cedula" placeholder="1718090761"
          onkeypress="ValidaSoloNumeros()" maxlength="13">
        </div>
      </div>
      <div class="form-group">
        <label for="nombre" class="col-md-2 control-label">Nombre</label>
        <div class="col-md-10">
          <input type="text" class="form-control" id="nombre" placeholder="Juan"
          onkeypress="txNombres()" maxlength="80">
        </div>
      </div>
      <div class="form-group">
        <label for="apellido" class="col-md-2 control-label">Apellido</label>
        <div class="col-md-10">
          <input type="text" class="form-control" id="apellido" placeholder="Perez"
          onkeypress="txNombres()" maxlength="80">
        </div>
      </div>
      <div class="form-group">
        <label for="direccion" class="col-md-2 control-label">Direccion</label>
        <div class="col-md-10">
          <input type="text" class="form-control" id="direccion" placeholder="Via Quevedo"
          maxlength="140">
        </div>
      </div>
      <div class="form-group">
        <label for="telefono" class="col-md-2 control-label">Telefono</label>
        <div class="col-md-10">
          <input type="text" class="form-control" id="telefono" maxlength="10"
            placeholder="028712387" onkeypress="ValidaSoloNumeros()">
        </div>
      </div>
      <div class="form-group">
        <label for="email" class="col-md-2 control-label">E-mail</label>
        <div class="col-md-10">
          <input type="text" class="form-control" id="email"
              placeholder="perez@gmail.com" maxlength="140" />
        </div>
      </div>
      <div class="form-group">
        <label for="sueldo" class="col-md-2 control-label">Sueldo</label>
        <div class="col-md-10">
          <input type="text" class="form-control" id="sueldo"
              placeholder="50" maxlength="4" onkeypress="ValidaSoloDecimal()" />
        </div>
      </div>

      <div class="form-group">
        <label for="rol" class="col-md-2 control-label">Cargo</label>
        <div class="col-md-10">
          <select id="rol" class="form-control">
            <option value="">Seleciona el cargo de empleado</option>
            <?php
              $cargo = $pdo->query("SELECT * FROM sgmecarg");
              while ($row = $cargo->fetch()) {?>
              <option value="<?= $row['ecarg_cod_ecarg'] ?>">
                <?= $row['ecarg_det_ecarg'] ?>
              </option>
              <?php }
            ?>
          </select>
        </div>
      </div>
    </form>
    <div class="footer-pane space-top center">
      <button class="btn btn-raised btn-danger" id="cancelar">Cancelar</button>
      <button class="btn btn-raised btn-info" id="save">Guardar</button>
    </div>
  </div>
</div>
