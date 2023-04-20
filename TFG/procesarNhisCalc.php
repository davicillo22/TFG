<?php

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/patient.php';
require_once __DIR__ . '/includes/usuarios.php';

$tituloPagina = 'Nhis-Prediction';

$contenidoPrincipal="";

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "bbdd");

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$nhisFound="false";
if (isset($_POST['nhis'])) {
    $id = $_POST['nhis'];
} else if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

if (ctype_digit($id)) {
    $sql = "SELECT * FROM patients WHERE NHIS = $id";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $nhisFound = "true";
        $contenidoPrincipal.= <<<EOS
            <span style='width: 100%; display: flex; margin-top: 1%'> <h3 style="margin-right: 20px;">Se ha generado un CSV a partir de los datos del paciente. Se procederá a la predicción...   </h3> <a href='calculadoraMilla.php' class='btn btn-success btn-lg'>Volver</a> </span>

        EOS;

        //creacion csv
        $row = mysqli_fetch_assoc($result);
        $encabezados = array_keys($row);
        $paciente = array_values($row);

        $archivo = fopen("pacienteNuevo2.csv", "w");
        fputcsv($archivo, $encabezados);
        fputcsv($archivo, $paciente);
        fclose($archivo);


        echo "";
    } else {
        header("Location: calculadoraMilla.php?nhisFound=$nhisFound");
    }
}else{
    header("Location: calculadoraMilla.php?nhisFound=$nhisFound");
}

// Close the connection
mysqli_close($conn);

require __DIR__.'/includes/layout.php';