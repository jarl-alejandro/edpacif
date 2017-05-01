<?php
include "../../conexion/conexion.php";

$id = $_POST["id"];
$est = $_POST["estado"];
$estado = 1;
$state = "activado";

if($est == 1) {
	$estado = 0;
	$state = "desactivado";
}

$areaDelete = $pdo->query("UPDATE sgmeltare SET ltare_est_ltare='$estado' WHERE ltare_cod_ltare='$id'");

if($areaDelete){
  $response = array('status'=>201, 'state'=>$state);
  echo json_encode($response);
}
