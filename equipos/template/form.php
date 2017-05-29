<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title text-center titulo">Registrar nuevo equipo</h3>
  </div>
  <div class="panel-body">
    <form class="form-horizontal" id="equiposForm">
      <input type="hidden" id="idEquipo" />
      <input type="hidden" name="newGeneral" id="newGeneral">
      <article class="col-xs-12">
        <div class="togglebutton">
          <label>
            Equipo / Vehiculo
            <input type="checkbox" checked="" id="esCheckedVehiculo">
          </label>
        </div>
      </article>
      <div class="col-xs-6">
        <div class="form-group">
          <label for="nombreEquipo" class="col-md-2 control-label">Detalle</label>
          <div class="col-md-10">
            <input type="text" class="form-control" id="nombreEquipo" placeholder="Equipo"
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
                onkeypress="ValidaSoloNumeros()" disabled>
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
          <label for="area" class="col-xs-3 control-label">Area</label>
          <div class="col-xs-9">
            <select class="form-control" id="area">
              <option value="">Selecciona la area</option>
              <?php
              $area = $pdo->query("SELECT * FROM sgmearea ORDER BY earea_cod_earea ASC");
              while ($row = $area->fetch()) {
              ?>
              <option value="<?=$row["earea_cod_earea"]?>"><?=$row["earea_det_earea"]?></option>
              <?php } ?>
            </select>
          </div>
        </div>
      </div>

      <div class="col-xs-6">
        <div class="form-group">
          <label for="subarea" class="col-xs-3 control-label">Sub Area</label>
          <div class="col-xs-9" id="containerSubArea">
            <select class="form-control" id="subarea">
              <option value="">Selecciona la area</option>
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

      <div class="col-xs-12 space-around">
        <div class="col-xs-4">
          <div class="checkbox radio-primary">
            <label>
              <input type="checkbox" id="activeHoras" disabled>
              Activar horas
            </label>
          </div>
        </div>

        <div class="col-xs-4">
          <div class="checkbox radio-primary">
            <label>
              <input type="checkbox" id="activeKilometros" disabled checked>
              Activar kilometraje
            </label>
          </div>
        </div>

        <div class="col-xs-4">
          <div class="form-group">
            <label for="fechaCompra" class="col-xs-3 control-label">Fecha de compra
            </label>
            <div class="col-xs-9">
              <input type="text" class="form-control datepicker" id="fechaCompra">
            </div>
          </div>
        </div>
      </div>

      <div class="col-xs-9">
        <button class="btn btn-raised ripple-effect btn-primary none" id="equipoModal">Equipo</button>
        <button class="btn btn-raised ripple-effect btn-warning" id="vehiculoModal">
          Vehiculo
        </button>
        <button class="btn btn-raised ripple-effect btn-primary" id="bajaEquipoBtn"
          style="display:none">
          Baja de equipo
        </button>
      </div>

      <div class="form-group">
        <input type="hidden" id="imagen_name" />
        <input type="file" id="equipoImage" accept="image/*" class="hidden">

        <div class="col-md-10 space-around middle">
          <label for="equipoImage" class="btn btn-warning btn-fab btn-fab-mini" data-toggle="tooltip"
            data-placement="bottom" data-original-title="Tooltip on bottom">
            <i class="fa fa-file-image-o" aria-hidden="true"></i>
          </label>
          <img src="" class="imagen__equipo" style="height:6em;width:9em !important;"/>
        </div>
      </div>

      <div class="end-flex conatinerBtnHelpers">
        <button class="btn__flat orange" id="cellar-add">
          <i class="fa fa-cart-plus white-text" aria-hidden="true"></i>
        </button>
      </div>
      <div style="height: 9em;overflow-y: scroll;">

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
      </div>
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
  <div class="input-group space-padding">
    <span class="input-group-addon" id="searchInventartio">
      <i class="fa fa-search black-text" aria-hidden="true"></i>
    </span>
    <input type="text" id="searchInven" class="form-control"
      placeholder="Escribe lo que andas buscando" aria-describedby="searchInventartio" />
  </div>
  <section class="panel-body" id="Tab_FilterInventario">
    <article></article>
    <?php
    $inventario = $pdo->query("SELECT * FROM sgmeinve
                    ORDER BY einven_cod_einven ASC");
    while ($row = $inventario->fetch()) {
    ?>
    <article class="row">
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
          data-cant="<?= $row["einven_cant_einven"]?>"
          >
          <i class="fa fa-cart-plus white-text" aria-hidden="true"></i>
        </button>
      </div>
    </article>
    <?php } ?>
  </section>
  <div class="col-xs-12 center">
    <ul class="pagination" id="NavPosicionInventario"></ul>
  </div>
  <div class="col-xs-12 center">
    <button class="btn__flat red text-minun close--inven">Cerrar</button>
  </div>
</div>

<div class="panel panel-primary" id="InformacionEquipo">
  <div class="panel-heading">
    <h3 class="panel-title text-center titutlo-informacion">Informacion del equipo</h3>
  </div>
  <div class="panel-body">
    <div class="col-xs-12">
      <div class="col-xs-6">
        <label for="inputModel">Escribe el modelo del <span class="informacioEQ">equipo</span>*</label>
        <input type="text" class="form-control" id="inputModel"
          placeholder="Ingresa...">
      </div>
      <div class="col-xs-6">
       <label for="inputModel">Escribe la marca de <span class="informacioEQ">equipo</span>*</label>
        <input type="text" class="form-control" id="inputMarca"
          placeholder="Ingresa...">
      </div>
    </div>

    <div class="col-xs-12">
      <div class="col-xs-6">
        <label for="inputModel">Escribe el año del <span class="informacioEQ">equipo</span>*</label>
        <input type="text" class="form-control" id="inputYer"
          placeholder="Ingresa..." onkeypress="ValidaSoloNumeros()">
      </div>
      <div class="col-xs-6">
        <label for="inputModel">Escribe el número de factura del *</label>
        <input type="text" class="form-control" id="inputNumeriFacu"
          placeholder="Ingresa..." onkeypress="ValidaSoloNumeros()">
      </div>
    </div>

    <div class="col-xs-12">
      <div class="col-xs-6">
        <label for="inputModel">Escribe el valor del <span class="informacioEQ">equipo</span>*</label>
        <input type="text" class="form-control" id="inputValor"
          placeholder="Ingresa..." onkeypress="ValidaSoloDecimal()">
      </div>
      <div class="col-xs-6">
        <label for="inputModel">Escribe la serie del <span class="informacioEQ">equipo</span>*</label>
        <input type="text" class="form-control" id="inputSerie"
          placeholder="Ingresa...">
      </div>
    </div>
    <div class="containerVehiculo none">
      <input type="checkbox" id="VehiculoBox" class="none">
      <div class="col-xs-12">
        <div class="col-xs-6">
          <label for="inputModel">Escribe la placa del vehiculo *</label>
          <input type="text" class="form-control" id="inputPlaca"
            placeholder="Ingresa...">
        </div>
        <div class="col-xs-6">
          <label for="inputModel">Escribe la serie del chasis *</label>
          <input type="text" class="form-control" id="inputSerieChasis"
            placeholder="Ingresa...">
        </div>
      </div>
      <div class="col-xs-12">
        <div class="col-xs-12">
          <label for="inputModel">Escribe la serie del motor *</label>
          <input type="text" class="form-control" id="inputSerieMotor"
              placeholder="Ingresa...">
        </div>
      </div>
    </div>

    <div class="col-xs-12 center">
      <button class="btn btn-warning" id="InformacionEquipo--aceptar">Aceptar</button>
    </div>
  </div>
</div>