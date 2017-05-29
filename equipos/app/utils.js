
function building () {
  var inventarios = JSON.parse(localStorage.getItem('inventarios'))

  $("#detalleEquipo").html("")

  for (var i in inventarios) {
    var item = inventarios[i]
    var total = parseFloat(item.total)
    total = total.toFixed(2)

    var template = `<tr>
      <td>${item.cant}</td>
      <td>${item.producto}</td>
      <td>${item.price}</td>
      <td>${total}</td>
      <td class="center">
        <button class="btn__flat red delete-detail"
          data-index=${i}>
          <i class="fa fa-trash-o" aria-hidden="true"></i>
        </button>
      </td>
    </tr>`
    $("#detalleEquipo").append(template)
  }

  $(".delete-detail").on("click", handleDetailDelete)
}

function handleDetailDelete (e) {
  e.preventDefault()
  var inventarios = JSON.parse(localStorage.getItem('inventarios'))
  var index = e.currentTarget.dataset.index
  inventarios.splice(index, 1)
  localStorage.setItem('inventarios', JSON.stringify(inventarios))
  building()
}