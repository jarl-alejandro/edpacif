;(function () {
  'use strict'

  $("#menuToggle").on("click", function () {
    $(this).toggleClass("Header-transform")
  })

  $(".media-list-contacts").load("../contacts_employ.php")
  $("#listTask").load("../tareas.php")
  $("#TareasAll").load("../task_table.php")

  loadEquipos()

  function loadEquipos () {
    $.ajax({
      type: "POST",
      url: "../service/equipo_km.php",
      dataType: "JSON"
    })
    .done(function (snap) {
      console.log(snap)
      if(snap.equipos.length > 0){
        templateEquipos(snap.equipos)
      }
    })
  }

  function templateEquipos (equipos) {
    var ulTag = $("<ol class='equipos__alert'>")
    $("body").append(ulTag)
    var title = `<h5 class="equipos__alert--title">Equipos necesitan mantenimiento</h5>`
    ulTag.append(title)

    equipos.map(function (e) {
			// eequi_cod_eequi
      var template = `<li>${e.eequi_det_eequi} Debe hacer cambio de aceite de motor
				<a class="btn btn-primary btn-raised" href="../tareas?id=${e.eequi_cod_eequi}&open=1">Aceptar</a></li>`
      ulTag.append(template)
    })
    var buttonTag =  $('<button class="btn btn-raised btn-danger" id="cancelarEQUI">Cerrar</button>')
     ulTag.append(buttonTag)
    $("#cancelarEQUI").on("click", function () {
      $(".equipos__alert").slideUp()
    })
  }
 
})()