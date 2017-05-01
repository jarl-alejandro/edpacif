<?php
session_start();
date_default_timezone_set('America/Guayaquil');

include "../../conexion/conexion.php";
include "../../conexion/codigo.php";

function upload_file ($codeImage, $routeImage) {
  $imagen = $_FILES['pdf']['name'];
  $imagen = $codeImage . ".pdf";
  $ruta = $_FILES["pdf"]["tmp_name"];
  $destino = "../../media/$routeImage/$imagen";

  copy($ruta, $destino);
  return $imagen;
}

$empleado = $_SESSION["3188768e18a5c00164bbe22d1749a30e4626a114"];
$code_pdf = setCode('PDF-', 8, 'ep_equipos', 'eparam_cont_img');
$fecha = date("Y/m/d");
$id = $_POST["id"];
$pdf_equipo = upload_file($code_pdf, "equipos");

$pdo->query("UPDATE smgeequi SET eequi_baja_eequi='1' WHERE eequi_cod_eequi='$id'");

$new = $pdo->query("INSERT INTO smgeeqbaj (eeqbaj_equi_eeqbaj, eeqbaj_fect_eeqbaj, 
      eeqbaj_empl_eeqbaj, eeqbaj_pdf_eeqbaj) VALUES ('$id', '$fecha', '$empleado', '$code_pdf')");

if ($new) {
  updateCode('eparam_cont_img');
  echo 2;
}