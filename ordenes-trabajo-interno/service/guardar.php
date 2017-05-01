<?php
include "../../conexion/conexion.php";
include "../../conexion/codigo.php";
date_default_timezone_set('America/Guayaquil');

$codigo = setCode('OR-', 8, 'sgmeorin', 'eparam_cont_orin');
$hoy = date("Y/m/d");

$emitidoPor = $_POST["emitidoPor"];
$subarea = $_POST["subarea"];
$equipo = $_POST["equipo"];
$empleado = $_POST["empleado"];
$mantenimiento = $_POST["mantenimiento"];
$detalle = $_POST["detalle"];
$motivo = $_POST["motivo"];
$estado = "asignado";

$interna = $pdo->prepare("INSERT INTO sgmeorin (eorin_cod_eorin, eorin_emi_eorin, eorin_sub_eorin,
  eorin_equ_eorin, eorin_emp_eorin, eorin_fet_eorin, eorin_man_eorin, eorin_det_eorin, eorin_est_eorin, eorin_mot_eorin) 
              VALUES (?,?,?,?,?,?,?,?,?,?)");

$interna->bindParam(1, $codigo);
$interna->bindParam(2, $emitidoPor);
$interna->bindParam(3, $subarea);
$interna->bindParam(4, $equipo);
$interna->bindParam(5, $empleado);
$interna->bindParam(6, $hoy);
$interna->bindParam(7, $mantenimiento);
$interna->bindParam(8, $detalle);
$interna->bindParam(9, $estado);
$interna->bindParam(10, $motivo);

$interna->execute();

if($interna) {
  updateCode("eparam_cont_orin");
  echo 2;
}