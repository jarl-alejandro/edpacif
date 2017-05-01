<?php
include "../../conexion/conexion.php";

$id = $_POST["id"];

$area = $pdo->query("SELECT * FROM sgmearea WHERE earea_gen_earea='$id'");

if($area->rowCount() > 0) {
  print 3;
  return false;
}

$query = $pdo->query("SELECT * FROM sgmearege WHERE earege_cod_earege='$id'");
$area = $query->fetch();

print json_encode($area);
