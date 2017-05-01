;(function () {
  'use strict'

  $(".editar").on("click", handleEdit)
  $(".eliminar").on("click", handleDelete)
  $("#print").on("click", handlePrint)
  $(".reporte").on("click", handleReporte)

  function handleEdit (e) {
    var id = e.currentTarget.dataset.id

    $.ajax({
      type: "POST",
      url: "service/general.php",
      data: { id },
      dataType: "JSON"
    })
    .done(function (snap) {
      console.log(snap);
      if (snap == 3) {
        alerta('No puedes editar por ya siendo requerido')
        return false
      }
      $(".titulo").html("Editar area general")
      $("#idCode").val(snap.earege_cod_earege)
      $("#codigo").val(snap.earege_cod_earege)
      document.getElementById("depende-aguaje").checked = snap.earege_agu_earege
      $("#detalle_name").val(snap.earege_det_earege)
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
      console.log(snap);
      if (parseInt(snap) === 2) {
        alertaInfo("Se ha eliminado con exito el area")
        $(".tabla-contianer").load("template/table.php")
      }
      if (snap == 3) {
        alerta('No puedes eliminar por ya siendo requerido')
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
