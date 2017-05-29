<?php
include "../../conexion/conexion.php";
date_default_timezone_set('America/Guayaquil');

$id = $_POST["id"];
$array = array();

$query = $pdo->query("SELECT * FROM v_herramientas_orden WHERE doih_cod_doih='$id'");

while ($row = $query->fetch()) {
	$array[] = $row;
}

$json = json_encode($array);
print $json;