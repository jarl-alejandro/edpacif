<input type="hidden" value="<?= $fecha ?>" id="DateMin">

<div class="col-xs-12">
	<div class="form-group">
		<label for="ordenTrabajo" class="col-xs-10 col-md-2 control-label">Tarea</label>
		<div class="col-xs-12 col-md-10">
			<select id="ordenTrabajoTask" class="form-control">
				<option value="">Selecione la Tarea</option>
        <?php
          $task = $pdo->query("SELECT * FROM v_tarea WHERE etare_esher_etare is null");
          while ($row = $task->fetch()) { ?>
          <option data-empleado="<?=$row['eempl_ced_eempl']?>" value="<?=$row['etare_cod_etare']?>">
            <?= $row["ltare_det_ltare"] ?>
          </option>
        <?php } ?>
			</select>
		</div>
	</div>
</div>
<div class="col-xs-12 col-md-6">
	<div class="form-group" style="display:flex;align-items:center;">
		<label for="empeado" class="col-xs-10 col-md-2 control-label">Empleado</label>
		<div class="col-xs-12 col-md-10">
			<select id="empeadoTask" class="form-control" disabled>
				<option value="">Empleado</option>
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
<div class="col-xs-12 col-md-6">
	<div class="form-group" style="display:flex;align-items:center;">
		<label for="fechaEntrega" class="col-xs-10 col-md-4 control-label">Fecha de entrega</label>
		<div class="col-xs-12 col-md-8">
			<input type="text" class="form-control datepicker" id="fechaEntregaTask" placeholder="<?= $fecha ?>">
		</div>
	</div>
</div>
<h4 style="margin-left: 1em;">Herramientas pendientes por devolver</h4>
<article class="col-xs-10" id="herramientasDevolverTask">
	<ul id="herrasmietasListaTask"></ul>
</article>

<div class="footer-form">
	<button class="btn btn-raised btn-primary ripple-effect" id='entregarHerrmientasTask'>Entregar</button>
</div>