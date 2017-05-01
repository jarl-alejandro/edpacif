<?php
include "../../conexion/conexion.php";

$id = $_POST["id"];

$exist = $pdo->query("SELECT * FROM sgmeempl WHERE eempl_car_eempl='$id'");

if($exist->rowCount() > 0) {
  print 3;
  return false;
}

$delete = $pdo->query("DELETE FROM sgmecarg WHERE ecarg_cod_ecarg='$id'");

if($delete){
  print 2;
}
