<?php

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/usuarios.php';

$tituloPagina = 'Calculadora de riesgo médico sobre el cáncer';
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
    $contenidoPrincipal .=  <<<EOS
       <body>
       <link rel='stylesheet' href="css/style.css">
        <h1>Calculadora de riesgo en pacientes oncológicos</h1>
        <h2>Bienvenido/a ${_SESSION['name']}</h2>
        <p class="welcome-message">¡Ha iniciado sesión en nuestra calculadora de riesgo médico sobre el cáncer! Esta herramienta le ayudará a evaluar su riesgo de desarrollar cáncer en función de una serie de factores de riesgo conocidos. Por favor, siga las instrucciones a continuación para realizar su cálculo de riesgo.</p>
        <p>Usando el menú superior puede navegar por las siguientes opciones:</p>
        <ul>
            <li>Botón "Pacientes": Para visualizar los pacientes, filtrarlos, añadir nuevos...</li>
            <li>Botón "Calculadora": A través de este espacio puede calcular mediante varios algoritmos con learning machine las probabilidades de ...</li>
            <li>Botón "Mi perfil": Para visualizar sus datos o modificarlos.</li>
            <li>Botón "Cerrar sesión": Para cerrar su sesión.</li>
        </ul>
        </body>
    EOS;

}

require __DIR__ . '/includes/layout.php';