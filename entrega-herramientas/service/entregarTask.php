<?php
include "../../conexion/conexion.php";
date_default_timezone_set('America/Guayaquil');

$id = $_POST['idTask'];
$herramientas = $_POST['herramientasTask'];
$len = $_POST['lenTask'];
$select = $_POST['selectTask'];

if ($len == $select) {
  $pdo->query("UPDATE sgmetare SET etare_esher_etare='entregado' WHERE etare_cod_etare='$id'");
}

foreach ($herramientas as $key) {
	$id = $key['id'];
	$codigo = $key['codigo'];
	$cant = $key['cant'];

	$eherr = $pdo->query("SELECT * FROM sgmeherr WHERE eherr_cod_eherr='$codigo'");
  $fetcHer = $eherr->fetch();
  $cantNew = $fetcHer["eherr_cant_eherr"] + $cant;
  $pdo->query("UPDATE sgmeherr SET eherr_cant_eherr='$cantNew' WHERE eherr_cod_eherr='$codigo'");

  $pdo->query("UPDATE sgmeherta SET doih_esta_doih='entregado' WHERE herta_id_herta='$id'");

}