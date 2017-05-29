<?php
include "../../conexion/conexion.php";
date_default_timezone_set('America/Guayaquil');

$id = $_POST['id'];
$herramientas = $_POST['herramientas'];
$len = $_POST['len'];
$select = $_POST['select'];

if ($len == $select) {
  $pdo->query("UPDATE sgmeorin SET eorin_esher_eorin='entregado' WHERE eorin_cod_eorin='$id'");
}

foreach ($herramientas as $key) {
	$id = $key['id'];
	$codigo = $key['codigo'];
	$cant = $key['cant'];

	$eherr = $pdo->query("SELECT * FROM sgmeherr WHERE eherr_cod_eherr='$codigo'");
  $fetcHer = $eherr->fetch();
  $cantNew = $fetcHer["eherr_cant_eherr"] + $cant;
  $pdo->query("UPDATE sgmeherr SET eherr_cant_eherr='$cantNew' WHERE eherr_cod_eherr='$codigo'");

  $pdo->query("UPDATE sgmedoih SET doih_esta_doih='entregado' WHERE doih_id_doih='$id'");

}