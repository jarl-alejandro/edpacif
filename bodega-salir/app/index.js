;(function () {
	'use strict'

	$(".cards-container").load("template/table.php")

	var $codigo = $("#codigo")
	var $id = $("#idEquipo")
	var $detalle = $("#detalle")
	var $subarea = $("#subarea")
	var $equipoImage = $("#equipoImage")
	var $horas = $("#horas")
	var $proveedor = $("#proveedor")
	var $kilo = $("#kilo")
	var inventarios = []

	$("#form-btn").on("click", function () {
		$("#form-quipos").slideDown()
	})

	$(".close--inven").on("click", function () {
		$(".panel-inventario").slideUp()
		$(".cant-input").val("")
	})

	$equipoImage.on("change", imageChange)
	$("#cancelar").on("click", cancelarForm)
	$("#cellar-add").on("click", handleAdd)
	$(".add-inve").on("click", handleInveCant)

	$("#save").on("click", function () {
		if(validarForm()) {
			$.ajax({
				type:"POST",
				url:"service/guardar.php",
				data:getData(),
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
					alerta("Ya existe")
				}
			})
		}
	})

	function getData () {
		var formData = new FormData()
		var file_image = document.getElementById("equipoImage")
		var invent = localStorage.getItem('inventarios')

		formData.append("id", $id.val())
		formData.append("horas", $horas.val())
		formData.append("codigo", $codigo.val())
		formData.append("detalle", $detalle.val())
		formData.append("subarea", $subarea.val())
		formData.append("proveedor", $proveedor.val())
		formData.append("kilometros", $kilo.val())
		formData.append("is_imagen", file_image.files.length)
		formData.append("imagen", file_image.files[0])
		formData.append("detalles", invent)
		return formData
	}

	function cancelarForm () {
		$("#form-quipos").slideUp()
		$("#imagen_name").val("")
		$id.val("")
		$kilo.val("")
		$proveedor.val("")
		$codigo.val("")
		$detalle.val("")
		$subarea.val("")
		$equipoImage.val("")
		$horas.val("")
    $("#detalleEquipo").html("")
		inventarios = []
		localStorage.clear()
	}

	function validarForm () {
		var invent = JSON.parse(localStorage.getItem('inventarios'))

		if ($codigo.val() === "" || /^\s*$/.test($codigo.val())) {
			alerta("Porfavor ingresa el codigo")
			$codigo.focus()
			return false
		}
		if ($detalle.val() === "" || /^\s*$/.test($detalle.val())) {
			alerta("Porfavor ingresa el detalle")
			$detalle.focus()
			return false
		}
		if ($horas.val() === "" || $horas.val() === "0") {
			alerta("Porfavor ingresa las hora de trabajo")
			$horas.focus()
			return false
		}
		if ($kilo.val() === "" || $kilo.val() === "0") {
			alerta("Porfavor ingresa los kilometros")
			$kilo.focus()
			return false
		}
		if ($subarea.val() === "" || /^\s*$/.test($subarea.val())) {
			alerta("Porfavor ingrese el sub area")
			$subarea.focus()
			return false
		}
		if ($proveedor.val() === "" || /^\s*$/.test($proveedor.val())) {
			alerta("Porfavor ingrese el proveedor")
			$proveedor.focus()
			return false
		}
		if($("#imagen_name").val() === "") {
			alerta("Porfavor ingrese la imagen del equipo")
			$equipoImage.focus()
			return false
		}
		if(invent === null || invent.length === 0){
			alerta("Porfavor ingrese los detalles del equipo")
			return false
		}
		else return true
	}

	function imageChange (e) {
		var upload = document.querySelector('#equipoImage')
		var imagenEquipo = document.querySelector(".imagen__equipo")

		var file = e.target.files[0]
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

		if(localStorage.state == "true"){
			inventarios = JSON.parse(localStorage.getItem('inventarios'))
		}


		var cant = $(`#cant${id}`)

		if(cant.val() === "" || cant.val() == 0){
			alerta("Porfavor ingrese la cantidad")
			cant.focus()
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

})()
