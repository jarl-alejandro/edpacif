;(function () {
  'use strict'

  var $empleado = $("#empleado")
  var $equipo = $("#equipo")
  var $fecha = $("#fecha")

  var ordenInventario = []
  var comentario = ""

  $(".tabla-contianer").load("template/table.php")
  $("#cancelar").on("click", handlecancelar)


  function handlecancelar () {
    $empleado.val("")
    $equipo.val("")
    $fecha.val("")
    ordenInventario = []
    $("#detalleEquipoTabla").html("")
    $("#tableLayout").slideDown()
    $(".form__layout").slideUp()
    $("#detalle").val("")
    $("#informe").val("")
    $("#layoutInforme").slideUp()
    $("#finish").slideUp()
    $("#save").slideDown()
  }


})()
