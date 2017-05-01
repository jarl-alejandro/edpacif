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
      url: "service/inventario.php",
      dataType: "JSON"
    })
    .done(function (snap) {
      if (snap == 3) {
        alerta("No puedo editar este recurso porque esta siendo requerido")
        return false
      }
      $(".titulo").html("Editar inventario")
      $("#idCode").val(snap.einven_cod_einven)
      $("#producto").val(snap.einven_pro_einven)
      $("#disponibilidad").val(snap.einven_dis_einven)
      $("#unidad").val(snap.einven_uni_einven)
      $("#costo").val(snap.einven_cos_einven)
      $("#bodega").val(snap.einven_bod_einven)
      $("#max").val(snap.einven_max_einven)
      $("#min").val(snap.einven_min_einven)
      $("#cant").val(snap.einven_cant_einven)
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
        alertaInfo("Se ha eliminado con exito el area")
        $(".tabla-contianer").load("template/table.php")
      }
      if (snap == 3) {
        alerta("No puedo eliminar este recurso porque esta siendo requerido")
        return false
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
