<?php
date_default_timezone_set('America/Guayaquil');

$hoy = date("Y-m-d");
$fecha = date("d/m/Y");
$meses = array('Enero',  'Febrero',  'Marzo', 'Abril',  'Mayo',  'Junio', 'Julio',  'Agosto',  'Semptiembre', 'Octubre',  'Noviembre',  'Diciembre');
?>
<input type="hidden" value="<?= $fecha ?>" id="DateMin">
<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title text-center titulo">Registrar nuevo aguaje</h3>
  </div>
  <div class="panel-body">
    <form class="form-horizontal" id="">
      <input type="hidden" id="id-aguaje">
      <div class="col-xs-6">
        <div class="form-group">
          <label for="inicio" class="col-md-4 control-label">Inicio</label>
          <div class="col-md-6">
            <input type="text" class="form-control datepicker" id="inicio" placeholder="<?= $fecha ?>">
          </div>
        </div>
      </div>
      <div class="col-xs-6">
        <div class="form-group">
          <label for="fin" class="col-md-4 control-label">Fin del Aguaje</label>
          <div class="col-md-6">
            <input type="text" class="form-control datepicker" id="fin" placeholder="<?= $fecha ?>">
          </div>
        </div>
      </div>

      <div class="form-group text-center">
        <!-- <label class="col-md-2 control-label">Prioridad</label> -->

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
              <input type="radio" name="prioridad" value="#FFEB3B_3"
                  class="prioridad">
              Bajo
            </label>
          </div>
        </div>

      </div>
    </form>
    <div class="footer-pane col-xs-12 center top-sapce top-space-bigger">
      <a class="btn btn-raised btn-danger" id="cancelar">Cancelar</a>
      <a class="btn btn-raised btn-info" id="save">Guardar</a>
    </div>
  </div>
</div>
