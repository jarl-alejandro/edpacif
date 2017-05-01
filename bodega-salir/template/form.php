<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title text-center">Registrar nuevo equipo</h3>
  </div>
  <div class="panel-body">
    <form class="form-horizontal" id="equiposForm">
      <input type="hidden" id="idEquipo" />
      <div class="col-xs-6">
        <div class="form-group">
          <label for="codigo" class="col-md-2 control-label">codigo</label>
          <div class="col-md-10">
            <input type="text" class="form-control" id="codigo" placeholder="1"
              maxlength="80" onkeypress="ValidaSoloNumeros()">
          </div>
        </div>        
      </div>

      <div class="col-xs-6">
        <div class="form-group">
          <label for="detalle" class="col-md-2 control-label">Detalle</label>
          <div class="col-md-10">
            <input type="text" class="form-control" id="detalle" placeholder="Equipo"
              maxlength="80">
          </div>
        </div>
      </div>
      <div class="col-xs-6">
        <div class="form-group">
          <label for="horas" class="col-xs-5 control-label">Horas de trabajo
          </label>
          <div class="col-xs-7">
            <input type="text" class="form-control" id="horas" 
                placeholder="434" maxlength="5" 
                onkeypress="ValidaSoloNumeros()">
          </div>
        </div>        
      </div>
      <div class="col-xs-6">
        <div class="form-group">
          <label for="kilo" class="col-xs-3 control-label">Kilometraje
          </label>
          <div class="col-xs-9">
            <input type="text" class="form-control" id="kilo" placeholder="250"
              maxlength="5" onkeypress="ValidaSoloDecimal()">
          </div>
        </div>
      </div>

      <div class="col-xs-6">
        <div class="form-group">
          <label for="subarea" class="col-xs-3 control-label">Sub Area</label>
          <div class="col-xs-9">
            <select class="form-control" id="subarea">
              <option value="">Selecciona la subarea</option>
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

      <div class="col-xs-6">
        <div class="form-group">
          <label for="subarea" class="col-xs-3 control-label">Proveedor</label>
          <div class="col-xs-9">
            <select class="form-control" id="proveedor">
              <option value="">Seleccione</option>
              <option value="interna">Interna</option>
              <option value="externa">Externa</option>
            </select>
          </div>
        </div>        
      </div>

      <div class="form-group">
        <input type="hidden" id="imagen_name" />
        <input type="file" id="equipoImage" accept="image/*" class="hidden">

        <div class="col-md-10 space-around middle top-space-big">
          <label for="equipoImage" class="btn btn-warning btn-fab btn-fab-mini" data-toggle="tooltip"
            data-placement="bottom" data-original-title="Tooltip on bottom">
            <i class="fa fa-file-image-o" aria-hidden="true"></i>
          </label>
          <img src="" class="imagen__equipo" />
        </div>
      </div>
      <div class="end-flex">
        <button class="btn__flat orange" id="cellar-add">
          <i class="fa fa-cart-plus white-text" aria-hidden="true"></i>
        </button>
      </div>
      <table class="table table-bordered top-space">
        <thead>
          <tr>
            <th>Cant</th>
            <th>Description</th>
            <th>Valor</th>
            <th>Total</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody id="detalleEquipo"></tbody>
      </table>
    </form>
    <div class="footer-pane top-space center">
      <button class="btn btn-raised btn-danger" id="cancelar">Cancelar</button>
      <button class="btn btn-raised btn-info" id="save">Guardar</button>
    </div>
  </div>
</div>
<div class="panel panel-danger panel-inventario none">
  <div class="panel-heading">
    <h3 class="panel-title text-center">Inventario</h3>
  </div>
  <div class="panel-body">
    <?php
    $inventario = $pdo->query("SELECT * FROM sgmeinve
                    ORDER BY einven_cod_einven ASC");
    while ($row = $inventario->fetch()) {
    ?>
    <div class="row">
      <h5 class="col-xs-4"><?= $row["einven_pro_einven"] ?></h5>
      <div class="form-group col-xs-6">
        <div class="col-md-12">
          <input type="text" class="form-control cant-input"
              id="cant<?= $row["einven_cod_einven"]?>"
              placeholder="Cant" maxlength="8"
              onkeypress="ValidaSoloNumeros()">
        </div>
      </div>
      <div class="col-xs-2">
        <button class="btn__flat orange add-inve"
          data-id="<?= $row["einven_cod_einven"]?>"
          data-producto="<?= $row["einven_pro_einven"]?>"
          data-price="<?= $row["einven_cos_einven"]?>"
          >
          <i class="fa fa-cart-plus white-text" aria-hidden="true"></i>
        </button>
      </div>
    </div>
    <?php } ?>
    <div class="center">
      <button class="btn__flat red text-minun close--inven">Cerrar</button>
    </div>
  </div>
</div>
