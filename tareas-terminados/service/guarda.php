<?php
include "../../conexion/conexion.php";
include "../../conexion/codigo.php";

$codigo = setCode('ORD-', 8, 'sgmeorde', 'eparam_cont_orden');
$empleado = $_POST["empleado"]; 
$equipo = $_POST["equipo"]; 
$fecha = $_POST["fecha"]; 
$comentario = $_POST["comentario"]; 
$ordenInventario = $_POST["ordenInventario"];
$estado = "asginado";

$orden = $pdo->prepare("INSERT INTO sgmeorde (eorde_cod_eorde, eorde_emp_eorde, eorde_equ_eorde, eorde_fecha_eorde, eorde_det_eorde, eorde_est_eorde) 
  VALUES (?,?,?,?,?,?)");

$orden->bindParam(1, $codigo);
$orden->bindParam(2, $empleado);
$orden->bindParam(3, $equipo);
$orden->bindParam(4, $fecha);
$orden->bindParam(5, $comentario);
$orden->bindParam(6, $estado);

$orden->execute();

foreach ($ordenInventario as $key) {
  $id = $key["id"];
  $comment = $key["comment"];

  $pdo->query("UPDATE sgmedequ SET edequ_est_edequ='M' 
      WHERE edequ_inv_edequ='$id' AND edequ_cod_edequ='$equipo'");
}

if($orden) {
  updateCode("eparam_cont_orden");
  echo 2;
}
