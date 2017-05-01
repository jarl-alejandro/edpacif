;(function () {
  'use strict'

  $(".editar").on("click", handleEdit)
  $("#print").on("click", handlePrint)
  $(".reporte").on("click", handleReporte)

  function handleEdit (e) {
    var id = e.currentTarget.dataset.id

    $.ajax({
      type: "POST",
      url: "service/ruta.php",
      data: { id },
      dataType: "JSON"
    })
    .done(function (snap) {
      $(".titulo").html("Editar ruta")
      $("#idCode").val(snap.eruta_cod_eruta)
      $("#detalle_ruta").val(snap.eruta_det_eruta)
      $("#kmInicial").val(snap.eruta_kmi_eruta)
      $("#kmFinal").val(snap.eruta_kmf_eruta)
      $("#fecha").val(snap.eruta_fet_eruta)
      $("#equipo").val(snap.eruta_equi_eruta)
      $("#empleado").val(snap.eruta_emp_eruta)
			$("#motivo").val(snap.eruta_motiv_eruta)
			$("#fecha-llegada").val(snap.eruta_llegf_eruta)
      $("#form-conatiner").slideDown()
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
