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
    $this->Text(110, 54, 'LISTADO DE EMPLEADOS');
    $this->Ln(25);

    if ($this->PageNo() > 1) {
      $this->Ln(30);
    }

  }

  function TablaColores($header) {
    $this->SetFillColor(192, 192, 192);
    $this->SetTextColor(255);
    $this->SetLineWidth(.3);
    $this->SetFont('Arial', 'B');

    $w = array(30, 150, 100);

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

$pdf -> SetY(65);
$header = array('CEDULA', 'EMPLEADO', 'E-MAIL');

$pdf -> SetX(5);
$pdf->SetFont('Arial', '',12);
$pdf->TablaColores($header);

$query = $pdo->query("SELECT * FROM sgmeempl");

while ($row = $query->fetch()) {

  $pdf -> SetX(5);
  $pdf->SetFont('Arial', '',9);

  $pdf->Cell(30, 6.5, $row["eempl_ced_eempl"], 1, 'C');
  $pdf->Cell(150, 6.5, utf8_decode($row["eempl_nom_eempl"]." ".$row["eempl_ape_eempl"]), 1, 'C');
  $pdf->Cell(100, 6.5, utf8_decode($row['eempl_mai_eempl']), 1, 'C');

  $pdf->Ln();
}

$pdf->Ln();

$pdf->Output();
?>
