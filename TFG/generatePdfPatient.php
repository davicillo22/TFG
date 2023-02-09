<?php
require('fpdf/fpdf.php');

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


if (!$result) {
    // Mostrar un mensaje de error si la consulta falla
    echo "Error: " . mysqli_error($conn);
    exit;
}

$str ="";

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
    $pdf->Cell(30, 10, 'BILAT2');
    $pdf->Cell(30, 10, $col['BILAT2']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'LOCALIZ');
    $pdf->Cell(30, 10, $col['LOCALIZ']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'MULTIFOC');
    $pdf->Cell(30, 10, $col['MULTIFOC']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'VOLUMEN');
    $pdf->Cell(30, 10, $col['VOLUMEN']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'EXTRACAP');
    $pdf->Cell(30, 10, $col['EXTRACAP']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'VVSS');
    $pdf->Cell(30, 10, $col['VVSS']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'IPERIN2');
    $pdf->Cell(30, 10, $col['IPERIN2']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'ILINF2');
    $pdf->Cell(30, 10, $col['ILINF2']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'IVASCU2');
    $pdf->Cell(30, 10, $col['IVASCU2']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'PINAG');
    $pdf->Cell(30, 10, $col['PINAG']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'MARGEN');
    $pdf->Cell(30, 10, $col['MARGEN']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'TNM2');
    $pdf->Cell(30, 10, $col['TNM2']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'MARGEN');
    $pdf->Cell(30, 10, $col['MARGEN']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'PSAPOS');
    $pdf->Cell(30, 10, $col['PSAPOS']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'RTPADYU');
    $pdf->Cell(30, 10, $col['RTPADYU']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'RTPMES');
    $pdf->Cell(30, 10, $col['RTPMES']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'RBQ');
    $pdf->Cell(30, 10, $col['RBQ']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'TRBQ');
    $pdf->Cell(30, 10, $col['TRBQ']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'TDUPLI');
    $pdf->Cell(30, 10, $col['TDUPLI']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'T1MTX');
    $pdf->Cell(30, 10, $col['T1MTX']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'FECHAFIN');
    $pdf->Cell(30, 10, $col['FECHAFIN']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'FALLEC');
    $pdf->Cell(30, 10, $col['FALLEC']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'TSUPERV');
    $pdf->Cell(30, 10, $col['TSUPERV']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'PSAFIN');
    $pdf->Cell(30, 10, $col['PSAFIN']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'TSEGUI');
    $pdf->Cell(30, 10, $col['TSEGUI']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'NOTAS');
    $str = iconv('UTF-8', 'windows-1252', $col['NOTAS']);

    $pdf->Cell(30, 10, $str);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'AY');
    $pdf->Cell(30, 10, $col['AY']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'CAPRA-S');
    $pdf->Cell(30, 10, $col['CAPRA-S']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'RA');
    $pdf->Cell(30, 10, $col['RA']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'PTEN');
    $pdf->Cell(30, 10, $col['PTEN']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'ERG');
    $pdf->Cell(30, 10, $col['ERG']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'KI-67');
    $pdf->Cell(30, 10, $col['KI-67']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'SPINK1');
    $pdf->Cell(30, 10, $col['SPINK1']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'C-MYC');
    $pdf->Cell(30, 10, $col['C-MYC']);
    $pdf->Ln();
    $pdf->Cell(30, 10, 'NHIS');
    $pdf->Cell(30, 10, $col['NHIS']);
    $pdf->Ln();
}

$pdf->Output();
mysqli_free_result($result);

require __DIR__.'/includes/layout.php';