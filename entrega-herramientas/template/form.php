<input type="hidden" value="<?= $fecha ?>" id="DateMin">

<div class="col-xs-12">
	<div class="form-group">
		<label for="ordenTrabajo" class="col-xs-10 col-md-2 control-label">Orden de trabajo</label>
		<div class="col-xs-12 col-md-10">
			<select id="ordenTrabajo" class="form-control">
				<option value="">Selecione la orden de trabajo</option>
        <?php
          $orden = $pdo->query("SELECT * FROM sgmeorin WHERE eorin_esher_eorin is null");
          while ($row = $orden->fetch()) { ?>
          <option data-empleado="<?=$row['eorin_emp_eorin']?>" value="<?=$row['eorin_cod_eorin']?>">
            <?= $row["eorin_det_eorin"] ?>
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
			<select id="empeado" class="form-control" disabled>
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
			<input type="text" class="form-control datepicker" id="fechaEntrega" placeholder="<?= $fecha ?>">
		</div>
	</div>
</div>
<h4 style="margin-left: 1em;">Herramientas pendientes por devolver</h4>
<article class="col-xs-10" id="herramientasDevolver">
	<ul id="herrasmietasLista"></ul>
</article>

<div class="footer-form">
	<button class="btn btn-raised btn-primary ripple-effect" id='entregarHerrmientas'>Entregar</button>
</div>