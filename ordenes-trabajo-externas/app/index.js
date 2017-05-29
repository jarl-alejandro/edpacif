'use strict'

var orden = {}
function OrdenesTrabajo () {}

orden.$subarea = $("#subarea")
orden.$proveedor = $("#proveedor")
orden.$equipo = $("#equipo")
orden.$detalle = $("#detalle")
orden.inicio = []
orden.fin = []
orden.herramientas = []
orden.repuestos = []
orden.editar = false
orden.inicio_count = 0
orden.fin_count = 0
orden.type_herramienta = false
orden.type_repuestos = false
orden.aguajeDepende = false

OrdenesTrabajo.prototype.showForm = function () {
  $("#botoneraOrdenTrabajo").slideUp()
  $(".form__layout").slideDown()
  $(".tabla-contianer").slideUp()
}

OrdenesTrabajo.prototype.terminarOrden = function (id) {
  $.ajax({
    type: "POST",
    url: "service/terminar.php",
    data: { id }
  })
  .done(function (snap) {
    if(snap == 2){
      alertaInfo("Ha termiando con exito la orden de trabajo")
      this.closeForm()
      $(".tabla-contianer").load("template/table.php")
    }
  }.bind(this))
}

OrdenesTrabajo.prototype.aprobar = function (id) {
  $.ajax({
    type: "POST",
    url: "service/aprobar.php",
    data: { id, herramientas: orden.herramientas, repuestos: orden.repuestos,
            type_herramienta: orden.type_herramienta, type_repuestos: orden.type_repuestos }
  })
  .done(function (snap) {
    console.log(snap)
    if(snap == 2) {
      this.closeForm()
      alertaInfo("Se ha aprobado con exito")
      $(".tabla-contianer").load("template/table.php")
    }
  }.bind(this))
}

OrdenesTrabajo.prototype.aceptarForm = function () {
  if(this.validarOrden()) {
    if(orden.aguajeDepende === true) $("#observacion-aguaje").slideDown()
    else this.saveOrdenInterna()
  }
}

