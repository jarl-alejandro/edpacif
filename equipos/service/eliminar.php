<?php 
include "../../conexion/conexion.php";
include "../../conexion/codigo.php";
date_default_timezone_set('America/Guayaquil');
 
$id = $_POST["id"];

$exist = $pdo->query("SELECT * FROM sgmeorin WHERE eorin_equ_eorin='$id'");

if($exist->rowCount() > 0) {
  print 3;
  return false;
}

$exist2 = $pdo->query("SELECT * FROM sgmetare WHERE etare_equ_etare='$id'");

if($exist2->rowCount() > 0) {
  print 3;
  return false;
}

$qEqui = $pdo->query("DELETE FROM smgeequi WHERE eequi_cod_eequi='$id'");
$pdo->query("DELETE FROM sgmedequ WHERE edequ_cod_edequ='$id'");
$pdo->query("DELETE FROM sgmeinfe WHERE einfe_equi_infe='$id'");

if ($id) {
  echo 2;
}