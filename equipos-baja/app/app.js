;(function () {
  'use strict'

  $("#print").on("click", handlePrint)
  $(".reporte").on("click", handleReporte)
  $('.ocupar').on('click', handleOcupar)

  function handlePrint () {
    window.open (`reporte/lista.php`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

  function handleReporte(e){
    var id = e.currentTarget.dataset.id
    window.open (`reporte/individual.php?id=${id}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

  function handleOcupar (e) {
    var id = e.currentTarget.dataset.id

    $.ajax({
      type: "POST",
      url: "service/guardar.php",
      data: { id }
    })
    .done(function (snap) {
      $(".tabla-contianer").load("template/table.php")
      if (snpa == 2) {
        alertaInfo("Se ha realizado con exito su tarea")
      }
    })
  }

})()
