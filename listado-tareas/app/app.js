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
      url: "service/tareas.php",
      dataType: "JSON"
    })
    .done(function (snap) {
      $("#save").slideUp()
      $("#general").attr("disabled", true)
      $("#detalle").attr("disabled", true)

      $("#idCode").val(snap.ltare_cod_ltare)
      $("#newGeneral").val(snap.ltare_suba_ltare)
      $("#general").val(snap.ltare_suba_ltare)
      $("#detalle_name").val(snap.ltare_det_ltare)

      // $("#codigo").val(snap.earea_cod_earea)
      $("#form-conatiner").slideDown()
    })
  }

  function handleDelete (e) {
    var id = e.currentTarget.dataset.id
    var estado = e.currentTarget.dataset.estado

    $.ajax({
      type: "POST",
      data: { id, estado },
      url: "service/delete.php",
      dataType: "JSON"
    })
    .done(function (snap) {
      console.log(snap)
      if (parseInt(snap.status) === 201) {
        alertaInfo(`Se ha ${snap.state} con exito`)
        $(".tabla-contianer").load("template/table.php")
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
