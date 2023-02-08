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
//$id = isset($_POST["nhis"]) ? $_POST["nhis"] : null;
$sql = "DELETE FROM patients WHERE NHIS = $id";


$result = mysqli_query($conn, $sql);
$patients = [];




$tabla = "";


    $tabla .= "0 results";

// Close the connection
mysqli_close($conn);

$contenidoPrincipal = $tabla;
$contenidoPrincipal .= "</div>";

require __DIR__.'/includes/layout.php';