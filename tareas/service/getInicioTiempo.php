<?php
include "../../conexion/conexion.php";
date_default_timezone_set('America/Guayaquil');

$id = $_POST["id"];
$iniQuery = $pdo->query("SELECT * FROM sgmefein WHERE fein_cod_fein='$id'");
$fetch = $iniQuery->fetch();

print json_encode($fetch);