<?php
include "../../conexion/conexion.php";

$id = $_POST["id"];

$herramientas = array();
$materiales = array();

$tarea = $pdo->query("SELECT * FROM v_tarea WHERE etare_cod_etare='$id'");
$fetch = $tarea->fetch();

$herra_query = $pdo->query("SELECT * FROM vista_herramienta_tarea WHERE herta_cod_herta='$id'");

while ($row = $herra_query->fetch()) {
  $herramientas[] = $row;
}

$mate_query = $pdo->query("SELECT * FROM vista_inventario_tareas WHERE repta_cod_repta='$id'");

while ($row = $mate_query->fetch()) {
  $materiales[] = $row;
}

$response = array('tarea'=>$fetch, 'herramientas'=>$herramientas, 'materiales'=>$materiales);

$json = json_encode($response);
print $json;