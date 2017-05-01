<?php
date_default_timezone_set('America/Guayaquil');

$hoy = date("Y-m-d");
$fecha = date("d/m/Y");
$meses = array('Enero',  'Febrero',  'Marzo', 'Abril',  'Mayo',  'Junio', 'Julio',  'Agosto',  'Semptiembre', 'Octubre',  'Noviembre',  'Diciembre');
?>
<input type="hidden" value="<?= $fecha ?>" id="DateMin">
<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title text-center titulo">Registrar nueva ruta</h3>
  </div>
  <div class="panel-body">
    <!-- Form -->
    <form class="form-horizontal" id="FormTag">
      <input type="hidden" name="id" id="idCode">

			<div class="col-xs-9">
        <div class="form-group">
          <label for="equipo" class="col-md-4 control-label">Equipo</label>
          <div class="col-md-8">
            <select class="form-control" name="equipo" id="equipo">
              <option value="">Selecion el equipo</option>
              <?php
              $equipos = $pdo->query("SELECT * FROM smgeequi WHERE eequi_kil_eequi!=0");
              while($row = $equipos->fetch()){ ?>
              <option value="<?=$row['eequi_cod_eequi']?>"><?=$row['eequi_det_eequi']?></option>
              <?php } ?>
            </select>
          </div>
        </div>
      </div>

      <div class="col-xs-9">
        <div class="form-group">
          <label for="empleado" class="col-md-4 control-label">Chofer</label>
          <div class="col-md-8">
            <select class="form-control" name="empleado" id="empleado">
              <option value="">Selecion el Chofer</option>
              <?php
              $equipos = $pdo->query("SELECT * FROM v_empleados WHERE ecarg_det_ecarg='CHOFER'");
              while($row = $equipos->fetch()){ ?>
              <option value="<?=$row['eempl_ced_eempl']?>">
                <?= $row["eempl_nom_eempl"]." ".$row["eempl_ape_eempl"] ?>
              </option>
              <?php } ?>
            </select>
          </div>
        </div>
      </div>
			
      <div class="col xs-12">
        <div class="col-xs-6">
          <div class="form-group">
            <label for="kmInicial" class="col-md-4 control-label">KM inicial</label>
            <div class="col-md-8">
              <input type="text" class="form-control" name="kmInicial" id="kmInicial"
                placeholder="348" maxlength="5" onkeypress="ValidaSoloNumeros()">
            </div>
          </div>
        </div>
        <div class="col-xs-6">
          <div class="form-group">
            <label for="kmFinal" class="col-md-4 control-label">KM final</label>
            <div class="col-md-8">
              <input type="text" class="form-control" name="kmFinal" id="kmFinal"
                placeholder="348" maxlength="5" onkeypress="ValidaSoloNumeros()">
            </div>
          </div>
        </div>
      </div>

      <div class="col-xs-12">
				<div class="col-xs-6">
					<div class="form-group">
						<label for="fecha" class="col-md-4 control-label">Fecha Salida</label>
						<div class="col-md-8">
							<input type="text" class="form-control datepicker" name="fecha" id="fecha" placeholder="<?= $fecha ?>"/>
						</div>
					</div>
				</div>

				<div class="col-xs-6">
					<div class="form-group">
						<label for="fecha" class="col-md-4 control-label">Fecha Llegada</label>
						<div class="col-md-8">
							<input type="text" class="form-control datepicker" name="fecha-llegada"
										 id="fecha-llegada" placeholder="<?= $fecha ?>"/>
						</div>
					</div>
				</div>
      </div>

			<div class="col-xs-12">
        <div class="form-group">
          <label for="detalle" class="col-md-2 control-label">Destino</label>
          <div class="col-md-10">
            <input type="text" class="form-control" name="detalle_ruta" id="detalle_ruta"
              placeholder="Atacame, Quito y guayaquil" maxlength="100">
          </div>
        </div>
      </div>

			<div class="col-xs-12">
        <div class="form-group">
          <label for="detalle" class="col-md-2 control-label">Detalle</label>
          <div class="col-md-10">
            <input type="text" class="form-control" name="motivo" id="motivo"
              placeholder="Ingrese el motivo del viaje" maxlength="140">
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
