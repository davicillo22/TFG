<?php

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/patient.php';
require_once __DIR__ . '/includes/usuarios.php';

$tituloPagina = 'Search-Patient';

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "bbdd");
$doneBorrado="true";
// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    $doneBorrado="false";
    header("Location: tablaPacientes.php?doneBorrado=$doneBorrado");
}


$id=$_GET["id"];
$sql = "DELETE FROM patients WHERE NHIS = $id";


$result = mysqli_query($conn, $sql);

// Close the connection
mysqli_close($conn);
header("Location: tablaPacientes.php?doneBorrado=$doneBorrado");

$tabla = "";


$tabla = "<h1>Paciente eliminado de la base de datos</h1>";
$tabla .= "<a href='tablaPacientes.php' class='btn btn-success btn-lg'>Volver</a>";



$contenidoPrincipal = $tabla;
$contenidoPrincipal .= "</div>";

require __DIR__.'/includes/layout.php';