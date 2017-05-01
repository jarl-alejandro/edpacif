<?php session_start();
include "./conexion/conexion.php";
date_default_timezone_set('America/Guayaquil');

$id = $_SESSION["3188768e18a5c00164bbe22d1749a30e4626a114"];
$hoy = date("Y/m/d");
date_default_timezone_set('America/Guayaquil');
$fecha = date("d/m/Y");

$tareas = $pdo->query("SELECT * FROM v_tarea 
      WHERE etare_fet_etare='$hoy' AND eempl_ced_eempl='$id' AND
      (etare_est_etare='asginado' OR etare_est_etare='visto' OR etare_est_etare='pedido' OR etare_est_etare='aprobado' OR etare_est_etare='fecha')
      ORDER BY etare_pri_etare ASC");

if($tareas->rowCount() == 0){
  echo '<div class="panel-body">
    <ul class="list-unstyled mb20">
      <li class="text-center"><a href="#">No hay tareas</a></li>
    </ul>
  </div>';
}
else if($tareas->rowCount() == 1){
  $rows = $tareas->fetch();
?>
<div class="panel-body">
  <ul class="list-unstyled mb20">
    <li style="background:<?= $rows['etare_col_etare']; ?>" class="pointer task">
      <a class="text-white" href="#"><?= $rows["ltare_det_ltare"]; ?></a>
      <small class="text-white"><?= $rows["etare_fet_etare"]; ?></small>
      <div class="space-around">
      <?php if($rows["etare_est_etare"] == 'pedido'){ ?>
        <button class="btn btn-raised btn-warning center button__little TareasPedidoByEmployee"
              data-id="<?= $rows["etare_cod_etare"]; ?>">
          <i class="fa fa-check" aria-hidden="true"></i>
        </button>
      <?php } else if($rows["etare_est_etare"] == 'aprobado'){ ?>
         <button class="btn btn-raised btn-primary center button__little TareasPedidoByEmployee"
              data-id="<?= $rows["etare_cod_etare"]; ?>">
          <i class="fa fa-flag-checkered" aria-hidden="true"></i>
        </button>
      <?php } else if($rows["etare_est_etare"] == 'fecha'){ ?>
         <button class="btn btn-raised btn-primary center button__little TareasPedidoByEmployee"
              data-id="<?= $rows["etare_cod_etare"]; ?>">
          <i class="fa fa-flag-checkered" aria-hidden="true"></i>
        </button>
      <?php } else{ ?>
        <button class="btn btn-raised btn-warning center button__little TareasVistoByEmployee"
              data-id="<?= $rows["etare_cod_etare"]; ?>">
          <i class="fa fa-check" aria-hidden="true"></i>
        </button>
      <?php } ?>
      </div>
    </li>
  </ul>
</div>
<?php }
else{?>
<div class="panel-body">
  <ul class="list-unstyled mb20">
    <li class="text-center"><a href="#">Tiene tareas</a></li>
  </ul>
</div>
<div class="panel-footer">
  <button class="btn btn-primary btn-block" id="verTareas">Ver mas... <i class="fa fa-arrow-right"></i></button>
</div>
<?php }?>

<div id="FormTareaTrabajar" class="none">
  <input type="hidden" value="<?= $fecha ?>" id="DateMin">

  <div class="panel panel-success">
    <div class="panel-heading">
      <h3 class="panel-title text-center">Tareas</h3>
    </div>
    <div class="panel-body">
      <form class="form-horizontal" id="tareas">
        <input type="hidden" id="task_id">

        <div class="col-xs-6">
          <div class="form-group">
            <label for="areaTask" class="col-xs-3 control-label">Area</label>
            <div class="col-xs-9">
              <select type="text" class="form-control" id="areaTask" name="area">
                <option value="">Selecion el area</option>
                <?php
                $area = $pdo->query("SELECT * FROM sgmearea ORDER BY earea_cod_earea ASC");
                while ($row = $area->fetch()) { ?>
                  <option value="<?=$row['earea_cod_earea']?>"><?=$row['earea_det_earea']?></option>               
                <?php } ?>
              </select>
            </div>
          </div>
        </div>

        <div class="col-xs-6">
          <div class="form-group">
            <label for="subareaTask" class="col-xs-3 control-label">Sub area</label>
            <div class="col-xs-9" id="subareaContainerTask">
              <select type="text" class="form-control" id="subareaTask" name="subarea">
                <option value="">Debe escoger primero el area</option>
              </select>
            </div>
          </div>
        </div>

        <div class="col-xs-6">
          <div class="form-group">
            <label for="empleadoTask" class="col-md-2 control-label">Empleado</label>
            <div class="col-md-10">
              <select id="empleadoTask" class="form-control" name="empleadoTask">
                <option value="">Selecione el empleado</option>
                <?php
                  $empleados = $pdo->query("SELECT * FROM sgmeempl");
                  while ($row = $empleados->fetch()) { ?>
                  <option value="<?=$row['eempl_ced_eempl']?>">
                    <?= $row["eempl_nom_eempl"]." ".$row["eempl_ape_eempl"] ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>    
        </div>

        <div class="col-xs-6">
          <div class="form-group">
            <label for="equipoTask" class="col-md-2 control-label">Equipos</label>
            <div class="col-md-10">
              <select id="equipoTask" class="form-control" name="equipoTask">
                <option value="">Selecione el Equipo</option>
                <?php
                  $equipos = $pdo->query("SELECT * FROM smgeequi");
                  while ($row = $equipos->fetch()) { ?>
                  <option value="<?=$row['eequi_cod_eequi']?>">
                    <?= $row["eequi_det_eequi"] ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>    
        </div>

        <div class="col-xs-6 col-xs-offset-3">
          <div class="form-group">
            <label for="fecha" class="col-md-2 control-label">Fecha</label>
            <div class="col-md-10">
              <input type="text" class="form-control datepicker" id="fechaTask" 
              placeholder="<?=$fecha?>" name="fecha">
            </div>
          </div>        
        </div>     

        <div class="col-xs-12">
          <div class="form-group">
            <label for="detalleTask" class="col-md-2 control-label">Detalle</label>
            <div class="col-md-10" id="tareasContainerTask">
              <select id="detalle" class="form-control" name="detalleTask">
                <option value="">Selecione primero el area</option>
              </select>
            </div>
          </div>
        </div>
        <!-- Informe -->
        <div class="col-xs-12 margin--tb none informLayout">
          <div class="form-group">
            <label for="informe" class="col-md-2 control-label">Informe</label>
            <div class="col-md-10">
              <input type="text" class="form-control" id="informe" name="informe">
            </div>
          </div>
        </div>
        <div class="form-group text-center">
          <!-- <label class="col-md-2 control-label">Prioridad</label> -->

          <div class="col-xs-4">
            <div class="radio radio-primary">
              <label>
                <input type="radio" name="prioridad" class="prioridad"
                      value="#F44336_1_task">
                Alto
              </label>
            </div>
          </div>
          <div class="col-xs-4">
            <div class="radio radio-primary">
              <label>
                <input type="radio" name="prioridad" class="prioridad" 
                      value="#4CAF50_2_task">
                Medio
              </label>
            </div>
          </div>
          <div class="col-xs-4">
            <div class="radio radio-primary">
              <label>
                <input type="radio" name="prioridad" value="#ead72e_3_task"
                    class="prioridad">
                Bajo
              </label>
            </div>
          </div>

        </div>

        <div class="form-group none" id="containerDetalleTask" style="display:flex;flex-wrap: wrap;justify-content: center;">
          <label for="detalle-task" class="col-xs-11">Ingresa el informe de la tarea</label>
          <div class="col-xs-11">
            <textarea id="detalle-task" rows="4" class="form-control"></textarea>
          </div>
        </div>
      </form>
      <div class="footer-pane space-top center col-xs-12">
        <button class="btn btn-raised btn-warning" id="herramientas-task">Herramientas</button>
        <button class="btn btn-raised btn-success" id="materiales-task">Materiales</button>
        <button class="btn btn-raised btn-primary none" id="tiempos-task">Tiempos</button>
        <button class="btn btn-raised btn-primary none" id="terminar-task">Terminar</button>

        <button class="btn btn-raised btn-default" id="ordenFormAceptar-task">Ingresar Herramientas y Repuestos</button>
        <button class="btn btn-raised btn-warning" id="cancelarTask">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<script src="../assets/js/task.js"></script>
<script type="text/javascript">
  $.material.init()

var taskDB = {}
taskDB.herramientas = []
taskDB.inventarios = []
taskDB.inicio = []
taskDB.inicio_count = 0


// Terminar
$("#terminar-task").on('click', function (e) {
  e.preventDefault()
  var informe = $("#detalle-task")
  var id = $("#id-task-work").val()

  if (informe.val() === "") {
    alerta("Ingrese el informe de la tarea")
    informe.focus()
    return false
  }
  $.ajax({
    type: "POST",
    url: "../tareas/service/entregar.php",
    data: { informe: informe.val(), id }
  })
  .done(function (snap) {
    console.log(snap)
    if (snap == 201)
      alertaInfo("Ha terminado la tarea espere a aque el se revisada")
      $(".panel-tiempos-task").slideUp()
      $("#listTask").load("../tareas.php")
      $("#TareasAll").load("../task_table.php")
  })
})
// Fin Terminar

//  Ingresar Herramientas de las tareas
$(".add-herr-task").on("click", function (e) {
  var id = e.currentTarget.dataset.id
  var producto = e.currentTarget.dataset.producto
  var price = e.currentTarget.dataset.price
  addHerramientasTask(id, producto, price)
})

function addHerramientasTask (id, producto, price) {
  var cant = $(`#cant${id}`)

  if(cant.val() === "" || cant.val() == 0){
    alerta("Porfavor ingrese la cantidad")
    cant.focus()
    return false
  }
  if (validHerramientasTask(id, cant.val()) ) {
    var total = parseFloat(price) * parseInt(cant.val())
    var contex = {
      id: id, producto: producto,price: price,
      total: total, cant: cant.val(),
    }
    taskDB.herramientas.push(contex)
    buildingHerramientasTask()
    $(".panel-listadoHerramientas-task").slideUp()    
    $(".cant-input").val("")
  }
}

function validHerramientasTask (id, cant) {
  var flag = false
  var herra = taskDB.herramientas

  if(herra === null || herra.length === 0){
    return true
  }
  for (var i in herra) {
    var item = herra[i]

    if(item.id === id) {
      item.cant = parseInt(item.cant) + parseInt(cant)
      item.total = parseInt(item.cant) * parseFloat(item.price)
      buildingHerramientasTask()
      alertaInfo("Se ha actualizado con exito")
      $(".panel-listadoHerramientas-task").slideUp()
      $(".cant-input").val("")
      return false
    }
    else flag = true
  }

  return flag
}

function buildingHerramientasTask () {
  var inventarios = taskDB.herramientas
  $("#tableHerramientasTask").html("")

  for (var i in inventarios) {
    var item = inventarios[i]
    var total = parseInt(item.cant) * parseFloat(item.price)
    total = total.toFixed(2)
    var template = `<tr>
      <td>${item.cant}</td>
      <td>${item.producto}</td>
      <td>${item.price}</td>
      <td>${total}</td>`
    $("#tableHerramientasTask").append(template)
  }
}

//  Ingresar Materiales de las tareas
$(".add-inve-task").on("click", function (e) {
  var id = e.currentTarget.dataset.id
  var producto = e.currentTarget.dataset.producto
  var price = e.currentTarget.dataset.price
  addInventarioTask(id, producto, price)
})

function addInventarioTask (id, producto, price) { 
  var cant = $(`#cant${id}`)

  if(cant.val() === "" || cant.val() == 0){
    alerta("Porfavor ingrese la cantidad")
    cant.focus()
    return false
  }
  if (validInventarioTask(id, cant.val()) ) {
    var total = parseFloat(price) * parseInt(cant.val())
    var contex = {
      id: id, producto: producto, price: price, total: total, cant: cant.val(),
    }
    taskDB.inventarios.push(contex)
    buildingInventarioTask()
    $(".panel-inventario-task").slideUp()
    $(".cant-input").val("")
  }

}

function validInventarioTask (id, cant) {
  var flag = false
  var invent = taskDB.inventarios

  if(invent === null || invent.length === 0){
    return true
  }
  for (var i in invent) {
    var item = invent[i]

    if(item.id === id) {
      item.cant = parseInt(item.cant) + parseInt(cant)
      item.total = parseInt(item.cant) * parseFloat(item.price)
      buildingInventarioTask()
      alertaInfo("Se ha actualizado con exito")
      $(".panel-inventario-task").slideUp()
      $(".cant-input").val("")
      return false
    }
    else flag = true
  }

  return flag
}

function buildingInventarioTask() {
  var inventarios = taskDB.inventarios
  $("#tablemateriales-task").html("")

  for (var i in inventarios) {
    var item = inventarios[i]
    var template = `<tr>
      <td>${item.cant}</td>
      <td>${item.producto}</td>
      <td>${item.price}</td>
      <td>${item.total}</td>`
    $("#tablemateriales-task").append(template)
  }
}

// Guardar los materiales y herramientas

$('#ordenFormAceptar-task').on('click', function (e) {
  e.preventDefault()
  if(validarOrdenTask() === true) {
    var id = $("#id-task-work").val()
    $.ajax({
      type: "POST",
      url: "../tareas/service/guardarHerramientasTak.php",
      data: { repuestos: taskDB.inventarios, herramientas: taskDB.herramientas, id }
    })
    .done(function (snap) {
      console.log(snap)
      if(snap == 2) {
        closeFomrTask()
        $(".tabla-contianer").load("template/table.php")
        alertaInfo("Se ha realizado con exito")
        location.reload()
      }
    })
  }
})


function validarOrdenTask () {
  if (taskDB.inventarios.length === 0 && taskDB.herramientas.length === 0) {
    alerta('Debe ingresar materiales o herrramientas')
    return false
  }
  else return true
}
$("#cancelarTask").on("click", cancelarTask)

function cancelarTask (e) {
  e.preventDefault()
  closeFomrTask()
}
function closeFomrTask () {
  $("#TareasAll").load("../task_table.php")
  $("#FormTareaTrabajar").slideUp()
  taskDB.inventarios = []
  taskDB.herramientas = []
  $("#tablemateriales-task").html("")
  $("#tableHerramientasTask").html("")
}

// Tiempos
$('#saveDateTime-task').on('click', function (e) {
  e.preventDefault()
  var hora = $("#horaDateTime-task").val()
  var fecha = $("#fechaDateTime-task").val()

  if (validarTiempoTask(hora, fecha)) {
    var object = { fecha, hora }

    if (taskDB.inicio_count == 0) {
        taskDB.inicio.push(object)
        buildingDateTimeTask()
      }
      else alerta('Ya tiene fecha y hora de inicio')
      taskDB.inicio_count++
    $('.form__date-time-task').slideUp()
    $("#horaDateTime-task").val("")
    $("#fechaDateTime-task").val("")
  }
})

$('#ordenFormTimeInicioTask').on('click', function (e) {
  e.preventDefault()
  if (taskDB.inicio.length === 0) {
    alerta("Ingresa el tiempo de inicio")
    $('.form__date-time-task').slideUp()
    return false
  }
  var id = $("#id-task-work").val()

  $.ajax({
    type: "POST",
    url: "../tareas/service/tiempoInicioGuardar.php",
    data: { inicio: taskDB.inicio, id }
  })
  .done(function (snap) {
    console.log(snap)
    if (snap == 2) {
      alertaInfo("Ha ingresado con exito la fecha de inicio")
      $("#herramientas-task").slideUp()
      $("#materiales-task").slideUp()
      $("#ordenFormAceptar-task").slideUp()
      $("#tiempos-task").slideUp()
      $("#containerDetalleTask").slideDown()
      $("#terminar-task").slideDown()
      //location.reload()
      $("#listTask").load("../tareas.php")
      $("#TareasAll").load("../task_table.php")
    }
  })
})

function validarTiempoTask (hora, fecha) {
  if(fecha == ""){
    alerta("Porfavor ingrese la fecha")
    $("#fechaDateTime-task").focus()
    return false
  }
  if(hora == "" || hora == "00:00"){
    alerta("Porfavor ingrese la hora")
    $("#horaDateTime-task").focus()
    return false
  }
  else return true
}

function buildingDateTimeTask () {
  $(`#tableInicioTask`).html("")
  var dateTime = []
  dateTime = taskDB.inicio

  for (var i in dateTime) {
    var item = dateTime[i]

    var template = `<tr>
      <td>${item.fecha}</td>
      <td>${item.hora}</td>`
    $(`#tableInicioTask`).append(template)
  }
}
// /Tiempos
</script>