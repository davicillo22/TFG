<?php

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/usuarios.php';

$tituloPagina = 'Create User';

$contenidoPrincipal='';

        //si hemos iniciado sesión como admin podremos crear una cuenta nueva
if(isset($_SESSION["id"]) && $_SESSION["privileges"] == 0) {
    if (!registerUser()) {
        $contenidoPrincipal = <<<EOS
            <h1>Ha ocurrido un error.</h1>
            <p>El usuario ya existe. <a href="register.php">¡Inténtalo de nuevo!</a></p>
        EOS;
    } else {
        $contenidoPrincipal = <<<EOS
            <p>La cuenta se ha creado correctamente.</p>
        EOS;
    }
}
require __DIR__ . '/includes/layout.php';