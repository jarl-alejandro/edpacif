;(function (){
	'use strict'

	var DBHERRAMIENTAS = []

	var dateMin = $("#DateMin").val()
  $( '.datepicker' ).pickadate({
    min: dateMin
  })

  var $ordenTrabajo = $('#ordenTrabajo')
  var $empleado = $('#empeado')
  var $fechaEntrega = $('#fechaEntrega')

  $('#entregarHerrmientas').on('click', handleEnetregar)
  $ordenTrabajo.on('change', handleChangeOrden)

  function handleEnetregar (e) {
  	if (validaForm()) {
  		$.ajax({
  			type: 'POST',
  			data: getData(),
  			url: 'service/entregar.php'
  		})
  		.done(snap => {
  			console.log(snap)
  			var id = $ordenTrabajo.val()
  			window.open(`../entrega-herramientas/reporte/herramientas.php?id=${id}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  			location.reload()
  		})
  	}
  }

  function getData () {
  	var herramientasCount = 0
  	var array = Array.prototype.slice.call(document.querySelectorAll('.herramientaItem'))
  	for (var i in array) {
  		var item = array[i]
  		if (item.checked === true) {
  			herramientasCount++
  			var context = {id: item.dataset.id, codigo: item.dataset.codigo, cant: item.dataset.cant}
  			DBHERRAMIENTAS.push(context)
  		}
  	}

  	return {
  		herramientas: DBHERRAMIENTAS,
  		id: $ordenTrabajo.val(),
  		len: array.length,
  		select: herramientasCount
  	}
  }

  function validaForm() {
  	var array = Array.prototype.slice.call(document.querySelectorAll('.herramientaItem'))
  	if ($ordenTrabajo.val() === '') {
  		alerta('Selecione la orden de trabajo')
  		$ordenTrabajo.focus()
  		return false
  	}
  	if ($fechaEntrega.val() === '') {
  		alerta('Ingrese la fecha de entrega')
  		$fechaEntrega.focus()
  		return false
  	}
  	for (var i in array) {
  		var item = array[i]
  		if (item.checked === true) {
  			return true
  		} else {
	  		alerta('Selciona las herramientas')
  			return false
  		}
  	}
  }

  function handleChangeOrden (e) {
  	$('#herrasmietasLista').html("")
  	DBHERRAMIENTAS = []
  	var select = document.getElementById('ordenTrabajo')
  	var selectedIndex = select.selectedIndex
  	var array = Array.prototype.slice.call(select.children)
  	var option = array[selectedIndex]
  	var empleoyee = option.dataset.empleado
 		$empleado.val(empleoyee)

 		$.ajax({
 			type: 'POST',
 			url: 'service/herramientas.php',
 			data: { id: $ordenTrabajo.val() },
 			dataType: 'JSON'
 		})
 		.done(snap => {
 			console.log(snap)
 			for (var i in snap) {
 				var item = snap[i]
 				if (item.doih_esta_doih != 'entregado') {
		 			var template = `<li>
						<div class="checkbox">
					    <label>
					      <input type="checkbox" class='herramientaItem'
					      	data-id='${item.doih_id_doih}' data-cant='${item.doih_cant_doih}'
					      	data-codigo='${item.eherr_cod_eherr}'> ${item.eherr_det_eherr}
					    </label>
					  </div>
		 			</li>`
	 				document.getElementById('herrasmietasLista').innerHTML += template
 				}
	 			//$('#herrasmietasLista').append(template)
 			}
	 		$.material.init()
 		})
  }

})();