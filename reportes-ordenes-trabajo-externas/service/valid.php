<?php
include "../../conexion/conexion.php";
date_default_timezone_set('America/Guayaquil');

$hoy = date("Y/m/d");
$equipo = $_POST["equipo"];


$orden =  $pdo->query("SELECT * FROM sgmeorin WHERE eorin_equ_eorin='$equipo' AND eorin_est_eorin!='finalizado'");

if($orden->rowCount() == 0) {
 	$task =  $pdo->query("SELECT * FROM sgmetare WHERE etare_equ_etare='$equipo' AND etare_est_etare!='finalizado'");
	
	if($task->rowCount() == 0) {
	 	$externa =  $pdo->query("SELECT * FROM sgmeorex WHERE eorex_equ_eorex='$equipo' AND eorex_est_eorex!='retorno'");
	  echo $externa->rowCount();
	}

}
else {
  echo $orden->rowCount();
}