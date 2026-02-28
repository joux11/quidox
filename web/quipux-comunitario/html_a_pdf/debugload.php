<?php
ini_set('display_errors', '0');      // no mostrar errores en salida
error_reporting(E_ALL & ~E_NOTICE);  // opcional: ocultar Notices

ob_start();

require_once(__DIR__.'/fpdi/fpdi.php');



$pdf = new FPDI();

$pdf->AddPage();


$pdf->SetFont('cambria', 'B', 12);

$pdf->Write(0, "Prueba Cambria: áéíóú ñ Ñ CACEP");
//$pdf->Output('test.pdf', 'I');
$pdf->Cell(0,10,iconv('UTF-8','windows-1252','Puyo, 25-02-2026'),0,1);
$pdf->Output('testt.pdf', 'I');
exit;