<?php
include "../../conexion/conexion.php";
date_default_timezone_set('America/Guayaquil');

$id = $_POST["id"];
$fin = $_POST["fin"];

$finQuery = $pdo->prepare("INSERT INTO sgmetaff (taff_cod_taff, taff_fet_taff, taff_hor_taff) VALUES (?, ? ,?)");

foreach($fin as $fechaFin) {
  $fecha = $fechaFin["fecha"];
  $hora = $fechaFin["hora"];

  $finQuery->bindParam(1, $id);
  $finQuery->bindParam(2, $fecha);
  $finQuery->bindParam(3, $hora);

  $finQuery->execute();
}
$update = $pdo->query("UPDATE sgmetare SET etare_est_etare='fechaFin' WHERE etare_cod_etare='$id'");

echo 2;