<input type="hidden" value="<?= $fecha ?>" id="DateMin">

<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title text-center titulo-orden-form">Nueva orden de trabajo</h3>
  </div>
  <div class="panel-body">
    <form>
      <div class="col-xs-12">
        <div class="col-xs-6 middle">
          <label for="fechaEmision" class="col-xs-4 control-label">Fecha de emision</label>
          <div class="col-xs-6">
            <input type="text" class="form-control" id="fechaEmision" value="<?=$hoy?>" disabled>
          </div>
        </div>
        <div class="col-xs-6 middle">
          <label for="emitidoPor" class="col-xs-3 control-label">Emitido por</label>
          <div class="col-xs-7">
            <input type="text" class="form-control" id="emitidoPor" value="<?= $nombre ?>" disabled>
          </div>
        </div>
      </div>

      <div class="col-xs-12">
        <div class="col-xs-6 middle">
          <label for="subarea" class="col-xs-3 control-label">Subarea</label>
          <div class="col-xs-7">
            <select id="subarea" class="form-control">
              <option value="">Selecione la subarea</option>
              <?php
                $subarea = $pdo->query("SELECT * FROM sgmesuba ORDER BY subare_cod_subare ASC");
                while($row = $subarea->fetch()){
              ?>
              <option value="<?= $row["subare_cod_subare"] ?>"><?= $row["subare_det_subare"] ?></option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="col-xs-6 middle">
          <label for="equipo" class="col-xs-3 control-label">Equipo</label>
          <div class="col-xs-7" id="equipoContainer">
            <select id="equipo" class="form-control">
              <option value="">Debes selecionar primero la subarea</option>
            </select>
          </div>
        </div>
      </div>

      <div class="col-xs-12">
        <div class="col-xs-6 middle">
          <label for="trabajo" class="col-xs-3 control-label">Trabajo</label>
          <div class="col-xs-7">
            <input id="trabajo" class="form-control" disabled value="INTERNO"/>
          </div>
        </div>

        <div class="col-xs-6 middle">
          <label for="empleado" class="col-xs-3 control-label">Empleado</label>
          <div class="col-xs-7">
            <select id="empleado" class="form-control">
              <option value="">Selecione el empleado</option>
              <?php
                $empleado = $pdo->query("SELECT * FROM sgmeempl");
                while($row = $empleado->fetch()){
              ?>
              <option value="<?= $row["eempl_ced_eempl"] ?>">
                <?= $row["eempl_nom_eempl"]." ".$row["eempl_ape_eempl"] ?>
              </option>
              <?php } ?>
            </select>
          </div>
        </div>
      </div>

      <div class="col-xs-12 middle">
        <div class="col-xs-3">
          <label for="mantenimiento" class="col-xs-3 control-label">Mantenimiento</label>
        </div>

         <div class="col-xs-3">
          <div class="radio radio-primary">
            <label>
              <input type="radio" name="mantenimiento" class="mantenimiento" value="Programado">Programado
            </label>
          </div>
        </div>
        <div class="col-xs-3">
          <div class="radio radio-primary">
            <label>
              <input type="radio" name="mantenimiento" class="mantenimiento" value="Preventivo">Preventivo
            </label>
          </div>
        </div>
        <div class="col-xs-3">
          <div class="radio radio-primary">
            <label>
              <input type="radio" name="mantenimiento" class="mantenimiento" value="Correctivo">Correctivo
            </label>
          </div>
        </div>
      </div>

      <div class="col-xs-12">
        <textarea id="detalle" rows="5" placeholder="DESCRIPCIÓN DEL TRABAJO" class="form-control"></textarea>
      </div>
      <div class="none" id="botoneraOrdenTrabajo">
        <div class="col-xs-12 middle center">
          <button class="btn btn-raised btn-default" id="tiempos">Tiempos</button>
          <button class="btn btn-raised btn-warning" id="herramientas">Herramientas</button>
          <button class="btn btn-raised btn-success" id="materiales">Materiales</button>
          <!-- <a href="#" target="_blank" id="ver_diagnosticos">Ver diagnostico</a> -->

        </div>
        <div class="col-xs-12" id="containerObse">
          <textarea id="observacion" rows="4" class="form-control"></textarea>
        </div>
      </div>
      <div class="col-xs-12 center">
        <button class="btn btn-raised btn-danger" id="ordenFormCancelar">Cancelar</button>
        <button class="btn btn-raised btn-info" id="ordenFormAceptar">Aceptar</button>
        <button class="btn btn-raised btn-info none" id="ordenFormTerminar">Terminar</button>
        <button class="btn btn-raised btn-warning none" id="ordenFormIncompleto">Incompleto</button>
        <button class="btn btn-raised btn-info none" id="ordenFormAprobar">Aprobar</button>
      </div>
    </form>
  </div>
</div>



<div class="panel panel-success panel-tiempos">
  <div class="panel-heading">
    <h3 class="panel-title text-center">Tiempo de trabajo realizado</h3>
  </div>
  <div class="panel-body">

    <div class="col-xs-6 space-around middle">
      <h4 class="text-center">INICIO</h4>
      <table class="table table-bordered table-default table-striped nomargin">
        <thead>
          <tr>
            <th>Fecha</th>
            <th>Hora</th>
          </tr>
        </thead>
        <tbody id="tableinicio">
          <td></td>
          <td></td>
        </tbody>
      </table>
    </div>

    <div class="col-xs-6 space-around middle">
      <h4 class="text-center">FIN</h4>
      <button class="btn__flat btn-success showFormTime"
        style="font-size: 16px;margin-bottom: 10px;padding: 6px 15px" data-type="fin">
        <i class="fa fa-clock-o white-text" aria-hidden="true"></i>
      </button>
      <button class="btn__flat btn-primary showFormTimeEdit"
        style="font-size: 16px;margin-bottom: 10px;padding: 6px 15px" data-type="fin">
        <i class="fa fa-clock-o white-text" aria-hidden="true"></i>
      </button>
      <table class="table table-bordered table-default table-striped nomargin">
        <thead>
          <tr>
            <th>Fecha</th>
            <th>Hora</th>
          </tr>
        </thead>
        <tbody id="tablefin">
          <td></td>
          <td></td>
        </tbody>
      </table>
      <button class="btn btn-raised btn-default" id="ordenFormTimeFin">Ingresar tiempos</button>
    </div>

    <div class="col-xs-12 center">
      <button class="btn btn-raised btn-danger" id="panelTiempoAceptar">Aceptar</button>
    </div>
  </div>
</div>

<div class="panel panel-primary form__date-time">
  <div class="panel-body">
    <div class="col-xs-6 middle">
      <label for="fechaDateTime" class="col-xs-2 control-label">Fecha</label>
      <div class="col-xs-7">
        <input id="fechaDateTime" class="form-control datepicker" placeholder="Ingrese le fecha que termino" />
      </div>
    </div>

    <div class="col-xs-6 middle">
      <label for="horaDateTime" class="col-xs-2 control-label">Hora</label>
      <div class="col-xs-7">
        <input id="horaDateTime" type="time" class="form-control"  />
      </div>
    </div>
    <div class="col-xs-12 center">
      <button class="btn btn-raised btn-danger" id="cancelDateTime">Cancelar</button>
      <button class="btn btn-raised btn-success" id="saveDateTime">Aceptar</button>
      <button class="btn btn-raised btn-success" id="updateDateTime">Aceptar</button>
    </div>
  </div>
</div>

<div class="panel panel-success panel-materiales">
  <div class="panel-heading">
    <h3 class="panel-title text-center">Materiales</h3>
  </div>
  <div class="panel-body">
    <div class="col-xs-12">
      <div class="col-xs-offset-11">
        <button class="btn__flat orange" id="materialesAdd"
          style="font-size: 16px;margin-bottom: 10px;padding: 6px 15px">
          <i class="fa fa-cart-plus white-text" aria-hidden="true"></i>
        </button>
      </div>
    </div>
    <div class="scroll">
      <table class="table table-bordered table-default table-striped nomargin">
        <thead>
          <tr>
            <th>Cant</th>
            <th>Detalle</th>
            <th>Valor Unit</th>
            <th>Valor Total</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody id="tablemateriales"></tbody>
      </table>
    </div>
    <div class="col-xs-12 center">
      <button class="btn btn-raised btn-danger" id="panelMaterAceptar">Aceptar</button>
    </div>
  </div>
</div>

<div class="panel panel-warning panel-herramienta">
  <div class="panel-heading">
    <h3 class="panel-title text-center">Herramientas</h3>
  </div>
  <div class="panel-body">
    <div class="col-xs-12">
      <div class="col-xs-offset-11">
        <button class="btn__flat orange" id="Herramientasadd"
          style="font-size: 16px;margin-bottom: 10px;padding: 6px 15px">
          <i class="fa fa-cart-plus white-text" aria-hidden="true"></i>
        </button>
      </div>
    </div>
    <div class="scroll">
      <table class="table table-bordered table-default table-striped nomargin">
        <thead>
          <tr>
            <th>Cant</th>
            <th>Detalle</th>
            <th>Valor Unit</th>
            <th>Valor Total</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody id="tableHerramientas"></tbody>
      </table>
    </div>
    <div class="col-xs-12 center">
      <button class="btn btn-raised btn-danger" id="panelHerramAceptar">Aceptar</button>
    </div>
  </div>
</div>

<div class="panel panel-danger panel-inventario none" style="top:-5em">
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
              id="cant<?= $row["einven_cod_einven"]?>inv"
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
  <div class="col-xs-12 center" style="margin-bottom: 1em;">
    <button class="btn__flat red text-minun close--inven">Cerrar</button>
  </div>
</div>

<div class="panel panel-danger panel-listadoHerramientas none" style="top:-5em">
  <div class="panel-heading">
    <h3 class="panel-title text-center">Listado de herramienta</h3>
  </div>
  <div class="input-group space-padding">
    <span class="input-group-addon" id="searchHerrList">
      <i class="fa fa-search black-text" aria-hidden="true"></i>
    </span>
    <input type="text" id="searchHerr" class="form-control"
      placeholder="Escribe lo que andas buscando" aria-describedby="searchHerrList" />
  </div>
  <section class="panel-body" id="Tab_FilterHermienta">
    <article></article>
    <?php
    $herramientas = $pdo->query("SELECT * FROM sgmeherr ORDER BY eherr_cod_eherr ASC");
    while ($row = $herramientas->fetch()) {
    ?>
    <article class="row">
      <h5 class="col-xs-4"><?= $row["eherr_det_eherr"] ?></h5>
      <div class="form-group col-xs-6">
        <div class="col-md-12">
          <input type="text" class="form-control cant-input"
              id="cant<?= $row["eherr_cod_eherr"]?>"
              placeholder="Cant" maxlength="8"
              onkeypress="ValidaSoloNumeros()">
        </div>
      </div>
      <div class="col-xs-2">
        <button class="btn__flat orange add-herr"
          data-id="<?= $row["eherr_cod_eherr"]?>"
          data-producto="<?= $row["eherr_det_eherr"]?>"
          data-price="<?= $row["eherr_cos_eherr"]?>"
          data-cant="<?= $row["eherr_cant_eherr"]?>"
          >
          <i class="fa fa-cart-plus white-text" aria-hidden="true"></i>
        </button>
      </div>
    </article>
    <?php } ?>
  </section>
  <div class="col-xs-12 center">
    <ul class="pagination" id="NavPosicionHerramientas"></ul>
  </div>
  <div class="col-xs-12 center" style="margin-bottom: 1em;">
    <button class="btn__flat red text-minun close--her">Cerrar</button>
  </div>
</div>

<div class="panel panel-success panel-editar col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3">
  <div class="panel-heading">
    <div class="panel-title text-center">Editar</div>
  </div>
  <div class="panel-body">
    <div class="form-group">
        <div class="col-md-12">
          <input type="text" class="form-control cant-input"
              id="EditarHerrInv"
              placeholder="Ingresa la cantidad" maxlength="8"
              onkeypress="ValidaSoloNumeros()">
        </div>
      </div>
      <div class="col-xs-12 text-center">
        <button class="btn btn-raised btn-danger" id='cancelarEditMET'>Cancelar</button>
        <button class="btn btn-raised btn-primary" id='aceptarEditMET'>Aceptar</button>
      </div>
  </div>
</div>