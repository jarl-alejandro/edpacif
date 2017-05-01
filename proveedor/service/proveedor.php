<?php
include "../../conexion/conexion.php";

$id = $_GET["id"];

$emplQuery = $pdo->query("SELECT * FROM sgmepro WHERE eprov_cod_eprov='$id'");
$employee = $emplQuery->fetch();

$json = json_encode($employee);
print $json;
