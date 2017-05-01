<?php
$hoy = date("Y-m-d");
?>
<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title text-center">Orden</h3>
  </div>
  <div class="panel-body">
    <form class="form-horizontal" id="">
      <input type="hidden" id="orden_id">
      <div class="col-xs-6">
        <div class="form-group">
          <label for="empleado" class="col-md-2 control-label">Empleado</label>
          <div class="col-md-10">
            <select id="empleado" class="form-control">
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
          <div class="col-md-10">
            <select id="equipo" class="form-control">
              <option value="">Selecione el Equipo</option>
              <?php
                $equipos = $pdo->query("SELECT * FROM smgeequi");
                while ($row = $equipos->fetch()) { ?>
                <option value="<?=$row['eequi_cod_eequi']?>">
                  <?= $row["eequi_det_eequi"] ?>
                </option>
              <?php } ?>
            </select>
          </div>
        </div>    
      </div>
      <div class="col-xs-6 margin--tb">
        <div class="form-group">
          <label for="fecha" class="col-md-2 control-label">Fecha</label>
          <div class="col-md-10">
            <input type="date" class="form-control" id="fecha" 
            min="<?=$hoy?>">
          </div>
        </div>        
      </div>
      
      <div class="none" id="layoutInforme">
        <div class="col-xs-12">
          <div class="form-group">
            <label for="equipo" class="col-md-2 control-label">Detalle</label>
            <div class="col-md-10">
              <input type="text" class="form-control" id="detalle" />
            </div>
          </div>    
        </div>
        <div class="col-xs-12 margin--tb">
          <div class="form-group">
            <label for="equipo" class="col-md-2 control-label">Informe</label>
            <div class="col-md-10">
              <input type="text" class="form-control" id="informe" />
            </div>
          </div>    
        </div>
      </div>
      <table class="table table-bordered top-space">
        <thead>
          <tr>
            <th>Codigo</th>
            <th>Detalle</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody id="detalleEquipoTabla"></tbody>
      </table>
    </form>
    <div class="footer-pane space-top center">
      <button class="btn btn-raised btn-danger" id="cancelar">Cerrar</button>
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