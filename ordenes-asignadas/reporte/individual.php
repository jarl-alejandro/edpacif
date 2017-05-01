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
    $this->Text(110, 54, 'ORDEN DE TRABAJO INTERNA');
    $this->Ln(25);
  }

  function TablaColores($header) {
    $this->SetFillColor(192, 192, 192);
    $this->SetTextColor(255);
    $this->SetLineWidth(.3);
    $this->SetFont('Arial', 'B');

    $w = array(20, 100);

    for ($i = 0; $i < count($header); $i++)
      $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);

    // $this->Ln();

    $this->SetTextColor(0);

    $this->SetFont('Times');
  }

  function Footer() {

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

$pdf->SetFont('Arial', '',12);

$id = $_GET["id"];

$query = $pdo->query("SELECT * FROM v_orden_interna WHERE eorin_cod_eorin='$id'");

$fetch = $query->fetch();

$pdf -> SetX(10);
$pdf->SetFont('Arial', '',10);

$pdf->Cell(200, 6.5, utf8_decode("ORDEN N°: " . $fetch["eorin_cod_eorin"]), 0, 'C');
$pdf->Cell(50, 6.5, "FECHA: " . $fetch["eorin_fet_eorin"], 0, 'C');
$pdf->Ln();

$pdf->Cell(200, 6.5, utf8_decode("EMPLEADO: " . $fetch['empleado']), 0, 'C');
$pdf->Cell(50, 6.5, strtoupper(utf8_decode("ESTADO: " . $fetch['eorin_est_eorin'])), 0, 'C');
$pdf->Ln();


$pdf->Cell(200, 6.5, utf8_decode("EMITIDO POR : " . $fetch['eorin_emi_eorin']), 0, 'C');
$pdf->Cell(50, 6.5, "EQUIPO: " . $fetch["eequi_det_eequi"], 0, 'C');

$pdf->Ln();

$pdf -> SetX(10);
$pdf->Cell(260, 6.5, utf8_decode("DETALLE: " . $fetch['eorin_det_eorin']), 0, 'C');
$pdf->Ln();

if($fetch['eorin_est_eorin'] == "finalizado" || $fetch['eorin_est_eorin'] == "revisado"){
  $pdf->Cell(260, 6.5, utf8_decode("OBSERVACION: " . $fetch['eorin_obs_eorin']), 0, 'C');
}

$setY = 75;

$pdf->Ln(10);
// $header = array('CODIGO', 'DETALLE');
// $pdf->TablaColores($header);

// $repuesto = $pdo->query("SELECT * FROM v_repuestos WHERE doir_cod_doir='$id'");
// $pdf->Ln();

// while ($detail = $repuesto->fetch()) {
//   $pdf->Cell(20, 6.5, $detail["einven_cod_einven"], 1, 'C');
//   $pdf->Cell(100, 6.5, utf8_decode($detail["einven_pro_einven"]), 1, 'C');
//   $pdf->Ln();
// }
// $setY = 101;
// $pdf->SetY(101);
// $pdf->SetX(160);
// $header1 = array('CANT', 'HERRAMIENTAS');
// $pdf->TablaColores($header1);

// $herramientas = $pdo->query("SELECT * FROM v_herramientas_orden WHERE doih_cod_doih='$id'");
// $pdf->Ln();

// while ($detail = $herramientas->fetch()) {
//   $pdf -> SetX(160);  
//   $setY = $setY + 20;
//   $pdf->Cell(20, 6.5, $detail["doih_cant_doih"], 1, 'C');
//   $pdf->Cell(100, 6.5, utf8_decode($detail["eherr_det_eherr"]), 1, 'C');
//   $pdf->Ln();
// }
// // $pdf->Ln(17);
// // FECHAS Y HORAS
// $pdf->SetY($setY);

// $pdf->Cell(40, 7, "FECHA INICIAL", 1, 0, 'C', true);
// $pdf->Cell(20, 7, "HORA", 1, 0, 'C', true);

// $fechaInicio = $pdo->query("SELECT * FROM sgmedofi WHERE dofi_cod_dofi='$id'");
// $pdf->Ln();

// $fechasInicio = array();
// $fechasFinal = array();

// while ($detail = $fechaInicio->fetch()) {
//   $fecha = $detail["dofi_fet_dofi"] . " " . $detail["dofi_hor_dofi"];
//   $datetime1 = new DateTime($fecha);
//   $fechasInicio[] = $datetime1;

//   $pdf->Cell(40, 6.5, utf8_decode($detail["dofi_fet_dofi"]), 1, 'C');
//   $pdf->Cell(20, 6.5, $detail["dofi_hor_dofi"], 1, 'C');
//   $pdf->Ln();
// }

// $pdf->SetY($setY);

// $pdf->SetX(90);
// $pdf->Cell(40, 7, "FECHA FINAL", 1, 0, 'C', true);
// $pdf->Cell(20, 7, "HORA", 1, 0, 'C', true);

// $fechaFinal = $pdo->query("SELECT * FROM sgmedoff WHERE doff_cod_doff='$id'");
// $pdf->Ln();

// while ($detail = $fechaFinal->fetch()) {
//   $pdf -> SetX(90);  
//   $fechaend = $detail["doff_fet_doff"] . " " . $detail["doff_hor_doff"];
//   $datetimeEnd = new DateTime($fechaend);
//   $fechasFinal[] = $datetimeEnd;

//   $pdf->Cell(40, 6.5, utf8_decode($detail["doff_fet_doff"]), 1, 'C');
//   $pdf->Cell(20, 6.5, $detail["doff_hor_doff"], 1, 'C');
//   $pdf->Ln();
// }
// $pdf->Ln(10);


// $pdf->SetY(131);
// $pdf->SetY($setY);

// $pdf->SetX(160);
// $pdf->Cell(40, 7, "HORAS", 1, 0, 'C', true);
// $pdf->Cell(40, 7, "COSTO UNITARIO", 1, 0, 'C', true);
// $pdf->Cell(40, 7, "COSTO TOTAL", 1, 0, 'C', true);

// $herramientas = $pdo->query("SELECT * FROM sgmedoff WHERE doff_cod_doff='$id'");
// $pdf->Ln();

// $sueldo = $fetch["eempl_suel_eempl"];
// $diasMes = 30;

// $valorHora = $sueldo/$diasMes;
// $subtotal = 0;

// for ($i=0; $i < count($fechasInicio); $i++) { 
//   $dateStart = $fechasInicio[$i];
//   $dateEnd = $fechasFinal[$i];

//   $dteDiff  = $dateStart->diff($dateEnd);   
//   $format = $dteDiff->format("%I"); 
//   $formatPresent = $dteDiff->format("%H:%I:%S"); 

//   $priceHoras = number_format(($format * $valorHora) / 24, 2);

//   $subtotal = $subtotal + $priceHoras;

//   $pdf->SetX(160);
//   $pdf->Cell(40, 6.5, $formatPresent, 1, 'C');
//   $pdf->Cell(40, 6.5, $priceHoras, 1, 'C');
//   $pdf->Cell(40, 6.5, $priceHoras, 1, 'C');
//   $pdf->Ln();
// }

// $pdf->setX(200);
// $pdf->Cell(40, 6.5, "SUBTOTAL", 1, 'C');
// $pdf->Cell(40, 6.5, number_format($subtotal, 2), 1, 'C');
// $pdf->Ln();

// $iva = $subtotal * 0.14;
// $pdf->setX(200);
// $pdf->Cell(40, 6.5, "IVA 14%", 1, 'C');
// $pdf->Cell(40, 6.5, number_format($iva, 2), 1, 'C');
// $pdf->Ln();

// $total = $iva + $subtotal;
// $pdf->setX(200);
// $pdf->Cell(40, 6.5, "TOTAL", 1, 'C');
// $pdf->Cell(40, 6.5, number_format($total, 2), 1, 'C');
// $pdf->Ln();

// $pdf->SetDash(1,1);
// $pdf->Line(50,160,15,160);
// $pdf->Cell(40, 6.5, "Firma Empleado", 0, 0, 'C');

// $pdf->setX(65);
// $pdf->Line(70,160, 110,160);
// $pdf->Cell(50, 6.5, "Supervisor", 0, 0, 'C');

// $pdf->setX(120);
// $pdf->Line(120,160, 180, 160);
// $pdf->Cell(60, 6.5, "Jefe Mantenimiento", 0, 0, 'C');


$pdf->Output();
?>
