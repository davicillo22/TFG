<?php
require('fpdf/fpdf.php');

//require 'searchPatient.php';
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/patient.php';
require_once __DIR__ . '/includes/usuarios.php';

$tituloPagina = 'Pdf-Patient';

$id = $_GET["id"];

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



// Datos de la tabla
$pdf->SetFont('Arial', '', 12);
while ($col = mysqli_fetch_array($result)) {
    $pdf->Cell(30, 10, 'FECHACIR');
    $pdf->Cell(30, 10, $col['FECHACIR']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'EDAD');
    $pdf->Cell(30, 10, $col['EDAD']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'ETNIA');
    $pdf->Cell(30, 10, $col['ETNIA']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'OBESO');
    $pdf->Cell(30, 10, $col['OBESO']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'HTA');
    $pdf->Cell(30, 10, $col['HTA']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'DM');
    $pdf->Cell(30, 10, $col['DM']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'TABACO');
    $pdf->Cell(30, 10, $col['TABACO']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'HEREDA');
    $pdf->Cell(30, 10, $col['HEREDA']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'TACTOR');
    $pdf->Cell(30, 10, $col['TACTOR']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'PSAPRE');
    $pdf->Cell(30, 10, $col['PSAPRE']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'PSALT');
    $pdf->Cell(30, 10, $col['PSALT']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'TDUPPRE');
    $pdf->Cell(30, 10, $col['TDUPPRE']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'ECOTR');
    $pdf->Cell(30, 10, $col['ECOTR']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'NBIOPSIA');
    $pdf->Cell(30, 10, $col['NBIOPSIA']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'HISTO');
    $pdf->Cell(30, 10, $col['HISTO']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'GLEASON1');
    $pdf->Cell(30, 10, $col['GLEASON1']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'NCILPOS');
    $pdf->Cell(30, 10, $col['NCILPOS']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'BILAT');
    $pdf->Cell(30, 10, $col['BILAT']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'PORCENT');
    $pdf->Cell(30, 10, $col['PORCENT']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'IPERIN');
    $pdf->Cell(30, 10, $col['IPERIN']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'ILINF');
    $pdf->Cell(30, 10, $col['ILINF']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'IPERIN');
    $pdf->Cell(30, 10, $col['IPERIN']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'IVASCU');
    $pdf->Cell(30, 10, $col['IVASCU']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'TNM1');
    $pdf->Cell(30, 10, $col['TNM1']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'TNM1');
    $pdf->Cell(30, 10, $col['TNM1']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'GLEASON2');
    $pdf->Cell(30, 10, $col['GLEASON2']);
    $pdf->Ln();
}


while ($row = mysqli_fetch_array($result)) {
    $pdf->Cell(30, 10, 'BILAT2');
    $pdf->Cell(30, 10, $col['BILAT2']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'LOCALIZ');
    $pdf->Cell(30, 10, $row['LOCALIZ']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'MULTIFOC');
    $pdf->Cell(30, 10, $row['MULTIFOC']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'VOLUMEN');
    $pdf->Cell(30, 10, $row['VOLUMEN']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'EXTRACAP');
    $pdf->Cell(30, 10, $row['EXTRACAP']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'VVSS');
    $pdf->Cell(30, 10, $row['VVSS']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'IPERIN2');
    $pdf->Cell(30, 10, $row['IPERIN2']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'ILINF2');
    $pdf->Cell(30, 10, $row['ILINF2']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'IVASCU2');
    $pdf->Cell(30, 10, $row['IVASCU2']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'PINAG');
    $pdf->Cell(30, 10, $row['PINAG']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'MARGEN');
    $pdf->Cell(30, 10, $row['MARGEN']);
    $pdf->Ln();

}

$pdf->Output();
mysqli_free_result($result);
//$header = array('TNM2','PSAPOS','RTPADYU','RTPMES','RBQ','TRBQ','TDUPLI','T1MTX','FECHAFIN','FALLEC','TSUPERV','PSAFIN','TSEGUI','NOTAS','AY','AZ','CAPRA-S','RA','PTEN','ERG','KI-67','SPINK1','C-MYC','NHIS');
