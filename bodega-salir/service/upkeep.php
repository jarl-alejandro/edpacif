<?php
include "../../conexion/conexion.php";
include "../../conexion/codigo.php";

date_default_timezone_set('America/Guayaquil');

$id = $_POST["id"];
$codigo = setCode('OR-', 8, 'ep_orden_pedido', 'cont_orden');
$employee = 1718760901;
$fecha = date("Y/m/d");
$ahora = date("H:i");

$damaged = $pdo->query("UPDATE ep_equipos SET es_equipo='mantenimiento'
                          WHERE id_equipo='$id'");

$orden = $pdo->prepare("INSERT INTO ep_orden_pedido (orden_pedido, cod_equipo,
          fecha_pedido, hora_pedido, cod_empleado) VALUES (?, ?, ?, ?, ?)");

$orden->bindParam(1, $codigo);
$orden->bindParam(2, $id);
$orden->bindParam(3, $fecha);
$orden->bindParam(4, $ahora);
$orden->bindParam(5, $employee);

$orden->execute();

if($damaged) {
  updateCode('cont_orden');
  echo 2;
}
else {
  echo 1;
}
