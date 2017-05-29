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
    $this->Text(110, 54, 'LISTADO DE ORDENES DE TRABAJO INTERNA');
    $this->Ln(25);

  }

  function TablaColores($header) {
    $this->SetFillColor(192, 192, 192);
    $this->SetTextColor(255);
    $this->SetLineWidth(.3);
    $this->SetFont('Arial', 'B', 10);

    $w = array(10, 25, 65, 65, 65, 20, 20, 20);

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
$header = array('#', 'CODIGO', 'EQUIPO', 'DETALLE', 'EMPLEADO', 'INICIO', ' FIN', 'COSTO');

$pdf -> SetX(3);
$pdf->SetFont('Arial', '',12);
$pdf->TablaColores($header);

if( !isset($_GET["inicio"]) ) {
  $query = $pdo->query("SELECT * FROM v_orden_interna");
}
else{
  $inicio = $_GET["inicio"];
  $fin = $_GET["fin"];

  $query = $pdo->query("SELECT * FROM v_orden_interna WHERE eorin_fet_eorin BETWEEN '$inicio' AND '$fin'");
}
$count = 0;

while ($row = $query->fetch()) {
  $count++;

  $pdf -> SetX(3);
  $pdf->SetFont('Arial', '',9);
  $id = $row['eorin_cod_eorin'];

  $pdf->Cell(10, 6.5, $count, 1, 0, 'C');
  $pdf->Cell(25, 6.5, $row["eorin_cod_eorin"], 1, 'C');
  $pdf->Cell(65, 6.5, utf8_decode($row['eequi_det_eequi']), 1, 'C');
  $pdf->Cell(65, 6.5, utf8_decode($row['eorin_det_eorin']), 1, 'C');
  $pdf->Cell(65, 6.5, utf8_decode($row['empleado']), 1, 'C');

  $queryIni = $pdo->query("SELECT * FROM sgmedofi WHERE dofi_cod_dofi='$id'");
  $incio = $queryIni->fetch();

  $queryFin = $pdo->query("SELECT * FROM sgmedoff WHERE doff_cod_doff='$id'");
  $fin = $queryFin->fetch();

  // Sacar costo
  $total_repuestos = 0;
  $repuesto = $pdo->query("SELECT * FROM sgmedoir WHERE doir_cod_doir='$id'");

  while ($detail = $repuesto->fetch()) {
    $suma = $detail["doir_cant_doir"] * $detail["doir_pric_doir"];
    $total_repuestos = $total_repuestos + $suma;
  }

  $herramientas = $pdo->query("SELECT * FROM sgmedoih WHERE doih_cod_doih='$id'");
  $total_herramientas = 0;

  while ($detail = $herramientas->fetch()) {
    $suma = $detail["doih_cant_doih"] * $detail["doih_pric_doih"];
    $total_herramientas = $total_herramientas + $suma;
  }

  $fechasInicio = array();
  $fechasFinal = array();

  $fecha = $incio["dofi_fet_dofi"] . " " . $incio["dofi_hor_dofi"];
  $datetime1 = new DateTime($fecha);
  $fechasInicio[] = $datetime1;

  $fechaend = $fin["doff_fet_doff"] . " " . $fin["doff_hor_doff"];
  $datetimeEnd = new DateTime($fechaend);
  $fechasFinal[] = $datetimeEnd;

  $sueldo = $row["eempl_suel_eempl"];
  $diasMes = 160 * 60;
  $valorHora = $sueldo/$diasMes;
  $subtotal = 0;
  $valorHoraWork = 0;

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
  }

  $param_query = $pdo->query("SELECT * FROM sgmeparam WHERE eparam_id_eparam='1'");
  $params = $param_query->fetch();

  $iva = $params['eparam_iva_eparam'];
  $iva_porcent = $iva / 100;

  $subtotal = $valorHoraWork + $total_repuestos + $total_herramientas;
  $iva_pagar = $subtotal * $iva_porcent;

  $costo = $iva_pagar + $subtotal;
  // Fin costo

  $pdf->Cell(20, 6.5, utf8_decode($incio['dofi_fet_dofi']), 1, 'C');
  $pdf->Cell(20, 6.5, utf8_decode($fin['doff_fet_doff']), 1, 'C');

  if ($row['eorin_est_eorin'] == 'finalizado') {
    $pdf->Cell(20, 6.5, number_format($costo, 2), 1, 'C');
  }
  else {
    $pdf->Cell(20, 6.5, "0.00", 1, 'C');
  }

  $pdf->Ln();
}
$pdf->Ln();

$pdf->Output();
?>
