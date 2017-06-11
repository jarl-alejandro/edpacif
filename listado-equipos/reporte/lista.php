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
    $this->Text(110, 54, 'LISTADO DE EQUIPOS');
    $this->Ln(25);

  }

  function TablaColores($header) {
    $this->SetFillColor(192, 192, 192);
    $this->SetTextColor(255);
    $this->SetLineWidth(.3);
    $this->SetFont('Arial', 'B');

    $w = array(30, 30, 150, 50);

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
$header = array('#', 'FECHA', 'EQUIPO', 'ESTADO');

$pdf -> SetX(15);
$pdf->SetFont('Arial', '',12);
$pdf->TablaColores($header);

$query = $pdo->query("SELECT * FROM v_orden_interna");
$index = 0;
while ($row = $query->fetch()) {
  $index++;

  $pdf->SetX(15);
  $pdf->SetFont('Arial', '',10);

  $pdf->Cell(30, 6.5, $index, 1, 'C');
  $pdf->Cell(30, 6.5, $row["eorin_fet_eorin"], 1, 'C');
  $pdf->Cell(150, 6.5, utf8_decode($row['eequi_det_eequi']), 1, 'C');

  if ($row["eorin_est_eorin"] == "asignado" || $row["eorin_est_eorin"] == "pedido") {
    $pdf->Cell(50, 6.5, "PENDIENTE", 1, 'C');
  }
  if ($row["eorin_est_eorin"] == "autorizado" || $row["eorin_est_eorin"] == "visto") {
    $pdf->Cell(50, 6.5, "MANTENIMIENTO", 1, 'C');
  }
  if ($row["eorin_est_eorin"] == "revisado" || $row["eorin_est_eorin"] == "finalizado") {
    $pdf->Cell(50, 6.5, "REALIZADO", 1, 'C');
  }
  $pdf->Ln();
}
$pdf->Ln();

$pdf->Output();
?>
