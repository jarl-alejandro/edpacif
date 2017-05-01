<?php
include "../../conexion/conexion.php";
date_default_timezone_set('America/Guayaquil');

$id = $_POST["id"];
$inicio = $_POST["inicio"];

$iniQuery = $pdo->prepare("INSERT INTO sgmedofi (dofi_cod_dofi, dofi_fet_dofi, dofi_hor_dofi) VALUES (?, ? ,?)");

foreach($inicio as $fechaIni) {
  $fecha = $fechaIni["fecha"];
  $hora = $fechaIni["hora"];

  $iniQuery->bindParam(1, $id);
  $iniQuery->bindParam(2, $fecha);
  $iniQuery->bindParam(3, $hora);

  $iniQuery->execute();
}

$interna = $pdo->query("UPDATE sgmeorin SET eorin_estfe_orin='1' WHERE eorin_cod_eorin='$id'");

echo 2;