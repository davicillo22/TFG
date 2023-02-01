<?php

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/usuarios.php';

$tituloPagina = 'Mi perfil';


if(!cambiarDatos($_SESSION["email"])){
    $contenidoPrincipal= "<p>Ha ocurrido un error. <a href='editProfile.php'>Inténtalo de nuevo</a></p>";
    $contenidoPrincipal.="<p>¿Has intentado cambiar la contraseña? Asegúrate de haberla puesto bien las dos veces.</p>";
}else{
    header( 'Location: profile.php' );

}

require __DIR__ . '/includes/layout.php';