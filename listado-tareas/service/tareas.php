<?php
include "../../conexion/conexion.php";

$id = $_GET["id"];

$areaQuery = $pdo->query("SELECT * FROM sgmeltare WHERE ltare_cod_ltare='$id'");

$area = $areaQuery->fetch();

print json_encode($area);
