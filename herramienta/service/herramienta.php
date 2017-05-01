<?php
include "../../conexion/conexion.php";

$id = $_GET["id"];

$query = $pdo->query("SELECT * FROM sgmeherr WHERE eherr_cod_eherr='$id'");

$inven = $query->fetch();

print json_encode($inven);
