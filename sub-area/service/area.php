<?php
include "../../conexion/conexion.php";

$id = $_GET["id"];

$exist = $pdo->query("SELECT * FROM smgeequi WHERE eequi_sare_eequi='$id'");

if($exist->rowCount() > 0) {
  print 3;
  return false;
}

$areaQuery = $pdo->query("SELECT * FROM sgmesuba
                            WHERE subare_cod_subare='$id'");

$area = $areaQuery->fetch();

print json_encode($area);
