<?php
include "../../conexion/conexion.php";
date_default_timezone_set('America/Guayaquil');

$id = $_POST["id"];

$interna = $pdo->query("SELECT * FROM sgmeorin WHERE eorin_cod_eorin='$id'");
$row = $interna->fetch();

// $pdo->query("UPDATE sgmeorin SET eorin_est_eorin='proceso' WHERE eorin_cod_eorin='$id'");

print json_encode($row);
