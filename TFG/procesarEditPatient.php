<?php

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/patient.php';
require_once __DIR__ . '/includes/patientFunctions.php';

$tituloPagina = 'Search-Patient';

$tabla = "";
$nhis = $_GET["id"];
if (registerPatient("modificar", $nhis)) {
    $tabla = "<h1>Paciente Modificado con éxito</h1>";
    $tabla .= "<a href='tablaPacientes.php' class='btn btn-success btn-lg'>Volver</a>";
} else {
    echo "Error actualizando registro: ";
}

$contenidoPrincipal = $tabla;
$contenidoPrincipal .= "</div>";

require __DIR__.'/includes/layout.php';
