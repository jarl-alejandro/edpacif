<?php
include "../../conexion/conexion.php";

$id = $_POST["id"];
$estado = "anulado";

$aguajes = $pdo->query("UPDATE sgmeagua SET eagua_est_eagua='$estado'
                      WHERE eagua_cod_eagua='$id'");

if($aguajes) {
  echo 2;
}
