<?php
include "../conexion/conexion.php";
$id = $_SESSION["3188768e18a5c00164bbe22d1749a30e4626a114"];
date_default_timezone_set('America/Guayaquil');

$hoy = date("Y/m/d");
$day = date("Y-m-d");

$query = $pdo->query("SELECT * FROM sgmeagua WHERE (
  (eagua_ini_eagua <='$hoy' AND eagua_fin_eagua >= '$hoy')
  OR eagua_ini_eagua BETWEEN '$hoy' AND '$hoy'
  OR eagua_fin_eagua BETWEEN '$hoy' AND '$hoy' )
  AND eagua_est_eagua='libre'");

$aguaje = $query->fetch();

$dia = date("l");

if ($dia=="Monday") $dia="Lunes";
if ($dia=="Tuesday") $dia="Martes";
if ($dia=="Wednesday") $dia="Miércoles";
if ($dia=="Thursday") $dia="Jueves";
if ($dia=="Friday") $dia="Viernes";
if ($dia=="Saturday") $dia="Sabado";
if ($dia=="Sunday") $dia="Domingo";

$mes = date("F");
$day = date("d");

if ($mes=="January") $mes="Enero";
if ($mes=="February") $mes="Febrero";
if ($mes=="March") $mes="Marzo";
if ($mes=="April") $mes="Abril";
if ($mes=="May") $mes="Mayo";
if ($mes=="June") $mes="Junio";
if ($mes=="July") $mes="Julio";
if ($mes=="August") $mes="Agosto";
if ($mes=="September") $mes="Setiembre";
if ($mes=="October") $mes="Octubre";
if ($mes=="November") $mes="Noviembre";
if ($mes=="December") $mes="Diciembre";

$year = date("Y");
$fecha = "$mes,  $dia $day del $year";

?>
<div class="panel panel-danger none" id="TaskRevisar">
  <div class="panel-heading">
  <h3 class="panel-title text-center">Tarea</h3>
  </div>
  <div class="panel-body">
    <div class="form-group">
      <div class="col-md-12">
        <input type="text" class="form-control" id="taskInput"
        placeholder="Se ha cambio el aceite con exito">
      </div>
    </div>
    <div class="top-space-big text-center">
      <button class="btn__flat text-normal green" id="taskAcept">
        Aceptar
      </button>
    </div>
  </div>
</div>

<div class="col-md-3 col-lg-4 dash-right">
  <div class="row">
    <div class="col-sm-5 col-md-12 col-lg-6">
      <div class="panel panel-danger panel-weather">
        <div class="panel-heading">
          <h4 class="panel-title">Panel de Notificaciones</h4>
        </div>
        <div class="panel-body inverse relative">
          <?php if ($query->rowCount()  == 0) {
            echo '<h2 class="today-day">No hay aguajes previstos.</h2>';
          } else { ?>
          <div class="bandera">
            <i class="fa fa-flag-checkered" 
              style="color:<?=$aguaje["eagua_col_eagua"]?>"></i>
          </div>
          <div class="row mb10">
            <div class="col-xs-6">
              <h2 class="today-day">Hoy.</h2>
              <!-- <h3 class="today-date">Diciembre 17, 2016</h3> -->
              <h3 class="today-date"><?= $fecha ?></h3>
            </div>
            <div class="col-xs-6">
              <i class="wi wi-hail today-cloud"></i>
            </div>
          </div>
          <p class="nomargin">
            <?php 
            if($aguaje["eagua_ini_eagua"] == $day) {
              echo "Hoy inicia el aguaje";
            }
            else if($aguaje["eagua_fin_eagua"] == $day) {
              echo "Hoy termina el aguaje";
            }
            else {
              echo "Estamos en aguaje";
            }
            ?>
          </p>
          <p class="nomargin">No estamos en posibilidad de marea baja.</p>
          <?php } ?>
        </div>

      </div>
    </div><!-- col-md-12 -->

    <div class="col-sm-5 col-md-12 col-lg-6">
      <div class="panel panel-primary list-announcement">
        <div class="panel-heading">
          <h4 class="panel-title">Tareas del Dia</h4>
        </div>
        <div id="listTask"></div>
      </div>
    </div><!-- col-md-12 -->

  </div><!-- row -->
</div><!-- row -->
<div class="panel panel-danger none" id="TaskPanel">
  <div class="panel-heading">
    <h3 class="panel-title">Tareas</h3>
  </div>
  <div class="panel-body">
    <div id="TareasAll"></div>
    <div class="col-xs-12 center">
      <button class="btn btn-danger" id="closeTareas">Cerrar
        <i class="fa fa-times"></i>
      </button>      
    </div>
  </div>
</div>