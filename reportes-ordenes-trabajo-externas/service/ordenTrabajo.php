<?php
include "../../conexion/conexion.php";
date_default_timezone_set('America/Guayaquil');

$id = $_POST["id"];
$inicio = array();
$fin = array();

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

$json = array("inicio"=>$inicio, "fin"=>$fin, "orden"=>$row);

print json_encode($json);
