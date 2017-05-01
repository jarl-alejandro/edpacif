<?php
include "../../conexion/conexion.php";

$aguQuery = $pdo->query("SELECT * FROM sgmeagua");
$aguaje = $aguQuery->fetch();

$json = json_encode($aguaje);
print $json;
