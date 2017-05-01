;(function () {
  'use strict'

  $(".tabla-contianer").load("template/table.php")
  var dateMin = $("#DateMin").val()
  $( '.datepicker' ).pickadate({
    min: dateMin
  })

  var $inicio = $("#inicio")
  var $fin = $("#fin")

  $("#form-btn").on("click", function () {
    $(".titulo").html("Registrar nuevo aguaje")
    $("#form-conatiner").slideDown()
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
          alertaInfo("Se ha guardado con exito el aguaje")
          $(".tabla-contianer").load("template/table.php")
          canelarForm()
        }
        if(response == 3){
          alerta("Y hay aguaje con la fecha que indico")
        }
      })
    }
  })

  function getData () {
    return  {
      inicio: $inicio.val(),
      fin: $fin.val(),
      id: $("#id-aguaje").val(),
      prioridad: $('input[name="prioridad"]:checked').val()
    }
  }

  function canelarForm () {
    $("#form-conatiner").slideUp()
    $inicio.val(dateMin)
    $fin.val(dateMin)
    $("#id-aguaje").val("")
  }

  function validarForm () {
    if($inicio.val() === "") {
      alerta("Porfavor ingresa el inicio del aguaje")
      $inicio.focus()
      return false
    }
    if($fin.val() === "") {
      alerta("Porfavor ingresa el fin del aguaje")
      $fin.focus()
      return false
    }
    if(new Date($inicio.val()) > new Date($fin.val())) {
      alerta("Porfavor el inicio del aguaje no puede ser mayor que fin del agaje")
      $fin.focus()
      return false
    }
    if($inicio.val() == $fin.val()) {
      alerta("Porfavor el inicio del aguaje no puede ser igual que fin del agaje")
      $fin.focus()
      return false
    }
    if($('input[name="prioridad"]:checked').val() == null) {
      alerta("Porfavor ingrese la prioridad del aguaje")
      return false
    }
    else return true
  }

})()
