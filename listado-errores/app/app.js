;(function () {

  $('.print--faild').on('click', handlePrintFaild)
  $('#print-all').on('click', handlePrint)

  function handlePrintFaild (e) {
    var id = e.currentTarget.dataset.id
    window.open(`reporte/individual.php?id=${id}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

  function handlePrint () {
    window.open(`reporte/lista.php`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

})()
