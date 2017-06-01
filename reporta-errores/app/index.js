;(function () {
  'use strict'

  var $equipo = $('#equipo')
  var $detalle = $('#detalle')

  $('#save').on('click', handleSaved)

  function handleSaved () {
    if (validar()) {
      $.ajax({
        type: 'POST',
        url: 'service/guardar.php',
        data: { equipo: $equipo.val(), detalle: $detalle.val() }
      })
      .done(function (snap) {
        console.log(snap)
        if (snap === "2") {
          $equipo.val('')
          $detalle.val('')
          alertaInfo('Se ha informado con exito el daño del equipo')
        }
      })
    }
  }

  function validar () {
    if ($equipo.val() === '') {
      alerta('Ingresa el equipo')
      $equipo.focus()
      return false
    }
    if ($detalle.val() === '') {
      alerta('Ingresa el detalle')
      $detalle.focus()
      reutrn false
    }
    if ($detalle.val().length < 19) {
      alerta('El informe del daño debe ser mas de 20 caracteres')
      $detalle.focus()
      return false
    }
    else return true
  }

})()