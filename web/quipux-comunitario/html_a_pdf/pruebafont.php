<?php


//define('FPDF_FONTPATH', __DIR__ . '/tcpdf/fonts/');
require_once("fpdi/fpdi.php");
//require_once(__DIR__ . '/fpdi/fpdf.php');

$pdf = new FPDI();
$pdf->AddPage();

$pdf->SetFont('cambria','',12);
//$pdf->Cell(0, 10, 'Puyo, 25-02-2026', 0, 1, 'L', false, '', 0);
$pdf->Cell(0,10,"22-11-2025  222/11/2002",0,1,'R');
//$pdf->Text(1, 20, 'Puyo, 25-02-2026');
//$pdf->MultiCell(0, 10, 'OF-CACEP-CBS-OSI-01 11/11/2025', 0, 'L', false, 1, '', '', true, 0, false);
//header('Content-Type: application/pdf');
//header('Content-Disposition: inline; filename="test_cambria.pdf"');

$pdf->Output('test_cambria.pdf', 'I');
exit;