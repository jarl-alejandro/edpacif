<?php
include "../../conexion/conexion.php";

$id = $_POST["id"];

$orden = $pdo->query("UPDATE sgmeorde SET eorde_est_eorde='finalizado' 
              WHERE eorde_cod_eorde='$id'");

if($orden){
  echo 2;
}