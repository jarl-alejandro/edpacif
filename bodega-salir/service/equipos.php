<?php 
include "../../conexion/conexion.php";
include "../../conexion/codigo.php";
date_default_timezone_set('America/Guayaquil');
 
$id = $_GET["id"];
$detalles = array();

$qEqui = $pdo->query("SELECT * FROM smgeequi WHERE eequi_cod_eequi='$id'");
$equipo = $qEqui->fetch();


$detEqui = $pdo->query("SELECT * FROM v_equipos_detalle 
          WHERE edequ_cod_edequ='$id'");

while ($row = $detEqui->fetch()) {
  $detalles[] = $row;
}

$equipos = ['equipos'=>$equipo, 'detalles'=>$detalles];
$json = json_encode($equipos);
print $json;