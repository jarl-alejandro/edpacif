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
      url: "service/proveedor.php",
      data: { id },
      dataType: "JSON"
    })
    .done(function (response) {
      $(".titulo").html("Editar proveedor")
      $("#form-proveedor").slideDown()
      templateProveedor(response)
    })
  }

  function handleDelete (e) {
    var id = e.currentTarget.dataset.id
    $.ajax({
      type: "POST",
      url: "service/delete.php",
      data: { id }
    })
    .done(function (response) {
      console.log(response);
      if (response == 2) {
        $(".tabla-container").load("template/table.php")
        $(".media-list-contacts").load("../contacts_employ.php")
        alertaInfo("Se ha guardado con exito el proveedor")
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

  function templateProveedor (proveedor) {
    $("#id_proveedor").val(proveedor.eprov_cod_eprov)
    $("#nombre").val(proveedor.eprov_nom_eprov)
    $("#direccion").val(proveedor.eprov_dir_eprov)
    $("#celular").val(proveedor.eprov_cel_eprov)
    $("#telefono").val(proveedor.eprov_tel_eprov)
    $("#email").val(proveedor.eprov_mai_eprov)
    $("#nombreContacto").val(proveedor.eprov_noc_eprov)
    $("#celularContacto").val(proveedor.eprov_cec_eprov)
    $("#telefonoContacto").val(proveedor.eprov_tec_eprov)
    $("#emailContacto").val(proveedor.eprov_emc_eprov)
  }

})()
