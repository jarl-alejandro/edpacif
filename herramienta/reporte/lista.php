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
    $this->Text(110, 54, 'LISTADO DE HERRAMIENTAS');
    $this->SetFont('Arial', '', 10);
    $fecha = date("Y/m/d");
    $hora = date("H:i");
    $empleado = $_SESSION["f9f011a553550aef31a8ee2690e1d1b5f261c9ff"];

    $this->Text(20, 48, "FECHA DE IMPRESION: $fecha");

    $this->Text(80, 48, "HORA: $hora");
    $this->Text(110, 48, "EMPLEADO: $empleado");
    $this->Ln(10);

    $this->SetFont('Arial', 'B', 15);
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

    $w = array(30, 87, 87, 20, 20, 20, 20);

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
$header = array('CODIGO', 'DETALLE', 'BODEGA','CANT', 'MAX', 'MIN', 'COSTO');

$pdf->SetX(5);
$pdf->SetFont('Arial', '',12);
$pdf->TablaColores($header);

$query = $pdo->query("SELECT * FROM v_herrmientas");

while ($row = $query->fetch()) {

  $pdf -> SetX(5);
  $pdf->SetFont('Arial', '', 7);

  $pdf->Cell(30, 6.5, $row["eherr_cod_eherr"], 1, 'C');
  $pdf->Cell(87, 6.5, utf8_decode($row["eherr_det_eherr"]), 1, 'C');
  $pdf->Cell(87, 6.5, utf8_decode($row['ebod_det_ebod']), 1, 'C');
  $pdf->Cell(20, 6.5, utf8_decode($row['eherr_cant_eherr']), 1, 'C');
  $pdf->Cell(20, 6.5, utf8_decode($row['eherr_max_eherr']), 1, 'C');
  $pdf->Cell(20, 6.5, utf8_decode($row['eherr_min_eherr']), 1, 'C');
  $pdf->Cell(20, 6.5, utf8_decode($row['eherr_cos_eherr']), 1, 'C');

  $pdf->Ln();
}
$pdf->Ln();

$pdf->Output();
?>
