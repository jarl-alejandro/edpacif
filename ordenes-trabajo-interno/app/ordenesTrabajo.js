;(function () {
  'use strict'

  var $FinFecha = $("#fin-fecha")
  var dateMin = $("#DateMin").val()

  $( '.datepicker' ).pickadate({ min: dateMin })
  $(".tabla-contianer").load("template/table.php")

  const ordenesTrabajo = new OrdenesTrabajo()

  $("#form-btn").on("click", ordenesTrabajo.showForm)

  $("#ordenFormAceptar").on("click", function (e) {
    e.preventDefault()
    ordenesTrabajo.aceptarForm()
  })

  $("#ordenFormCancelar").on("click", function (e) {
    e.preventDefault()
    ordenesTrabajo.closeForm()
  })

  $("#ordenFormTerminar").on("click", function (e) {
    e.preventDefault()
    var id = e.currentTarget.dataset.id
    ordenesTrabajo.terminarOrden(id)
  })

  $("#ordenFormAprobar").on("click", function (e) {
    e.preventDefault()
    var id = e.currentTarget.dataset.id
    ordenesTrabajo.aprobar(id)
  })

  $(".showFormTime").on("click", function (e) {
    var type = e.currentTarget.dataset.type
    document.getElementById("saveDateTime").dataset.type = type
    $(".form__date-time").slideDown()
  })

  $(".add-inve").on("click", function (e) {
    var id = e.currentTarget.dataset.id
    var producto = e.currentTarget.dataset.producto
    var price = e.currentTarget.dataset.price
    var cantProducto = e.currentTarget.dataset.cant

    ordenesTrabajo.addInventario(id, producto, price, cantProducto)
  })

  $(".add-herr").on("click", function (e) {
    var id = e.currentTarget.dataset.id
    var producto = e.currentTarget.dataset.producto
    var price = e.currentTarget.dataset.price
    var cantProducto = e.currentTarget.dataset.cant

    ordenesTrabajo.addHerramientas(id, producto, price, cantProducto)
  })

  $("#cancelDateTime").on("click", function () {
    $("#horaDateTime").val("")
    $("#fechaDateTime").val("")
    orden.editar = false
    $(".form__date-time").slideUp()
  })

  $("#saveDateTime").on("click", function (e) {
    var type = e.currentTarget.dataset.type
    ordenesTrabajo.saveDateTime(type)
  })

  $("#subarea").on("change", function (e) {
    e.preventDefault()
    ordenesTrabajo.loadEquipos()
  })

  $("#tiempos").on("click", function (e) {
    e.preventDefault()
    $(".panel-tiempos").slideDown()
  })

  $("#panelTiempoAceptar").on("click", function (e) {
    e.preventDefault()
    $(".panel-tiempos").slideUp()
  })


  $("#herramientas").on("click", function (e) {
    e.preventDefault()
    $(".panel-herramienta").slideDown()
  })

  $("#materiales").on("click", function (e) {
    e.preventDefault()
    $(".panel-materiales").slideDown()
  })

  $("#panelHerramAceptar").on("click", function (e) {
    $(".panel-herramienta").slideUp()
  })

  $("#panelMaterAceptar").on("click", function (e) {
    $(".panel-materiales").slideUp()
  })

  $("#herramientas").on("click", function (e) {
    e.preventDefault()
    $(".panel-herramienta").slideDown()
  })

  $("#ordenFormTimeFin").on("click", function (e) {
    ordenesTrabajo.ordenFinDateTime()
  })

  $(".showFormTimeEdit").on('click', function (e) {
    // e.preventDefault()
    $(".form__date-time").slideDown()
    if (orden.fin[0] != undefined) {
      $("#horaDateTime").val(orden.fin[0].hora)
      $("#fechaDateTime").val(orden.fin[0].fecha)
      $("#saveDateTime").fadeOut()
      $("#updateDateTime").fadeIn()
    }
    else {
      $("#saveDateTime").fadeIn()
      $("#updateDateTime").fadeOut()
    }
  })

  $("#updateDateTime").on('click', function () {
     var hora = $("#horaDateTime").val()
     var fecha = $("#fechaDateTime").val()

    if (ordenesTrabajo.validDateTime(hora+":00", fecha)) {
      if (orden.fin[0] != undefined) {
        orden.fin[0].hora = $("#horaDateTime").val()
        orden.fin[0].fecha = $("#fechaDateTime").val()
        ordenesTrabajo.buildingDateTime("fin")
        orden.editar = true
      }

      $("#horaDateTime").val("")
      $("#fechaDateTime").val("")
      $(".form__date-time").slideUp()
      $("#saveDateTime").fadeIn()
      $("#updateDateTime").fadeOut()
    }
  })

  $("#materialesAdd").on("click", function (e) {
    $(".panel-inventario").slideDown()
  })

   $(".close--inven").on("click", function () {
    $(".panel-inventario").slideUp()
  })

  $("#Herramientasadd").on("click", function () {
    $(".panel-listadoHerramientas").slideDown()
  })

  $("#panelHerramAceptar").on("click", function () {
    $(".panel-listadoHerramientas").slideUp()
  })

  $(".close--her").on("click", function (e) {
    e.preventDefault()
    $(".panel-listadoHerramientas").slideUp()
  })

  $("#aceptarEditMET").on('click', function (e) {
    var config = e.currentTarget.dataset
    var cant = $("#EditarHerrInv")
    var invent = null

    if (cant.val() == "") {
      alerta('Ingrese la cantidad')
      cant.focus()
      return false
    }

    if(config.type === "materiales") {
      invent = orden.repuestos
      orden.type_repuestos = true
    }
    if(config.type === "Herramientas") {
      invent = orden.herramientas
      orden.type_herramienta = true
    }

    invent[config.index].cant = cant.val()
    ordenesTrabajo.buildingInventario(config.type)
    $('.panel-editar').slideUp()
  })

  $("#cancelarEditMET").on('click', function (e) {
    $('.panel-editar').slideUp()
  })

  $("#no-aguaje").on('click', function (e) {
    $("#observacion-aguaje").slideUp()
    ordenesTrabajo.closeForm()
  })

  $("#si-aguaje").on("click", function (e) {
    $("#observacion-aguaje").slideUp()
    $("#mantenimiento-aguaje").slideDown()
  })

  $("#acept-aguaje").on('click', function (e) {
    var motivo = $("#motivo-mante")

    if(motivo.val() === "") {
      alerta("Porfavor ingrese el motivo del matenimiento")
      motivo.focus()
      return false
    }
    if(motivo.val().length < 20) {
      alerta("Motivo no valido")
      motivo.focus()
      return false
    }
    $("#mantenimiento-aguaje").slideUp()
    ordenesTrabajo.saveOrdenInterna()
    motivo.val("")
  })

})()
