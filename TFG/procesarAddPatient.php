<?php

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/patientFunctions.php';
require_once __DIR__ . '/includes/patient.php';

$tituloPagina = 'AddPatient';


if(!registerPatient()){
    $contenidoPrincipal= "<p>Ha ocurrido un error. <a href='addPatient.php'>Inténtalo de nuevo</a></p>";
}else{

    $tabla = "";


    $tabla = "<h1>Paciente añadido con éxito</h1>";
    $tabla .= "<a href='addPatient.php' class='btn btn-success btn-lg'>Volver</a>";


    $contenidoPrincipal = $tabla;
    $contenidoPrincipal .= "</div>";

}

require __DIR__ . '/includes/layout.php';