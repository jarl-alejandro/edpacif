<?php
include "../../conexion/conexion.php";
date_default_timezone_set('America/Guayaquil');

$pedidos = array();

$querys = $pdo->query("SELECT * FROM sgmeorin WHERE eorin_est_eorin='pedido'");


while($row = $querys->fetch()) {
	$pedidos[] = $row;
}

$json = json_encode($pedidos);
print $json;