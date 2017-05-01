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
      url: "service/employee.php",
      data: { id },
      dataType: "JSON"
    })
    .done(function (response) {
      console.log(response)
      if (response.status == 3) {
        alerta("No puede editar este recurso porque esta siendo requerido")
        return false
      }
      $(".titulo").html("Editar empleado")
      $("#form-employ").slideDown()
      templateEmployee(response)
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
        alertaInfo("Se ha guardado con exito el empleado")
      }
      if (response == 3) {
        alerta("No puede eliminar este recurso porque esta siendo requerido")
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

  function templateEmployee (employee) {
    $("#id_employee").val(employee.eempl_ced_eempl)
    $("#cedula").val(employee.eempl_ced_eempl)
    $("#nombre").val(employee.eempl_nom_eempl)
    $("#apellido").val(employee.eempl_ape_eempl)
    $("#direccion").val(employee.eempl_dir_eempl)
    $("#rol").val(employee.eempl_car_eempl)
    $("#sueldo").val(employee.eempl_suel_eempl)
    $("#email").val(employee.eempl_mai_eempl)
    $("#telefono").val(employee.eempl_tel_eempl)
  }

})()
