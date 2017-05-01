;(function () {
  'use strict'

  $(".editar").on("click", handleEdit)
  $(".eliminar").on("click", handleDelete)
  $("#print").on("click", handlePrint)
  $(".reporte").on("click", handleReporte)

  $('.darBaja').on('click', handelDarBaja)

  function handleEdit (e) {
    e.preventDefault()
    var id = e.currentTarget.dataset.id

    $.ajax({
      type: "GET",
      data: { id },
      url: "service/equipos.php",
      dataType: "JSON"
    })
    .done(function (snap) {
      console.log(snap)
      if (snap.status == 3) {
        alerta("No puede editar este recurso porque esta siendo requerido")
        return false
      }
      $(".titulo").html("Editar equipo")
      $("#form-quipos").slideDown()
      templateEquipo(snap)
    })
  }

  function handleDelete (e) {
    e.preventDefault()
    var id = e.currentTarget.dataset.id

    $.ajax({
      type: "POST",
      data: { id },
      url: "service/eliminar.php"
    })
    .done(function (snap) {
      console.log(snap)
      if(snap == 2) {
        $(".cards-container").load("template/table.php")
        alertaInfo("Se ha eliminado con exito")
      }
      if (snap == 3) {
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


  function templateEquipo (snap) {
		console.log(snap)
    var inventarios = []
		$("#area").val(snap.equipos.subare_are_subare)
    if(snap.equipos.eequi_esq_eequi == true) {
      $("#equipoModal").fadeOut()
      $("#vehiculoModal").fadeIn()
    }
    if(snap.equipos.eequi_esq_eequi == false) {
      $("#equipoModal").fadeIn()
      $("#vehiculoModal").fadeOut()
    }
    
    document.getElementById('esCheckedVehiculo').checked = snap.equipos.eequi_esq_eequi

		$("#containerSubArea").load(`template/subarea.php?id=${snap.equipos.subare_are_subare}`, 
		function () {
			// $subarea = $("#subarea")
    	$("#subarea").val(snap.equipos.subare_cod_subare)
      localStorage.setItem('flagSubarea', true)
      localStorage.setItem('area', snap.equipos.subare_are_subare)
      localStorage.setItem('subarea', snap.equipos.subare_cod_subare)
		})

    $("#bajaEquipoBtn").fadeIn()

    $("#horas").val(snap.equipos.eequi_horas_eequi)
    $("#codigo").val(snap.equipos.eequi_cod_eequi)
    $("#idEquipo").val(snap.equipos.eequi_cod_eequi)
    $("#nombreEquipo").val(snap.equipos.eequi_det_eequi)
    $("#newGeneral").val(snap.equipos.subare_cod_subare)
    $("#imagen_name").val(snap.equipos.eequi_ima_eequi)
    $("#proveedor").val(snap.equipos.eequi_prov_eequi)
    $("#kilo").val(snap.equipos.eequi_kil_eequi)
    $("#fechaCompra").val(snap.equipos.eequi_fcom_eequi)

    $("#fechaCompra").attr('disabled', true)

    $("#inputModel").val(snap.informacion.einfe_mod_infe)
    $("#inputMarca").val(snap.informacion.einfe_mar_infe)
    $("#inputYer").val(snap.informacion.einfe_year_infe)
    $("#inputNumeriFacu").val(snap.informacion.einfe_nfac_infe)
    $("#inputValor").val(snap.informacion.einfe_val_infe)
    $("#inputSerie").val(snap.informacion.einfe_ser_infe)
    $("#inputPlaca").val(snap.informacion.einfe_pla_infe)
    $("#inputSerieChasis").val(snap.informacion.einfe_cha_infe)
    $("#inputSerieMotor").val(snap.informacion.einfe_mot_infe)

    $(".imagen__equipo").attr("src", `../media/equipos/${snap.equipos.eequi_ima_eequi}`)

    for (var i in snap.detalles) {
      var item = snap.detalles[i]
      var contex = {
        id: item.einven_cod_einven,
        producto: item.einven_pro_einven,
        price: item.einven_cos_einven,
        total: item.edequ_tot_edequ,
        cant: item.edequ_cant_edequ,
      }
      inventarios.push(contex)
      localStorage.setItem('inventarios', JSON.stringify(inventarios))
      localStorage.setItem('state', true)
      building()
    }
  }

  function handelDarBaja (e) {
    var id = e.currentTarget.dataset.id
    $("#idEquipo").val(id)
    $('.panel-baja-equipo').slideDown()
  }

})()
