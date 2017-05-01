<?php
include "../../conexion/conexion.php";

$id = $_POST["id"];

$exist = $pdo->query("SELECT * FROM sgmeorin WHERE eorin_emp_eorin='$id'");

if($exist->rowCount() > 0) {
  print 3;
  return false;
}

$exist2 = $pdo->query("SELECT * FROM sgmetare WHERE etare_emp_etare='$id'");

if($exist2->rowCount() > 0) {
  print 3;
  return false;
}

$employ = $pdo->query("DELETE FROM sgmeempl WHERE eempl_ced_eempl='$id'");

if($employ){
  echo 2;
}
