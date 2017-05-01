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
    $this->Text(110, 54, 'LISTADO DE TAREAS');
    $this->Ln(25);

  }

  function TablaColores($header) {
    $this->SetFillColor(192, 192, 192);
    $this->SetTextColor(255);
    $this->SetLineWidth(.3);
    $this->SetFont('Arial', 'B');

    $w = array(30, 30, 100, 100);

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
$header = array('#', 'CODIGO', 'EMPLEADO', 'DETALLE');

$pdf -> SetX(10);
$pdf->SetFont('Arial', '',12);
$pdf->TablaColores($header);

if( !isset($_GET["inicio"]) ) {
  $query = $pdo->query("SELECT * FROM v_tarea");
}
else{
  $inicio = $_GET["inicio"];
  $fin = $_GET["fin"];

  $query = $pdo->query("SELECT * FROM v_tarea WHERE etare_fet_etare BETWEEN '$inicio' AND '$fin'");  
}

$count = 0;

while ($row = $query->fetch()) {
  $count++;
  $pdf -> SetX(10);
  $pdf->SetFont('Arial', '',10);

  $pdf->Cell(30, 6.5, $count, 1, 0, 'C');
  $pdf->Cell(30, 6.5, utf8_decode($row['etare_cod_etare']), 1, 'C');
  $pdf->Cell(100, 6.5, utf8_decode($row['empleado']), 1, 'C');
  $pdf->Cell(100, 6.5, utf8_decode($row['ltare_det_ltare']), 1, 'C');

  $pdf->Ln();
}
$pdf->Ln();

$pdf->Output();
?>
