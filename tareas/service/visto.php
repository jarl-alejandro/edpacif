<?php
include "../../conexion/conexion.php";

$id = $_POST["id"];
$estado = "visto";

$tarea = $pdo->query("UPDATE sgmetare SET etare_est_etare='$estado' WHERE etare_cod_etare='$id'");

$task = $pdo->query("SELECT * FROM v_tarea WHERE etare_cod_etare='$id'");
$fetch = $task->fetch();

$json = json_encode($fetch);
echo $json;