;(function (){
	'use strict'

	var DBHERRAMIENTASTask = []

	var dateMin = $("#DateMin").val()
  $( '.datepicker' ).pickadate({
    min: dateMin
  })

  var $ordenTrabajoTask = $('#ordenTrabajoTask')
  var $empleadoTask = $('#empeadoTask')
  var $fechaEntregaTask = $('#fechaEntregaTask')

  $('#entregarHerrmientasTask').on('click', handleEnetregar)
  $ordenTrabajoTask.on('change', handleChangeOrden)

  function handleEnetregar (e) {
  	if (validaForm()) {
  		$.ajax({
  			type: 'POST',
  			data: getData(),
  			url: 'service/entregarTask.php'
  		})
  		.done(snap => {
  			console.log(snap)
  			var id = $ordenTrabajoTask.val()
  			window.open(`../entrega-herramientas/reporte/herramientasTask.php?id=${id}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  			location.reload()
  		})
  	}
  }

  function getData () {
  	var herramientasCountTask = 0
  	var arrayTask = Array.prototype.slice.call(document.querySelectorAll('.herramientaItemTask'))
  	for (var i in arrayTask) {
  		var item = arrayTask[i]
  		if (item.checked === true) {
  			herramientasCountTask++
  			var context = {id: item.dataset.id, codigo: item.dataset.codigo, cant: item.dataset.cant}
  			DBHERRAMIENTASTask.push(context)
  		}
  	}

  	return {
  		herramientasTask: DBHERRAMIENTASTask,
  		idTask: $ordenTrabajoTask.val(),
  		lenTask: arrayTask.length,
  		selectTask: herramientasCountTask
  	}
  }

  function validaForm() {
  	var array = Array.prototype.slice.call(document.querySelectorAll('.herramientaItemTask'))
  	if ($ordenTrabajoTask.val() === '') {
  		alerta('Selecione la orden de trabajo')
  		$ordenTrabajoTask.focus()
  		return false
  	}
  	if ($fechaEntregaTask.val() === '') {
  		alerta('Ingrese la fecha de entrega')
  		$fechaEntregaTask.focus()
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
  	$('#herrasmietasListaTask').html("")
  	DBHERRAMIENTASTask = []
  	var select = document.getElementById('ordenTrabajoTask')
  	var selectedIndex = select.selectedIndex
  	var array = Array.prototype.slice.call(select.children)
  	var option = array[selectedIndex]
  	var empleoyee = option.dataset.empleado
 		$empleadoTask.val(empleoyee)

 		$.ajax({
 			type: 'POST',
 			url: 'service/herramientasTask.php',
 			data: { id: $ordenTrabajoTask.val() },
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
					      <input type="checkbox" class='herramientaItemTask'
					      	data-id='${item.herta_id_herta}' data-cant='${item.herta_cant_herta}'
					      	data-codigo='${item.eherr_cod_eherr}'> ${item.eherr_det_eherr}
					    </label>
					  </div>
		 			</li>`
	 				document.getElementById('herrasmietasListaTask').innerHTML += template
 				}
	 			//$('#herrasmietasLista').append(template)
 			}
	 		$.material.init()
 		})
  }

})();