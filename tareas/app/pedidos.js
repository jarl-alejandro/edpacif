;(function () {
  'use strict'

  var taskDBLoca = {}
  taskDBLoca.herramientas = []
  taskDBLoca.inventarios = []

  $('#aprobarMat').on('click', handleAprobar)

  $('#btn-mater').on('click', handleMateriales)
  $('#btn-herram').on('click', handlHerramientas)
  $('#panelHerramAceptar').on('click', handleHerramientasClose)
  $('#panelMaterAceptar').on('click', handleMaterialesClose)
  $('.task-pedido').on('click', handlePedidoView)

  $('#Herramientasadd').on('click', handleListHerramientas)
  $('.close--herr').on('click', handleListHerramientasClose)

  $('#materialesAdd').on('click', handleListInventarios)
  $('.close--inven').on('click', handleListInventariosClose)

  $("#cancelar").on("click", handlecancelar)

  function handleAprobar (e) {
    e.preventDefault()
    var id = e.currentTarget.dataset.id
    $.ajax({
      type: "POST",
      url: "service/aprobar.php",
      data: { id, herramientas: taskDBLoca.herramientas, materiales: taskDBLoca.inventarios }
    })
    .done(function (snap) {
      console.log(snap)
      if (snap == 2) {
        handlecancelar()
        alertaInfo("Se ha aprobado con exito")
        location.reload()
      }
      else alerta("Tuvimos problemas intente nuevamente")
    })
  }

  function handlecancelar () {
    $("#modalTarea").slideDown()
    $("#subarea").val("")
    $("#area").val("")
    $("#empleado").val("")
    $("#equipo").val("")
    $("#fecha").val("")
    $("#detalle").val("")
    $("#informe").val("")
    $("#task_id").val("")
    $(".informLayout").slideUp()
    $("#tableLayout").slideDown()
    $(".form__layout").slideUp()
    $("#save").slideDown()
    $("#finish").slideUp()
    $('#aprobarMat').slideUp()
    $('.container-materiales').slideUp()
    taskDBLoca.herramientas = []
    taskDBLoca.inventarios = []
  }

  function handleListHerramientas (e) {
    e.preventDefault()
    $('.panel-listadoHerramientas').slideDown()
  }

  function handleListHerramientasClose (e) {
    e.preventDefault()
    $('.panel-listadoHerramientas').slideUp()
  }

  function handleListInventarios (e) {
    e.preventDefault()
    $('.panel-inventario').slideDown()
  }

  function handleListInventariosClose (e) {
    e.preventDefault()
    $('.panel-inventario').slideUp()
  }

  function handleMateriales (e) {
    e.preventDefault()
    $('.panel-materiales').slideDown()
  }

  function handleMaterialesClose (e) {
    e.preventDefault()
    $('.panel-materiales').slideUp()
  }

  function handlHerramientas (e) {
    e.preventDefault()
    $('.panel-herramienta').slideDown()
  }

  function handleHerramientasClose (e) {
    e.preventDefault()
    $('.panel-herramienta').slideUp()
  }

  function handlePedidoView (e) {
    var id = e.currentTarget.dataset.id

    $.ajax({
      url: 'service/task-pedidos.php',
      data: { id },
      type: 'POST',
      dataType: 'JSON'
    })
    .done(function (snap) {
      console.log(snap)
      document.getElementById('aprobarMat').dataset.id = snap.tarea.etare_cod_etare
      renderTemplateMateriales(snap.materiales)
      renderTemplateHerramientas(snap.herramientas)

      var prioridad = `${snap.tarea.etare_col_etare}_${snap.tarea.etare_pri_etare}`
      var a = document.querySelector(`input[value="${prioridad}"]`).checked = true
      var area = snap.tarea.subare_are_subare
      $("#area").val(area)
      $("#modalTarea").slideUp()

      $("#subareaContainer").load(`template/subarea.php?id=${area}`, function (){
        $("#subarea").val(snap.tarea.subare_cod_subare)
      })
      $("#tareasContainer").load(`../tareas/template/tareas.php?id=${snap.tarea.subare_cod_subare}`, function () {
        $("#detalle").val(snap.tarea.ltare_cod_ltare)
      })

      $("#empleado").val(snap.tarea.etare_emp_etare)
      $("#equipo").val(snap.tarea.etare_equ_etare)
      $("#fecha").val(snap.tarea.etare_fet_etare)
      $("#detalle").val(snap.tarea.etare_det_etare)
      $("#equipo").val(snap.tarea.eequi_cod_eequi)      
      $("#area").val(snap.tarea.subare_are_subare)
      $("#empleado").val(snap.tarea.eempl_ced_eempl)
      $("#fecha").val(snap.tarea.etare_fet_etare)
      $("#task_id").val(snap.tarea.etare_cod_etare)
      document.querySelector(`input[value="${snap.tarea.etare_col_etare}_${snap.tarea.etare_pri_etare}"]`).checked = true
      
      $("#save").slideUp()
      $("#finish").slideUp()
      $("#tableLayout").slideUp()
      $('#aprobarMat').slideDown()
      $('.container-materiales').slideDown()
      $(".form__layout").slideDown()
    })
  }

  function renderTemplateMateriales (materiales) {
    for (var i in materiales) {
      var data = materiales[i]

      var total = parseInt(data.repta_cant_repta) * parseFloat(data.repta_pric_repta)
      var contex = { id: data.repta_herr_repta, producto: data.einven_pro_einven, 
          price: data.repta_pric_repta, total, cant: data.repta_cant_repta
      }
      taskDBLoca.herramientas.push(contex)
    }
    buildingHerramientas()
  }

  function renderTemplateHerramientas (herramientas) {
    for (var i in herramientas) {
      var data = herramientas[i]
      var total = parseInt(data.herta_cant_herta) * parseFloat(data.herta_pric_herta)
      var contex = {
        id: data.herta_herr_herta, producto: data.eherr_det_eherr, price: data.herta_pric_herta,
        total, cant: data.herta_cant_herta,
      }
      taskDBLoca.inventarios.push(contex)
    }
    buildingInventario()
  }

  //  Ingresar Herramientas de las tareas
  $(".add-herr").on("click", function (e) {
    var id = e.currentTarget.dataset.id
    var producto = e.currentTarget.dataset.producto
    var price = e.currentTarget.dataset.price
    addHerramientas(id, producto, price)
  })

  function addHerramientas (id, producto, price) {
    var cant = $(`#cant${id}`)

    if(cant.val() === "" || cant.val() == 0){
      alerta("Porfavor ingrese la cantidad")
      cant.focus()
      return false
    }
    if (validHerramientas(id, cant.val()) ) {
      var total = parseFloat(price) * parseInt(cant.val())
      var contex = {
        id: id, producto: producto,price: price,
        total: total, cant: cant.val(),
      }
      taskDBLoca.herramientas.push(contex)
      buildingHerramientas()
      $(".panel-listadoHerramientas").slideUp()    
      $(".cant-input").val("")
    }
  }

  function validHerramientas (id, cant) {
    var flag = false
    var herra = taskDBLoca.herramientas

    if(herra === null || herra.length === 0){
      return true
    }
    for (var i in herra) {
      var item = herra[i]

      if(item.id === id) {
        item.cant = parseInt(item.cant) + parseInt(cant)
        item.total = parseInt(item.cant) * parseFloat(item.price)
        buildingHerramientas()
        alertaInfo("Se ha actualizado con exito")
        $(".panel-listadoHerramientas").slideUp()
        $(".cant-input").val("")
        return false
      }
      else flag = true
    }

    return flag
  }

  function buildingHerramientas () {
    var herramientas = taskDBLoca.herramientas
    $("#tableHerramientas").html("")

    for (var i in herramientas) {
      var item = herramientas[i]
      var total = parseInt(item.cant) * parseFloat(item.price)
      total = total.toFixed(2)
      var template = `<tr>
        <td>${item.cant}</td>
        <td>${item.producto}</td>
        <td>${item.price}</td>
        <td>${total}</td>
        <td><button data-index="${i}" class="btn btn-raised btn-danger ripple-effect eliminar-herr-task">
          Eliminar</button>
        </td>`
      $("#tableHerramientas").append(template)
    }
    $('.eliminar-herr-task').on('click', function (e) {
      e.preventDefault()
      var index = e.currentTarget.dataset.index
      taskDBLoca.herramientas.splice(index, 1)
      buildingHerramientas()
    })
  }

  //  Ingresar Materiales de las tareas
  $(".add-inve").on("click", function (e) {
    var id = e.currentTarget.dataset.id
    var producto = e.currentTarget.dataset.producto
    var price = e.currentTarget.dataset.price
    addInventario(id, producto, price)
  })

  function addInventario (id, producto, price) { 
    var cant = $(`#cant${id}`)

    if(cant.val() === "" || cant.val() == 0){
      alerta("Porfavor ingrese la cantidad")
      cant.focus()
      return false
    }
    if (validInventario(id, cant.val()) ) {
      var total = parseFloat(price) * parseInt(cant.val())
      var contex = {
        id: id, producto: producto, price: price, total: total, cant: cant.val(),
      }
      taskDBLoca.inventarios.push(contex)
      buildingInventario()
      $(".panel-inventario").slideUp()
      $(".cant-input").val("")
    }

  }

  function validInventario (id, cant) {
    var flag = false
    var invent = taskDBLoca.inventarios

    if(invent === null || invent.length === 0){
      return true
    }
    for (var i in invent) {
      var item = invent[i]

      if(item.id === id) {
        item.cant = parseInt(item.cant) + parseInt(cant)
        item.total = parseInt(item.cant) * parseFloat(item.price)
        buildingInventario()
        alertaInfo("Se ha actualizado con exito")
        $(".panel-inventario").slideUp()
        $(".cant-input").val("")
        return false
      }
      else flag = true
    }

    return flag
  }

  function buildingInventario() {
    var inventarios = taskDBLoca.inventarios
    $("#tablemateriales").html("")

    for (var i in inventarios) {
      var item = inventarios[i]
      var template = `<tr>
        <td>${item.cant}</td>
        <td>${item.producto}</td>
        <td>${item.price}</td>
        <td>${item.total}</td>
        <td><button data-index="${i}" class="btn btn-raised btn-danger ripple-effect eliminar-invent-task">
          Eliminar</button>
        </td>`
      $("#tablemateriales").append(template)
    }
    $('.eliminar-invent-task').on('click', function (e){
      e.preventDefault()
      var index = e.currentTarget.dataset.index
      taskDBLoca.inventarios.splice(index, 1)
      buildingInventario()
    })
  }

  // Guardar los materiales y herramientas

  $('#ordenFormAceptar').on('click', function (e) {
    e.preventDefault()
    if(validarOrden() === true) {
      //var id = $("#id-task-work").val()
      $.ajax({
        type: "POST",
        url: "../tareas/service/guardarHerramientasTak.php",
        data: { repuestos: taskDBLoca.inventarios, herramientas: taskDBLoca.herramientas, id }
      })
      .done(function (snap) {
        console.log(snap)
        if(snap == 2) {
          closeFomrTask()
          $(".tabla-contianer").load("template/table.php")
          alertaInfo("Se ha realizado con exito")
          location.reload()
        }
      })
    }
  })

  function validarOrdenTask () {
    if (taskDBLoca.inventarios.length === 0 && taskDBLoca.herramientas.length === 0) {
      alerta('Debe ingresar materiales o herrramientas')
      return false
    }
    else return true
  }
  
  // $("#cancelarTask").on("click", cancelarTask)

  // function cancelarTask (e) {
  //   e.preventDefault()
  //   closeFomrTask()
  // }

  // function closeFomrTask () {
  //   $("#TareasAll").load("../task_table.php")
  //   $("#FormTareaTrabajar").slideUp()
  //   taskDBLoca.inventarios = []
  //   taskDBLoca.herramientas = []
  //   $("#tablemateriales-task").html("")
  //   $("#tableHerramientasTask").html("")
  // }

})()