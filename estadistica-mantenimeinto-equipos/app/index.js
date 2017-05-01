;(function (){
  'use strict'

  var $inicioFecha = $("#inicio-fecha")
  var $FinFecha = $("#fin-fecha")
  var $equipo = $("#equipo-select")

  $( '.datepicker' ).pickadate({})

  $("#form-btn").on("click", handleShowPanel)
  $("#cerrar-fecha").on("click", handleCerrarFecha)
  $("#acept-fecha").on("click", handleAceptFecha)

  function handleShowPanel (e) {
    e.preventDefault()
    $("#panel-orden-fecha").slideDown()
  }

    function handleCerrarFecha (e) {
    e.preventDefault()
    closeFormFecha()
  }

  function handleAceptFecha (e) {
    e.preventDefault()
    if(validarForm()){
      $("#estadistica-container").load(`estadistica.php?equipo=${$equipo.val()}&inicio=${$inicioFecha.val()}&fin=${$FinFecha.val()}`)
      $("#estadistica-form").slideUp()
      $("#estadistica-container").slideDown()
      closeFormFecha()
    }
  }

  function closeFormFecha(){
    $inicioFecha.val("")
    $FinFecha.val("")
    $equipo.val("")
  }

  function validarForm () {
    if($equipo.val() == ""){
      alerta("Ingrese el equipo")
      $equipo.focus()
      return false
    }
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