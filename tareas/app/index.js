;(function () {
  'use strict'

	openedMantenimiento()

  var $empleado = $("#empleado")
  var $equipo = $("#equipo")
  var $fecha = $("#fecha")
  var $detalle = $("#detalle")
  var $subarea = $("#subarea");

  var dateMin = $("#DateMin").val()
  $( '.datepicker' ).pickadate({
    min: dateMin
  })

  $(".tabla-contianer").load("template/table.php")
  $("#save").on("click", handleSave)
  $("#form-btn").on("click", handleForm)
  $("#finish").on("click", handleFinish)
  $("#area").change(handleAreaFilter)
  $subarea.on("change", handleFilterTask)
  $("#modalTarea").on("click", handleModalTarea)

  $detalle.on("change", function () {
    document.getElementById("tareaFormChecked").checked = false
  })

  $("#modalTareaForm #save").on("click", function (e) { 
    e.preventDefault()
    $("#modalTareaForm").slideUp()    
  })

  function handleModalTarea (e) {
    e.preventDefault()
    document.getElementById("tareaFormChecked").checked = true    
    $("#modalTareaForm").slideDown()
  }

  function handleAreaFilter (e) {
    e.preventDefault()
    var area = $("#area").val()
    $(".ocultar").fadeIn()

    $("#subareaContainer").load(`template/subarea.php?id=${area}`, function () {
      $subarea = $("#subarea")
      $subarea.on("change", handleFilterTask)
      var template = `<select id="detalle" class="form-control" name="detalle">
          <option value="">Selecione primero el area</option>
        </select>`
      $("#tareasContainer").html(template)
      $(".ocultar").fadeOut()
    }) 
  }

  function handleFilterTask (e) {
    e.preventDefault()
    var id = $subarea.val()
    $(".ocultar").fadeIn()

    $("#tareasContainer").load(`template/tareas.php?id=${id}`, function () {
      $detalle = $("#detalle")
      $(".ocultar").fadeOut()
    })

    var subarea = $("#subarea").val()
    $.ajax({
      type: "GET",
      url: "service/aguaje.php",
      data: { id: subarea },
      dataType: "JSON"
    })
    .done(function (snap) {
     // orden.aguajeDepende = snap.earege_agu_earege
      console.log(snap)
    })

    $("#equipoContainer").load(`template/equipos.php?subarea=${subarea}`, function () {
      $equipo = $("#equipo")
    })
  } 

  function handleForm (e) {
    e.preventDefault()
    $(".container-materiales").fadeOut()
    $("#tableLayout").slideUp()
    $(".form__layout").slideDown()
  }

  function handleSave (e) {
    e.preventDefault()
    if(validar()){
      $.ajax({
        type: "POST",
        url: "service/guarda.php",
        data: getData()
      })
      .done(function (snap) {
        console.log(snap)
        if(snap == 2){
					location.href = location.pathname
          $(".tabla-contianer").load("template/table.php")
          $("#listTask").load("../tareas.php")
          handlecancelar()
        }
      })
    }
  }

  function handleFinish () {
    if (true) {
      $.ajax({
        type: "POST",
        data: { id:$("#task_id").val() },
        url: "service/terminar.php"
      })
      .done(function (snap) {
        console.log(snap)
        if(snap == 2) {
          $(".tabla-contianer").load("template/table.php")
          $("#listTask").load("../tareas.php")
          handlecancelar()
        }
      })
    }
  }

  function handlecancelar () {
    $(".container-materiales").fadeOut()
    location.reload()
  }

  function validar () {
    var checkTask = document.getElementById("tareaFormChecked").checked

    if($empleado.val() === ""){
      alerta("Porfavor ingrese el empleado")
      $empleado.focus()
      return false
    }
    if($equipo.val() === ""){
      alerta("Porfavor ingrese el equipo")
      $equipo.focus()
      return false
    }
    if($fecha.val() === ""){
      alerta("Porfavor ingrese la fecha")
      $fecha.focus()
      return false
    }
    if($subarea.val() === ""){
      alerta("Porfavor ingrese la subarea")
      $subarea.focus()
      return false
    }
    if(checkTask === false){
      if($detalle.val() === "" || /^\s*$/.test($detalle.val())){
        alerta("Porfavor ingrese el detalle")
        $detalle.focus()
        return false
      }
    }
    if(checkTask === true) {
      if ( $("#modalTareaForm #general").val() === "" ) {
        alerta("Porfavor ingrese la sub area")
        $("#modalTareaForm #general").focus()
        return false
      }
      if ( $("#modalTareaForm #detalle").val() === "" ) {
        alerta("Porfavor ingrese el detalle")
        $("#modalTareaForm #detalle").focus()
        return false
      }
    }
    if($('input[name="prioridad"]:checked').val() == null) {
      alerta("Porfavor ingrese la prioridad de la tareas")
      return false
    }
    else return true
  }

  function getData() {
    return {
      detalle: $detalle.val(),
      empleado: $empleado.val(),
      equipo: $equipo.val(),
      fecha: $fecha.val(),
      prioridad: $('input[name="prioridad"]:checked').val(),
      subarea: $subarea.val(),
      tareaSub: $("#modalTareaForm #general").val(),
      tareaDet: $("#modalTareaForm #detalle_name").val()
    }
  }

	function openedMantenimiento () {
		var id = $("#open-id").val()
		var is = $("#open-is")

		if(is.val() == 1) {
			$("#tableLayout").slideUp()
			$(".form__layout").slideDown()
			$("#equipo").val(id)
		}
	}

   $("#equipo").on("change", function () {
    var equipo = document.getElementById('equipo')
    $.ajax({
      type: "POST",
      url: "service/valid.php",
      data: { equipo: equipo.value }
    })
    .done(function (snap) {
      console.log(snap)
      if(snap > 0) {
        equipo.value = ""
        alerta("El equipo tiene una tarea pendiente")
      }
    })
  })

})()
