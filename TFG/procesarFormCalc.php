<?php

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/patient.php';
require_once __DIR__ . '/includes/usuarios.php';

$tituloPagina = 'Form-Prediction';

$contenidoPrincipal="";

$algoritmo = $_POST['algoritmos'];
$variable = $_POST['variables'];



if($algoritmo == 'algoritmo3'){
    if($variable == 'variable5'){
        //llamada al script correspondiente: script.py con parámetros: csv, algoritmo y variable
        //llamada al php de muestra de resutlados con el output de script.py
    }else if($variable == 'variable6'){
        //llamada al script correspondiente: script.py con parámetros: csv, algoritmo y variable
        //llamada al php de muestra de resutlados con el output de script.py
    }
}else{
    if($variable == 'variable1'){
        if($algoritmo == 'algoritmo2'){
            //llamada al script correspondiente: script.py con parámetros: csv, algoritmo y variable
            //llamada al php de muestra de resutlados con el output de script.py
        }else{
            //llamada al script correspondiente: script.py con parámetros: csv, algoritmo y variable
            //llamada al php de muestra de resutlados con el output de script.py
        }

    }else if($variable == 'variable2'){
        if($algoritmo == 'algoritmo2'){
            //llamada al script correspondiente: script.py con parámetros: csv, algoritmo y variable
            //llamada al php de muestra de resutlados con el output de script.py
        }else{
            //llamada al script correspondiente: script.py con parámetros: csv, algoritmo y variable
            //llamada al php de muestra de resutlados con el output de script.py
        }

    }else if($variable == 'variable3'){
        if($algoritmo == 'algoritmo2'){
            //llamada al script correspondiente: script.py con parámetros: csv, algoritmo y variable
            //llamada al php de muestra de resutlados con el output de script.py
        }else{
            //llamada al script correspondiente: script.py con parámetros: csv, algoritmo y variable
            //llamada al php de muestra de resutlados con el output de script.py
        }

    }else if($variable == 'variable4'){
        if($algoritmo == 'algoritmo2'){
            //llamada al script correspondiente: script.py con parámetros: csv, algoritmo y variable
            //llamada al php de muestra de resutlados con el output de script.py
        }else{
            //llamada al script correspondiente: script.py con parámetros: csv, algoritmo y variable
            //llamada al php de muestra de resutlados con el output de script.py
        }

    }

require __DIR__.'/includes/layout.php';