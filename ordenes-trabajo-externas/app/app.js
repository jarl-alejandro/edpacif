
;(function () {
  'use strict'

  const ordenesTrabajo = new OrdenesTrabajo()

  var $inicioFecha = $("#inicio-fecha")
  var $FinFecha = $("#fin-fecha")


  $("#acept-fecha").on("click", handleAceptFecha)
  $("#print").on("click", handleClickReport)
  $("#print-fecha").on("click", handleClickFechaReport)
  $("#closeFecha").on("click", handleClickClose)
  $(".enviadoExterna").on('click', handleEnviado)

  function handleEnviado (e) {
    var id = e.currentTarget.dataset.id
    ordenesTrabajo.showPedido(id)
  }

  function handleClickClose () {
    $(".tabla-contianer").load("template/table.php")
  }

  function handleClickReport () {
    window.open (`reporte/lista.php`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

  function handleClickFechaReport () {
    var inicio = $("#inicio-table").val()
    var fin = $("#fin-table").val()
    window.open (`reporte/lista.php?inicio=${inicio}&fin=${fin}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

  function handleAceptFecha (e) {
    e.preventDefault()
    if(validarForm()){
      $(".tabla-contianer").load(`template/fecha.php?inicio=${$inicioFecha.val()}&fin=${$FinFecha.val()}`)
    }
  }

  function validarForm () {
    if($inicioFecha.val() == ""){
      alerta("Ingrese la fecha inicial")
      $inicioFecha.focus()
      return false
    }

    if($FinFecha.val() == ""){
      alerta("Ingrese la fecha final")
      $FinFecha.focus()
      return false
    }
    if($FinFecha.val() <= $inicioFecha.val()){
      alerta("La fecha final no puede ser menor que la fecha inicial")
      $FinFecha.focus()
      return false
    }
    else return true

  }

  $(".ordenTrabajoRevisado").on("click", function (e) {
    e.preventDefault()
    var id = e.currentTarget.dataset.id
    ordenesTrabajo.ShowOrden(id)
  })

  $(".ordenTrabajoPedido").on("click", function (e) {
    e.preventDefault()
    var id = e.currentTarget.dataset.id
    ordenesTrabajo.showPedido(id)
  })

  $(".reporte").on("click", function (e){
    var id = e.currentTarget.dataset.id
    window.open(`reporte/individual.php?id=${id}&impr=1`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  })

  var table = $('#notifications__table')

  // var notify = setInterval(function () {
  //   $.ajax({
  //     type: "POST",
  //     url: "service/pedidos_herramientas.php",
  //     dataType: "JSON"
  //   })
  //   .done(function (snap) {
  //     console.log(snap)
  //     table.html("")
  //     if(snap.length == 0) {
  //       // alert(snap.length)
  //       clearInterval(notify)
  //       $('.notifications').fadeOut()
  //     }


  //     for (var i in snap) {
  //       var item = snap[i]
  //       $('.notifications').fadeIn()
  //       setTimeout(function () {
  //         $('.notifications').fadeOut()
  //       }, 2000)

  //       var template = `<tr>
  //         <td>${ i+1 }</td>
  //         <td>${ item.eorin_det_eorin }</td>
  //         <td><button class="btn btn-raised center review button__little getPed"
  //           data-id="${item.eorin_cod_eorin}">
  //           <i class="fa fa-bullhorn text-medium" aria-hidden="true"></i>
  //         </button></td>
  //       </tr>`
  //       table.append(template)
  //     }
  //     $(".getPed").on("click", function (e) {
  //       e.preventDefault()
  //       var id = e.currentTarget.dataset.id
  //       ordenesTrabajo.showPedido(id)
  //     })
  //   })

  // }, 3000)

})()
