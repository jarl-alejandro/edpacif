;(function () {
  'use strict'

  var dateMin = $("#DateMin").val()
  $( '.datepicker' ).pickadate({
    min: dateMin
  })

  $(".tabla-contianer").load("template/table.php")
  localStorage.clear()

  const ordenesTrabajo = new OrdenesTrabajo()

  $("#ordenFormSave").on("click", function (e) {
    e.preventDefault()
    ordenesTrabajo.teminarOrdenTrabajo()
  })

  $("#ordenFormAceptar").on("click", function (e) {
    e.preventDefault()    
    ordenesTrabajo.aceptarForm()
  })

  $("#ordenFormCancelar").on("click", function (e) {
    e.preventDefault()
    ordenesTrabajo.closeForm()
  })

  $("#saveDateTime").on("click", function (e) {
    var type = e.currentTarget.dataset.type
    ordenesTrabajo.saveDateTime(type)
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

  $("#ordenFormTimeInicio").on("click", function (e) {
    ordenesTrabajo.ordenInicioDateTime()
  })

  $("#ordenFormTimeFin").on("click", function (e) {
    ordenesTrabajo.ordenFinDateTime()
  })

  $("#meOlvideMat").on('click', function (e) {
    e.preventDefault()
    var id = $("#id_orden").val()
    $.ajax({
      type: "POST",
      url: 'service/olvide_materiales.php',
      data: { id }
    })
    .done(function (snap) {
      console.log(snap)
      if (snap == 2) {
        $(".tabla-contianer").load("template/table.php")
        ordenesTrabajo.closeForm()
        alertaInfo("Se ha pedido mas materiales y herramientas")
      }

    })
  })

  $(".showFormTime").on("click", function (e) {
    var type = e.currentTarget.dataset.type
    document.getElementById("saveDateTime").dataset.type = type
    $(".form__date-time").slideDown()
  })

  $("#cancelDateTime").on("click", function () {
    $("#horaDateTime").val("")
    $("#fechaDateTime").val("")
    $(".form__date-time").slideUp()    
  })

  $("#herramientas").on("click", function (e) {
    e.preventDefault()
    $(".panel-herramienta").slideDown()
  })

  $("#materiales").on("click", function (e) {
    e.preventDefault()
    $(".panel-materiales").slideDown()
  })

  $("#tiempos").on("click", function (e) {
    e.preventDefault()
    $(".panel-tiempos").slideDown()
  })

  $("#panelHerramAceptar").on("click", function (e) {
    $(".panel-herramienta").slideUp()
  })

  $("#panelMaterAceptar").on("click", function (e) {
    $(".panel-materiales").slideUp()
  })

  $(".close--her").on("click", function (e) {
    e.preventDefault()
    $(".panel-listadoHerramientas").slideUp()
  })

  $("#panelTiempoAceptar").on("click", function (e) {
    $(".panel-tiempos").slideUp()
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

})()
  