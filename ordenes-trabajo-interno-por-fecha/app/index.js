;(function (){
  'use strict'

  var dateMin = $("#DateMin").val()
  var $inicioFecha = $("#inicio-fecha")
  var $FinFecha = $("#fin-fecha")
  
  $( '.datepicker' ).pickadate({})

  $(".tabla-contianer").load("template/table.php")

  $("#cerrar-fecha").on("click", handleCerrarFecha)
  $("#acept-fecha").on("click", handleAceptFecha)
  $("#form-btn").on("click", handleFechaPanel)

  function handleFechaPanel () {
    $("#panel-orden-fecha").slideDown()    
  }

  function handleCerrarFecha (e) {
    e.preventDefault()
    closeFormFecha()
  }

  function handleAceptFecha (e) {
    e.preventDefault()
    if(validarForm()){
      var $empleado = $("#employee-fecha").val()
      $(".tabla-contianer").load(`template/fecha.php?inicio=${$inicioFecha.val()}&fin=${$FinFecha.val()}&empleado=${$empleado}`)
      closeFormFecha()
    }
  }

  function closeFormFecha(){
    $("#panel-orden-fecha").slideUp()
    $inicioFecha.val("")
    $FinFecha.val("")
    $("#employee-fecha").val("")
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