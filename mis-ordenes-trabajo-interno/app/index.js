'use strict'

var orden = {}
function OrdenesTrabajo () {}

orden.$subarea = $("#subarea")
orden.$empleado = $("#empleado")
orden.$equipo = $("#equipo")
orden.$detalle = $("#detalle")
orden.$obsevacion = $("#observacion")
orden.$diagnostico = $("#diagnostico")
orden.inventarios = []
orden.herramientas = []
orden.inicio = []
orden.fin = []
orden.inicioEnviar = 0

orden.inicio_count = 0
orden.fin_count = 0

OrdenesTrabajo.prototype.teminarOrdenTrabajo = function () {
  var id = $("#id_orden").val()
  if(orden.$obsevacion.val() === ""){
    orden.$obsevacion.focus()
    alerta("Porfavor ingrese su observacion")
    return false
  }
  var formData = new FormData()
  var file_image = document.getElementById("diagnostico")

  // formData.append("diagnostico", file_image.files[0])
	formData.append("obsevacion", orden.$obsevacion.val())
	formData.append("id", id)

  $.ajax({
    type: "POST",
    url: "service/terminar.php",
    data: formData,
    cache: false,
		contentType: false,
		processData: false
  })
  .done(function (snap) {
    console.log(snap)
    if(snap == 2){
      alertaInfo("Se ha realizado con exito la orden de trabajo")
      this.closeForm()
      $(".tabla-contianer").load("template/table.php")
    }
  }.bind(this))
}

OrdenesTrabajo.prototype.closeForm = function () {
  $(".form__layout").slideUp()
  $(".tabla-contianer").slideDown()
  orden.$subarea.val("")
  orden.$empleado.val("")
  orden.$equipo.val("")
  orden.$detalle.val("")
  orden.$obsevacion.val("")
  orden.$diagnostico.val("")
  document.querySelector('input[name="mantenimiento"]:checked').checked = false
  localStorage.clear()
  orden.inventarios = []
  orden.herramientas = []
  orden.inicio = []
  orden.fin = []

  $('#ordenFormAceptar').fadeIn()
  $('#herramientas').fadeIn()
  $('#materiales').fadeIn()
  $('#tiempos').fadeIn()

  $("#tableHerramientas").html("")
  $("#tablemateriales").html("")
  $("#tableinicio").html("")
  $("#tablefin").html("")


}

OrdenesTrabajo.prototype.aceptarForm = function () {
  if(this.validarOrden()) {
    var id = $("#id_orden").val()
    $.ajax({
      type: "POST",
      url: "service/guardarHerramientas.php",
      data: { repuestos: orden.inventarios, herramientas: orden.herramientas, id }
    })
    .done(function (snap) {
      console.log(snap)
      if(snap == 2) {
        this.closeForm()
        $(".tabla-contianer").load("template/table.php")
        alertaInfo("Se ha realizado con exito")
      }
    }.bind(this))
  }
}

OrdenesTrabajo.prototype.ordenInicioDateTime = function () {
  if(orden.inicio.length === 0){
    alerta("Pofavor ingrese el inicio de fecha")
    return false
  }
  if (orden.inicioEnviar === 0) {
    var id = $("#id_orden").val()

    $.ajax({
      type: "POST",
      url: "service/inicioFecha.php",
      data: { inicio: orden.inicio, id }
    })
    .done(function (snap) {
      console.log(snap)
      if(snap == 2){
        orden.inicioEnviar = 1
        alertaInfo("Se ha guardado con exito")
      }
    })
  }
  
}
OrdenesTrabajo.prototype.ordenFinDateTime = function () {
  if(orden.fin.length === 0){
    alerta("Pofavor ingrese el fin de fecha")
    return false
  }

  var id = $("#id_orden").val()

  $.ajax({
    type: "POST",
    url: "service/finFecha.php",
    data: { fin: orden.fin, id }
  })
  .done(function (snap) {
    console.log(snap)
    if(snap == 2){
      alertaInfo("Se ha guardado con exito")
    }
  })
  
}
OrdenesTrabajo.prototype.saveDateTime = function (type) {
  var hora = $("#horaDateTime").val()
  var fecha = $("#fechaDateTime").val()
  
  if(this.validDateTime(hora, fecha)){
    var object = { fecha, hora }

    if(type === "inicio") {
      if (orden.inicio_count == 0) {
        orden.inicio.push(object)
        this.buildingDateTime(type)
      }
      else alerta('Ya tiene fecha y hora de inicio')
      orden.inicio_count++
    }
    if(type === "fin"){
      if (orden.fin_count == 0) {
        orden.fin.push(object)
        this.buildingDateTime(type)
      }
      else alerta('Ya tiene fecha y hora de fin')
      orden.fin_count++
    }

    $("#horaDateTime").val("")
    $("#fechaDateTime").val("")
    $(".form__date-time").slideUp()
  }
}

