;(function () {
  'use strict'

  $(".tabla-contianer").load("template/table.php")

  var $producto = $("#producto")
  var $disponibilidad = $("#disponibilidad")
  var $unidad = $("#unidad")
  var $costo = $("#costo")
  var $bodega = $("#bodega")
  var $max = $("#max")
  var $min = $("#min")
  var $cant = $("#cant")

  $("#cancelar").on("click", canelarForm)

  $("#form-btn").on("click", function () {
    $(".titulo").html("Registrar nueva inventario")
    $("#form-conatiner").slideDown()
  })

  $("#save").on("click", function (e) {
    e.preventDefault()
    getCode()

    if(validarForm()) {
      $.ajax({
        type: "POST",
        url: "service/guardar.php",
        data: $("#inventario").formObject()
      })
      .done(function (response) {
        console.log(response)
        if (parseInt(response) === 2){
          alertaInfo("Se ha guardado con exito")
          $(".tabla-contianer").load("template/table.php")
          limpiar()
        }
        if(parseInt(response) === 3) {
          alerta("El codigo ya existe")
          $codigo.focus()
        }
        if(parseInt(response) === 1) {
          alerta("El producto ya existe")
          $producto.focus()
        }
      })

    }
  })

  function canelarForm (e) {
    e.preventDefault()
    limpiar()
  }

  function limpiar () {
    $("#form-conatiner").slideUp()
    $producto.val("")
    $disponibilidad.val("")
    $unidad.val("")
    $bodega.val("")
    $costo.val("")
    $max.val("")
    $min.val("")
    $cant.val("")
    $("#idCode").val("")
  }

  function validarForm () {
    if ($producto.val() === "" || /^\s*$/.test($producto.val()) ) {
      alerta("Porfavor ingresa el producto")
      $producto.focus()
      return false
    }
    if($disponibilidad.val() === "" || /^\s*$/.test($disponibilidad.val()) ){
      alerta("Porfavor ingresa la disponibilidad")
      $disponibilidad.focus()
      return false
    }
    if($unidad.val() === "" || /^\s*$/.test($unidad.val()) ){
      alerta("Porfavor ingresa la unidad")
      $unidad.focus()
      return false
    }
    if($max.val() === "" || $max.val() === "0"){
      alerta("Porfavor ingresa la cantida maxima")
      $max.focus()
      return false
    }
    if($min.val() === "" || $min.val() === "0"){
      alerta("Porfavor ingresa la cantida minima")
      $min.focus()
      return false
    }
    if(parseInt($min.val()) > parseInt($max.val())){
      alerta("La cantida minima no puede ser mayor que la cantida maxima")
      $min.focus()
      return false
    }
    if($cant.val() === "" || $cant.val() === "0"){
      alerta("Porfavor ingresa la cantida")
      $cant.focus()
      return false
    }
    if(parseInt($cant.val()) > parseInt($max.val())){
      alerta("La cantida que ingreso no puede ser mayor que la cantida maxima")
      $cant.focus()
      return false
    }
    if($costo.val() === "" || /^\s*$/.test($costo.val()) ){
      alerta("Porfavor ingresa el costo")
      $costo.focus()
      return false
    }
    if($bodega.val() === ""){
      alerta("Porfavor ingresa su bodega")
      $bodega.focus()
      return false
    }
    else return true
  }

  function getCode (){
    var palabra = $producto.val()
    var array = palabra.split(" ")

    if(array.length == 1){
      var p1 = array[0].substring(2, 0)
      $("#code").val(p1)
    }
    else {
      if (array[1].length === 2) {
        var p1 = array[0].substring(1, 0)
        var p2 = array[2].substring(1, 0)
      }
      else {
        var p1 = array[0].substring(1, 0)
        var p2 = array[1].substring(1, 0)
      }
      var newCode = `${p1}${p2}`
      $("#code").val(newCode)
    }
  }

})()
