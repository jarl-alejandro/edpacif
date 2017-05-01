<?php
include "../../conexion/conexion.php";
include "../../conexion/codigo.php";

$codigo = setCode('RTA-', 8, 'sgmeruta', 'eparam_cont_ruta');

$id = $_POST["id"];
$detalle = strtoupper($_POST["detalle"]);
$kmInicial = $_POST["kmInicial"];
$kmFinal = $_POST["kmFinal"];
$fecha = strtoupper($_POST["fecha"]);
$equipo = strtoupper($_POST["equipo"]);
$empleado = strtoupper($_POST["empleado"]);
$llegada = strtoupper($_POST["llegada"]);
$motivo = strtoupper($_POST["motivo"]);

if($id == ""){
  
  $code = $pdo->query("SELECT COUNT(*) FROM sgmeruta WHERE eruta_cod_eruta='$codigo'");
  $fetch_code = $code->fetch();

  if ($fetch_code["count"] > 0) {
    echo 3;
    return false;
  }

  $ruta = $pdo->prepare("INSERT INTO sgmeruta (eruta_cod_eruta, eruta_det_eruta, 
					eruta_kmi_eruta, eruta_fet_eruta, eruta_equi_eruta, eruta_emp_eruta, eruta_kmf_eruta,
					eruta_llegf_eruta, eruta_motiv_eruta) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

  $ruta->bindParam(1, $codigo);
  $ruta->bindParam(2, $detalle);
  $ruta->bindParam(3, $kmInicial);
  $ruta->bindParam(4, $fecha);
  $ruta->bindParam(5, $equipo);
  $ruta->bindParam(6, $empleado);
  $ruta->bindParam(7, $kmFinal);
  $ruta->bindParam(8, $llegada);
  $ruta->bindParam(9, $motivo);

  $ruta->execute();

  updateCode("eparam_cont_ruta");
}
else{
  $query_equi = $pdo->query("SELECT * FROM smgeequi WHERE eequi_cod_eequi='$equipo'");
	$fetch_equi = $query_equi->fetch();

	if ($fetch_equi["eequi_kme_eequi"] == "") {
		$ruta = $pdo->query("UPDATE sgmeruta SET eruta_kmf_eruta='$kmFinal',
														eruta_llegf_eruta='$llegada' WHERE eruta_cod_eruta='$id'");


		$equipoQ = $pdo->query("SELECT * FROM smgeequi WHERE eequi_cod_eequi='$equipo'");
		$equipoRow = $equipoQ->fetch();
		
		$km = $kmFinal + $kmInicial + $equipoRow["eequi_kme_eequi"];

		$pdo->query("UPDATE smgeequi SET eequi_kme_eequi='$km' WHERE eequi_cod_eequi='$equipo'");
	}
}

if($ruta) {
  echo 2;
}
