<?php

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/patient.php';
require_once __DIR__ . '/includes/usuarios.php';

$tituloPagina = 'Resultados';

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
        echo "RBQ a 5 años (preoperatorio): " . $rbq_5_years_pre . "<br>";
        $rbq_10_years_pre = $_POST['rbq_10_years_pre'];
        echo "RBQ a 10 años (preoperatorio): " . $rbq_10_years_pre . "<br>";
        ?>
        <img src="images/rbqpre.jpg" alt="Metricas para RBQ preoperatorio" width="300" height="200">
        <?php
    }else if($variable == 'rbqPost'){
        $rbq_5_years_post = $_POST['rbq_5_years_post'];
        echo "RBQ a 5 años (postoperatorio): " . $rbq_5_years_post . "<br>";
        $rbq_10_years_post = $_POST['rbq_10_years_post'];
        echo "RBQ a 10 años (postoperatorio): " . $rbq_10_years_post . "<br>";
        ?>
        <img src="images/rbqpost.jpg" alt="Metricas para RBQ postoperatorio" width="300" height="200">
        <?php
    }
}else{
    if ($variable == 'extracap') {
        if ($algoritmo == 'regresion') {
            $lr_probability = $_POST['lr_probability'];
            echo "Regresion logística EXTRACAP: " . $lr_probability . "<br>";
        }else {
            $rf_probability = $_POST['rf_probability'];
            echo "Arboles aleatorios EXTRACAP: " . $rf_probability . "<br>";
        }
        ?>
        <img src="images/extracap.jpg" alt="Metricas para EXTRACAP" width="300" height="200">
        <?php
    }else if ($variable == 'margen') {
        if ($algoritmo == 'regresion') {
            $lr_probability = $_POST['lr_probability'];
            echo "Regresion logística MARGEN: " . $lr_probability . "<br>";

        }else {
            $rf_probability = $_POST['rf_probability'];
            echo "Arboles aleatorios MARGEN: " . $rf_probability . "<br>";
        }
        ?>
        <img src="images/margen.jpg" alt="Metricas para MARGEN" width="300" height="200">
        <?php
    } else if ($variable == 'tnm2') {
        if ($algoritmo == 'regresion') {
            $lr_probability = $_POST['lr_probability'];
            echo "Regresion logística TNM2: " . $lr_probability . "<br>";

        }else {
            $rf_probability = $_POST['rf_probability'];
            echo "Arboles aleatorios TNM2: " . $rf_probability . "<br>";
        }
        ?>
        <img src="images/tnm2.jpg" alt="Metricas para TNM2" width="300" height="200">
        <?php
    } else if ($variable == 'vvss') {
        if ($algoritmo == 'regresion') {
            $lr_probability = $_POST['lr_probability'];
            echo "Regresión logística VVSS: " . $lr_probability . "<br>";

        }else {
            $rf_probability = $_POST['rf_probability'];
            echo "Arboles aleatorios VVSS: " . $rf_probability . "<br>";
        }
        ?>
        <img src="images/vvss.jpg" alt="Metricas para VVSS" width="300" height="200">
        <?php
    }
}