OrdenesTrabajo.prototype.saveOrdenInterna = function () {
  $.ajax({
    type: "POST",
    url: "service/guardar.php",
    data: this.getData()
  })
  .done(function (snap) {
    console.log(snap)
    this.closeForm()
    $(".tabla-contianer").load("template/table.php")
    alertaInfo("Se ha realizado la orden de trabajo con exito")
    window.open(`reporte/individual.php?id=${snap}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }.bind(this))
}

OrdenesTrabajo.prototype.closeForm = function () {
  $(".form__layout").slideUp()
  $("#ordenFormAprobar").slideUp()
  $(".tabla-contianer").slideDown()
  $("#ver_diagnosticos").slideUp()
  $("#containerObse").slideUp()
  $("#tiempos").slideUp()
  orden.$subarea.val("")
  orden.$proveedor.val("")

  $("#ordenFormGuardar").fadeOut()
  $("#ordenFormTerminar").fadeOut()
  $("#ordenFormAceptar").fadeIn()

  $(".footer-externa").slideUp()

  $("#fechaEntrega").val("")
  $("#costoOT").val("")
  $("#facturaExterna").val("")
  $("#InformExterna").val("")

  $("#subarea").attr("disabled", false)
  $("#proveedor").attr("disabled", false)
  $("#detalle").attr("disabled", false)
  $("#fechaEmision").attr("disabled", false)
  $("#id_orden").attr("disabled", false)
  $("#emitidoPor").attr("disabled", false)
  $("#observacion").attr("disabled", false)
  $(".mantenimiento").attr("disabled", false)
  $("#equipo").attr("disabled", false)

  var templateEqui = `<select id="equipo" class="form-control">
      <option value="">Debes selecionar primero la subarea</option>
    </select>`

  $("#equipoContainer").html(templateEqui)
  $("#equipo").val("")
  orden.$detalle.val("")

  orden.inicio = []
  orden.fin = []
  orden.herramientas = []
  orden.repuestos = []

  orden.aguajeDepende = false

  document.querySelector('input[name="mantenimiento"]:checked').checked = false
  $("#ordenFormTerminar").slideUp()
  $("#ordenFormAceptar").slideDown()
}

OrdenesTrabajo.prototype.loadEquipos = function () {
  var subarea = $("#subarea").val()
  $.ajax({
    type: "GET",
    url: "service/aguaje.php",
    data: { id: subarea },
    dataType: "JSON"
  })
  .done(function (snap) {
    orden.aguajeDepende = snap.earege_agu_earege
    console.log(snap)
  })

  $("#equipoContainer").load(`template/equipos.php?subarea=${subarea}`, function () {
    orden.$equipo = $("#equipo")
  })
}

OrdenesTrabajo.prototype.validarOrden = function () {
  if(orden.$subarea.val() === "") {
    orden.$subarea.focus()
    alerta("Porfavor selecione la subarea")
    return false
  }
  if(orden.$equipo.val() === "") {
    orden.$equipo.focus()
    alerta("Porfavor selecione el equipo")
    return false
  }
  if(orden.$proveedor.val() === "") {
    orden.$proveedor.focus()
    alerta("Porfavor selecione el emlpleado")
    return false
  }
  if($('input[name="mantenimiento"]:checked').val() == null){
    alerta("Porfavor el tipo de mantenimiento")
    return false
  }
  if(orden.$detalle.val() === "") {
    orden.$detalle.focus()
    alerta("Porfavor escriba el detalle de la orden de trabajo")
    return false
  }
  if(orden.$detalle.val().length < 20){
    orden.$detalle.focus()
    alerta("El detalle debe ser mas de 20 caracteres")
    return false
  }
  else return true
}

OrdenesTrabajo.prototype.getData = function () {
  return {
    subarea: orden.$subarea.val(),
    equipo: orden.$equipo.val(),
    proveedor: orden.$proveedor.val(),
    emitidoPor: $("#emitidoPor").val(),
    mantenimiento: $('input[name="mantenimiento"]:checked').val(),
    detalle: orden.$detalle.val(),
    motivo: $("#motivo-mante").val()
  }
}

OrdenesTrabajo.prototype.ShowOrden = function (id) {
  $("#ordenFormTerminar").slideDown()
  $("#ordenFormAceptar").slideUp()
  document.getElementById("ordenFormTerminar").dataset.id = id

  $.ajax({
    type: "POST",
    data: { id },
    url: "service/ordenTrabajo.php",
    dataType: "JSON"
  })
  .done(function (snap) {
    console.log(snap)
    $("#equipoContainer").load(`template/equipos.php?subarea=${snap.orden.eorin_sub_eorin}`, function () {
      $("#equipo").val(snap.orden.eorin_equ_eorin)
    })
    $("#subarea").val(snap.orden.eorin_sub_eorin)
    $("#proveedor").val(snap.orden.eorin_emp_eorin)

    $("#detalle").val(snap.orden.eorin_det_eorin)
    $("#fechaEmision").val(snap.orden.eorin_fet_eorin)
    $("#id_orden").val(snap.orden.eorin_cod_eorin)
    $("#emitidoPor").val(snap.orden.eorin_emi_eorin)
    $("#observacion").val(snap.orden.eorin_obs_eorin)

    // $("#ver_diagnosticos").attr("href", `../media/diagnostico/${snap.orden.eorin_dig_eorin}`)

    document.querySelector(`input[value="${snap.orden.eorin_man_eorin}"]`).checked = true

    for(var i in snap.inicio) {
      var item = snap.inicio[i]
      var object = { hora: item.dofi_hor_dofi, fecha: item.dofi_fet_dofi}
      orden.inicio.push(object)
    }

    for(var i in snap.fin) {
      var item = snap.fin[i]
      var object = { hora: item.doff_hor_doff, fecha: item.doff_fet_doff}
      orden.fin.push(object)
    }

    this.buildingDateTime("inicio")
    this.buildingDateTime("fin")

    $("#botoneraOrdenTrabajo").slideDown()
    $(".form__layout").slideDown()
    $(".tabla-contianer").slideUp()

  }.bind(this))
}

OrdenesTrabajo.prototype.showPedido = function (id) {
  document.getElementById("ordenFormGuardar").dataset.id = id
  document.getElementById("ordenFormTerminar").dataset.id = id

  $.ajax({
    type: "POST",
    url: "service/pedido.php",
    data: { id },
    dataType: "JSON"
  })
  .done(function (snap) {
    console.log(snap)
     $("#equipoContainer").load(`template/equipos.php?subarea=${snap.orden.eorex_sub_eorex}`, function () {
      $("#equipo").val(snap.orden.eorex_equ_eorex)
      $("#equipo").attr("disabled", true)

    })
    $("#subarea").val(snap.orden.eorex_sub_eorex)
    $("#proveedor").val(snap.orden.eorex_prov_eorex)
    $("#detalle").val(snap.orden.eorex_det_eorex)
    $("#fechaEmision").val(snap.orden.eorex_fet_eorex)
    $("#id_orden").val(snap.orden.eorex_cod_eorex)
    $("#emitidoPor").val(snap.orden.eorex_emi_eorex)
    $("#observacion").val(snap.orden.eorex_obs_eorex)

    $("#fechaEntrega").val(snap.orden.eorex_ffe_eorex)
    $("#costoOT").val(snap.orden.eorex_cos_eorex)

    $("#facturaExternaInput").val(snap.orden.eorex_fact_eorex)
    $("#InformExternaInput").val(snap.orden.eorex_infor_eorex)

    $("#subarea").attr("disabled", true)
    $("#proveedor").attr("disabled", true)
    $("#detalle").attr("disabled", true)
    $("#fechaEmision").attr("disabled", true)
    $("#id_orden").attr("disabled", true)
    $("#emitidoPor").attr("disabled", true)
    $("#observacion").attr("disabled", true)
    $(".mantenimiento").attr("disabled", true)

    $("#ordenFormGuardar").fadeIn()
    $("#ordenFormTerminar").fadeIn()
    $("#ordenFormAceptar").fadeOut()

    document.querySelector(`input[value="${snap.orden.eorex_man_eorex}"]`).checked = true
    $(".footer-externa").slideDown()
    $(".footer-externa").css('display', 'flex')

    // $("#ver_diagnosticos").slideUp()
    // $("#containerObse").slideUp()
    // $("#tiempos").slideUp()
    // $("#ordenFormAceptar").slideUp()
    // $("#botoneraOrdenTrabajo").slideDown()
    // $("#ordenFormAprobar").slideDown()

    $(".form__layout").slideDown()
    $(".tabla-contianer").slideUp()
  }.bind(this))
}


OrdenesTrabajo.prototype.buildingInventario = function (type) {
  $(`#table${type}`).html("")
  var invent = []

  if(type === "materiales") invent = orden.repuestos
  if(type === "Herramientas") invent = orden.herramientas

  for (var i in invent) {
    var item = invent[i]
    var template = `<tr>
      <td>${item.cant}</td>
      <td>${item.detalle}</td>
      <td>${item.price}
      <button class='btn btn-danger btn-raised elmin-invent' data-index="${i}" data-type="${type}" style='margin-left: 1em;'>Eliminar</button>

       <button class='btn btn-primary btn-raised edit-invent' data-index="${i}" data-type="${type}" style='margin-left: 1em;'>Editar</button>
      </td>`
    $(`#table${type}`).append(template)
  }

  $(".elmin-invent").on("click", function (e){
    var index = e.currentTarget.dataset.index
    var type = e.currentTarget.dataset.type

    if(type === "materiales") {
      invent = orden.repuestos
      orden.type_repuestos = true
    }
    if(type === "Herramientas") {
      invent = orden.herramientas
      orden.type_herramienta = true
    }

    invent.splice(index, 1)
    this.buildingInventario(type)

  }.bind(this))

  $('.edit-invent').on('click', function (e) {
    var index = e.currentTarget.dataset.index
    var type = e.currentTarget.dataset.type

    $('.panel-editar').slideDown()
    document.querySelector('#aceptarEditMET').dataset.index = index
    document.querySelector('#aceptarEditMET').dataset.type = type

  }.bind(this))

}

OrdenesTrabajo.prototype.buildingDateTime = function (type) {
  $(`#table${type}`).html("")
  var dateTime = []

  if(type === "inicio") dateTime = orden.inicio
  if(type === "fin"){
   dateTime = orden.fin
    orden.fin_count = 1
    $(".showFormTime").fadeOut()
  }

  for (var i in dateTime) {
    var item = dateTime[i]

    var template = `<tr>
      <td>${item.fecha}</td>
      <td>${item.hora}</td>`
    $(`#table${type}`).append(template)
  }
}


OrdenesTrabajo.prototype.saveDateTime = function (type) {
  var hora = $("#horaDateTime").val()
  var fecha = $("#fechaDateTime").val()

  if(this.validDateTime(hora, fecha)){
    var object = { fecha, hora }

    if (orden.fin_count == 0) {
      orden.fin.push(object)
      this.buildingDateTime(type)
    }
    else alerta('Ya tiene fecha y hora de fin')
    orden.fin_count++

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

OrdenesTrabajo.prototype.ordenFinDateTime = function () {
  if(orden.fin.length === 0){
    alerta("Pofavor ingrese el fin de fecha")
    return false
  }

  var id = $("#id_orden").val()

  $.ajax({
    type: "POST",
    url: "service/finFecha.php",
    data: { fin: orden.fin, id, estado: orden.editar }
  })
  .done(function (snap) {
    console.log(snap)
    if(snap == 2){
      alertaInfo("Se ha guardado con exito")
    }
  })

}


OrdenesTrabajo.prototype.addInventario = function (id, producto, price) {
  var cant = $(`#cant${id}inv`)

  if(cant.val() === "" || cant.val() == 0){
    alerta("Porfavor ingrese la cantidad")
    cant.focus()
    return false
  }
  if (this.validInventario(id, cant.val()) ) {
    var total = parseFloat(price) * parseInt(cant.val())
    var contex = {
      id: id,
      detalle: producto,
      price: price,
      total: total,
      cant: cant.val(),
		}
		orden.repuestos.push(contex)
    this.buildingInventario("materiales")
		$(".panel-inventario").slideUp()
		$(".cant-input").val("")
	}

}

OrdenesTrabajo.prototype.validInventario = function (id, cant) {
  var flag = false

  if(orden.repuestos.length === 0){
    return true
  }
  for (var i in orden.repuestos) {
		var item = orden.repuestos[i]

		if(item.id === id) {
			item.cant = parseInt(item.cant) + parseInt(cant)
			item.total = parseInt(item.cant) * parseFloat(item.price)
      this.buildingInventario("materiales")
			alertaInfo("Se ha actualizado con exito")
			$(".panel-inventario").slideUp()
			$(".cant-input").val("")
			return false
		}
		else flag = true
	}

	return flag
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
      detalle: producto,
      price: price,
      total: total,
      cant: cant.val(),
		}
		orden.herramientas.push(contex)
    this.buildingInventario("Herramientas")
		$(".panel-listadoHerramientas").slideUp()
		$(".cant-input").val("")
	}
}


OrdenesTrabajo.prototype.validHerramientas = function (id, cant) {
  var flag = false

  if(orden.herramientas.length === 0){
    return true
  }
  for (var i in orden.herramientas) {
		var item = orden.herramientas[i]

		if(item.id === id) {
			item.cant = parseInt(item.cant) + parseInt(cant)
			item.total = parseInt(item.cant) * parseFloat(item.price)
      this.buildingInventario("Herramientas")
			alertaInfo("Se ha actualizado con exito")
			$(".panel-listadoHerramientas").slideUp()
			$(".cant-input").val("")
			return false
		}
		else flag = true
	}

	return flag
}
