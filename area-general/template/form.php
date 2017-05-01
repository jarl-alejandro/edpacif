<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title text-center titulo">Registrar nueva area general</h3>
  </div>
  <div class="panel-body">
    <!-- Form -->
    <form class="form-horizontal" id="areaGeneralForm">
      <input type="hidden" name="id" id="idCode">
      <div class="col-xs-3">
        <div class="form-group">
          <label for="codigo" class="col-md-4 control-label">Codigo</label>
          <div class="col-md-8">
            <input type="text" class="form-control" id="codigo" name="codigo"
              placeholder="1." onkeypress="ValidaSoloNumeros()" maxlength="4">
          </div>
        </div>
      </div>
      <div class="col-xs-9">
        <div class="form-group">
          <label for="detalle" class="col-md-4 control-label">Detalle</label>
          <div class="col-md-8">
            <input type="text" class="form-control" name="detalle" id="detalle_name"
              placeholder="PRODUCCIÓN" onkeypress="txNombres()" maxlength="80">
          </div>
        </div>
      </div>
      <div class="col-xs-12" style="display: flex;justify-content: center;margin-top: 2em;">
        <div class="togglebutton">
          <label>
            Depedende de aguaje
            <input type="checkbox" checked="" id="depende-aguaje" name="dependeAguaje">
          </label>
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
