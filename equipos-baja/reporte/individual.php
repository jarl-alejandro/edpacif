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
$pdf->SetFont('Arial', '',12);

$id = $_GET["id"];

$query = $pdo->query("SELECT * FROM v_equipo
        WHERE eequi_cod_eequi='$id'");

$row = $query->fetch();

$pdf->SetX(10);
$pdf->SetFont('Arial', '',10);

$header = array('CODIGO', 'EQUIPO', 'SUB AREA', 'PROVEDOOR', 'IMAGEN');

$pdf->TablaColores($header);
$pdf->SetFont('Arial', '',10);
$pdf->SetX(10);

$pdf->Cell(25, 16, $row["eequi_cod_eequi"], 1, 'C');
$pdf->Cell(80, 16, utf8_decode($row['eequi_det_eequi']), 1, 'C');
$pdf->Cell(80, 16, utf8_decode($row["subare_det_subare"]), 1, 'C');
$pdf->Cell(40, 16, strtoupper($row['eequi_prov_eequi']), 1, 'C');
$pdf->Cell(50, 16, $pdf->Image("../../media/equipos/".$row["eequi_ima_eequi"],
            $pdf->GetX(), $pdf->GetY(), 50, 16), 1,0,'R');

$pdf->Ln(40);
$pdf->SetX(50);
$pdf->SetTextColor(255);

$pdf->Cell(25, 7, "CANT", 1, 0, 'C', true);
$pdf->Cell(100, 7, "DETALLE", 1, 0, 'C', true);
$pdf->Cell(25, 7, "VALOR", 1, 0, 'C', true);
$pdf->Cell(25, 7, "TOTAL", 1, 0, 'C', true);
$pdf->Ln();

$detalle = $pdo->query("SELECT * FROM v_detalle_equipo
            WHERE edequ_cod_edequ='$id'");


while ($row = $detalle->fetch()) {
  $pdf->SetTextColor(0);
  $pdf->SetX(50);
  $pdf->SetFont('Arial', '',10);

  $pdf->Cell(25, 6.5, $row["edequ_cant_edequ"], 1, 'C');
  $pdf->Cell(100, 6.5, utf8_decode($row["einven_pro_einven"]), 1, 'C');
  $pdf->Cell(25, 6.5, $row['einven_cos_einven'], 1, 'C');
  $pdf->Cell(25, 6.5, $row['edequ_tot_edequ'], 1, 'C');

  $pdf->Ln();
}
$pdf->Ln();

$pdf->Output();
?>
