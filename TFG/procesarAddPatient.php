<?php

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/patient.php';
require_once __DIR__ . '/includes/usuarios.php';

$tituloPagina = 'AddPatient';


if(!cambiarDatos($_SESSION["email"])){
    $contenidoPrincipal= "<p>Ha ocurrido un error. <a href='editProfile.php'>Inténtalo de nuevo</a></p>";
    $contenidoPrincipal.="<p>¿Has intentado cambiar la contraseña? Asegúrate de haberla puesto bien las dos veces.</p>";
}else{
    header( 'Location: addPatient.php' );

}

require __DIR__ . '/includes/layout.php';