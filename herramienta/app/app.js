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
      url: "service/herramienta.php",
      dataType: "JSON"
    })
    .done(function (snap) {
      $(".titulo").html("Editar herramienta")
      $("#idCode").val(snap.eherr_cod_eherr)
      $("#producto").val(snap.eherr_det_eherr)
      $("#unidad").val(snap.eherr_uni_eherr)
      $("#costo").val(snap.eherr_cos_eherr)
      $("#bodega").val(snap.eherr_bod_eherr)
      $("#max").val(snap.eherr_max_eherr)
      $("#min").val(snap.eherr_min_eherr)
      $("#cant").val(snap.eherr_cant_eherr)
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
        alertaInfo("Se ha eliminado con exito")
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
