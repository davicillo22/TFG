<?php

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/patient.php';
require_once __DIR__ . '/includes/usuarios.php';

$tituloPagina = 'Search-Patient';

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "bbdd");

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



$id = isset($_POST["nhis"]) ? $_POST["nhis"] : null;
$sql = "SELECT * FROM patients WHERE NHIS = $id";


$result = mysqli_query($conn, $sql);
$patients = [];
$contenidoPrincipal= <<<EOS
<div style="width: 1500px; height: 50px; margin: 0 auto; margin-top: 50px;">

    <a href="generatePdfPatient.php?$id=variable1" class="btn btn-success btn-lg">Crear pdf del paciente $id</a>
</div>
<link rel="stylesheet" href="css/tableStyle.css">
<div style="width: 1500px; height: 600px; overflow: auto; margin: 0 auto; margin-top: 30px; outline: 2px solid black;">
EOS;

$tabla = "";

if (mysqli_num_rows($result) > 0) {
    $tabla .= "<table>";
    $tabla .= "<tr>";

    // Get the column names
    $column_names = mysqli_fetch_fields($result);
    foreach ($column_names as $column_name) {
        $tabla .= "<th>" . $column_name->name . "</th>";
    }

    $tabla .= "</tr>";

    // Loop through the results and print each row
    while ($row = mysqli_fetch_assoc($result)) {
        $tabla .= "<tr>";
        foreach ($column_names as $column_name) {
            $tabla .= "<td>" . $row[$column_name->name] . "</td>";
        }
        $tabla .= "</tr>";
    }

    $tabla .= "</table>";
} else {
    $tabla .= "0 results";
}

// Close the connection
mysqli_close($conn);

$contenidoPrincipal .= $tabla;
$contenidoPrincipal .= "</div>";

require __DIR__.'/includes/layout.php';