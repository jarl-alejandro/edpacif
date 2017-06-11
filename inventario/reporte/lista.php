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
    $this->SetFont('Arial', '', 10);
    $fecha = date("Y/m/d");
    $hora = date("H:i");
    $empleado = $_SESSION["f9f011a553550aef31a8ee2690e1d1b5f261c9ff"];

    $this->Text(20, 48, "FECHA DE IMPRESION: $fecha");

    $this->Text(80, 48, "HORA: $hora");
    $this->Text(110, 48, "EMPLEADO: $empleado");
    $this->Ln(10);

    $this->SetFont('Arial', 'B', 15);
    $this->Text(110, 54, 'LISTADO DE INVENTARIOS');
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

    $w = array(30, 120, 40, 20, 20, 20, 20, 20);

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

$pdf->setX(4);
$header = array('CODIGO', 'DETALLE', 'BODEGA','CANT', 'MAX', 'MIN', 'COSTO', 'TOTAL');
$pdf->SetFont('Arial', '',12);
$pdf->TablaColores($header);

$query = $pdo->query("SELECT * FROM v_inventario");

$index = 0;
$pdf->SetFont('Arial', '',10);
$Y_Table_Position = 0;
$altoY = 6.5;

while ($row = $query->fetch()) {
	$pdf->setX(4);
  $alto = 6.5;
  $pdf->SetFont('Arial', '', 7);

  $pdf->Cell(30, $alto, $row["einven_cod_einven"], 1, 'L');
  $pdf->Cell(120, $alto, utf8_decode($row["einven_pro_einven"]), 1, 'C');
  $pdf->Cell(40, $alto, utf8_decode($row['ebod_det_ebod']), 1, 'C');
  $pdf->Cell(20, $alto, utf8_decode($row['einven_cant_einven']), 1, 'C');
  $pdf->Cell(20, $alto, utf8_decode($row['einven_max_einven']), 1, 'C');
  $pdf->Cell(20, $alto, utf8_decode($row['einven_min_einven']), 1, 'C');
  $pdf->Cell(20, $alto, utf8_decode($row['einven_cos_einven']), 1, 'C');
  $pdf->Cell(20, $alto, $row['einven_cant_einven'] * $row['einven_cos_einven'], 1, 'C');

  $pdf->Ln();

}
$pdf->Ln();



$pdf->Output();
?>
