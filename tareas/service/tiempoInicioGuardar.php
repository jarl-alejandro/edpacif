<?php
include "../../conexion/conexion.php";
date_default_timezone_set('America/Guayaquil');

$id = $_POST["id"];
$inicio = $_POST["inicio"];

$iniQuery = $pdo->prepare("INSERT INTO sgmefein (fein_cod_fein, fein_fet_fein, fein_hor_fein) VALUES (?, ? ,?)");

foreach($inicio as $fechaIni) {
  $fecha = $fechaIni["fecha"];
  $hora = $fechaIni["hora"];

  $iniQuery->bindParam(1, $id);
  $iniQuery->bindParam(2, $fecha);
  $iniQuery->bindParam(3, $hora);

  $iniQuery->execute();
}
$update = $pdo->query("UPDATE sgmetare SET etare_est_etare='fecha' WHERE etare_cod_etare='$id'");

echo 2;