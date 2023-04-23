<?php

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/usuarios.php';

$tituloPagina = 'Calculadora de riesgo';
$log = false;

$contenidoPrincipal = "";

if (!checkLogin() && !checkSession()) {
    header("Location: login.php?log=$log");
    $contenidoPrincipal= <<<EOS
        <h1>Error</h1>
        <p>El email o contraseña introducidos no son válidos.</p>
        <p><a href="login.php"><button>Volver</button></a></p>
    EOS;
} else {
    $contenidoPrincipal .= <<<EOS
        <body class="fondo">
            <link rel='stylesheet' href="css/style.css">
            <h2>Bienvenido/a ${_SESSION['name']}</h2>
            
            <footer class="footer">
                
                
                 <p class="footer-text">
                 <a class="footer-text" href="mailto:ofroiz@ucm.es">Contacto</a> |
                 <a class="footer-text" href="https://www.cancer.gov/es">Recursos sobre el cáncer</a> 
                    
                 </p>
                <p class="footer-text">
                    <a class="footer-text" href="#">Política de privacidad</a> |
                    <a class="footer-text" href="#">Términos y condiciones</a>
                </p>
                <p class="footer-text">&copy; 2023 Calculadora de Riesgo para pacientes oncológicos.</p>
                
                <p class="footer-title">Todos los derechos reservados a Exotic Company.
            </footer>
        </body>
    EOS;
}

require __DIR__ . '/includes/layout.php';