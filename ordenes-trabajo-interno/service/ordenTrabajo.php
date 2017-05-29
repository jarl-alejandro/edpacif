<?php
include "../../conexion/conexion.php";
date_default_timezone_set('America/Guayaquil');

$id = $_POST["id"];
$inicio = array();
$fin = array();

$herramientas = array();
$repuestos = array();

$interna = $pdo->query("SELECT * FROM sgmeorin WHERE eorin_cod_eorin='$id'");
$row = $interna->fetch();

$iniQuery = $pdo->query("SELECT * FROM  sgmedofi WHERE dofi_cod_dofi='$id'");
$finQuery = $pdo->query("SELECT * FROM  sgmedoff WHERE doff_cod_doff='$id'");

while($inicioRow = $iniQuery->fetch()){
  $inicio[] = $inicioRow;
}

while($finRow = $finQuery->fetch()){
  $fin[] = $finRow;
}

$herrQuery = $pdo->query("SELECT * FROM v_herramientas_orden WHERE doih_cod_doih='$id'");
$repQuery = $pdo->query("SELECT * FROM v_repuestos WHERE doir_cod_doir='$id'");

while($herrRow = $herrQuery->fetch()){
  $herramientas[] = $herrRow;
}

while($repRow = $repQuery->fetch()){
  $repuestos[] = $repRow;
}


$json = array("inicio"=>$inicio, "fin"=>$fin, "orden"=>$row, "herramientas"=>$herramientas, "repuestos"=>$repuestos);

print json_encode($json);
