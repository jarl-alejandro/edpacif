<?php
include "../../conexion/conexion.php";

$id = $_POST["id"];
$informe = $_POST["informe"];
$estado = "revisar";

$tarea = $pdo->query("UPDATE sgmetare SET etare_est_etare='$estado', 
            etare_inf_etare='$informe' WHERE etare_cod_etare='$id'");

if($tarea){
  echo 2;
}