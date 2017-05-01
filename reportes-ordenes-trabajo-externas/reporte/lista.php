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
    $this->Text(90, 54, 'LISTADO DE ORDENES DE TRABAJO EXTERNA');
    $this->Ln(25);

  }

  function TablaColores($header) {
    $this->SetFillColor(192, 192, 192);
    $this->SetTextColor(255);
    $this->SetLineWidth(.3);
    $this->SetFont('Arial', 'B', 10);

    $w = array(20, 20, 20, 20, 100, 100);

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
$header = array('CODIGO', 'FECHA', 'ENTREGA', 'COSTO', 'EQUIPO', 'PROVEEDOR');

$pdf -> SetX(5);
$pdf->SetFont('Arial', '',12);
$pdf->TablaColores($header);

if( !isset($_GET["inicio"]) ) {
  $query = $pdo->query("SELECT * FROM v_externa");
}
else{
  $inicio = $_GET["inicio"];
  $fin = $_GET["fin"];

  $query = $pdo->query("SELECT * FROM v_externa WHERE eorex_fet_eorex BETWEEN '$inicio' AND '$fin'");  
}

while ($row = $query->fetch()) {


  $pdf -> SetX(5);
  $pdf->SetFont('Arial', '', 9);

  $pdf->Cell(20, 6.5, $row["eorex_cod_eorex"], 1, 'C');
  $pdf->Cell(20, 6.5, $row["eorex_fet_eorex"], 1, 'C');
  $pdf->Cell(20, 6.5, utf8_decode($row['eorex_ffe_eorex']), 1, 'C');
  $pdf->Cell(20, 6.5, utf8_decode($row['eorex_cos_eorex']), 1, 'C');
  $pdf->Cell(100, 6.5, utf8_decode($row['eequi_det_eequi']), 1, 'C');
  $pdf->Cell(100, 6.5, utf8_decode($row['eprov_nom_eprov']), 1, 'C');

  $pdf->Ln();
}
$pdf->Ln();

$pdf->Output();
?>
