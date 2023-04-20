<?php

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/patient.php';
require_once __DIR__ . '/includes/usuarios.php';

$tituloPagina = 'Nhis-Prediction';

$contenidoPrincipal="";

$conn = mysqli_connect("localhost", "root", "", "bbdd");

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$algoritmo = $_POST['algoritmo'];
$variable = $_POST['variable'];

if($algoritmo == 'cox'){
    if($variable == 'rbqPre'){
        $rbq_5_years_pre = $_POST['rbq_5_years_pre'];
        $rbq_10_years_pre = $_POST['rbq_10_years_pre'];
    }else if($variable == 'rbqPost'){
        $rbq_5_years_post = $_POST['rbq_5_years_post'];
        $rbq_10_years_post = $_POST['rbq_10_years_post'];
    }
}else{
    if ($variable == 'extracap') {
        if ($algoritmo == 'regresion') {
            $lr_probability = $_POST['lr_probability'];
            echo "Regresion extracap: " . $lr_probability . "<br>";
            <img src="images/extracap.jpg" alt="Texto alternativo de la imagen" width="300" height="200">

        }else {
            $rf_probability = $_POST['rf_probability'];
        }
    }else if ($variable == 'margen') {
        if ($algoritmo == 'regresion') {
            $lr_probability = $_POST['lr_probability'];
        }else {
            $rf_probability = $_POST['rf_probability'];
        }
    } else if ($variable == 'tnm2') {
            if ($algoritmo == 'regresion') {
                $lr_probability = $_POST['lr_probability'];
            }else {
                $rf_probability = $_POST['rf_probability'];
            }
    } else if ($variable == 'vvss') {
        if ($algoritmo == 'regresion') {
            $lr_probability = $_POST['lr_probability'];
        }else {
            $rf_probability = $_POST['rf_probability'];
        }
    }

}







