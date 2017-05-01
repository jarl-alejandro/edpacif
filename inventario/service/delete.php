<?php
include "../../conexion/conexion.php";

$id = $_POST["id"];

$exist = $pdo->query("SELECT * FROM sgmedequ WHERE edequ_inv_edequ='$id'");

if($exist->rowCount() > 0) {
  print 3;
  return false;
}

$delete = $pdo->query("DELETE FROM sgmeinve WHERE einven_cod_einven='$id'");

if($delete){
  print 2;
}
