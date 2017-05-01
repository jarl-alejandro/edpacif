<?php
include "../../conexion/conexion.php";
date_default_timezone_set('America/Guayaquil');

$id = $_POST["id"];

$orden = $pdo->query("UPDATE sgmeorin SET eorin_est_eorin='finalizado' WHERE eorin_cod_eorin='$id'");

if($orden){
  echo 2;
}