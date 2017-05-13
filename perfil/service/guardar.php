<?php session_start();
include "../../conexion/conexion.php";

$id = $_SESSION["3188768e18a5c00164bbe22d1749a30e4626a114"];
$password = sha1($_POST["password"]);

$update = $pdo->query("UPDATE sgmeempl SET eempl_cont_eempl='$password' 
  WHERE eempl_ced_eempl='$id'");

if($update) {
  echo 2;
}