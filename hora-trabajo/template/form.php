<?php
date_default_timezone_set('America/Guayaquil');

$hoy = date("Y-m-d");
$fecha = date("d/m/Y");
$meses = array('Enero',  'Febrero',  'Marzo', 'Abril',  'Mayo',  'Junio', 'Julio',  'Agosto',  'Semptiembre', 'Octubre',  'Noviembre',  'Diciembre');
?>
<input type="hidden" value="<?= $fecha ?>" id="DateMin">
<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title text-center">Registrar nueva horas de trabajo</h3>
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
              $equipos = $pdo->query("SELECT * FROM smgeequi WHERE eequi_horas_eequi!=0");
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
						<input type="hidden" id="empleado" value="<?= $_SESSION["3188768e18a5c00164bbe22d1749a30e4626a114"] ?>">
						<input type="text" disabled class="form-control" value="<?= $_SESSION["f9f011a553550aef31a8ee2690e1d1b5f261c9ff"] ?>">
          </div>
        </div>
      </div>

			<div class="col-xs-12">
				<div class="col-xs-6">
					<div class="form-group">
						<label for="fecha" class="col-md-4 control-label">Fecha inicial</label>
						<div class="col-md-8">
							<input type="text" class="form-control datepicker" name="fecha" id="fecha" value="<?= $fecha ?>"/>
						</div>
					</div>
				</div>

				<div class="col-xs-6">
					<div class="form-group">
						<label for="fecha" class="col-md-4 control-label">Fecha final</label>
						<div class="col-md-8">
							<input type="text" class="form-control datepicker" name="fecha-llegada"
										 id="fecha-llegada" placeholder="<?= $fecha ?>"/>
						</div>
					</div>
				</div>
      </div>
			
      <div class="col xs-12">
        <div class="col-xs-6">
          <div class="form-group">
            <label for="kmInicial" class="col-md-4 control-label">Hora</label>
            <div class="col-md-8">
              <input type="time" class="form-control" name="hora" id="hora">
            </div>
          </div>
        </div>
        <div class="col-xs-6">
          <div class="form-group">
            <label for="kmFinal" class="col-md-4 control-label">Hora Final</label>
            <div class="col-md-8">
              <input type="time" class="form-control" name="hora-final" id="hora-final">
            </div>
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
