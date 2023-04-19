<?php
require_once __DIR__.'/config.php';
require_once __DIR__.'/usuarios.php';

// Comprueba que la petición es una petición POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Comprueba que el parámetro 'variable' se ha enviado
    if (isset($_POST['variable'])) {
        // Obtiene el valor del parámetro 'variable'
        $variable = $_POST['variable'];

        // Ejecuta el script de Python y obtiene el resultado en formato JSON
        $json_result = shell_exec("python MARGENprob.py");

        // Decodifica el resultado JSON a un objeto de PHP
        $result = json_decode($json_result);

        // Retorna la probabilidad correspondiente a la variable solicitada
        if ($variable === 'lr') {
            echo $result->lr_probability;
        } else if ($variable === 'rf') {
            echo $result->rf_probability;
        } else {
            echo 'Variable no válida';
        }
    } else {
        echo 'Parámetro "variable" no encontrado';
    }
}