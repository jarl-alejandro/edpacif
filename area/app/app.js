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
        alerta("No puede editar esat area porque esta siendo usada")
        return false
      }
      $(".titulo").html("Editar area")
      $("#idCode").val(snap.earea_cod_earea)
      $("#codigo").val(snap.earea_cod_earea)
      // $("#codigo").attr("disabled", true)
      $("#detalle_name").val(snap.earea_det_earea)
      $("#general").val(snap.earea_gen_earea)
      $("#newGeneral").val(snap.earea_gen_earea)
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
        alerta("No puede eliminar esat area porque esta siendo usada")
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
