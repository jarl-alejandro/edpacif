  'use strict'

  var $taskInput = $("#taskInput")

  $(".TareasPedidoByEmployee").on("click", taskPedido)
  $(".TareasVistoByEmployee").on("click", taskView)
  $(".task_revisar").on("click", taskCheck)
  $("#taskAcept").on("click", taskAcept)

  $("#verTareas").on("click", taskVer)
  $("#closeTareas").on("click", taskClose)

  function taskVer (e) {
    $("#TaskPanel").slideDown()
  }

  function taskClose () {
    $("#TaskPanel").slideUp()
  }

  function taskPedido (e) {
    var id = e.currentTarget.dataset.id
    $("#id-task-work").val(id)
     $.ajax({
      type: "POST",
      data: { id },
      url: "../tareas/service/pedido.php",
      dataType: "JSON"
    })
    .done(function (snap) {
      console.log(snap)
      renderTemplate(snap)
      document.getElementById('olvidarMat-task').dataset.id = id
      if (snap.etare_est_etare === "aprobado") {
        $("#herramientas-task").slideUp()
        $("#materiales-task").slideUp()
        $("#ordenFormAceptar-task").slideUp()
        $("#tiempos-task").slideDown()
        $("#terminar-task").slideUp()
        $('#olvidarMat-task').slideDown()
      }
      if (snap.etare_est_etare === "fecha") {
        $("#herramientas-task").slideUp()
        $("#materiales-task").slideUp()
        $("#ordenFormAceptar-task").slideUp()
        $("#tiempos-task").slideUp()
        $("#containerDetalleTask").slideDown()
        $("#terminar-task").slideDown()
      }
    })
  }

  function taskView (e) {
    var id = e.currentTarget.dataset.id
    $("#id-task-work").val(id)
    $.ajax({
      type: "POST",
      data: { id },
      url: "../tareas/service/visto.php",
      dataType: "JSON"
    })
    .done(function(snap) {
      console.log(snap)
      renderTemplate(snap)
      alertaInfo("Ha visto la tarea empieza a trabajar")
      $("#TareasAll").load("../task_table.php")
    })
  }

  function renderTemplate (snap) {
    $("#subareaContainerTask").load(`../tareas/template/subtask.php?id=${snap.subare_are_subare}`,
    function () {
      $("#subareaTask").val(snap.subare_cod_subare)
    })

    $("#tareasContainerTask").load(`../tareas/template/detalleTask.php?id=${snap.subare_cod_subare}`, function () {
      $("#detalleTask").val(snap.ltare_cod_ltare)
    })

    $("#equipoTask").val(snap.eequi_cod_eequi)
    $("#areaTask").val(snap.subare_are_subare)
    $("#empleadoTask").val(snap.eempl_ced_eempl)
    $("#fechaTask").val(snap.etare_fet_etare)
    document.querySelector(`input[value="${snap.etare_col_etare}_${snap.etare_pri_etare}_task"]`).checked = true
    $("#FormTareaTrabajar").slideDown()
  }

  function taskCheck (e){
    var id = e.currentTarget.dataset.id
    $("#id-task-work").val(id)

    $("#TaskRevisar").slideDown()
    document.getElementById('taskAcept').dataset.id = id
  }

  function taskAcept (e) {
    var id = e.currentTarget.dataset.id
    $("#id-task-work").val(id)

    if($taskInput.val() === "" ||  /^\s*$/.test($taskInput.val())){
      alerta("Porfavor ingrese su inform")
      $taskInput.focus()
      return false
    }
    $.ajax({
      type: "POST",
      data: { id, informe:$taskInput.val() },
      url: "../tareas/service/revisar.php"
    })
    .done(function (snap){
      console.log(snap)
      if(snap == 2) {
        $("#listTask").load("../tareas.php")
        $("#TaskRevisar").slideUp()
        $taskInput.val("")
        $("#TareasAll").load("../task_table.php")
        alertaInfo("Se ha realiza su tarea con exito")
      }
    })

  }

// Task Tiempos
$("#tiempos-task").on('click', function (e) {
  e.preventDefault()
  $(".panel-tiempos-task").slideDown()
})

$('#panelTiempoAceptar-task').on('click', function (e) {
  e.preventDefault()
  $(".panel-tiempos-task").slideUp()
})

$('.showFormTime-task').on('click', function (e) {
  e.preventDefault()
  $('.form__date-time-task').slideDown()
})

$('#cancelDateTime-task').on('click', function (e) {
  e.preventDefault()
  $('.form__date-time-task').slideUp()
})

// TASK Herramientas
$("#herramientas-task").on('click', function (e) {
  e.preventDefault()
  $(".panel-herramienta-task").slideDown()
})

$("#panelHerramAceptar-task").on('click', function (e) {
  e.preventDefault()
  $(".panel-herramienta-task").slideUp()
})

$("#materiales-task").on('click', function (e) {
  e.preventDefault()
  $(".panel-materiales-task").slideDown()
})

$("#panelMaterAceptar-task").on('click', function (e) {
  e.preventDefault()
  $(".panel-materiales-task").slideUp()
})


$('#Herramientasadd-task').on('click', function (e) {
  e.preventDefault()
  $(".panel-listadoHerramientas-task").slideDown()
})

$('.close--her-task').on('click', function (e) {
  e.preventDefault()
  $(".panel-listadoHerramientas-task").slideUp()
})

$('#materialesAdd-task').on('click', function (e) {
  e.preventDefault()
  $(".panel-inventario-task").slideDown()
})

$('.close--inven-task').on('click', function (e) {
  e.preventDefault()
  $(".panel-inventario-task").slideUp()
})
