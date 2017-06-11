;(function () {
  'use strict'

  var detail = new Detail($)

  $(".tabla-contianer").load("template/table.php")

  $('#form-btn').on('click', handleShowFrom)
  $('#showListInventarios').on('click', handleListInvetarioShow)
  $('#cerrarListInventario').on('click', handleInventarioCerrar)
  $('.add-inve').on('click', handleAddInvetario)
  $('.cancelar-form-stock').on('click', handleCancelForm)
  $('.save-form').on('click', handleSaveForm)

  function handleShowFrom (e) {
    e.preventDefault()
    $('#form-conatiner').slideDown()
  }

  function handleListInvetarioShow (e) {
    e.preventDefault()
    $('.panel-inventario').slideDown()
  }

  function handleAddInvetario (e) {
    var data = e.currentTarget.dataset
    var input = $(`#cant${data.id}`)
    if (input.val() === '' || input.val() === '0') {
      input.focus()
      alerta('Ingrese la cantidad')
      return false
    }
    detail.add(data, input)
  }

  function handleInventarioCerrar () {
    $('.panel-inventario').slideUp()
  }

  function handleCancelForm (e) {
    e.preventDefault()
    closeForm()
  }

  function handleSaveForm (e) {
    e.preventDefault()
    if (DB.inventarios.length === 0) {
      $('.panel-inventario').slideDown()
      alerta('Debe ingresar los pedidos')
    } else {
      $.ajax({
        type: 'POST',
        url: 'service/guardar.php',
        data: { inventarios: DB.inventarios }
      })
      .done(data => {
        console.log(data)
        closeForm()
      })
    }
  }

  function closeForm () {
    $('#form-conatiner').slideUp()
    var template = `<tr><td colspan="3" class='text-center'>Ingrese los pedidos</td></tr>`
    $('#pedidosStock').html(template)
    DB.inventarios = []
  }

})()
