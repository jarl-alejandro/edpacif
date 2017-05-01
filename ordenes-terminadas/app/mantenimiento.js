;(function () {
  'use strict'

  $(".review").on("click", handleReview)
  $("#print").on("click", handlePrint)
  $(".reporte").on("click", handleReporte)

  function handleReview (e) {
    var id = e.currentTarget.dataset.id

    $.ajax({
      type: "POST",
      data: { id },
      url: "service/ordenes.php",
      dataType: "JSON"
    })
    .done(function (snap) {
      // $(".tabla-contianer").load("template/table.php")
      $("#layoutInforme").slideDown()
      $("#finish").slideDown()
      $("#save").slideUp()
      $("#detalle").val(snap.orden.eorde_det_eorde)
      $("#informe").val(snap.orden.eorde_inf_eorde)

      $("#orden_id").val(snap.orden.eorde_cod_eorde)
      $("#empleado").val(snap.orden.eorde_emp_eorde)
      $("#equipo").val(snap.orden.eorde_equ_eorde)
      $("#fecha").val(snap.orden.eorde_fecha_eorde)
      templateEquipo(snap.detalle)
      $("#tableLayout").slideUp()
      $(".form__layout").slideDown()
    })
  }

   function templateEquipo (snap) {
    $("#detalleEquipoTabla").html("")

    for (var i in snap) {
      var item = snap[i]
      var template = `<tr>
        <td>${ item.einven_cod_einven }</td>
        <td>${ item.einven_pro_einven }</td>
        <td class="center">
          <button class="btn__flat mant__equipo team team__ok"
            data-id="${ item.einven_cod_einven }" data-index=${i}
            id="btnOrden${i}">
            <i class="fa fa-check" id="teamOk${i}"></i>
            <i class="fa fa-times none" id="teamError${i}" ></i>
          </button>
        </td>
      </tr>`
      $("#detalleEquipoTabla").append(template)
      if(item.edequ_est_edequ === "M"){
        $(`#teamOk${i}`).slideToggle()
        $(`#teamError${i}`).slideToggle()
        $(`#btnOrden${i}`).toggleClass("team__ok")
        $(`#btnOrden${i}`).toggleClass("team__error")
      }
    }
    $(".mant__equipo").on("click", e => e.preventDefault())
  }

  function handlePrint () {
    window.open (`reporte/lista.php`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

  function handleReporte(e){
    var id = e.currentTarget.dataset.id
    window.open (`reporte/individual.php?id=${id}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")

  }

})()


