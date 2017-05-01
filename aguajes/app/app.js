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
      url: "service/aguaje.php",
      data: { id },
      dataType: "JSON"
    })
    .done(function (response) {
      $("#form-conatiner").slideDown()
      templateAguaje(response)
    })
  }

  function handleDelete (e) {
    var id = e.currentTarget.dataset.id

    $.ajax({
      type: "POST",
      url: "service/anular.php",
      data: { id }
    })
    .done(function (response) {
      console.log(response);
      if (parseInt(response) === 2){
        alertaInfo("Se ha anulad con exito")
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

  function templateAguaje (aguaje) {
    $(".titulo").html("Editar aguaje")
    $("#id-aguaje").val(aguaje.eagua_cod_eagua)
    $("#inicio").val(aguaje.eagua_ini_eagua)
    $("#fin").val(aguaje.eagua_fin_eagua)
  }

})()
