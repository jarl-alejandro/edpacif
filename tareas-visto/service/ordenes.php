<?php
include "../../conexion/conexion.php";

$id = $_POST["id"];
$array = array();

$qOrden = $pdo->query("SELECT * FROM sgmeorde WHERE eorde_cod_eorde='$id'");
$orden = $qOrden->fetch();

$equipo = $orden["eorde_equ_eorde"];

$detalle = $pdo->query("SELECT * FROM v_equipos_detalle 
                          WHERE edequ_cod_edequ='$equipo'");

while ($row = $detalle->fetch()) {
  $array[] =$row;
}

$mantenimiento = array('orden'=>$orden, 'detalle'=>$array);

$json = json_encode($mantenimiento);
print $json;