;(function () {
  'use strict'

  $(".tabla-container").load("template/table.php")

  var $nombre = $("#nombre")
  var $direccion = $("#direccion")
  var $celular = $("#celular")
  var $telefono = $("#telefono")
  var $email = $("#email")
  var $nombreContacto = $("#nombreContacto")
  var $celularContacto = $("#celularContacto")
  var $telefonoContacto = $("#telefonoContacto")
  var $emailContacto = $("#emailContacto")

  $("#form-btn").on("click", function () {
    $(".titulo").html("Registrar nuevo proveedor")
    $("#form-proveedor").slideDown()
  })

  $("#cancelar").on("click", canelarForm )

  $("#save").on("click", function () {
    if(validarForm()) {
      $.ajax({
        type: "POST",
        url: "service/guardar.php",
        data: $("#proveedorForm").formObject()
      })
      .done(function (response) {
        console.log(response)
        if (parseInt(response) === 2){
          $(".tabla-container").load("template/table.php")
          $(".media-list-contacts").load("../contacts_employ.php")
          alertaInfo("Se ha guardado con exito el proveedor")
          canelarForm()
        }
      })
    }
  })

  function canelarForm () {
    $("#form-proveedor").slideUp()
    $("#id_proveedor").val("")
    $nombre.val("")
    $direccion.val("")
    $celular.val("")
    $telefono.val("")
    $email.val("")
    $nombreContacto.val("")
    $celularContacto.val("")
    $telefonoContacto.val("")
    $emailContacto.val("")
  }

  function validarForm () {
    if ($nombre.val() === "" || /^\s*$/.test($nombre.val())) {
      alerta("Porfavor ingresa el nombre del proveedor")
      $nombre.focus()
      return false
    }
    if($direccion.val() === "" || /^\s*$/.test($direccion.val())) {
      alerta("Porfavor ingresa la direccion del proveedor")
      $direccion.focus()
      return false
    }
    if($celular.val() === "" || parseInt($celular.val()) === 0) {
      alerta("Porfavor ingresa el celular del proveedor")
      $celular.focus()
      return false
    }
    if($celular.val().length < 10) {
      alerta("Porfavor ingresa el celular correcto")
      $celular.focus()
      return false
    }
    if($telefono.val() === "" || parseInt($telefono.val()) === 0) {
      alerta("Porfavor ingresa el telefono del proveedor")
      $telefono.focus()
      return false
    }
    if($telefono.val().length < 9) {
      alerta("Porfavor ingresa el telefono correcto")
      $telefono.focus()
      return false
    }
    if($email.val() === "" || /^\s*$/.test($email.val())) {
      alerta("Porfavor ingresa el email del proveedor")
      $email.focus()
      return false
    }
    if($nombreContacto.val() === "" || /^\s*$/.test($nombreContacto.val())) {
      alerta("Porfavor ingresa el nombre del contacto")
      $nombreContacto.focus()
      return false
    }
    if($celularContacto.val() === "" || /^\s*$/.test($celularContacto.val())) {
      alerta("Porfavor ingresa el celular del contacto")
      $celularContacto.focus()
      return false
    }
    if($celularContacto.val().length < 10) {
      alerta("Porfavor ingresa el telefono correcto")
      $celularContacto.focus()
      return false
    }
    if($telefonoContacto.val() === "" || /^\s*$/.test($telefonoContacto.val())) {
      alerta("Porfavor ingresa el telefono del contacto")
      $telefonoContacto.focus()
      return false
    }
    if($telefonoContacto.val().length < 9) {
      alerta("Porfavor ingresa el telefono correcto")
      $telefonoContacto.focus()
      return false
    }
    if($emailContacto.val() === "" || /^\s*$/.test($emailContacto.val())) {
      alerta("Porfavor ingresa el e-mail del contacto")
      $emailContacto.focus()
      return false
    }
    else return true
  }

})()
