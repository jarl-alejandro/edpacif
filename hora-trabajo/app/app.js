;(function () {
  'use strict'

  $(".editar").on("click", handleEdit)
  $("#print").on("click", handlePrint)
  $(".reporte").on("click", handleReporte)

  function handleEdit (e) {
    var id = e.currentTarget.dataset.id

    $.ajax({
      type: "POST",
      url: "service/hora.php",
      data: { id },
      dataType: "JSON"
    })
    .done(function (snap) {
      $("#idCode").val(snap.ehora_cod_hora)
     	$("#hora").val(snap.ehora_hor_ehora)
			$("#fecha").val(snap.ehora_fet_ehora)
			$("#equipo").val(snap.ehora_equi_ehora)

		 	// $("#hora-final").val(snap.eruta_cod_eruta)
			// $("#fecha-llegada").val(snap.eruta_cod_eruta)
			// $("#empleado").val(snap.eruta_cod_eruta)
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
