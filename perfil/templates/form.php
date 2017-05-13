<style>
.card{
  width: 55em;
  padding: 1em;
  left: 7em;
  box-shadow: 0px 1px 1.5px #b2b4b8 !important;
}
</style>
<div class="card col-xs-10">
  <div class="form-group">
    <label for="password" class="col-xs-4 control-label">Contraseña
      <i class="fa fa-eye black-text showPassword"></i>
    </label>
    <div class="col-xs-8">
      <input type="password" class="form-control" id="password" name="password"
        placeholder="Ingresa tu nueva contraseña" maxlength="140">
    </div>
  </div>
  <div class="form-group">
    <label for="passwordRepeat" class="col-xs-4 control-label">Repeti tu nueva contraseña
      <i class="fa fa-eye black-text showPasswordRepeat"></i>
    </label>
    <div class="col-xs-8">
      <input type="password" class="form-control" id="passwordRepeat" name="passwordRepeat"
        placeholder="Repite tu contraseña" maxlength="140">
    </div>
  </div>
  <div class="col-xs-12 center">
    <button class="btn btn-raised btn-primary aceptarCambio">Aceptar</button>
  </div>
</div>