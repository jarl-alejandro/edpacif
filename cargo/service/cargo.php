<?php
include "../../conexion/conexion.php";

$id = $_POST["id"];

$exist = $pdo->query("SELECT * FROM sgmeempl WHERE eempl_car_eempl='$id'");

if($exist->rowCount() > 0) {
  print 3;
  return false;
}

$query = $pdo->query("SELECT * FROM sgmecarg WHERE ecarg_cod_ecarg='$id'");
$bod = $query->fetch();

print json_encode($bod);
