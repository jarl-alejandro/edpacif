<?php
session_start();
include "../../conexion/conexion.php";

$equipo = $_POST['equipo'];
$detalle = $_POST['detalle'];
$empleado = $_SESSION["3188768e18a5c00164bbe22d1749a30e4626a114"];

$new = $pdo->prepare("INSERT INTO sgmerepo (erepo_det_erepo, erepo_equi_erepo, erepo_emp_erepo) VALUES (?, ?, ?)");

$new->bindParam(1, $detalle);
$new->bindParam(2, $detalle);
$new->bindParam(3, $empleado);

$new->execute();

if ($new) {
  echo 2;
}