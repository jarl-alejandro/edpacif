;(function () {
  'use strict'

  $(".tabla-contianer").load("template/table.php")

  var $hora = $("#hora")
  var $horaFinal = $("#hora-final")
  var $fecha = $("#fecha")
  var $llegada = $("#fecha-llegada")
  var $equipo = $("#equipo")
  var $empleado = $("#empleado")


  var dateMin = $("#DateMin").val()
  $( '.datepicker' ).pickadate({
    min: dateMin
  })

  $("#cancelar").on("click", canelarForm)
	$equipo.on("change", handleChangeEquipo)

  $("#form-btn").on("click", function () {
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
				alertaInfo("Se ha guardado con exito")
				$(".tabla-contianer").load("template/table.php")
				limpiar()
        if (parseInt(response) === 2){}
      })

    }
  })

	function  getData () {
		return{
			id: $("#idCode").val(),
			hora: $hora.val(),
			horaFinal: $horaFinal.val(),
			fecha: $fecha.val(),
			llegada: $llegada.val(),
			equipo: $equipo.val(),
			empleado: $empleado.val(),
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
				$hora.val(snap.eruta_kmf_eruta)
				$hora.attr("disabled", true)
			}
			if (snap == false){
				$hora.val("")
				$hora.attr("disabled", false)
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
    $hora.val("")
    $horaFinal.val("")
    // $fecha.val("")
		$llegada.val("")
    $equipo.val("")
    // $empleado.val("")
		$hora.attr("disabled", false)
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
    if($hora.val() === "" || /^\s*$/.test($hora.val()) ){
      alerta("Porfavor ingresa la hora")
      $hora.focus()
      return false
    }
		if($horaFinal.val() != "") {
			if( parseInt($hora.val()) >= parseInt($horaFinal.val()) ) {
				alerta("La hora final no ser o igual que la hora inicial")
				$horaFinal.focus()
				return false
			}
			if($llegada.val() == ""){
			alerta("Ingrese la fecha de final")
				$llegada.focus()
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
    else return true
  }


})()
