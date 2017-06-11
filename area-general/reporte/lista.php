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
    $this->Text(110, 54, 'LISTADO DE AREA GENERAL');
    $this->Ln(25);

  }

  function TablaColores($header) {
    $this->SetFillColor(192, 192, 192);
    $this->SetTextColor(255);
    $this->SetLineWidth(.3);
    $this->SetFont('Arial', 'B');

    $w = array(30, 150, 60);

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
$header = array('CODIGO', 'AREA GENERAL', 'DEPENDE DEL AGUAJE');

$pdf->SetX(30);
$pdf->SetFont('Arial', '', 12);
$pdf->TablaColores($header);

$query = $pdo->query("SELECT * FROM sgmearege ORDER BY earege_cod_earege ASC");

while ($row = $query->fetch()) {

  $pdf->SetX(30);
  $pdf->SetFont('Arial', '',10);

  $pdf->Cell(30, 6.5, $row["earege_cod_earege"], 1, 0, 'C');
  $pdf->Cell(150, 6.5, utf8_decode($row['earege_det_earege']), 1, 'C');
  if($row["earege_agu_earege"] == true)
    $pdf->Cell(60, 6.5, 'SI', 1, 0, 'C');
  else
    $pdf->Cell(60, 6.5, 'NO', 1, 0, 'C');

  $pdf->Ln();
}
$pdf->Ln();

$pdf->Output();
?>
