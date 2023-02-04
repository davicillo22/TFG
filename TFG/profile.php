<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/usuarios.php';

$tituloPagina = 'Mi perfil';

$contenidoPrincipal=datosUsuario($_SESSION["email"]);
$contenidoPrincipal.=<<<EOS
<link rel="stylesheet" href="css/style.css">


EOS;

require __DIR__.'/includes/layout.php';