<?php
include "../../conexion/conexion.php";
date_default_timezone_set('America/Guayaquil');

$id = $_POST["id"];

$update = $pdo->query("UPDATE sgmeorin SET eorin_est_eorin='pedido' WHERE eorin_cod_eorin='$id'");

if($update) {
	echo 2;
}