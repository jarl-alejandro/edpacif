;(function () {
  'use strict'

  $(".task_visto").on("click", taskVisto)
  $(".reporte").on("click", handleReporte)
  $("#btn-tiempos").on('click', handleTiempo)
  
  var tareasDb = {}
  tareasDb.fin = []
  tareasDb.fin_count = 0

  $("#ordenFormTimeFin").on("click", function (e) {
    if(tareasDb.fin.length === 0){
      alerta("Pofavor ingrese el fin de fecha")
      return false
    }
    var id = $("#id_tarea_revisar").val()
    $.ajax({
      type: "POST",
      url: "service/finFecha.php",
      data: { fin: tareasDb.fin, id }
    })
    .done(function (snap) {
      console.log(snap)
      if(snap == 2){
        $(".tabla-contianer").load("template/table.php")
        alertaInfo("Se ha guardado con exito")
        $("#btn-tiempos").slideUp()
        $("#finish").slideDown()
        $(".panel-tiempos").slideUp()
      }
    })
  })

  function handleTiempo (e) {
    e.preventDefault()
    var id = $("#id_tarea_revisar").val()
    $.ajax({
      type: "POST",
      url: "service/getInicioTiempo.php",
      data: { id },
      dataType: "JSON"
    })
    .done(function (snap) {
      console.log(snap)
      $(".panel-tiempos").slideDown()
      var inicio = { fecha: snap.fein_fet_fein, hora: snap.fein_hor_fein }
      var template = `<tr>
        <td>${inicio.fecha}</td>
        <td>${inicio.hora}</td>`
      $(`#tableinicio`).append(template)

    })
  }

  $("#saveDateTime").on("click", function (e) {
    var type = e.currentTarget.dataset.type
    var hora = $("#horaDateTime").val()
    var fecha = $("#fechaDateTime").val()

    if(validDateTime (hora, fecha)) {
      var object = { fecha, hora }
      if (tareasDb.fin_count == 0) {
        tareasDb.fin.push(object)
        buildingDateTime(type)
      $(".form__date-time").slideUp()
      }
      else alerta('Ya tiene fecha y hora de inicio')
      tareasDb.fin_count++
    }

  })

  function validDateTime (hora, fecha) {
    if(fecha == ""){
      alerta("Porfavor ingrese la fecha")
      $("#fechaDateTime").focus()
      return false
    }
    if(hora == "" || hora == "00:00"){
      alerta("Porfavor ingrese la hora")
      $("#horaDateTime").focus()
      return false
    }
    else return true
  }

  function buildingDateTime (type) {
    $(`#table${type}`).html("")
    var dateTime = []

    dateTime = tareasDb.fin

    for (var i in dateTime) {
      var item = dateTime[i]
      var template = `<tr>
        <td>${item.fecha}</td>
        <td>${item.hora}</td>`
      $(`#table${type}`).append(template)
    }
  }

  $("#panelTiempoAceptar").on("click", function (e) {
    $(".panel-tiempos").slideUp()
  })

  $(".showFormTime").on("click", function (e) {
    var type = e.currentTarget.dataset.type
    document.getElementById("saveDateTime").dataset.type = type
    $(".form__date-time").slideDown()
  })

  $("#cancelDateTime").on("click", function () {
    $("#horaDateTime").val("")
    $("#fechaDateTime").val("")
    $(".form__date-time").slideUp()    
  })

  function taskVisto (e) {
    var id = e.currentTarget.dataset.id
    $("#id_tarea_revisar").val(id)
    $.ajax({
      type: "POST",
      data: { id },
      url: "service/tarea.php",
      dataType: "JSON"
    })
    .done(function (snap) {
      console.log(snap)
      var prioridad = `${snap.etare_col_etare}_${snap.etare_pri_etare}`
      var a = document.querySelector(`input[value="${prioridad}"]`).checked = true
      var area = snap.subare_are_subare
      $("#area").val(area)
      $("#modalTarea").slideUp()

      $("#subareaContainer").load(`template/subarea.php?id=${area}`, function (){
        $("#subarea").val(snap.subare_cod_subare)
      })

       $("#tareasContainer").load(`../tareas/template/tareas.php?id=${snap.subare_cod_subare}`, function () {
        $("#detalle").val(snap.ltare_cod_ltare)
      })

      $("#empleado").val(snap.etare_emp_etare)
      $("#equipo").val(snap.etare_equ_etare)
      $("#fecha").val(snap.etare_fet_etare)
      $("#detalle").val(snap.etare_det_etare)

      $("#equipo").val(snap.eequi_cod_eequi)      
      $("#area").val(snap.subare_are_subare)
      $("#empleado").val(snap.eempl_ced_eempl)
      $("#fecha").val(snap.etare_fet_etare)
      document.querySelector(`input[value="${snap.etare_col_etare}_${snap.etare_pri_etare}"]`).checked = true

      $("#informe").val(snap.etare_inf_etare)
      $("#task_id").val(snap.etare_cod_etare)

      if (snap.etare_est_etare === "revisar" || snap.etare_est_etare === "fechaFin") {
        $(".container-materiales").slideUp()
        $("#btn-tiempos").slideDown()
      }
      else {
        $("#btn-tiempos").slideUp()
      }

      if (snap.etare_est_etare === "fechaFin") {
        $("#btn-tiempos").slideUp()
        $("#finish").slideDown()
      }
      
      $("#save").slideUp()
      $("#finish").slideDown()
      $(".informLayout").slideDown()
      $("#tableLayout").slideUp()
      $(".form__layout").slideDown()
    })
  }

  function handleReporte(e){
    var id = e.currentTarget.dataset.id
    window.open (`reporte/individual.php?id=${id}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
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
