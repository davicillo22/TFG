<?php

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/patientFunctions.php';
require_once __DIR__ . '/includes/patient.php';

$tituloPagina = 'AddPatient';


if(!registerPatient()){
    $contenidoPrincipal= "<p>Ha ocurrido un error. <a href='addPatient.php'>Inténtalo de nuevo</a></p>";
}else{

    header( 'Location: addPatient.php' );

}

require __DIR__ . '/includes/layout.php';