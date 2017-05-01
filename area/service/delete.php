<?php
include "../../conexion/conexion.php";

$id = $_POST["id"];

$exist = $pdo->query("SELECT * FROM sgmesuba WHERE subare_are_subare='$id'");

if($exist->rowCount() > 0) {
  print 3;
  return false;
}

$areaDelete = $pdo->query("DELETE FROM sgmearea
                WHERE earea_cod_earea='$id'");

if($areaDelete){
  print 2;
}
