;(function () {
  'use strict'

  $("#login-button").on("click", handleLogin)

  var $email = $("#inputEmail")
  var $password = $("#inputPassword")

  function handleLogin (e) {
    e.preventDefault()

    if(validLogin()) {
      $.ajax({
        type:"POST",
        url:"service/login.php",
        data: $(".login-form").formObject()
      })
      .done(function (snap) {
        console.log(snap);
        if(snap == 2) {
          alertaInfo("Has iniciado sesión con exito.")
          location.reload()
        }
        if (snap == 404){
          alerta("Usuario no existe")
        }
      })
    }
  }

  function validLogin () {
    if ($email.val() === "" || /^\s*$/.test($email.val())) {
      alerta("Porfavor ingrese el e-mail")
      $email.focus()
      return false
    }
    if ($password.val() === "" ||  /^\s*$/.test($password.val())) {
      alerta("Porfavor ingrese su contraseña")
      $password.focus()
      return false
    }
    else return true
  }

})()
