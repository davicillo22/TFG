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
$hayResultado=true;
$contenidoPrincipal="";

if (empty($_GET)) {
    $id = isset($_POST["nhis"]) ? $_POST["nhis"] : null;
    if($id==null){
        header('location: tablaPacientes.php');
    }
}
else
    $id=$_GET["id"];

$sql = "SELECT * FROM patients WHERE NHIS = $id";


$result = mysqli_query($conn, $sql);
$patients = [];




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
    $tabla .= "<h1>0 results</h1>";
    $tabla .= "<a href='tablaPacientes.php' class='btn btn-success btn-lg'>Volver</a>";
    $hayResultado=false;
}

// Close the connection
mysqli_close($conn);
if($hayResultado){
    $contenidoPrincipal.= <<<EOS
<div style="width: 1500px; height: 50px; margin: 0 auto; margin-top: 50px;">

   <a href="generatePdfPatient.php?$id=variable1" class="btn btn-success btn-lg">Crear pdf del paciente $id</a>
    <a href="editPatient.php?id=$id" class="btn btn-success btn-lg">Modificar datos del paciente $id</a>
    <a href="deletePatient.php?id=$id" class="btn btn-success btn-lg">Borrar paciente $id</a>
    
</div>
<link rel="stylesheet" href="css/tableStyle.css">
<div style="width: 1500px; height: 600px; overflow: auto; margin: 0 auto; margin-top: 30px; outline: 2px solid black;">
EOS;
}
$contenidoPrincipal .= $tabla;
$contenidoPrincipal .= "</div>";

require __DIR__.'/includes/layout.php';