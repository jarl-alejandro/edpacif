<?php
include "../../conexion/conexion.php";
date_default_timezone_set('America/Guayaquil');

$id = $_POST["id"];

$tarea = $pdo->query("UPDATE sgmetare SET etare_est_etare='asginado', etare_esr_etare='0' WHERE etare_cod_etare='$id'");

if ($tarea) {
  echo 2;
}