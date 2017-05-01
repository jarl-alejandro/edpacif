<?php
include "../../conexion/conexion.php";

$id = $_GET["id"];

$exist = $pdo->query("SELECT * FROM sgmeorin WHERE eorin_emp_eorin='$id'");

if($exist->rowCount() > 0) {
  $resp = array('status'=>3);
  print json_encode($resp); 
  return false;
}

$exist2 = $pdo->query("SELECT * FROM sgmetare WHERE etare_emp_etare='$id'");

if($exist2->rowCount() > 0) {
  $resp = array('status'=>3);
  print json_encode($resp);  
  return false;
}

$emplQuery = $pdo->query("SELECT * FROM sgmeempl WHERE eempl_ced_eempl='$id'");
$employee = $emplQuery->fetch();

$json = json_encode($employee);
print $json;
