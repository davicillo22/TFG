<?php

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/usuarios.php';

$tituloPagina = 'Login';

$contenidoPrincipal='';
if (!checkLogin()) {
    $contenidoPrincipal= <<<EOS
		<h1>Error</h1>
		<p>El email o contraseña introducidos no son válidos.</p>
		<p><a href="login.php"><button>Volver</button></a></p>
	EOS;
} else {
    $contenidoPrincipal=<<<EOS
		<h1>Bienvenido/a ${_SESSION['name']}</h1>
		<p>Usa el menú superior para navegar.</p>
	EOS;
}

require __DIR__ . '/includes/layout.php';