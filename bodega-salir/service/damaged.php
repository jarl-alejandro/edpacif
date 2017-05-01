<?php
include "../../conexion/conexion.php";

$id = $_POST["id"];

$damaged = $pdo->query("UPDATE ep_equipos SET es_equipo='dañado'
                          WHERE id_equipo='$id'");

if($damaged) {
  echo 2;
}
else {
  echo 1;
}
