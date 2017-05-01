<?php
include "../../conexion/conexion.php";
date_default_timezone_set('America/Guayaquil');

$id = $_POST["id"];

$externa = $pdo->query("SELECT * FROM sgmeorex WHERE eorex_cod_eorex='$id'");
$row = $externa->fetch();


$json = array("orden"=>$row);

print json_encode($json);
