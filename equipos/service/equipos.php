<?php 
include "../../conexion/conexion.php";
include "../../conexion/codigo.php";
date_default_timezone_set('America/Guayaquil');
 
$id = $_GET["id"];
$detalles = array();
// v_equipo_info
/*
$exist = $pdo->query("SELECT * FROM sgmeorin WHERE eorin_equ_eorin='$id'");

if($exist->rowCount() > 0) {
  $resp = array('status'=>3);
  print json_encode($resp); 
  return false;
}

$exist2 = $pdo->query("SELECT * FROM sgmetare WHERE etare_equ_etare='$id'");

if($exist2->rowCount() > 0) {
  $resp = array('status'=>3);
  print json_encode($resp); 
  return false;
}
*/
$qEqui = $pdo->query("SELECT * FROM v_equipo WHERE eequi_cod_eequi='$id'");
$equipo = $qEqui->fetch();

$query_info = $pdo->query("SELECT * FROM sgmeinfe WHERE einfe_equi_infe='$id'");
$informacion = $query_info->fetch();


$detEqui = $pdo->query("SELECT * FROM v_equipos_detalle 
          WHERE edequ_cod_edequ='$id'");

while ($row = $detEqui->fetch()) {
  $detalles[] = $row;
}

$equipos = ['equipos'=>$equipo, 'detalles'=>$detalles, 'informacion'=>$informacion];
$json = json_encode($equipos);
print $json;