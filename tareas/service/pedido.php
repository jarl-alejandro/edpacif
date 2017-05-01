<?php
include "../../conexion/conexion.php";

$id = $_POST["id"];

$task = $pdo->query("SELECT * FROM v_tarea WHERE etare_cod_etare='$id'");
$fetch = $task->fetch();

$json = json_encode($fetch);
echo $json;