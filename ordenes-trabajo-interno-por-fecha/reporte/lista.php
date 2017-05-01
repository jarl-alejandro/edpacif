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
    $this->Text(110, 54, 'LISTADO DE ORDENES DE TRABAJO INTERNA POR FECHA');
    $this->Ln(25);

  }

  function TablaColores($header) {
    $this->SetFillColor(192, 192, 192);
    $this->SetTextColor(255);
    $this->SetLineWidth(.3);
    $this->SetFont('Arial', 'B');

    $w = array(30, 30, 100, 50, 70); 

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
$header = array('CODIGO', 'FECHA', 'DESCRIPCION', 'CODIGO EQUIPO', 'EQUIPO');

$pdf -> SetX(5);
$pdf->SetFont('Arial', '',12);
$pdf->TablaColores($header);

if( !isset($_GET["inicio"]) ) {
  $query = $pdo->query("SELECT * FROM v_orden_interna");
}
else{
  $inicio = $_GET["inicio"];
  $fin = $_GET["fin"];
  $empleado = $_GET["empleado"];

  if($empleado == ""){
    $query = $pdo->query("SELECT * FROM v_orden_interna WHERE eorin_fet_eorin 
                            BETWEEN '$inicio' AND '$fin'");  
  }
  else {
    $query = $pdo->query("SELECT * FROM v_orden_interna WHERE eorin_fet_eorin 
          BETWEEN '$inicio' AND '$fin' AND eempl_ced_eempl='$empleado'");      
  }
}

while ($row = $query->fetch()) {


  $pdf -> SetX(5);
  $pdf->SetFont('Arial', '',10);

  $pdf->Cell(30, 6.5, $row["eorin_cod_eorin"], 1, 'C');
  $pdf->Cell(30, 6.5, $row["eorin_fet_eorin"], 1, 'C');
  $pdf->Cell(100, 6.5, utf8_decode($row['eorin_det_eorin']), 1, 'C');
  $pdf->Cell(50, 6.5, utf8_decode($row['eorin_equ_eorin']), 1, 'C');
  $pdf->Cell(70, 6.5, utf8_decode($row['eequi_det_eequi']), 1, 'C');

  $pdf->Ln();
}
$pdf->Ln();

$pdf->Output();
?>
