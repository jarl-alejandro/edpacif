<?php
include "../../conexion/conexion.php";

$id = $_POST["id"];

$delete = $pdo->query("DELETE FROM sgmeherr WHERE eherr_cod_eherr='$id'");

if($delete){
  print 2;
}
