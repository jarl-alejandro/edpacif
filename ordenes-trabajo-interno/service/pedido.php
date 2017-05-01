<?php
include "../../conexion/conexion.php";
date_default_timezone_set('America/Guayaquil');

$id = $_POST["id"];
$herramientas = array();
$repuestos = array();

$interna = $pdo->query("SELECT * FROM sgmeorin WHERE eorin_cod_eorin='$id'");
$row = $interna->fetch();

$herrQuery = $pdo->query("SELECT * FROM v_herramientas_orden WHERE doih_cod_doih='$id'");
$repQuery = $pdo->query("SELECT * FROM v_repuestos WHERE doir_cod_doir='$id'");

while($herrRow = $herrQuery->fetch()){
  $herramientas[] = $herrRow;
}

while($repRow = $repQuery->fetch()){
  $repuestos[] = $repRow;
}

$json = array("herramientas"=>$herramientas, "repuestos"=>$repuestos, "orden"=>$row);

print json_encode($json);
