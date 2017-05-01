<?php
include "../../conexion/conexion.php";

$equipo = $_GET["equipo"];
$array = array();

$detalle = $pdo->query("SELECT * FROM v_equipos_detalle 
                          WHERE edequ_cod_edequ='$equipo'");

while ($row = $detalle->fetch()) {
  $array[] =$row;
}

$json = json_encode($array);
print $json;