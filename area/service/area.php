<?php
include "../../conexion/conexion.php";

$id = $_GET["id"];

$exist = $pdo->query("SELECT * FROM sgmesuba WHERE subare_are_subare='$id'");

if($exist->rowCount() > 0) {
  print 3;
  return false;
}

$areaQuery = $pdo->query("SELECT * FROM sgmearea
                            WHERE earea_cod_earea='$id'");

$area = $areaQuery->fetch();

print json_encode($area);
