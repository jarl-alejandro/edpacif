<?php
$id = $_SESSION["3188768e18a5c00164bbe22d1749a30e4626a114"];

$qs = $pdo->query("SELECT * FROM sgmeempl WHERE eempl_ced_eempl='$id'");
$employee = $qs->fetch();

$rol = strtoupper($employee['eempl_car_eempl']);

if ($rol == 'TECNICO') {
  require "./tecnico.php";
} else if ($rol == 'MANTENIMIENTO') {
  require "./manteniento.php";
} else if ($rol == 'JEFES') {
  require "./jefes.php";
}

/*
$ordenes = $pdo->query("SELECT * FROM sgmeorin WHERE eorin_est_eorin='asignado'
	AND eorin_emp_eorin='$id'");
$countOrden = $ordenes->rowCount();

$task = $pdo->query("SELECT * FROM sgmetare WHERE etare_est_etare='asginado' AND etare_emp_etare='$id'");
$countTask = $task->rowCount();
*/
?>
