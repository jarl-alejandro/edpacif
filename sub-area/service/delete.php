<?php
include "../../conexion/conexion.php";

$id = $_POST["id"];

$exist = $pdo->query("SELECT * FROM smgeequi WHERE eequi_sare_eequi='$id'");

if($exist->rowCount() > 0) {
  print 3;
  return false;
}

$exist2 = $pdo->query("SELECT * FROM sgmeorin WHERE eorin_sub_eorin='$id'");

if($exist2->rowCount() > 0) {
  print 3;
  return false;
}


$areaDelete = $pdo->query("DELETE FROM sgmesuba WHERE subare_cod_subare='$id'");

if($areaDelete){
  print 2;
}
