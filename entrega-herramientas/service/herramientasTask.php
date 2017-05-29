<?php
include "../../conexion/conexion.php";
date_default_timezone_set('America/Guayaquil');

$id = $_POST["id"];
$array = array();

$query = $pdo->query("SELECT * FROM vista_herramienta_tarea WHERE herta_cod_herta='$id'");

while ($row = $query->fetch()) {
	$array[] = $row;
}

$json = json_encode($array);
print $json;