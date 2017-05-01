<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title text-center titulo">Registrar nuevo proveedor</h3>
  </div>
  <div class="panel-body">
    <form class="form-horizontal" id="proveedorForm">
      <input type="hidden" id="id_proveedor" name="id_proveedor" />
      <div class="col-xs-6">
        <div class="form-group">
          <label for="nombre" class="col-md-2 control-label">Nombre</label>
          <div class="col-md-10">
            <input type="text" class="form-control" name="nombre" id="nombre"
                placeholder="proveedor" onkeypress="txNombres()" maxlength="80">
          </div>
        </div>
        <div class="form-group">
          <label for="direccion" class="col-md-2 control-label">Direccion</label>
          <div class="col-md-10">
            <input type="text" class="form-control" id="direccion" name="direccion"
             placeholder="Via Quevedo" maxlength="140">
          </div>
        </div>
        <div class="form-group">
          <label for="celular" class="col-md-2 control-label">Celular</label>
          <div class="col-md-10">
            <input type="text" class="form-control" id="celular" name="celular"
             placeholder="0993284823" maxlength="10" onkeypress="ValidaSoloNumeros()">
          </div>
        </div>
        <div class="form-group">
          <label for="telefono" class="col-md-2 control-label">Telefono</label>
          <div class="col-md-10">
            <input type="text" class="form-control" id="telefono" maxlength="10"
              placeholder="028712387" onkeypress="ValidaSoloNumeros()" 
              name="telefono">
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-md-2 control-label">E-mail</label>
          <div class="col-md-10">
            <input type="text" class="form-control" id="email"
                placeholder="proveedor@gmail.com" maxlength="140" name="email" />
          </div>
        </div>
      </div>
      <div class="col-xs-6">
       <div class="form-group">
          <label for="nombreContacto" class="col-md-2 control-label">Nombre Contacto</label>
          <div class="col-md-10">
            <input type="text" class="form-control" name="nombreContacto" 
                id="nombreContacto" placeholder="proveedor" 
                onkeypress="txNombres()" maxlength="80">
          </div>
        </div>
        <div class="form-group">
          <label for="celularContacto" class="col-md-2 control-label">
            Celular Contacto
          </label>
          <div class="col-md-10">
            <input type="text" class="form-control" id="celularContacto" 
              name="celularContacto" placeholder="0993284823" maxlength="10"
              onkeypress="ValidaSoloNumeros()">
          </div>
        </div>
        <div class="form-group">
          <label for="telefonoContacto" class="col-md-2 control-label">
            Telefono Contacto
          </label>
          <div class="col-md-10">
            <input type="text" class="form-control" id="telefonoContacto"
              maxlength="10" placeholder="028712387"
              onkeypress="ValidaSoloNumeros()" name="telefonoContacto">
          </div>
        </div>
        <div class="form-group">
          <label for="emailContacto" class="col-md-2 control-label">
            E-mail Contacto
          </label>
          <div class="col-md-10">
            <input type="text" class="form-control" id="emailContacto"
                placeholder="proveedor@gmail.com" maxlength="140" 
                name="emailContacto" />
          </div>
        </div>
      </div>
    </form>
    <div class="footer-pane space-top center col-xs-12">
      <button class="btn btn-raised btn-danger" id="cancelar">Cancelar</button>
      <button class="btn btn-raised btn-info" id="save">Guardar</button>
    </div>
  </div>
</div>
