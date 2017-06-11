<?php
session_start();

require('fpdf.php');
include "../conexion/conexion.php";


date_default_timezone_set('America/Guayaquil');

class PDF extends FPDF {

  function Header() {
    $this->Image('../assets/img/logo.png', 0, 0, 210, 42);
    include "../conexion/conexion.php";

    $tareaId = $_GET["id"];
    $taskQuery = $pdo->query("SELECT * FROM sgmetare WHERE etare_cod_etare='$tareaId'");
    $row = $taskQuery->fetch();
    $estado = $row['etare_esr_etare'];

    if($estado == 0) {
      $pdo->query("UPDATE sgmetare SET etare_esr_etare='1'
                    WHERE etare_cod_etare='$tareaId'");
    }

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
    if ($estado == 0) {
      $this->Text(68, 54, 'TAREAS MATERIALES');
    }
    else {
      $this->Text(68, 54, 'TAREAS MATERIALES REIMPRESO');
    }
    $this->Ln(25);
  }

  function TablaColores($header) {
    $this->SetFillColor(192, 192, 192);
    $this->SetTextColor(255);
    $this->SetLineWidth(.3);
    $this->SetFont('Arial', 'B');

    $w = array(20, 20, 150);

    for ($i = 0; $i < count($header); $i++)
      $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);

    // $this->Ln();

    $this->SetTextColor(0);

    $this->SetFont('Times');
  }

  function Footer() {
    $this->SetY(-30);

    $this->SetDash(1,1);
    // $this->Line(50, 235, 15, 235);

    $this->setX(45);
    $this->Line(90, 265, 40, 265);
    $this->Cell(40, 6.5, "Firma Empleado", 0, 0, 'C');

    $this->setX(105);
    $this->Line(105, 265, 150, 265);
    $this->Cell(50, 6.5, "Bodegero", 0, 0, 'C');

    // $this->setX(120);
    // $this->Line(120,160, 180, 160);
    // $this->Cell(60, 6.5, "Jefe Mantenimiento", 0, 0, 'C');

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

$pdf = new PDF();
$pdf->AddPage();

$pdf->SetY(65);

$pdf->SetFont('Arial', '',12);

$id = $_GET["id"];

$query = $pdo->query("SELECT * FROM v_tarea WHERE etare_cod_etare='$id'");

$fetch = $query->fetch();

$pdf -> SetX(10);
$pdf->SetFont('Arial', '', 8);

$pdf->Cell(200, 6.5, utf8_decode("TAREA N°: " . $fetch["etare_cod_etare"]), 0, 'C');
$pdf->Ln(4);

$pdf->Cell(50, 6.5, "FECHA: " . $fetch["etare_fet_etare"], 0, 'C');
$pdf->Ln(4);

$pdf->Cell(200, 6.5, utf8_decode("EMPLEADO: " . $fetch['empleado']), 0, 'C');
$pdf->Ln(4);
$pdf->Cell(50, 6.5, strtoupper(utf8_decode("ESTADO: " . $fetch['etare_est_etare'])), 0, 'C');
$pdf->Ln(4);


//$pdf->Cell(200, 6.5, utf8_decode("EMITIDO POR : " . $fetch['etare_emi_etare']), 0, 'C');
$pdf->Ln(4);
$pdf->Cell(50, 6.5, "EQUIPO: " . $fetch["eequi_det_eequi"], 0, 'C');

$pdf->Ln(4);

$pdf -> SetX(10);
$pdf->Cell(260, 6.5, utf8_decode("DETALLE: " . $fetch['ltare_det_ltare']), 0, 'C');
$pdf->Ln(4);

if($fetch['etare_est_etare'] == "finalizado" || $fetch['etare_est_etare'] == "revisado"){
  $pdf->Cell(260, 6.5, utf8_decode("OBSERVACION: " . $fetch['eorin_inf_eorin']), 0, 'C');
}


$pdf->Ln(10);
$header = array('CODIGO', 'CANT', 'HERRAMIENTAS');
$pdf->TablaColores($header);

$repuesto = $pdo->query("SELECT * FROM vista_herramienta_tarea WHERE herta_cod_herta='$id'");
$pdf->Ln();

if ($repuesto->rowCount() == 0) {
  $pdf->Cell(190, 6.5, utf8_decode('No ha solicitado herramientas'), 1, 'C');
}

while ($detail = $repuesto->fetch()) {
  $pdf->Cell(20, 6.5, $detail["eherr_cod_eherr"], 1, 'C');
  $pdf->Cell(20, 6.5, $detail["herta_cant_herta"], 1, 'C');
  $pdf->Cell(150, 6.5, utf8_decode($detail["eherr_det_eherr"]), 1, 'C');
  $pdf->Ln();
}

$pdf->Ln('10');

$header1 = array('CODIGO', 'CANT', 'MATERIALES / REPUESTOS');
$pdf->TablaColores($header1);

$herramientas = $pdo->query("SELECT * FROM vista_inventario_tareas WHERE repta_cod_repta='$id'");
$pdf->Ln();

if ($herramientas->rowCount() == 0) {
  $pdf->Cell(190, 6.5, utf8_decode('No ha solicitado materiales'), 1, 'C');
}

while ($detail = $herramientas->fetch()) {
  $pdf->Cell(20, 6.5, $detail["einven_cod_einven"], 1, 'C');
  $pdf->Cell(20, 6.5, $detail["repta_cant_repta"], 1, 'C');
  $pdf->Cell(150, 6.5, utf8_decode($detail["einven_pro_einven"]), 1, 'C');
  $pdf->Ln();

  // if ($setY > 80) {
  //   $setY = 0;
  //   $pdf->AddPage();
  // }

}

$pdf->Ln(50);



$pdf->Output();
?>
