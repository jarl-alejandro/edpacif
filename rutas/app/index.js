;(function () {
  'use strict'

  $(".tabla-contianer").load("template/table.php")

  var $detalle = $("#detalle_ruta")
  var $kmInicial = $("#kmInicial")
  var $kmFinal = $("#kmFinal")
  var $fecha = $("#fecha")
  var $equipo = $("#equipo")
  var $empleado = $("#empleado")

  var $llegada = $("#fecha-llegada")
  var $motivo = $("#motivo")

  var dateMin = $("#DateMin").val()
  $( '.datepicker' ).pickadate({
    min: dateMin
  })

  $("#cancelar").on("click", canelarForm)
	$equipo.on("change", handleChangeEquipo)

  $("#form-btn").on("click", function () {
    $(".titulo").html("Registrar nueva ruta")
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
          alertaInfo("Se ha guardado con exito")
          $(".tabla-contianer").load("template/table.php")
          limpiar()
        }
      })

    }
  })

	function  getData () {
		return{
			id: $("#idCode").val(),
			detalle: $detalle.val(),
			kmInicial: $kmInicial.val(),
			kmFinal: $kmFinal.val(),
			fecha: $fecha.val(),
			equipo: $equipo.val(),
			empleado: $empleado.val(),
			llegada: $llegada.val(),
			motivo: $motivo.val(),
		}
	}

	function handleChangeEquipo () {
		$.ajax({
			type: "GET",
			url: "service/equipo.php",
			data: { equipo: $equipo.val() },
			dataType: "JSON"
		})
		.done(function (snap) {
			if (snap.eruta_kmf_eruta != "") {
				$kmInicial.val(snap.eruta_kmf_eruta)
				$kmInicial.attr("disabled", true)
			}
			if (snap == false){
				$kmInicial.val("")
				$kmInicial.attr("disabled", false)
			}
		})
	}

  function canelarForm (e) {
    e.preventDefault()
    limpiar()
  }

  function limpiar () {
    $("#form-conatiner").slideUp()
    $("#idCode").val("")
    $detalle.val("")
    $kmInicial.val("")
    $kmFinal.val("")
    $fecha.val("")
    $equipo.val("")
    $empleado.val("")
		$llegada.val("")
		$motivo.val("")
		$kmInicial.attr("disabled", false)
  }

  function validarForm () {
		if($equipo.val() === "" || /^\s*$/.test($equipo.val()) ){
      alerta("Porfavor ingresa el equipo")
      $equipo.focus()
      return false
    }
    if($empleado.val() === "" || /^\s*$/.test($empleado.val()) ){
      alerta("Porfavor ingresa el empleado")
      $empleado.focus()
      return false
    }
    if($kmInicial.val() === "" || /^\s*$/.test($kmInicial.val()) ){
      alerta("Porfavor ingresa el kilometraje incial")
      $kmInicial.focus()
      return false
    }
		if($kmFinal.val() != "") {
			if( parseInt($kmInicial.val()) >= parseInt($kmFinal.val()) ) {
				alerta("El km final no ser o igual que el km inicial")
				$kmFinal.focus()
				return false
			}
			if( new Date($fecha.val()) < new Date($llegada.val()) ) {
				alerta("La fecha de llegada no puede ser menor que la de salida")
				$llegada.focus()
				return false
			}
		}
    if($fecha.val() === "" || /^\s*$/.test($fecha.val()) ){
      alerta("Porfavor ingresa la fecha")
      $fecha.focus()
      return false
    }
		if($detalle.val() === "" || /^\s*$/.test($detalle.val()) ){
      alerta("Porfavor ingresa el detalle")
      $detalle.focus()
      return false
    }
		if($motivo.val() === "" || /^\s*$/.test($motivo.val()) ){
      alerta("Porfavor ingresa el moti$motivo")
      $motivo.focus()
      return false
    }
    else return true
  }


})()
