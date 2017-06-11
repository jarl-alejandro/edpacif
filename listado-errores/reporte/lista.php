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
    $this->Text(110, 54, utf8_decode('LISTADO DE EQUIPO DAÑADO'));
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

    $w = array(100, 30, 80, 80);

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
$header = array('INFORME', 'CODIGO', 'EQUIPO', 'EMPLEADO');

$pdf -> SetX(5);
$pdf->SetFont('Arial', '',12);
$pdf->TablaColores($header);

$query = $pdo->query("SELECT * FROM view_report_faild");

while ($row = $query->fetch()) {

  $pdf -> SetX(5);
  $pdf->SetFont('Arial', '',9);

  $pdf->Cell(100, 6.5, utf8_decode($row["erepo_det_erepo"]), 1, 'C');
  $pdf->Cell(30, 6.5, utf8_decode($row["erepo_equi_erepo"]), 1, 'C');
  $pdf->Cell(80, 6.5, utf8_decode($row['eequi_det_eequi']), 1, 'C');
  $pdf->Cell(80, 6.5, utf8_decode($row['empleado']), 1, 'C');

  $pdf->Ln();
}

$pdf->Ln();

$pdf->Output();
?>
