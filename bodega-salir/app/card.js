;(function () {
  'use strict'

  $(".editar").on("click", handleEdit)
  $(".eliminar").on("click", handleDelete)

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
    })
  }

  function templateEquipo (snap) {
    var inventarios = []
    $("#horas").val(snap.equipos.eequi_horas_eequi)
    $("#codigo").val(snap.equipos.eequi_cod_eequi)
    $("#idEquipo").val(snap.equipos.eequi_cod_eequi)
    $("#detalle").val(snap.equipos.eequi_det_eequi)
    $("#subarea").val(snap.equipos.eequi_sare_eequi)
    $("#imagen_name").val(snap.equipos.eequi_ima_eequi)
    
    $("#proveedor").val(snap.equipos.eequi_prov_eequi)
    $("#kilo").val(snap.equipos.eequi_kil_eequi)

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

})()
