;(function () {
  'use strict'

  $(".tabla-contianer").load("template/table.php")

  var $codigo = $("#codigo")
  var $detalle = $("#detalle_name")
  var $dependeAguaje = document.getElementById("depende-aguaje")

  $("#cancelar").on("click", canelarForm)

  $("#form-btn").on("click", function () {
    $(".titulo").html("Registrar nueva area general")
    $("#form-conatiner").slideDown()
  })

  $("#save").on("click", function (e) {
    e.preventDefault()

    if(validarForm()) {
      $.ajax({
        type: "POST",
        url: "service/guardar.php",
        data: getData()
      })
      .done(function (response) {
        console.log(response)
        if (parseInt(response) === 2){
          alertaInfo("Se ha guardado con exito el area")
          $(".tabla-contianer").load("template/table.php")
          limpiar()
        }
        if(parseInt(response) === 3) {
          alerta("El codigo ya existe")
          $codigo.focus()
        }
        if(response == 1) {
          alerta("El area existe")
          $detalle.focus()
        }
      })

    }
  })

  function getData () {
    return  {
      codigo: $codigo.val(),
      id: $("#idCode").val(),
      detalle: $detalle.val(),
      dependeAguaje: $dependeAguaje.checked
    }
  }

  function canelarForm (e) {
    e.preventDefault()
    limpiar()
  }

  function limpiar () {
    $("#form-conatiner").slideUp()
    $("#idCode").val("")
    $("#codigo").attr("disabled", false)
    $codigo.val("")
    $detalle.val("")
    document.getElementById("depende-aguaje").checked = true
  }

  function validarForm () {
    if ($codigo.val() === "" || /^\s*$/.test($codigo.val()) ) {
      alerta("Porfavor ingresa el codigo")
      $codigo.focus()
      return false
    }
    if($detalle.val() === "" || /^\s*$/.test($detalle.val()) ){
      alerta("Porfavor ingresa el detalle")
      $detalle.focus()
      return false
    }
    else return true
  }

})()
