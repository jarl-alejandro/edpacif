<?php
include "../../conexion/conexion.php";

$id = $_POST["id"];


$update = $pdo->query("UPDATE smgeequi SET eequi_baja_eequi='0' WHERE eequi_cod_eequi='$id'");
$pdo->query("DELETE FROM smgeeqbaj WHERE eeqbaj_equi_eeqbaj='$id'");

if ($update) {
  echo 2;
}