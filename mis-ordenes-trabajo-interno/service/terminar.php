<?php
include "../../conexion/conexion.php";
include "../../conexion/codigo.php";

$obsevacion = $_POST["obsevacion"];
$id = $_POST["id"];
// $code_pdf = setCode('PDF-', 8, 'diagnostico', 'eparam_cont_img');

// $diagnostico = $_FILES['diagnostico']['name'];
// $diagnostico = $code_pdf . ".pdf";

// $ruta = $_FILES["diagnostico"]["tmp_name"];
// $destino = "../../media/diagnostico/$diagnostico";

// copy($ruta, $destino);

$orden = $pdo->query("UPDATE sgmeorin SET eorin_obs_eorin='$obsevacion', eorin_est_eorin='revisado' WHERE eorin_cod_eorin='$id'");

if($orden) {
  echo 2;
}