var DB = {}
DB.inventarios = []

var Detail = function Detail (jQuery) {
  this.$ = jQuery
}

Detail.prototype = {

  add: function add (invetario, input) {
    if (this.validInventario(invetario.id, input.val()) ) {
      var contex = {
        id: invetario.id,
        producto: invetario.producto,
        cant: input.val(),
      }
      DB.inventarios.push(contex)
      this.buildingInventario()
      this.$('.panel-inventario').slideUp()
      this.$('.cant-input').val('')
    }
  },

  validInventario: function validInventario (id, cant) {
    var flag = false

    if(DB.inventarios.length === 0){
      return true
    }

    for (var i in DB.inventarios) {
      var item = DB.inventarios[i]

      if(item.id === id) {
        item.cant = parseInt(item.cant) + parseInt(cant)
        this.buildingInventario()
        alertaInfo('Se ha actualizado con exito')
        this.$('.panel-inventario').slideUp()
        this.$('.cant-input').val('')
        return false
      }
      else flag = true
    }

    return flag
  },

  buildingInventario: function buildingInventario () {
    var index = 0
    this.$('#pedidosStock').html('')

    for (var i in DB.inventarios) {
      var item = DB.inventarios[i]
      index++

      var template = `<tr>
        <td>${index}</td>
        <td>${item.cant}</td>
        <td>${item.producto}</td>`
      this.$('#pedidosStock').append(template)
    }
  }

}
