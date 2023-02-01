<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/usuarios.php';

$tituloPagina = 'Mi perfil';

$contenidoPrincipal=datosUsuario($_SESSION["email"]);
$contenidoPrincipal.=<<<EOS
<div class="containerModif2">
<a href = "editProfile.php"> <button class="btn btn-primary "> Modifica tus datos </button></a>
</div>
EOS;

require __DIR__.'/includes/layout.php';