<?php
require('fpdf/fpdf.php');

//require 'searchPatient.php';
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/patient.php';
require_once __DIR__ . '/includes/usuarios.php';

$tituloPagina = 'Pdf-Patient';

$id = $_GET["variable1"];

// Conexión a la base de datos
$conn = mysqli_connect("localhost", "root", "", "bbdd");


// Consulta para obtener los datos de la tabla
$query = "SELECT * FROM patients WHERE NHIS = $id";
$result = mysqli_query($conn, $query);


$result = mysqli_query($conn, $query);

if (!$result) {
    // Mostrar un mensaje de error si la consulta falla
    echo "Error: " . mysqli_error($conn);
    exit;
}
// Creación del PDF
$pdf = new FPDF();
$pdf->AddPage();

// Encabezados de las columnas
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'FECHACIR');
$pdf->Cell(40, 10, 'EDAD');
$pdf->Cell(40, 10, 'ETNIA');
$pdf->Cell(40, 10, 'OBESO');
$pdf->Cell(40, 10, 'HTA');
$pdf->Cell(40, 10, 'DM');
$pdf->Ln();

// Datos de la tabla
$pdf->SetFont('Arial', '', 12);
while ($row = mysqli_fetch_array($result)) {
    $pdf->Cell(40, 10, $row['FECHACIR']);
    $pdf->Cell(40, 10, $row['EDAD']);
    $pdf->Cell(40, 10, $row['ETNIA']);
    $pdf->Cell(40, 10, $row['OBESO']);
    $pdf->Cell(40, 10, $row['HTA']);
    $pdf->Cell(40, 10, $row['DM']);

    $pdf->Ln();
}

$pdf->Output();
mysqli_free_result($result);
//$header = array('FECHACIR','EDAD','ETNIA','OBESO','HTA','DM','TABACO','HEREDA','TACTOR','PSAPRE','PSALT','TDUPPRE','ECOTR','NBIOPSIA','HISTO','GLEASON1','NCILPOS','BILAT','PORCENT','IPERIN','ILINF','IVASCU','TNM1','HISTO2','GLEASON2','BILAT2','LOCALIZ','MULTIFOC','VOLUMEN','EXTRACAP','VVSS','IPERIN2','ILINF2','IVASCU2','PINAG','MARGEN','TNM2','PSAPOS','RTPADYU','RTPMES','RBQ','TRBQ','TDUPLI','T1MTX','FECHAFIN','FALLEC','TSUPERV','PSAFIN','TSEGUI','NOTAS','AY','AZ','CAPRA-S','RA','PTEN','ERG','KI-67','SPINK1','C-MYC','NHIS');
