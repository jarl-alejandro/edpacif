<?php
session_start();

require('fpdf.php');
include "../../conexion/conexion.php";

date_default_timezone_set('America/Guayaquil');

class PDF extends FPDF {

  function Header() {
    $this->Image('../../assets/img/logo.png', 0, 0, 210, 42);

    $this->SetFont('Arial', 'B', 15);
    $this->SetTextColor(0, 0, 0);
    $this->Ln(1);
    $this->Line(2, 42, 295, 42);
    $this->Text(100, 54, 'TAREA');
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
    $this->Line(50,265,15,265);
    $this->Cell(40, 6.5, "Firma Empleado", 0, 0, 'C');

    $this->setX(65);
    $this->Line(70,265, 110,265);
    $this->Cell(50, 6.5, "Supervisor", 0, 0, 'C');

    $this->setX(120);
    $this->Line(120,265, 180, 265);
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

$pdf = new PDF();
$pdf->AddPage();

$pdf->SetY(65);

$pdf->SetFont('Arial', '', 8);

$id = $_GET["id"];

$query = $pdo->query("SELECT * FROM v_tarea WHERE etare_cod_etare='$id'");

$fetch = $query->fetch();

$pdf -> SetX(10);
$pdf->SetFont('Arial', '',10);
$pdf->Cell(200, 6.5, utf8_decode("TAREA N°: " . $fetch["etare_cod_etare"]), 0, 'C');
$pdf->Ln(4);

$pdf->Cell(50, 6.5, "FECHA: " . $fetch["etare_fet_etare"], 0, 'C');
$pdf->Ln(4);

$pdf->Cell(200, 6.5, utf8_decode("EMPLEADO: " . $fetch['empleado']), 0, 'C');
$pdf->Ln(4);
$pdf->Cell(50, 6.5, strtoupper(utf8_decode("ESTADO: " . $fetch['etare_est_etare'])), 0, 'C');
$pdf->Ln(4);


$pdf->Cell(200, 6.5, utf8_decode("EMITIDO POR : " . $fetch['etare_emit_etare']), 0, 'C');
$pdf->Ln(4);
$pdf->Cell(50, 6.5, "EQUIPO: " . $fetch["eequi_det_eequi"], 0, 'C');

$pdf->Ln(4);

$pdf -> SetX(10);
$pdf->Cell(260, 6.5, utf8_decode("DETALLE: " . $fetch['ltare_det_ltare']), 0, 'C');
$pdf->Ln(4);

if($fetch['etare_est_etare'] == "finalizado" || $fetch['etare_est_etare'] == "revisado"){
  $pdf->Cell(260, 6.5, utf8_decode("INFORME: " . $fetch['etare_inf_etare']), 0, 'C');
}

$pdf->Ln(15);

$repuesto = $pdo->query("SELECT * FROM vista_inventario_tareas WHERE repta_cod_repta='$id'");

$fechaInicio = $pdo->query("SELECT * FROM sgmefein WHERE fein_cod_fein='$id'");

$fechaFinal = $pdo->query("SELECT * FROM sgmetaff WHERE taff_cod_taff='$id'");

if ($fechaFinal->rowCount() > 0) {

$header = array('CODIGO', 'CANT', 'DETALLE', 'PRECIO', 'TOTAL');
$pdf->TablaColores($header);

$pdf->Ln();

if($repuesto->rowCount() == 0) {
  $pdf->Cell(190, 6.5, utf8_decode('No a salicitado repuestos'), 1, 'C');
}

$total_repuestos = 0;

while ($detail = $repuesto->fetch()) {
  $suma = $detail["repta_cant_repta"] * $detail["repta_pric_repta"];
  $total_repuestos = $total_repuestos + $suma;

  $pdf->Cell(20, 6.5, $detail["einven_cod_einven"], 1, 'C');
  $pdf->Cell(20, 6.5, $detail["repta_cant_repta"], 1, 'C');
  $pdf->Cell(100, 6.5, utf8_decode($detail["einven_pro_einven"]), 1, 'C');
  $pdf->Cell(30, 6.5, $detail["repta_pric_repta"], 1, 'C');

  $pdf->Cell(20, 6.5, number_format($suma, 2), 1, 'C');

  $pdf->Ln();

}

$pdf->Ln(10);
$header1 = array('CODIGO', 'CANT', 'DETALLE', 'PRECIO', 'TOTAL');

$pdf->TablaColores($header1);

$herramientas = $pdo->query("SELECT * FROM vista_herramienta_tarea
                              WHERE herta_cod_herta='$id'");
$pdf->Ln();
$total_herramientas = 0;

if($herramientas->rowCount() == 0) {
  $pdf->Cell(190, 6.5, utf8_decode('No a salicitado herramientas'), 1, 'C');
}

while ($detail = $herramientas->fetch()) {
  $suma = $detail["herta_cant_herta"] * $detail["herta_pric_herta"];
  $total_herramientas = $total_herramientas + $suma;

  $pdf->Cell(20, 6.5, $detail["eherr_cod_eherr"], 1, 'C');
  $pdf->Cell(20, 6.5, $detail["herta_cant_herta"], 1, 'C');
  $pdf->Cell(100, 6.5, utf8_decode($detail["eherr_det_eherr"]), 1, 'C');
  $pdf->Cell(30, 6.5, $detail["herta_pric_herta"], 1, 'C');

  $pdf->Cell(20, 6.5, number_format($suma, 2), 1, 'C');
  $pdf->Ln();
}
$pdf->Ln(15);


$pdf->Cell(40, 7, "FECHA INICIAL", 1, 0, 'C', true);
$pdf->Cell(20, 7, "HORA", 1, 0, 'C', true);

$pdf->Cell(40, 7, "FECHA FINAL", 1, 0, 'C', true);
$pdf->Cell(20, 7, "HORA", 1, 0, 'C', true);

$pdf->Ln();

$fechasInicio = array();
$fechasFinal = array();

while ($detail = $fechaInicio->fetch()) {
  $fecha = $detail["fein_fet_fein"] . " " . $detail["fein_hor_fein"];
  $datetime1 = new DateTime($fecha);
  $fechasInicio[] = $datetime1;

  $pdf->Cell(40, 6.5, utf8_decode($detail["fein_fet_fein"]), 1, 'C');
  $pdf->Cell(20, 6.5, $detail["fein_hor_fein"], 1, 'C');
}

while ($detail = $fechaFinal->fetch()) {
  $fechaend = $detail["taff_fet_taff"] . " " . $detail["taff_hor_taff"];
  $datetimeEnd = new DateTime($fechaend);
  $fechasFinal[] = $datetimeEnd;

  $pdf->Cell(40, 6.5, utf8_decode($detail["taff_fet_taff"]), 1, 'C');
  $pdf->Cell(20, 6.5, $detail["taff_hor_taff"], 1, 'C');
  $pdf->Ln();
}
$pdf->Ln(10);



$pdf->Cell(40, 7, "DETALLES", 1, 0, 'C', true);
$pdf->Cell(40, 7, "COSTO", 1, 0, 'C', true);
$pdf->Cell(40, 7, "TOTAL", 1, 0, 'C', true);

//$herramientas = $pdo->query("SELECT * FROM sgmedoff WHERE doff_cod_doff='$id'");
$pdf->Ln();

$sueldo = $fetch["eempl_suel_eempl"];

$diasMes = 160 * 60;

$valorHora = $sueldo/$diasMes;

$subtotal = 0;


  for ($i=0; $i < count($fechasInicio); $i++) {
    $dateStart = $fechasInicio[$i];
    $dateEnd = $fechasFinal[$i];

    $dteDiff  = $dateStart->diff($dateEnd);
    $format = $dteDiff->format("%I");
    $formatPresent = $dteDiff->format("%H:%I:%S");

    $segundos = $dteDiff->format("%S");
    $minutos = $dteDiff->format("%I");
    $horas = $dteDiff->format("%H") * 60;

    $convert = ($horas + $minutos);

    $valorHoraWork = number_format($convert * $valorHora, 2);


    $pdf->Cell(40, 6.5, 'HORAS', 1, 'C');
    $pdf->Cell(40, 6.5, $formatPresent, 1, 'C');
    $pdf->Cell(40, 6.5, $valorHoraWork, 1, 'C');
    $pdf->Ln();

    $pdf->Cell(40, 6.5, 'REPUESTOS', 1, 'C');
    $pdf->Cell(40, 6.5, number_format($total_repuestos, 2), 1, 'C');
    $pdf->Cell(40, 6.5, number_format($total_repuestos, 2), 1, 'C');
    $pdf->Ln();

    $pdf->Cell(40, 6.5, 'HERRAMIETAS', 1, 'C');
    $pdf->Cell(40, 6.5, number_format($total_herramientas, 2), 1, 'C');
    $pdf->Cell(40, 6.5, number_format($total_herramientas, 2), 1, 'C');
    $pdf->Ln();
  }

  $param_query = $pdo->query("SELECT * FROM sgmeparam WHERE eparam_id_eparam='1'");
  $params = $param_query->fetch();

  $iva = $params['eparam_iva_eparam'];
  $iva_porcent = $iva / 100;

  $subtotal = $valorHoraWork + $total_repuestos + $total_herramientas;

  $pdf->setX(50);
  $pdf->Cell(40, 6.5, "SUBTOTAL", 1, 'C');
  $pdf->Cell(40, 6.5, number_format($subtotal, 2), 1, 'C');
  $pdf->Ln();

  $iva_pagar = $subtotal * $iva_porcent;


  $pdf->setX(50);
  $pdf->Cell(40, 6.5, "IVA $iva%", 1, 'C');
  $pdf->Cell(40, 6.5, number_format($iva_pagar, 2), 1, 'C');
  $pdf->Ln();

  $total = $iva_pagar + $subtotal;
  $pdf->setX(50);
  $pdf->Cell(40, 6.5, "TOTAL", 1, 'C');
  $pdf->Cell(40, 6.5, number_format($total, 2), 1, 'C');
  $pdf->Ln();

}



$pdf->Output();
?>