OrdenesTrabajo.prototype.validDateTime = function (hora, fecha) {
  if(fecha == ""){
    alerta("Porfavor ingrese la fecha")
    $("#fechaDateTime").focus()
    return false
  }
  if(hora == "" || hora == "00:00"){
    alerta("Porfavor ingrese la hora")
    $("#horaDateTime").focus()
    return false
  }
  else return true
}

OrdenesTrabajo.prototype.buildingDateTime = function (type) {
  $(`#table${type}`).html("")
  var dateTime = []

  if(type === "inicio") dateTime = orden.inicio
  if(type === "fin") dateTime = orden.fin

  for (var i in dateTime) {
    var item = dateTime[i]

    var template = `<tr>
      <td>${item.fecha}</td>
      <td>${item.hora}</td>`
    $(`#table${type}`).append(template)
  }
}

OrdenesTrabajo.prototype.validarOrden = function () {
  if(orden.inventarios.length === 0 && orden.herramientas.length === 0) {
    alerta("Porfavor debe ingresar los materiales o herramientas a usar")
    return false
  }
  else return true
}

OrdenesTrabajo.prototype.addInventario = function (id, producto, price) { 
  var cant = $(`#cant${id}`)

  if(cant.val() === "" || cant.val() == 0){
    alerta("Porfavor ingrese la cantidad")
    cant.focus()
    return false
  }
  if (this.validInventario(id, cant.val()) ) {
    var total = parseFloat(price) * parseInt(cant.val())
    var contex = {
      id: id,
      producto: producto,
      price: price,
      total: total,
      cant: cant.val(),
		}
		orden.inventarios.push(contex)
		localStorage.setItem('inventarios', JSON.stringify(orden.inventarios))
		this.buildingInventario()
		$(".panel-inventario").slideUp()
		$(".cant-input").val("")
	}

}

OrdenesTrabajo.prototype.validInventario = function (id, cant) {
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
			this.buildingInventario()
			alertaInfo("Se ha actualizado con exito")
			$(".panel-inventario").slideUp()
			$(".cant-input").val("")
			return false
		}
		else flag = true
	}

	return flag
}

OrdenesTrabajo.prototype.buildingInventario = function () {

  var inventarios = JSON.parse(localStorage.getItem('inventarios'))
  $("#tablemateriales").html("")

  for (var i in inventarios) {
    var item = inventarios[i]
    var total = parseFloat(item.price) * parseInt(item.cant)
    total = total.toFixed(2)
    var template = `<tr>
      <td>${item.cant}</td>
      <td>${item.producto}</td>
      <td>${item.price}</td>
      <td>${total}</td>`
    $("#tablemateriales").append(template)
  }

  // $(".delete-detail").on("click", this.handleDetailDelete)
}


OrdenesTrabajo.prototype.addHerramientas = function (id, producto, price) {
  var cant = $(`#cant${id}`)

  if(cant.val() === "" || cant.val() == 0){
    alerta("Porfavor ingrese la cantidad")
    cant.focus()
    return false
  }
  if (this.validHerramientas(id, cant.val()) ) {
    var total = parseFloat(price) * parseInt(cant.val())
    var contex = {
      id: id,
      producto: producto,
      price: price,
      total: total,
      cant: cant.val(),
		}
		orden.herramientas.push(contex)
		localStorage.setItem('herramientas', JSON.stringify(orden.herramientas))
		this.buildingHerramientas()
		$(".panel-listadoHerramientas").slideUp()
		$(".cant-input").val("")
	}
}


OrdenesTrabajo.prototype.validHerramientas = function (id, cant) {
  var flag = false
  var herra = JSON.parse(localStorage.getItem('herramientas'))

  if(herra === null || herra.length === 0){
    return true
  }
  for (var i in herra) {
		var item = herra[i]

		if(item.id === id) {
			item.cant = parseInt(item.cant) + parseInt(cant)
			item.total = parseInt(item.cant) * parseFloat(item.price)
			localStorage.setItem('herramientas', JSON.stringify(herra))
			this.buildingHerramientas()
			alertaInfo("Se ha actualizado con exito")
			$(".panel-listadoHerramientas").slideUp()
			$(".cant-input").val("")
			return false
		}
		else flag = true
	}

	return flag
}

OrdenesTrabajo.prototype.buildingHerramientas = function () {

  var inventarios = JSON.parse(localStorage.getItem('herramientas'))
  $("#tableHerramientas").html("")

  for (var i in inventarios) {
    var item = inventarios[i]
    var total = parseInt(item.cant) * parseFloat(item.price)
    total = total.toFixed(2)
    var template = `<tr>
      <td>${item.cant}</td>
      <td>${item.producto}</td>
      <td>${item.price}</td>
      <td>${total}</td>`
    $("#tableHerramientas").append(template)
  }

  // $(".delete-detail").on("click", this.handleDetailDelete)
}


// OrdenesTrabajo.prototype.handleDetailDelete = function (e) {
//   e.preventDefault()
//   var inventarios = JSON.parse(localStorage.getItem('inventarios'))
//   var index = e.currentTarget.dataset.index 
//   inventarios.splice(index, 1)
//   localStorage.setItem('inventarios', JSON.stringify(inventarios))
//   this.buildingInventario()
// }

