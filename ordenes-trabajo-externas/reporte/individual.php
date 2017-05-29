<?php
session_start();
date_default_timezone_set('America/Guayaquil');

require('fpdf.php');
include "../../conexion/conexion.php";



class PDF extends FPDF {

  function Header() {
    $this->Image('../../assets/img/logo.png', 0, 0, 300, 42);

    $impr = false;

    if(isset($_GET["impr"]) ){
      $impr = true;
    }

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
    if ($impr == true)
      $this->Text(85, 60, 'ORDEN DE TRABAJO EXTERNA REIMPRESO');
    else
      $this->Text(108, 60, 'ORDEN DE TRABAJO EXTERNA');
    $this->Ln(25);
  }

  function TablaColores($header) {
    $this->SetFillColor(192, 192, 192);
    $this->SetTextColor(255);
    $this->SetLineWidth(.3);
    $this->SetFont('Arial', 'B');

    $w = array(20, 20, 100, 30, 20);

    for ($i = 0; $i < count($header); $i++)
      $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);

    // $this->Ln();

    $this->SetTextColor(0);

    $this->SetFont('Times');
  }

  function Footer() {
    $this->SetY(-30);

    $this->SetDash(1,1);

    $this->setX(85);
    $this->Line(90, 180, 130, 180);
    $this->Cell(50, 6.5, "Supervisor", 0, 0, 'C');

    $this->setX(160);
    $this->Line(160, 180, 215, 180);
    $this->Cell(60, 6.5, "Jefe Mantenimiento", 0, 0, 'C');

    $this->SetY(-15);
    $this->SetFont('Arial', 'I', 8);
    $this->Cell(0, 10, utf8_decode('Página ' . $this->PageNo() . '/Edpacif'), 0, 0, 'C');
  }

   function SetDash($black=false, $white=false) {
    if($black and $white)
      $s=sprintf('[%.3f %.3f] 0 d', $black*$this->k, $white*$this->k);
    else
      $s='[] 0 d';
    $this->_out($s);
  }

}

$pdf = new PDF("L");
$pdf->AddPage();
$pdf->SetY(65);
$pdf->SetFont('Arial', '', 8);

$id = $_GET["id"];

$query = $pdo->query("SELECT * FROM v_externa
  JOIN sgmeinfe ON eequi_cod_eequi=einfe_equi_infe
  WHERE eorex_cod_eorex='$id'");

$fetch = $query->fetch();

$pdf->SetX(10);
$pdf->SetFont('Arial', '',10);

$pdf->Cell(50, 6.5, utf8_decode("ORDEN DE TRABAJO N°. "), 1, 'C');
$pdf->Cell(50, 6.5, $fetch["eorex_cod_eorex"], 1, 'C');

$pdf->SetX(140);

$pdf->Cell(50, 6.5, "FECHA EMISION", 1, 'C');
$pdf->Cell(50, 6.5, $fetch["eorex_fet_eorex"], 1, 'C');

$pdf->Ln();

$pdf->Cell(50, 6.5, utf8_decode("PROVEEDOR"), 1, 'C');
$pdf->Cell(50, 6.5, utf8_decode($fetch['eprov_nom_eprov']), 1, 'C');

$pdf->SetX(140);

$pdf->Cell(50, 6.5, utf8_decode("SUBÀREA"), 1, 'C');
$pdf->Cell(50, 6.5, utf8_decode($fetch['subare_det_subare']), 1, 'C');

$pdf->Ln();

$pdf->Cell(50, 6.5, "TELEFONO", 1, 'C');
$pdf->Cell(50, 6.5, $fetch['eprov_tel_eprov'], 1, 'C');

$pdf->SetX(140);

$pdf->Cell(50, 6.5, utf8_decode("EQUIPO"), 1, 'C');
$pdf->Cell(50, 6.5, utf8_decode($fetch['eequi_det_eequi']), 1, 'C');

$pdf->Ln();

$pdf->Cell(50, 6.5, utf8_decode("EMPLEADO"), 1, 'C');
$pdf->Cell(50, 6.5, utf8_decode($fetch['eorex_emi_eorex']), 1, 'C');

$pdf->SetX(140);

$pdf->Cell(50, 6.5, utf8_decode("SERIE DE EQUIPO"), 1, 'C');
$pdf->Cell(50, 6.5, utf8_decode($fetch['einfe_ser_infe']), 1, 'C');

$pdf->Ln();

if($fetch['eorex_est_eorex'] == 'terminar') {
  $pdf->SetX(140);

  $pdf->Cell(50, 6.5, utf8_decode("FECHA DE RECEPCION"), 1, 'C');
  $pdf->Cell(50, 6.5, utf8_decode($fetch['eorex_ffe_eorex']), 1, 'C');
  $pdf->Ln();
  $pdf->SetX(140);

  $pdf->Cell(50, 6.5, utf8_decode("COSTO DE REPARACION"), 1, 'C');
  $pdf->Cell(50, 6.5, utf8_decode($fetch['eorex_cos_eorex']), 1, 'C');
}

$pdf->Ln();

$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(50, 6.5, "DETALLE DE MANTENIENTO", 0, 'C');
$pdf->Ln(6);

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(200, 6.5, utf8_decode($fetch['eorex_det_eorex']), 0, 'C');


$pdf->Output();
?>
