<?php
include "../../conexion/conexion.php";
date_default_timezone_set('America/Guayaquil');

$id = $_POST["id"];

$pdo->query("UPDATE sgmeorin SET eorin_est_eorin='proceso' WHERE eorin_cod_eorin='$id'");