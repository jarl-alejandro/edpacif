<?php
include "../../conexion/conexion.php";
date_default_timezone_set('America/Guayaquil');

$id = $_GET["id"];
$fecha = $_GET["fecha"];
$hoy = date("Y/m/d");

$valid = $pdo->query("SELECT * FROM sgmeagua WHERE (
  (eagua_ini_eagua <='$fecha' AND eagua_fin_eagua >= '$fecha')
  OR eagua_ini_eagua BETWEEN '$fecha' AND '$fecha'
  OR eagua_fin_eagua BETWEEN '$fecha' AND '$fecha') AND eagua_est_eagua='libre'");


if($valid->rowCount() > 0){
  $depen = $pdo->query("SELECT * FROM v_daguaje WHERE subare_cod_subare='$id'");
  $row = $depen->fetch();
  $json = json_encode($row);
  print $json;
}
else {
  $row = array('earege_agu_earege'=>false);
  $json = json_encode($row);
  print $json;
}

