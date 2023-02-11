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
$nhisFound=false;
$contenidoPrincipal="";

if (isset($_POST['nhis'])) {
    $id = $_POST['nhis'];
} else if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (ctype_digit($id)) {
    $sql = "SELECT * FROM patients WHERE NHIS = $id";

    $result = mysqli_query($conn, $sql);
    $patients = [];

    $tabla = "";

    if (mysqli_num_rows($result) > 0) {
        $nhisFound = true;
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
        header("Location: tablaPacientes.php?nhisFound=$nhisFound");
    }
}else{
    header("Location: tablaPacientes.php?nhisFound=$nhisFound");
}
// Close the connection
mysqli_close($conn);
if($nhisFound){
    $contenidoPrincipal.= <<<EOS
<div style="width: 1500px; height: 50px; margin: 0 auto; margin-top: 50px;">

   <a href="generatePdfPatient.php?id=$id" target=”_blank” class="btn btn-success btn-lg">Crear pdf del paciente $id</a>
    <a href="editPatient.php?id=$id" class="btn btn-success btn-lg">Modificar datos del paciente $id</a>
    <a href="deletePatient.php?id=$id" class="btn btn-success btn-lg">Borrar paciente $id</a>
    
</div>
<link rel="stylesheet" href="css/tableStyle.css">
<div style="width: 1500px; height: 110px; overflow: auto; margin: 0 auto; margin-top: 30px;">
EOS;
}
$contenidoPrincipal .= $tabla;
$contenidoPrincipal .= "</div>";

require __DIR__.'/includes/layout.php';