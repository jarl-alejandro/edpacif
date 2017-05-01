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
    $this->Text(110, 54, 'LISTADO DE PEDIDOS');
    $this->Ln(25);
  }

  function TablaColores($header) {
    $this->SetFillColor(192, 192, 192);
    $this->SetTextColor(255);
    $this->SetLineWidth(.3);
    $this->SetFont('Arial', 'B');

    $w = array(25, 150);

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
$pdf->SetFont('Arial', '',12);

$id = $_GET["id"];

$query = $pdo->query("SELECT * FROM sgmemape
        WHERE eped_cod_eped='$id'");

$row = $query->fetch();

$pdf->SetX(20);
$pdf->SetFont('Arial', '',10);

$header = array('CODIGO', 'DETALLE');

$pdf->TablaColores($header);
$pdf->SetFont('Arial', '',10);
$pdf->SetX(20);

$pdf->Cell(25, 7, $row["eped_cod_eped"], 1, 'C');
$pdf->Cell(150, 7, utf8_decode($row['eped_fec_eped']), 1, 'C');

$pdf->Ln(20);
$pdf->SetX(50);
$pdf->SetTextColor(255);

$pdf->Cell(25, 7, "ID", 1, 0, 'C', true);
$pdf->Cell(100, 7, "DETALLE", 1, 0, 'C', true);
$pdf->Ln();

$detalle = $pdo->query("SELECT * FROM sgmepedi
            WHERE epedi_cod_epedi='$id'");

$index = 0;

while ($row = $detalle->fetch()) {
  $index++;
  $pdf->SetTextColor(0);
  $pdf->SetX(50);
  $pdf->SetFont('Arial', '',10);

  $pdf->Cell(25, 6.5, $index, 1, 'C');
  $pdf->Cell(100, 6.5, utf8_decode($row["epedi_nom_epedi"]), 1, 'C');

  $pdf->Ln();
}
$pdf->Ln();

$pdf->Output();
?>
