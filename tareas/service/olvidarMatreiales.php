<?php
include "../../conexion/conexion.php";

$id = $_POST["id"];

$tarea = $pdo->query("UPDATE sgmetare SET etare_est_etare='pedido', etare_esr_etare='0' WHERE etare_cod_etare='$id'");


if($tarea){
  echo 2;
}