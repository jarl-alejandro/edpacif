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
    $this->Text(110, 54, 'LISTADO DE INVENTARIOS');
    $this->Ln(25);
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
$pdf->SetFont('Arial', '',12);

$id = $_GET["id"];

$query = $pdo->query("SELECT * FROM v_inventario
        WHERE einven_cod_einven='$id'");

$row = $query->fetch();

$pdf->SetX(5);
$pdf->SetFont('Arial', '',10);
$header = array('CODIGO', 'DETALLE', 'BODEGA','CANT', 'MAX', 'MIN', 'COSTO');

$pdf->TablaColores($header);
$pdf->SetFont('Arial', '',10);
$pdf->SetX(5);

$pdf->Cell(30, 6.5, $row["einven_cod_einven"], 1, 'C');
$pdf->Cell(87, 6.5, utf8_decode($row["einven_pro_einven"]), 1, 'C');
$pdf->Cell(87, 6.5, utf8_decode($row['ebod_det_ebod']), 1, 'C');
$pdf->Cell(20, 6.5, utf8_decode($row['einven_cant_einven']), 1, 'C');
$pdf->Cell(20, 6.5, utf8_decode($row['einven_max_einven']), 1, 'C');
$pdf->Cell(20, 6.5, utf8_decode($row['einven_min_einven']), 1, 'C');
$pdf->Cell(20, 6.5, utf8_decode($row['einven_cos_einven']), 1, 'C');

$pdf->Output();
?>
