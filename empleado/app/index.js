;(function () {
  'use strict'

  $(".tabla-container").load("template/table.php")

  var $cedula = $("#cedula")
  var $nombre = $("#nombre")
  var $apellido = $("#apellido")
  var $direccion = $("#direccion")
  var $rol = $("#rol")
  var $sueldo = $("#sueldo")
  var $email = $("#email")
  var $telefono = $("#telefono")

  $("#form-btn").on("click", function () {
    $(".titulo").html("Registrar nuevo empleado")
    $("#form-employ").slideDown()
  })

  $("#cancelar").on("click", canelarForm )

  $("#save").on("click", function () {
    if(validarForm()) {
      $.ajax({
        type:"POST",
        url:"service/guardar.php",
        data:getData()
      })
      .done(function (response) {
        console.log(response)
        if (parseInt(response) === 2){
          $(".tabla-container").load("template/table.php")
          $(".media-list-contacts").load("../contacts_employ.php")
          alertaInfo("Se ha guardado con exito el empleado")
          canelarForm()
        }
        if (parseInt(response) === 3) {
          alerta("El empleado ya existe")
          $cedula.focus()
        }
      })
    }
  })

  function getData () {
    return  {
      id: $("#id_employee").val(),
      cedula: $cedula.val(),
      nombre: $nombre.val(),
      apellido: $apellido.val(),
      direccion: $direccion.val(),
      rol: $rol.val(),
      email: $email.val(),
      telefono: $telefono.val(),
      sueldo: $sueldo.val()
    }
  }

  function canelarForm () {
    $("#form-employ").slideUp()
    $cedula.val("")
    $nombre.val("")
    $apellido.val("")
    $direccion.val("")
    $rol.val("")
    $email.val("")
    $telefono.val("")
    $sueldo.val("")
    $("#id_employee").val("")
  }

  function validarForm () {
    if ($cedula.val() === "") {
      alerta("Porfavor ingrese el numero de cedula")
      $cedula.focus()
      return false
    }
    if (!valida_ce($cedula.val())) {
      $cedula.focus()
      return false
    }
    if ($nombre.val() === "" || /^\s*$/.test($nombre.val())) {
      alerta("Porfavor ingresa el nombre del empleado")
      $nombre.focus()
      return false
    }
    if($apellido.val() === "" || /^\s*$/.test($apellido.val())) {
      alerta("Porfavor ingrese el apellido del empleado")
      $apellido.focus()
      return false
    }
    if($direccion.val() === "" || /^\s*$/.test($direccion.val())) {
      alerta("Porfavor ingresa la direccion del empleado")
      $direccion.focus()
      return false
    }
    if($telefono.val() === "" || /^\s*$/.test($telefono.val())) {
      alerta("Porfavor ingresa el telefono del empleado")
      $telefono.focus()
      return false
    }
    if($telefono.val().length < 9) {
      alerta("Porfavor ingresa el telefono correcto")
      $telefono.focus()
      return false
    }
    if($email.val() === "" || /^\s*$/.test($email.val())) {
      alerta("Porfavor ingresa el email del empleado")
      $email.focus()
      return false
    }
    if($sueldo.val() === "" || /^\s*$/.test($sueldo.val())) {
      alerta("Porfavor ingresa el sueldo del empleado")
      $sueldo.focus()
      return false
    }
    if($rol.val() === "") {
      alerta("Porfavor ingrese el rol del empleado")
      $rol.focus()
      return false
    }
    else return true
  }

})()
