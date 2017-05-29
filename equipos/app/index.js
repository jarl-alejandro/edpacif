var inventarios = []

;(function () {
	'use strict'

  $( '.datepicker' ).pickadate({
  	 labelMonthNext: 'Siguienre mes',
	  labelMonthPrev: 'Mes anterior',
	  labelMonthSelect: 'Selecione el mes',
	  labelYearSelect: 'Selecione el año',
	  selectMonths: true,
	  selectYears: true
  })

	$(".cards-container").load("template/table.php")

	var $id = $("#idEquipo")
	var $detalle = $("#nombreEquipo")
	var $subarea = $("#subarea")
	var $equipoImage = $("#equipoImage")
	var $horas = $("#horas")
	var $proveedor = $("#proveedor")
	var $kilo = $("#kilo")
  var $fechaCompra = $("#fechaCompra")

	var $inputModel = $("#inputModel")
	var $inputMarca = $("#inputMarca")
	var $inputYer = $("#inputYer")
	var $inputNumeriFacu = $("#inputNumeriFacu")
	var $inputValor = $("#inputValor")
	var $inputSerie = $("#inputSerie")
	var $inputPlaca = $("#inputPlaca")
	var $inputSerieChasis = $("#inputSerieChasis")
	var $inputSerieMotor = $("#inputSerieMotor")

	var vehiculoBox = document.getElementById("VehiculoBox")
	var activeHoras = true
	var activeKilometros = false

	$("#esCheckedVehiculo").on('change', function () {
		var esCheck = document.getElementById("esCheckedVehiculo").checked

		if(esCheck == true) {
			$("#equipoModal").fadeOut()
			$("#vehiculoModal").fadeIn()

			document.getElementById("horas").disabled = true
			document.getElementById("kilo").disabled = false
			document.getElementById("activeHoras").checked = false
			document.getElementById("activeKilometros").checked = true
			activeKilometros = false
			activeHoras = true
		}
		if(esCheck == false) {
			$("#equipoModal").fadeIn()
			$("#vehiculoModal").fadeOut()

			document.getElementById("horas").disabled = false
			document.getElementById("kilo").disabled = true
			document.getElementById("activeHoras").checked = true
			document.getElementById("activeKilometros").checked = false
			activeKilometros = true
			activeHoras = false
		}
	})

	$("#activeHoras").on("change", function () {
		activeHoras = !activeHoras
		document.getElementById("horas").disabled = activeHoras
	})

	$("#activeKilometros").on("change", function () {
		activeKilometros = !activeKilometros
		document.getElementById("kilo").disabled = activeKilometros
	})

	$("#form-btn").on("click", function () {
    $(".titulo").html("Registrar nuevo equipo")
    $("#idEquipo").val("")
		$("#form-quipos").slideDown()
	})

	$(".close--inven").on("click", function () {
		$(".panel-inventario").slideUp()
		$(".cant-input").val("")
	})

	$("#area").on("change", handleAreaChange)

	$equipoImage.on("change", imageChange)
	$("#cancelar").on("click", cancelarForm)
	$("#cellar-add").on("click", handleAdd)
	$(".add-inve").on("click", handleInveCant)
	$("#equipoModal").on("click", equipoModal)
	$("#vehiculoModal").on("click", vehiculoModal)
	$("#InformacionEquipo--aceptar").on("click", handleInfoEquipo)

	$("#save").on("click", function () {
		if(validarForm()) {
			$.ajax({
				type:"POST",
				url:"service/guardar.php",
				data: getData(),
				cache: false,
				contentType: false,
				processData: false
			})
			.done(function (response) {
				console.log(response)
				if (parseInt(response) === 201){
					alertaInfo("Se ha guardado con exito el equipo")
					$(".cards-container").load("template/table.php")
					cancelarForm()
				}
				else {
					alerta("Ya existe equipo")
				}
			})
		}
	})

	function equipoModal (e) {
		e.preventDefault()
		$("#InformacionEquipo").slideDown()
		$(".titutlo-informacion").html("Informacion del equipo")
		$("#InformacionEquipo").addClass("panel-primary")
		$("#InformacionEquipo").removeClass("panel-warning")
		$('.informacioEQ').html('equipo')
	}

	function vehiculoModal (e) {
		e.preventDefault()
		$(".containerVehiculo").slideDown()
		vehiculoBox.checked = true
		$(".titutlo-informacion").html("Informacion del vehiculo")
		$("#InformacionEquipo").slideDown()
		$("#InformacionEquipo").addClass("panel-warning")
		$("#InformacionEquipo").removeClass("panel-primary")
		$('.informacioEQ').html('vehiculo')
	}

	function handleInfoEquipo () {
		$("#InformacionEquipo").slideUp()
	}

	function handleAreaChange () {
		var area = $("#area").val()
		$("#containerSubArea").load(`template/subarea.php?id=${area}`, function () {
			$subarea = $("#subarea")
		})
	}

	function getData () {
		var formData = new FormData()
		var file_image = document.getElementById("equipoImage")
		var invent = localStorage.getItem('inventarios')
		var esEquipo = document.getElementById('esCheckedVehiculo')

		var kilo = $kilo.val() || 0
		var horas = $horas.val() || 0

		var nombreEq = $detalle.val().trim()

		formData.append("id", $id.val())
		formData.append("horas", horas)
		formData.append("detalle", nombreEq)
		formData.append("subarea", $("#subarea").val())
		formData.append("newGeneral", $("#newGeneral").val())
		formData.append("proveedor", $proveedor.val())
		formData.append("kilometros", kilo)
		formData.append("is_imagen", file_image.files.length)
		formData.append("imagen", file_image.files[0])
		formData.append("detalles", invent)
		formData.append("esEquipo", esEquipo.checked)
    formData.append("fechaCompra", $fechaCompra.val())

		formData.append("inputModel", $inputModel.val() || "")
		formData.append("inputMarca", $inputMarca.val() || "")
		formData.append("inputYer", $inputYer.val() || "")
		formData.append("inputNumeriFacu", $inputNumeriFacu.val() || "")
		formData.append("inputValor", $inputValor.val() || "")
		formData.append("inputSerie", $inputSerie.val() || "")
		formData.append("inputPlaca", $inputPlaca.val() || "")
		formData.append("inputSerieChasis", $inputSerieChasis.val() || "")
		formData.append("inputSerieMotor", $inputSerieMotor.val() || "")

		return formData
	}

	function cancelarForm () {
		$("#form-quipos").slideUp()
		$("#imagen_name").val("")

    $id.val("")
		$kilo.val("")
		$proveedor.val("")
		$detalle.val("")
		$subarea.val("")
		$equipoImage.val("")
		$horas.val("")

		$("#bajaEquipoBtn").fadeOut()
	  $("#newGeneral").val("")
	  $("#detalleEquipo").html("")
	  $("#area").val("")
	  $("#fechaCompra").attr('disabled', false)

		inventarios = []
		localStorage.clear()
		$inputModel.val("")
		$inputMarca.val("")
		$inputYer.val("")
		$inputNumeriFacu.val("")
		$inputValor.val("")
		$inputSerie.val("")
		$inputPlaca.val("")
		$inputSerieChasis.val("")
		$inputSerieMotor.val("")
		vehiculoBox.checked = false

    var imagenEquipo = document.querySelector(".imagen__equipo")
		imagenEquipo.src = ""

    $(".containerVehiculo").slideUp()

		activeKilometros = false
		activeHoras = true
		document.getElementById("esCheckedVehiculo").checked = true
		$("#equipoModal").fadeOut()
		$("#vehiculoModal").fadeIn()
		document.getElementById("horas").disabled = true
		document.getElementById("kilo").disabled = false
		document.getElementById("activeHoras").checked = false
		document.getElementById("activeKilometros").checked = true

    $fechaCompra.val()

		$("#containerSubArea").html(` <select class="form-control" id="subarea">
												<option value="">Selecciona la area</option></select>`)
	}

	function validarForm () {
		var flag = localStorage.getItem('flagSubarea')

		if(flag == true) {
      		var area = localStorage.getItem('area')
      		var subarea = localStorage.getItem('subarea')
      		$("#containerSubArea").load(`template/subarea.php?id=${area}`,
				function () {
		    		$("#subarea").val(subarea)
		    		$subarea = $("#subarea")
				})
		}

		var invent = JSON.parse(localStorage.getItem('inventarios'))

		if ($detalle.val() === "" || /^\s*$/.test($detalle.val())) {
			alerta("Porfavor ingresa el detalle")
			$detalle.focus()
			return false
		}
		if(activeHoras === false){
			if ($horas.val() === "" || $horas.val() === "0") {
				alerta("Porfavor ingresa las hora de trabajo")
				$horas.focus()
				return false
			}
		}
		if(activeKilometros === false){
			if ($kilo.val() === "" || $kilo.val() === "0") {
				alerta("Porfavor ingresa los kilometros")
				$kilo.focus()
				return false
			}
		}
		if ($("#subarea").val() === "") {
			alerta("Porfavor ingrese el sub area")
			$subarea.focus()
			return false
		}
		if ($proveedor.val() === "" || /^\s*$/.test($proveedor.val())) {
			alerta("Porfavor ingrese el proveedor")
			$proveedor.focus()
			return false
		}
	    if ($fechaCompra.val() === "") {
	      alerta("Porfavor ingrese la fecha de compra")
				$fechaCompra.focus()
				return false
	    }
		if ($("#imagen_name").val() === "") {
			alerta("Porfavor ingrese la imagen del equipo")
			$equipoImage.focus()
			return false
		}
		if(invent === null || invent.length === 0){
			alerta("Porfavor ingrese los detalles del equipo")
			return false
		}
		if ($("#inputModel").val() == "") {
 				alerta("Porfavor ingrese el modelo")
				$("#InformacionEquipo").slideDown()
				$("#inputModel").focus()
				return false
		}
		if ($("#inputMarca").val() == "") {
 				alerta("Porfavor ingrese la marca")
				$("#InformacionEquipo").slideDown()
				$("#inputMarca").focus()
				return false
		}
		if ($("#inputSerie").val() == "") {
 				alerta("Porfavor ingrese la serie")
				$("#InformacionEquipo").slideDown()
				$("#inputSerie").focus()
				return false
		}
		if(document.getElementById("esCheckedVehiculo").checked == true) {
			if ($("#inputPlaca").val() == "") {
	 				alerta("Porfavor ingrese la placa")
					$("#InformacionEquipo").slideDown()
					$("#inputPlaca").focus()
					return false
			}
			if ($("#inputSerieChasis").val() == "") {
	 				alerta("Porfavor ingrese el chasis")
					$("#inputSerieChasis").focus()
					$("#InformacionEquipo").slideDown()
					return false
			}
			if ($("#inputSerieMotor").val() == "") {
	 				alerta("Porfavor ingrese el motor")
					$("#inputSerieMotor").focus()
					$("#InformacionEquipo").slideDown()
					return false
			}
			else return true
		}
		else return true
	}

	function imageChange (e) {
		var upload = document.querySelector('#equipoImage')
		var imagenEquipo = document.querySelector(".imagen__equipo")

		var file = e.target.files[0]
		console.log(1024 * 1024 * 2)
		console.log(file.size)
		if (file.size > (1024 * 1024 * 2)) {
			alerta("No puede subir imagenes mas de 2mb")
			return false
		}

		var reader = new FileReader()
		reader.onload = (function (theFile) {
			return function (e) {
				imagenEquipo.src = e.target.result
				$("#imagen_name").val(e.target.result)
			}
		})(file)
		reader.readAsDataURL(file)
	}

	function handleAdd (e) {
		e.preventDefault()
		$(".panel-inventario").slideDown()
	}

	function handleInveCant (e) {
		e.preventDefault()
		var id = e.currentTarget.dataset.id
		var producto = e.currentTarget.dataset.producto
		var price = e.currentTarget.dataset.price
		var cantProd = e.currentTarget.dataset.cant

		if(localStorage.state == "true"){
			inventarios = JSON.parse(localStorage.getItem('inventarios'))
		}

		var cant = $(`#cant${id}`)

		if(cant.val() === "" || cant.val() == 0){
			cant.focus()
			alerta("Porfavor ingrese la cantidad")
			return false
		}
		if (cantProd <= 0) {
			alerta(`No tiene mas ${producto} en inventario`)
			return false
		}
		if(validInventario(id, cant.val())){
			var total = parseFloat(price) * parseInt(cant.val())
			var contex = {
				id: id,
				producto: producto,
				price: price,
				total: total,
				cant: cant.val(),
			}
			inventarios.push(contex)
			localStorage.setItem('inventarios', JSON.stringify(inventarios))
			building()
			$(".panel-inventario").slideUp()
			$(".cant-input").val("")
		}

	}

	function validInventario(id, cant){
		var flag = false
		var invent = JSON.parse(localStorage.getItem('inventarios'))

		if(invent === null || invent.length === 0){
			return true
		}
		for (var i in invent) {
			var item = invent[i]
			if(item.id === id) {
				item.cant = parseInt(item.cant) + parseInt(cant)
				item.total = parseInt(item.cant) * parseFloat(item.price)
				localStorage.setItem('inventarios', JSON.stringify(invent))
				building()
				alertaInfo("Se ha actualizado con exito")
				$(".panel-inventario").slideUp()
				$(".cant-input").val("")
				return false
			}
			else flag = true

		}

		return flag
	}

  $("#bajaEquipoBtn").on("click", handleBajaEquipoShow)
  $('#cancelarBaja').on('click', handleCancelarBaja)
  $('#aceptarBaja').on('click', handleAceptarBaja)

  $("baja_pdf").on('change', handleChangeBja)

  function handleBajaEquipoShow (e) {
    e.preventDefault()
    $('.panel-baja-equipo').slideDown()
  }

  function handleCancelarBaja () {
    $('.panel-baja-equipo').slideUp()
    $('#baja_pdf').val()
  }

  function handleAceptarBaja () {
    if (validarBaja()) {
      var formData = new FormData()
      var file_pdf = document.getElementById("baja_pdf")
      var id =  $("#idEquipo").val()
      formData.append("id", id)
      formData.append("pdf", file_pdf.files[0])

      $.ajax({
				type: "POST",
				url: "service/baja.php",
				data: formData,
				cache: false,
				contentType: false,
				processData: false
			})
      .done(function (snap) {
        console.log(snap)
        if (snap == 2) {
          alertaInfo("Se ha dado de bajo con exito")
          $(".cards-container").load("template/table.php")
          handleCancelarBaja()
          cancelarForm()
        }
        else alerta("Tenemos problemas intente nuevamente")
      })
    }
  }

  function validarBaja () {
    if(  $('#baja_pdf').val() === "" ) {
      alerta('Ingrese el reporte')
      return false
    }
    else return true
  }

  function handleChangeBja () {
	  var upload = document.querySelector('#baja_pdf')

		var file = e.target.files[0]
		if (file.size > (1024 * 1024 * 2)) {
			alerta("No puede subir pdf mas de 2mb")
      $('#baja_pdf').val("")
			return false
		}
  }

})()
