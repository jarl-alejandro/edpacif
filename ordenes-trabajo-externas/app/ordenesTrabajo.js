;(function () {
  'use strict'

  var dateMin = $("#DateMin").val()
  $( '.datepicker' ).pickadate({
    min: dateMin
  })

  var $FinFecha = $("#fin-fecha")

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

    ordenesTrabajo.addInventario(id, producto, price)
  })

  $(".add-herr").on("click", function (e) {
    var id = e.currentTarget.dataset.id
    var producto = e.currentTarget.dataset.producto
    var price = e.currentTarget.dataset.price

    ordenesTrabajo.addHerramientas(id, producto, price)
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
    $("#horaDateTime").val(orden.fin[0].hora)
    $("#fechaDateTime").val(orden.fin[0].fecha)
    $("#saveDateTime").fadeOut()
    $("#updateDateTime").fadeIn()
  })

  $("#updateDateTime").on('click', function () {
    orden.fin[0].hora = $("#horaDateTime").val()
    orden.fin[0].fecha = $("#fechaDateTime").val()
    ordenesTrabajo.buildingDateTime("fin")
    orden.editar = true

    $("#horaDateTime").val("")
    $("#fechaDateTime").val("")
    $(".form__date-time").slideUp()
    $("#saveDateTime").fadeIn()
    $("#updateDateTime").fadeOut()
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

  $("#ordenFormGuardar").on("click", function (e) {
    e.preventDefault()
    var id = e.currentTarget.dataset.id
    var array = $('#fechaEntrega').val().split("-")
    var fechaEntry = array[2]+"-"+array[1]+"-"+array[0]

    if ($('#fechaEntrega').val() != "") {
      if ( fechaEntry <= $("#fechaEmision").val()){
        alerta('Ingrese una fecha correcta')
        $('#fechaEntrega').focus()
        return false
      }
    }
    $.ajax({
      type: "POST",
      url: "service/parcial_orden.php",
      data: getData(id),
      cache: false,
      contentType: false,
      processData: false
    })
    .done(function (snap) {
      console.log(snap)
      alertaInfo("Se ha guardado con exito")
      ordenesTrabajo.closeForm()
    })

  })

  $("#ordenFormTerminar").on("click", function (e) {
    e.preventDefault()
    var id = e.currentTarget.dataset.id

    if(validarExterna()) {
      $.ajax({
        type: "POST",
        url: "service/terminar.php",
        data: getData(id),
        cache: false,
        contentType: false,
        processData: false
      })
      .done(function (snap) {
        console.log(snap)
        alertaInfo("Se ha guardado con exito")
        $(".tabla-contianer").load("template/table.php")
        ordenesTrabajo.closeForm()
      })
    }
  })

  function validarExterna () {
    var array = $('#fechaEntrega').val().split("-")
    var fechaEntry = array[2]+"-"+array[1]+"-"+array[0]

    if($("#fechaEntrega").val() === "") {
      alerta("Ingrese la fecha de entraga")
      $("#fechaEntrega").focus()
      return false
    }
    if ( fechaEntry <= $("#fechaEmision").val()){
      alerta('Ingrese una fecha correcta')
      $('#fechaEntrega').focus()
      return false
    }
    if($("#costoOT").val() === "") {
      alerta("Ingrese el costo")
      $("#costoOT").focus()
      return false
    }
    if($("#InformExternaInput").val() == "") {
      alerta("Suba el informe")
      return false
    }
    if($("#facturaExternaInput").val() == "") {
      alerta("Suba la factura")
      return false
    }
    else return true
  }

  $('#diagnostico').on('change', function (e) {
    var file = e.target.files[0]
    if (file.size > (1024 * 1024 * 2)) {
      alerta("No puede subir imagenes mas de 2mb")
      $("#InformExternaInput").val('')
      $('#diagnostico').val('')
      return false
    }
    else $("#InformExternaInput").val('diagnostico')
  })

  $('#factura').on('change', function (e) {
    var file = e.target.files[0]
    if (file.size > (1024 * 1024 * 2)) {
      alerta("No puede subir imagenes mas de 2mb")
      $("#facturaExternaInput").val('')
      $('#factura').val('')
      return false
    }
    else $("#facturaExternaInput").val('factura')
  })

  function getData (id) {
    var formData = new FormData()
    var file_inform = document.getElementById("diagnostico")
    var file_factura = document.getElementById("factura")

    formData.append("id", id)
    formData.append("costo", $("#costoOT").val() || 0)
    formData.append("fecha", $("#fechaEntrega").val())

    formData.append("is_informe", file_inform.files.length)
    formData.append("informe", file_inform.files[0])

    formData.append("is_factura", file_factura.files.length)
    formData.append("factura", file_factura.files[0])
    return formData
  }

})()
