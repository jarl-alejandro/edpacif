<?php
include "../../conexion/conexion.php";

$id = $_POST["id"];
$informe = $_POST["informe"];

$tarea = $pdo->query("UPDATE sgmetare SET etare_est_etare='revisar', etare_inf_etare='$informe' 
                      WHERE etare_cod_etare='$id'");

if ($tarea) {
  echo 201;
}
