<?php
include "../../conexion/conexion.php";

$id = $_POST["id"];
$estado = "finalizado";

$tarea = $pdo->query("UPDATE sgmetare SET etare_est_etare='$estado' WHERE etare_cod_etare='$id'");

$select = $pdo->query("SELECT * FROM sgmetare WHERE etare_cod_etare='$id'");
$fetch =  $select->fetch();
$equipo = $fetch["etare_equ_etare"];

$select_equipo = $pdo->query("SELECT * FROM smgeequi WHERE eequi_cod_eequi='$equipo'");
$fetch_equipo = $select_equipo->fetch();


if($fetch_equipo["eequi_horas_eequi"] != 0) {
	$pdo->query("UPDATE smgeequi SET eequi_hoe_eequi='0' WHERE eequi_cod_eequi='$equipo'");
}
else {
	$pdo->query("UPDATE smgeequi SET eequi_kme_eequi='0' WHERE eequi_cod_eequi='$equipo'");	
}


if($tarea){
  echo 2;
}