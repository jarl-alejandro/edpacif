<?php
include "../../conexion/conexion.php";
date_default_timezone_set('America/Guayaquil');

$id = $_GET["id"];
$hoy = date("Y/m/d");

$valid = $pdo->query("SELECT * FROM sgmeagua WHERE (
  (eagua_ini_eagua <='$hoy' AND eagua_fin_eagua >= '$hoy')
  OR eagua_ini_eagua BETWEEN '$hoy' AND '$hoy'
  OR eagua_fin_eagua BETWEEN '$hoy' AND '$hoy') AND eagua_est_eagua='libre'");


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

