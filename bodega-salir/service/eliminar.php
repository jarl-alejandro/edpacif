<?php 
include "../../conexion/conexion.php";
include "../../conexion/codigo.php";
date_default_timezone_set('America/Guayaquil');
 
$id = $_POST["id"];

$qEqui = $pdo->query("DELETE FROM smgeequi WHERE eequi_cod_eequi='$id'");
  $pdo->query("DELETE FROM sgmedequ WHERE edequ_cod_edequ='$id'");

if ($id) {
  echo 2;
}