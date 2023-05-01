<?php
require('fpdf/fpdf.php');

// Obtener las variables pasadas desde otra página PHP
$f1 = $_POST['f1'];
$recall = $_POST['recall'];
$precision = $_POST['precision'];
$accuracy = $_POST['accuracy'];
$lr_probability = $_POST['lr_probability'];
$rf_probability = $_POST['rf_probability'];
$textoVariable = $_POST['textoVariable'];
$rbq_5_years_post = $_POST['rbq_5_years_post'];
$rbq_10_years_post = $_POST['rbq_10_years_post'];
$rbq_5_years_pre = $_POST['rbq_5_years_pre'];
$rbq_10_years_pre = $_POST['rbq_10_years_pre'];
$algoritmoTexto = $_POST['algoritmoTexto'];

// Crear una instancia de la clase FPDF
$pdf = new FPDF();

// Configurar la página
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Informe de aprendizaje automático');

// Agregar los elementos del informe
$pdf->Ln();
$pdf->SetFont('Arial','B',14);
$pdf->Cell(40,10,'Resultados');
$pdf->Ln();
$pdf->SetFont('Arial','',12);

if (!empty($f1)) {
$pdf->Cell(40,10,'F1: '.$f1);
$pdf->Ln();
}

if (!empty($recall)) {
$pdf->Cell(40,10,'Recall: '.$recall);
$pdf->Ln();
}

if (!empty($precision)) {
    $pdf->Cell(40,10,'Precision: '.$precision);
    $pdf->Ln();
}

if (!empty($accuracy)) {
    $pdf->Cell(40,10,'Accuracy: '.$accuracy);
    $pdf->Ln();
}

if (!empty($lr_probability)) {
    $pdf->Cell(40,10,'LR Probability: '.$lr_probability);
    $pdf->Ln();
}

if (!empty($rf_probability)) {
    $pdf->Cell(40,10,'RF Probability: '.$rf_probability);
    $pdf->Ln();
}

if (!empty($textoVariable)) {
    $pdf->Cell(0, 10, 'Texto Variable: ' . $textoVariable, 0, 1);
    $pdf->Ln();
}

if (!empty($rbq_5_years_post)) {
    $pdf->Cell(0, 10, 'RBQ 5 Years Post: ' . $rbq_5_years_post, 0, 1);
    $pdf->Ln();
}

if (!empty($rbq_10_years_post)) {
    $pdf->Cell(0, 10, 'RBQ 10 Years Post: ' . $rbq_10_years_post, 0, 1);
    $pdf->Ln();
}

if (!empty($rbq_5_years_pre)) {
    $pdf->Cell(0, 10, 'RBQ 5 Years Pre: ' . $rbq_5_years_pre, 0, 1);
    $pdf->Ln();
}

if (!empty($rbq_10_years_pre)) {
    $pdf->Cell(0, 10, 'RBQ 10 Years Pre: ' . $rbq_10_years_pre, 0, 1);
    $pdf->Ln();
}

if (!empty($algoritmoTexto)) {
    $pdf->Cell(0, 10, 'Algoritmo Texto: ' . $algoritmoTexto, 0, 1);
    $pdf->Ln();
}
$pdf->Output();


