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


$id=$_GET["id"];
$sql = "UPDATE `patients` SET `FECHACIR` = '%s' WHERE `patients`.`NHIS` = '%s', $conn->real_escape_string('nuevoName'), $conn->real_escape_string($this->id));";


$result = mysqli_query($conn, $sql);


$tabla = "";


$tabla = "<h1>Paciente eliminado de la base de datos</h1>";
$tabla .= "<a href='tablaPacientes.php' class='btn btn-success btn-lg'>Volver</a>";

// Close the connection
mysqli_close($conn);

$contenidoPrincipal = $tabla;
$contenidoPrincipal .= "</div>";

require __DIR__.'/includes/layout.php';
