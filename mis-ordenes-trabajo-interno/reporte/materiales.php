<?php
session_start();

require('fpdf.php');
include "../../conexion/conexion.php";

date_default_timezone_set('America/Guayaquil');

class PDF extends FPDF {

  function Header() {
    $this->Image('../../assets/img/logo.png', 0, 0, 210, 42);

    $this->SetFont('Arial', 'B', 15);
    $this->SetTextColor(0, 0, 0);
    $this->Ln(1);
    $this->Line(2, 42, 295, 42);
    $this->Text(68, 54, 'ORDEN DE TRABAJO INTERNA');
    $this->Ln(25);
  }

  function TablaColores($header) {
    $this->SetFillColor(192, 192, 192);
    $this->SetTextColor(255);
    $this->SetLineWidth(.3);
    $this->SetFont('Arial', 'B');

    $w = array(20, 20, 150);

    for ($i = 0; $i < count($header); $i++)
      $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);

    // $this->Ln();

    $this->SetTextColor(0);

    $this->SetFont('Times');
  }

  function Footer() {
    $this->SetY(-30);

    $this->SetDash(1,1);
    // $this->Line(50, 235, 15, 235);

    $this->setX(45);
    $this->Line(90, 265, 40, 265);
    $this->Cell(40, 6.5, "Firma Empleado", 0, 0, 'C');

    $this->setX(105);
    $this->Line(105, 265, 150, 265);
    $this->Cell(50, 6.5, "Bodegero", 0, 0, 'C');

    // $this->setX(120);
    // $this->Line(120,160, 180, 160);
    // $this->Cell(60, 6.5, "Jefe Mantenimiento", 0, 0, 'C');

    $this->SetY(-15);
    $this->SetFont('Arial', 'I', 8);
    $this->Cell(0, 10, utf8_decode('Página ' . $this->PageNo() . '/Edpacif'), 0, 0, 'C');
  }

   function SetDash($black=false, $white=false) {
    if($black and $white)
      $s=sprintf('[%.3f %.3f] 0 d', $black*$this->k, $white*$this->k);
    else
      $s='[] 0 d';
    $this->_out($s);
  }

}

$pdf = new PDF();
$pdf->AddPage();

$pdf->SetY(65);

$pdf->SetFont('Arial', '',12);

$id = $_GET["id"];

$query = $pdo->query("SELECT * FROM v_orden_interna WHERE eorin_cod_eorin='$id'");

$fetch = $query->fetch();

$pdf -> SetX(10);
$pdf->SetFont('Arial', '', 8);

$pdf->Cell(200, 6.5, utf8_decode("ORDEN N°: " . $fetch["eorin_cod_eorin"]), 0, 'C');
$pdf->Ln(4);

$pdf->Cell(50, 6.5, "FECHA: " . $fetch["eorin_fet_eorin"], 0, 'C');
$pdf->Ln(4);

$pdf->Cell(200, 6.5, utf8_decode("EMPLEADO: " . $fetch['empleado']), 0, 'C');
$pdf->Ln(4);
$pdf->Cell(50, 6.5, strtoupper(utf8_decode("ESTADO: " . $fetch['eorin_est_eorin'])), 0, 'C');
$pdf->Ln(4);


$pdf->Cell(200, 6.5, utf8_decode("EMITIDO POR : " . $fetch['eorin_emi_eorin']), 0, 'C');
$pdf->Ln(4);
$pdf->Cell(50, 6.5, "EQUIPO: " . $fetch["eequi_det_eequi"], 0, 'C');

$pdf->Ln(4);

$pdf -> SetX(10);
$pdf->Cell(260, 6.5, utf8_decode("DETALLE: " . $fetch['eorin_det_eorin']), 0, 'C');
$pdf->Ln(4);

if($fetch['eorin_est_eorin'] == "finalizado" || $fetch['eorin_est_eorin'] == "revisado"){
  $pdf->Cell(260, 6.5, utf8_decode("OBSERVACION: " . $fetch['eorin_obs_eorin']), 0, 'C');
}


$pdf->Ln(10);
$header = array('CODIGO', 'CANT', 'MATERIALES / REPUESTOS');
$pdf->TablaColores($header);

$repuesto = $pdo->query("SELECT * FROM v_repuestos WHERE doir_cod_doir='$id'");
$pdf->Ln();

if ($repuesto->rowCount() == 0) {
  $pdf->Cell(190, 6.5, utf8_decode('No ha solicitado repuestos'), 1, 'C');
}

while ($detail = $repuesto->fetch()) {
  $pdf->Cell(20, 6.5, $detail["einven_cod_einven"], 1, 'C');
  $pdf->Cell(20, 6.5, $detail["doir_cant_doir"], 1, 'C');
  $pdf->Cell(150, 6.5, utf8_decode($detail["einven_pro_einven"]), 1, 'C');
  $pdf->Ln();
}

$pdf->Ln('10');

$header1 = array('CODIGO', 'CANT', 'HERRAMIENTAS');
$pdf->TablaColores($header1);

$herramientas = $pdo->query("SELECT * FROM v_herramientas_orden WHERE doih_cod_doih='$id'");
$pdf->Ln();

if ($herramientas->rowCount() == 0) {
  $pdf->Cell(190, 6.5, utf8_decode('No ha solicitado herramientas'), 1, 'C');
}

while ($detail = $herramientas->fetch()) {
  $pdf->Cell(20, 6.5, $detail["eherr_cod_eherr"], 1, 'C');
  $pdf->Cell(20, 6.5, $detail["doih_cant_doih"], 1, 'C');
  $pdf->Cell(150, 6.5, utf8_decode($detail["eherr_det_eherr"]), 1, 'C');
  $pdf->Ln();

  // if ($setY > 80) {
  //   $setY = 0;
  //   $pdf->AddPage();
  // }

}

$pdf->Ln(50);



$pdf->Output();
?>
