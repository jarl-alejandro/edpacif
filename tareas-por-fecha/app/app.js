;(function (){
  'use strict'

  $(".print-report").on("click", handleClickPrint)
  $("#print").on("click", handleClickReport)
  $("#print-fecha").on("click", handleClickFechaReport)
  $("#closeFecha").on("click", handleClickClose)

  function handleClickPrint (e) {
    var id = e.currentTarget.dataset.id
    window.open (`reporte/individual.php?id=${id}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")    
  }

  function handleClickReport () {
    window.open (`reporte/lista.php`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

  function handleClickFechaReport () {
    var inicio = $("#inicio-table").val()
    var fin = $("#fin-table").val()
    var empleado = $("#empleado-table").val()
    window.open (`reporte/lista.php?inicio=${inicio}&fin=${fin}&empleado=${empleado}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

  function handleClickClose () {
    $(".tabla-contianer").load("template/table.php")
  }

})()