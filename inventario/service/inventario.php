<?php
include "../../conexion/conexion.php";

$id = $_GET["id"];

$exist = $pdo->query("SELECT * FROM sgmedequ WHERE edequ_inv_edequ='$id'");

if($exist->rowCount() > 0) {
  print 3;
  return false;
}

$query = $pdo->query("SELECT * FROM sgmeinve WHERE einven_cod_einven='$id'");

$inven = $query->fetch();

print json_encode($inven);
