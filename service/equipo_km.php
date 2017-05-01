<?php 
include '../conexion/conexion.php';

$equipoQ = $pdo->query("SELECT * FROM smgeequi");
$equipos = array();

while ($row = $equipoQ->fetch()) {
	$km = $row["eequi_kil_eequi"];
	$hora = $row["eequi_horas_eequi"];

	if ($km != 0) {
		$estado = $row["eequi_kme_eequi"];
		$porcent = $km * 0.80;

		if($estado >= $porcent){
			$equipos[] = $row;
		}
	}

	if($hora != 0) {
		$estado = $row["eequi_hoe_eequi"];
		$porcent = $hora * 0.80;

		if($estado >= $porcent){
			$equipos[] = $row;
		}
	}
}

$response = array("equipos"=>$equipos);
$json = json_encode($response);
print $json;