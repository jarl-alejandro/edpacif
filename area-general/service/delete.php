<?php
include "../../conexion/conexion.php";

$id = $_POST["id"];

$area = $pdo->query("SELECT * FROM sgmearea WHERE earea_gen_earea='$id'");


if($area->rowCount() > 0) {
  print 3;
  return false;
}

$areaDelete = $pdo->query("DELETE FROM sgmearege
                WHERE earege_cod_earege='$id'");

if($areaDelete){
  print 2;
}
