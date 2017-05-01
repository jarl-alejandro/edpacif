<?php
include "../../conexion/conexion.php";

$id = $_POST["id"];

$tarea = $pdo->query("SELECT * FROM v_tarea WHERE etare_cod_etare='$id'");
$fetch = $tarea->fetch();

$json = json_encode($fetch);
print $json;