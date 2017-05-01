;(function () {
  'use strict'

  $("#print").on("click", handlePrint)
  $(".reporte").on("click", handleReporte)
  $(".pedido").on("click", handlePedido)

  function handlePedido (e) {
    var id = e.currentTarget.dataset.id

    $(".form__layout").slideDown()
    $("#tableLayout").slideUp()

    $.ajax({
      type: "POST",
      data: { id },
      url: "service/pedidos.php",
      dataType: "JSON"
    })
    .done(function (snap) {
      console.log(snap);
      build(snap.pedidos)
    })
  }

  function build (pedidos) {
    $("#pedidosTabla").html("")
    var index = 0
    for (var i in pedidos) {
      var item = pedidos[i]
      index++

      var template = `<tr>
        <td>${ index }</td>
        <td>${ item.epedi_nom_epedi }</td>
        <td class="center">
          <button class="btn__flat mant__equipo team team__ok"
            data-id="${ item.epedi_id_epedi }" data-index=${i}>
            <i class="fa fa-check" id="teamOk${i}"></i>
            <i class="fa fa-times none" id="teamError${i}" ></i>
          </button>
        </td>
      </tr>`
      $("#pedidosTabla").append(template)
    }
  }

  function handlePrint () {
    window.open (`reporte/lista.php`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

  function handleReporte(e){
    var id = e.currentTarget.dataset.id
    window.open (`reporte/individual.php?id=${id}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

})()
