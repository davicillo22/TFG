<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/usuarios.php';

$tituloPagina = 'Mi perfil';

$contenidoPrincipal=datosUsuario($_SESSION["email"]);
$contenidoPrincipal.=<<<EOS

<a href = "editProfile.php"> <button> Modifica tus datos </button></a>

EOS;

require __DIR__.'/includes/layout.php';