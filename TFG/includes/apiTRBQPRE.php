<?php
// Ejecutar el script de Python y obtener el resultado en formato JSON
$json_result = shell_exec("python RBQPREprob.py");

// Decodificar el resultado JSON a un objeto de PHP
$result = json_decode($json_result);

// Asignar las probabilidades a variables de PHP
$rbq_5_years_pre= $result->rbq_5_years_pre;
$rbq_10_years_pre= $result->rbq_10_years_pre;
?>