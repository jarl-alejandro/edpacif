<?php
date_default_timezone_set('America/Guayaquil');
$hoy = date("Y-m-d");
$fecha = date("d/m/Y");

?>
<input type="hidden" value="<?= $fecha ?>" id="DateMin">
<input type="hidden" id="id_tarea_revisar">
<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title text-center">Tareas</h3>
  </div>
  <div class="panel-body">
    <form class="form-horizontal" id="tareas">
      <input type="hidden" id="task_id">

      <div class="col-xs-6">
        <div class="form-group">
          <label for="area" class="col-xs-3 control-label">Area</label>
          <div class="col-xs-9">
            <select type="text" class="form-control" id="area" name="area">
              <option value="">Selecion el area</option>
              <?php
               $area = $pdo->query("SELECT * FROM sgmearea ORDER BY earea_cod_earea ASC");
               while ($row = $area->fetch()) { ?>
                <option value="<?=$row['earea_cod_earea']?>"><?=$row['earea_det_earea']?></option>               
              <?php } ?>
            </select>
          </div>
        </div>
      </div>

      <div class="col-xs-6">
        <div class="form-group">
          <label for="subarea" class="col-xs-3 control-label">Sub area</label>
          <div class="col-xs-9" id="subareaContainer">
            <select type="text" class="form-control" id="subarea" name="subarea">
              <option value="">Debe escoger primero el area</option>
            </select>
          </div>
        </div>
      </div>

      <div class="col-xs-6">
        <div class="form-group">
          <label for="empleado" class="col-md-2 control-label">Empleado</label>
          <div class="col-md-10">
            <select id="empleado" class="form-control" name="empleado">
              <option value="">Selecione el empleado</option>
              <?php
                $empleados = $pdo->query("SELECT * FROM sgmeempl");
                while ($row = $empleados->fetch()) { ?>
                <option value="<?=$row['eempl_ced_eempl']?>">
                  <?= $row["eempl_nom_eempl"]." ".$row["eempl_ape_eempl"] ?>
                </option>
              <?php } ?>
            </select>
          </div>
        </div>    
      </div>

      <div class="col-xs-6">
        <div class="form-group">
          <label for="equipo" class="col-md-2 control-label">Equipos</label>
          <div class="col-md-10" id="equipoContainer">
            <select id="equipo" class="form-control" name="equipo">
              <option value="">Selecione la sub area</option>
            </select>
          </div>
        </div>    
      </div>

      <div class="col-xs-6 col-xs-offset-3">
        <div class="form-group">
          <label for="fecha" class="col-md-2 control-label">Fecha</label>
          <div class="col-md-10">
            <input type="text" class="form-control datepicker" id="fecha" 
            placeholder="<?=$fecha?>" name="fecha">
          </div>
        </div>        
      </div>     

      <div class="col-xs-12">
        <div class="form-group">
          <label for="detalle" class="col-md-2 control-label">Detalle</label>
          <div class="col-md-10" id="tareasContainer">
            <select id="detalle" class="form-control" name="detalle">
              <option value="">Selecione primero el area</option>
            </select>
          </div>
        </div>
      </div>
      <div class="col-xs-4 col-xs-offset-1">
          <button class="btn btn-raised center" id="modalTarea">Tarea</button>          
      </div>
      
      <!-- Informe -->
      <div class="col-xs-12 margin--tb none informLayout">
        <div class="form-group">
          <label for="informe" class="col-md-2 control-label">Informe</label>
          <div class="col-md-10">
            <input type="text" class="form-control" id="informe" name="informe">
          </div>
        </div>
      </div>

      <div class="form-group text-center">
        <div class="col-xs-12">
          <div class="col-xs-4">
            <div class="radio radio-primary">
              <label>
                <input type="radio" name="prioridad" class="prioridad"
                      value="#F44336_1">
                Alto
              </label>
            </div>
          </div>
          <div class="col-xs-4">
            <div class="radio radio-primary">
              <label>
                <input type="radio" name="prioridad" class="prioridad" 
                      value="#4CAF50_2">
                Medio
              </label>
            </div>
          </div>
          <div class="col-xs-4">
            <div class="radio radio-primary">
              <label>
                <input type="radio" name="prioridad" value="#ead72e_3"
                    class="prioridad">
                Bajo
              </label>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xs-12 none container-materiales" style="display:flex;justify-content:space-around;">
        <button class="btn btn-raised ripple-effect btn-primary" id="btn-mater">Materiales</button>
        <button class="btn btn-raised ripple-effect btn-warning" id="btn-herram">Herramientas</button>
      </div>

    </form>
    <div class="footer-pane space-top center col-xs-12">
      <button class="btn btn-raised ripple-effect btn-warning none" 
          id="btn-tiempos">Tiempos</button>
      <button class="btn btn-raised btn-primary none" id="aprobarMat">Aprobar</button>
      <button class="btn btn-raised btn-danger" id="cancelar">Cancelar</button>
      <button class="btn btn-raised btn-info" id="save">Guardar</button>
      <button class="btn btn-raised btn-info none" id="finish">Terminar</button>
    </div>
  </div>
</div>

<div class="panel panel-danger Orden__mensaje none">
  <div class="panel-heading">
    <h3 class="panel-title text-center">Comentario</h3>
  </div>
  <div class="panel-body">
    <div class="form-group">
      <div class="col-md-12">
        <input type="text" class="form-control" id="comment"
                placeholder="Cambio de aceite">
      </div>
    </div>
    <div class="top-space-big text-center">
      <button class="btn__flat text-normal green" id="commnetAcept">
        Aceptar
      </button>
    </div>
  </div>
</div>

<div id="modalTareaForm">
  <input type="checkbox" id="tareaFormChecked" class="none">
  <?php include "../listado-tareas/template/form.php" ?>
</div>


<!-- Herramientas -->
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
    <div class="col-xs-12 center">
      <button class="btn btn-raised btn-danger" id="panelHerramAceptar">Aceptar</button>
    </div>
  </div>
</div>
<!-- /Herramientas -->

<!-- materiales -->
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
    <div class="col-xs-12 center">
      <button class="btn btn-raised btn-danger" id="panelMaterAceptar">Aceptar</button>
    </div>
  </div>
</div>
<!-- /materiales -->

<!-- Listado de Herramientas -->
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
    $herramientasTask = $pdo->query("SELECT * FROM sgmeherr ORDER BY eherr_cod_eherr ASC");
    while ($row = $herramientasTask->fetch()) {
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
    <button class="btn__flat red text-minun close--herr">Cerrar</button>
  </div>
</div>
<!-- /Listado de Herramientas -->

<!-- Listado de Materiales -->
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

<!-- Tiempos -->
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
        <input id="fechaDateTime" class="form-control datepicker" placeholder="<?=$fecha?>" />
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
    </div>
  </div>
</div>
<!-- /Tiempos -->