<?php
session_start();

include '../conexion/conexion.php';

$email = $_POST["email"];
$password = sha1($_POST["password"]);

$employeQuery = $pdo->query("SELECT * FROM sgmeempl WHERE eempl_mai_eempl='$email'
      AND eempl_cont_eempl='$password'");

if($employeQuery->rowCount() > 0){
  $employee = $employeQuery->fetch();

  $_SESSION["3188768e18a5c00164bbe22d1749a30e4626a114"] = $employee['eempl_ced_eempl'];
  $_SESSION["f9f011a553550aef31a8ee2690e1d1b5f261c9ff"] =
      $employee['eempl_nom_eempl']. " ". $employee['eempl_ape_eempl'];
  $_SESSION["a88b7dcd1a9e3e17770bbaa6d7515b31a2d7e85d"] = $employee['eempl_mai_eempl'];
  $_SESSION["9c3bb49ffea1144231cbe02d904b8d9018744e9d"] = $employee['eempl_ava_eempl'];

  echo 2;
}
else{
  echo 404;
}
