;(function () {
  'use strict'

  $(".reporte").on("click", function (e){
    var id = e.currentTarget.dataset.id
    window.open(`reporte/individual.php?id=${id}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  })

  $(".ordenTrabajoAutorizado").on("click", function (e) {
    var id = e.currentTarget.dataset.id
    $.ajax({
      type: "POST",
      url: "service/proceso.php",
      data: { id } 
    })
    .done(function (snap) {
      console.log(snap)
      $(".tabla-contianer").load("template/table.php")
      showOrdenTrabajo(id)
    })
    window.open(`reporte/materiales.php?id=${id}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")    
  })

  $(".ordenTrabajo").on("click", function (e) {
    var id = e.currentTarget.dataset.id
    showOrdenTrabajo(id)
  })

  function showOrdenTrabajo (id) {
    $.ajax({
      type: "POST",
      url: "service/ordenTrabajo.php",
      data: { id },
      dataType: "JSON"
    })
    .done(function (snap) {
      console.log(snap)
      $(".tabla-contianer").load("template/table.php")
      $("#equipoContainer").load(`template/equipos.php?subarea=${snap.eorin_sub_eorin}`, function () {
        $("#equipo").val(snap.eorin_equ_eorin)
      })
      $("#subarea").val(snap.eorin_sub_eorin)
      $("#empleado").val(snap.eorin_emp_eorin)
      
      $("#detalle").val(snap.eorin_det_eorin)
      $("#fechaEmision").val(snap.eorin_fet_eorin)
      $("#id_orden").val(snap.eorin_cod_eorin)
      $("#emitidoPor").val(snap.eorin_emi_eorin)
      document.querySelector(`input[value="${snap.eorin_man_eorin}"]`).checked = true

      if (snap.eorin_estfe_orin == 1) $('#tiempos').fadeOut()
      
      if (snap.eorin_est_eorin == 'pedido' || snap.eorin_est_eorin == 'proceso') {
        $('#ordenFormAceptar').fadeOut()
        $('#herramientas').fadeOut()
        $('#materiales').fadeOut()
      }

      if (snap.eorin_est_eorin == 'proceso') {
        $('#ordenFormSave').slideDown()
        $('#meOlvideMat').slideDown()
      }

      if(snap.eorin_est_eorin == "asignado" || snap.eorin_est_eorin == "visto") {
        $('#tiempos').fadeOut()
        $('#observacion').fadeOut()
      } 

      $(".form__layout").slideDown()
      $(".tabla-contianer").slideUp()
    })
  }


  var $inicioFecha = $("#inicio-fecha")
  var $FinFecha = $("#fin-fecha")

  $( '.datepicker' ).pickadate({})

  $("#acept-fecha").on("click", handleAceptFecha)
  $("#print").on("click", handleClickReport)
  $("#print-fecha").on("click", handleClickFechaReport)
  $("#closeFecha").on("click", handleClickClose)

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

})()
  