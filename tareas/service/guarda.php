<?php
include "../../conexion/conexion.php";
include "../../conexion/codigo.php";

if($_POST["tareaSub"] != "") {
  $tareaSub = $_POST["tareaSub"];
  $tareaDet = strtoupper($_POST["tareaDet"]);
  $stateTask = 1;
  
  $nameRepeat = $pdo->query("SELECT ltare_det_ltare FROM sgmeltare
      WHERE ltare_det_ltare='$tareaDet'");

  $genQuery = $pdo->query("SELECT * FROM sgmeltare WHERE ltare_suba_ltare='$tareaSub'");

  $index = $genQuery->rowCount() + 1;
  $codigo = $_POST["tareaSub"].".".$index;

  $area = $pdo->prepare("INSERT INTO sgmeltare (ltare_cod_ltare, ltare_det_ltare, ltare_suba_ltare, ltare_est_ltare) 
        VALUES (?, ?, ?, ?)");

  $area->bindParam(1, $codigo);
  $area->bindParam(2, $tareaDet);
  $area->bindParam(3, $tareaSub);
  $area->bindParam(4, $stateTask);

  $area->execute();

  $detalle = $codigo;
}
else {
  $detalle = $_POST["detalle"];
}

$codigo = setCode('TAS-', 8, 'sgmetare', 'eparam_cont_tarea');
$empleado = $_POST["empleado"]; 
$equipo = $_POST["equipo"]; 
$fecha = $_POST["fecha"]; 
$prioridad = $_POST["prioridad"]; 
$subarea = $_POST["subarea"];
$estado = "asginado";
$hora = date("G:i");
$split = explode("_", $prioridad);
$color = $split["0"];
$orden = $split["1"];

$tarea = $pdo->prepare("INSERT INTO sgmetare (etare_cod_etare, etare_det_etare, etare_emp_etare, etare_equ_etare, etare_fet_etare, etare_pri_etare, etare_est_etare, etare_hor_etare, etare_col_etare, etare_sub_etare)
  VALUES (?,?,?,?,?,?,?,?, ?, ?)");

$tarea->bindParam(1, $codigo);
$tarea->bindParam(2, $detalle);
$tarea->bindParam(3, $empleado);
$tarea->bindParam(4, $equipo);
$tarea->bindParam(5, $fecha);
$tarea->bindParam(6, $orden);
$tarea->bindParam(7, $estado);
$tarea->bindParam(8, $hora);
$tarea->bindParam(9, $color);
$tarea->bindParam(10, $subarea);

$tarea->execute();


if($tarea) {
  updateCode("eparam_cont_tarea");
  echo 2;
}
