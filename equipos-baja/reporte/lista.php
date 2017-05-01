<?php
session_start();

require('fpdf.php');
include "../../conexion/conexion.php";

date_default_timezone_set('America/Guayaquil');

class PDF extends FPDF {

  function Header() {

    $this->Image('../../assets/img/logo.png', 15, 5, 270, 34);
    $this->SetFont('Arial', 'B', 15);
    $this->SetTextColor(0, 0, 0);
    $this->Ln(1);
    $this->Line(2, 42, 295, 42);
    $this->Text(110, 54, 'LISTADO DE EQUIPOS');
    $this->Ln(25);

  }

  function TablaColores($header) {
    $this->SetFillColor(192, 192, 192);
    $this->SetTextColor(255);
    $this->SetLineWidth(.3);
    $this->SetFont('Arial', 'B');
    
    $w = array(25, 80, 80, 40, 50);

    for ($i = 0; $i < count($header); $i++)
      $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);

    $this->Ln();

    $this->SetTextColor(0);

    $this->SetFont('Times');
  }

  function Footer() {

    $this->SetY(-15);
    $this->SetFont('Arial', 'I', 8);
    $this->Cell(0, 10, utf8_decode('Página ' . $this->PageNo() . '/Edpacif'), 0, 0, 'C');
  }

}

$pdf = new PDF("L");
$pdf->AddPage();

$pdf->SetY(65);
$header = array('CODIGO', 'EQUIPO', 'SUB AREA', 'PROVEDOOR', 'IMAGEN');

$pdf -> SetX(10);
$pdf->SetFont('Arial', '',12);
$pdf->TablaColores($header);

$query = $pdo->query("SELECT * FROM v_equipo WHERE eequi_baja_eequi='1'");

while ($row = $query->fetch()) {

  $pdf -> SetX(10);
  $pdf->SetFont('Arial', '',10);

  $pdf->Cell(25, 16, $row["eequi_cod_eequi"], 1, 'C');
  $pdf->Cell(80, 16, utf8_decode($row['eequi_det_eequi']), 1, 'C');
  $pdf->Cell(80, 16, utf8_decode($row["subare_det_subare"]), 1, 'C');
  $pdf->Cell(40, 16, strtoupper($row['eequi_prov_eequi']), 1, 'C');
  $pdf->Cell(50, 16, $pdf->Image("../../media/equipos/".$row["eequi_ima_eequi"],
              $pdf->GetX(), $pdf->GetY(), 50, 16), 1,0,'R');

  $pdf->Ln();
}
$pdf->Ln();

$pdf->Output();
?>
