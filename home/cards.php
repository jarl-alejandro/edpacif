<?php
$id = $_SESSION["3188768e18a5c00164bbe22d1749a30e4626a114"];

$qs = $pdo->query("SELECT * FROM v_empleados WHERE eempl_ced_eempl='$id'");
$employee = $qs->fetch();

$rol = strtoupper($employee['ecarg_det_ecarg']);

if ($rol == 'TECNICO') {
  require "./tecnico.php";
} else if ($rol == 'SUPERVISOR') {
  require "./manteniento.php";
} else if ($rol == 'SUPERVISOR') {
  require "./jefes.php";
}
?>
