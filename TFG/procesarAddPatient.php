<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/patientFunctions.php';
require_once __DIR__ . '/includes/patient.php';

$tituloPagina = 'AddPatient';


if(!registerPatient("registrar", NULL)){
    $contenidoPrincipal= "<p>Ha ocurrido un error. <a href='addPatient.php'>Inténtalo de nuevo</a></p>";
}else{
    $contenidoPrincipal = "<div style='display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100vh; text-align: center;'>";
    $contenidoPrincipal .= "<h1 style='margin-bottom: 20px;'>Paciente añadido con éxito</h1>";
    $contenidoPrincipal .= "<a href='addPatient.php' class='btn btn-success btn-lg'>Volver</a>";
    $contenidoPrincipal .= "</div>";
}

require __DIR__ . '/includes/layout.php';
?>