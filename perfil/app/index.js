;(function () {

  var $password = $("#password")
  var $passwordRepeat = $("#passwordRepeat")

  $(".showPassword").mousedown(function (e) {
    $("#password").removeAttr("type")
  })
  
  $(".showPassword").mouseup(function (e) {
    $("#password").attr("type", "password")
  })

  $(".showPasswordRepeat").mousedown(function (e) {
    $("#passwordRepeat").removeAttr("type")
  })
  
  $(".showPasswordRepeat").mouseup(function (e) {
    $("#passwordRepeat").attr("type", "password")
  })

  $(".aceptarCambio").on('click', function (e){
    if (validar()) {
      $.ajax({
        type: 'POST',
        url: 'service/guardar.php',
        data: { password:$password.val() }
      })
      .done(function (snap) {
        console.log(snap)
        if (snap == 2) {
          alertaInfo("Se ha guardadocon exito")
          $password.val("")
          $passwordRepeat.val("")
        }
        else alerta("Tenemos inconvenientes")
      })
    }
  })

  function validar () {
    if ($password.val() == "") {
      alerta("Ingresa tu nueva contrseña")
      $password.focus()
      return false
    }
    if ($passwordRepeat.val() == ""){
      alerta("Repite tu contraseña")
      $passwordRepeat.focus()
      return false
    }
    if ($password.val() != $passwordRepeat.val()) {
      alerta("Las contraseña no coinciden")
      $passwordRepeat.focus()
      return false
    }
    else return true
  }

})()