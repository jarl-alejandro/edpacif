<?php
include "../../conexion/conexion.php";
date_default_timezone_set('America/Guayaquil');

$id = $_POST["id"];
$fin = $_POST["fin"];
$estado = $_POST["estado"];

if ($estado == "false") {
	$finQuery = $pdo->prepare("INSERT INTO sgmedoff (doff_cod_doff, doff_fet_doff, doff_hor_doff) VALUES (?, ? ,?)");

	foreach($fin as $fechaFin) {
	  $fecha = $fechaFin["fecha"];
	  $hora = $fechaFin["hora"];

	  $finQuery->bindParam(1, $id);
	  $finQuery->bindParam(2, $fecha);
	  $finQuery->bindParam(3, $hora);

	  $finQuery->execute();
	}

$interna = $pdo->query("UPDATE sgmeorin SET eorin_estfe_orin='2' 
				WHERE eorin_cod_eorin='$id'");


}
if ($estado == "true") {
	foreach($fin as $fechaFin) {
		$fecha = $fechaFin["fecha"];
	  	$hora = $fechaFin["hora"];
		$finQuery = $pdo->query("UPDATE sgmedoff SET doff_fet_doff='$fecha', doff_hor_doff='$hora' WHERE doff_cod_doff='$id'");
	}
}

echo 2;