<?php
require('fpdf/fpdf.php');


class PDF extends FPDF
{
// Cabecera de página
    function Header()
    {

        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Movernos a la derecha
        $this->Cell(60);
        // Título
        $this->Cell(30,10,'Informe del paciente',0,0,'C');
        // Salto de línea
        $this->Ln(20);

        $this->Cell(50, 10, 'FECHACIR', 1, 0, 'C', 0);
        $this->Cell(50, 10, 'EDAD', 1, 0, 'C', 0);
        $this->Cell(50, 10, 'ETNIA', 1, 0, 'C', 0);
        $this->Cell(50, 10, 'OBESO', 1, 1, 'C', 0);
    }

// Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,utf8_decode('Page').$this->PageNo().'/{nb}',0,0,'C');
    }
}


require 'cn.php';
//require_once 'searchPatient.php';
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/patient.php';
require_once __DIR__ . '/includes/usuarios.php';



// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

//while(($row = mysqli_num_rows($result)) > 0) {
    $pdf->Cell(90, 10, ['FECHACIR'],1, 0, 'C', 0);
   // $pdf->Cell(90, 10, $row['EDAD'],1, 0, 'C', 0);
    //$pdf->Cell(90, 10, $row['ETNIA'],1, 0, 'C', 0);
   // $pdf->Cell(90, 10, $row['OBESO'],1, 0, 'C', 0);


$pdf->Output();
?>