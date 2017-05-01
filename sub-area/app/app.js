;(function () {
  'use strict'

  $(".editar").on("click", handleEdit)
  $(".eliminar").on("click", handleDelete)
  $("#print").on("click", handlePrint)
  $(".reporte").on("click", handleReporte)

  function handleEdit (e) {
    var id = e.currentTarget.dataset.id

    $.ajax({
      type: "GET",
      data: { id },
      url: "service/area.php",
      dataType: "JSON"
    })
    .done(function (snap) {
      if (snap == 3) {
        alerta('No puede editar porque esta siendo requerida')
        return false
      }
      $(".titulo").html("Editar subarea")
      $("#idCode").val(snap.subare_cod_subare)
      // $("#codigo").attr("disabled", true)
      $("#codigo").val(snap.subare_cod_subare)
      $("#detalle_name").val(snap.subare_det_subare)
      $("#general").val(snap.subare_are_subare)
      $("#newGeneral").val(snap.subare_are_subare)
      $("#form-conatiner").slideDown()
    })
  }

  function handleDelete (e) {
    var id = e.currentTarget.dataset.id
    $.ajax({
      type: "POST",
      data: { id },
      url: "service/delete.php"
    })
    .done(function (snap) {
      if (parseInt(snap) === 2) {
        alertaInfo("Se ha eliminado con exito el area")
        $(".tabla-contianer").load("template/table.php")
      }
      if (snap == 3) {
        alerta('No puede editar porque esta siendo requerida')
        return false
      }
    })
  }

  function handlePrint () {
    window.open (`reporte/lista.php`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

  function handleReporte(e){
    var id = e.currentTarget.dataset.id
    window.open (`reporte/individual.php?id=${id}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

})()
