;(function () {
  'use strict'

  $(".tabla-contianer").load("template/table.php")

  // var $codigo = $("#codigo")
  var $detalle = $("#detalle_name")
  var $general = $("#general")

  $("#cancelar").on("click", canelarForm)

  $("#form-btn").on("click", function () {
    $("#form-conatiner").slideDown()
  })

  $("#save").on("click", function (e) {
    e.preventDefault()

    if(validarForm()) {
      $.ajax({
        type: "POST",
        url: "service/guardar.php",
        data: $("#areaGeneralForm").formObject()
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
          alerta("La tarea ya existe")
          $detalle.focus()
        }
      })

    }
  })

  function canelarForm (e) {
    e.preventDefault()
    limpiar()
  }

  function limpiar () {
    $("#form-conatiner").slideUp()
    setTimeout(function () {
      $("#codigo").attr("disabled", false)
      $detalle.val("")
      $general.val("")
      $("#idCode").val("")
      $("#save").slideDown()
      $("#general").attr("disabled", false)
      $("#detalle").attr("disabled", false)

    }, 300)
  }

  function validarForm () {
    if($detalle.val() === "" || /^\s*$/.test($detalle.val()) ){
      alerta("Porfavor ingresa el detalle")
      $detalle.focus()
      return false
    }
    if($general.val() === ""){
      alerta("Porfavor ingresa el codigo del area general")
      $general.focus()
      return false
    }
    else return true
  }

})()
