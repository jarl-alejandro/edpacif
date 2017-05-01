;(function () {
  'use strict'

  $(".tabla-contianer").load("template/table.php")

  $("#cancelar").on("click", handleCancelar)
  $("#save").on("click", handleSave)

  function handleCancelar (e) {
    e.preventDefault()
    $(".form__layout").slideUp()
    $("#tableLayout").slideDown()
    $("#pedidosTabla").html("")
  }

  function handleSave (e) {
    e.preventDefault()
    alert("Guardado...")
  }

})()
