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
        $json_result = shell_exec("python VVSSprob.py");

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


require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/patient.php';
require_once __DIR__ . '/includes/usuarios.php';

$tituloPagina = 'Nhis-Prediction';

$contenidoPrincipal = "";

$conn = mysqli_connect("localhost", "root", "", "bbdd");

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$algoritmo = $_POST['algoritmo'];
$variable = $_POST['variable'];

if ($algoritmo == 'cox') {
    if ($variable == 'rbqPre') {
        $rbq_5_years_pre = $_POST['rbq_5_years_pre'];
        $rbq_10_years_pre = $_POST['rbq_10_years_pre'];
    } else if ($variable == 'rbqPost') {
        $rbq_5_years_post = $_POST['rbq_5_years_post'];
        $rbq_10_years_post = $_POST['rbq_10_years_post'];
    }
} else {
    if ($variable == 'extracap') {
        if ($algoritmo == 'regresion') {
            $lr_probability = $_POST['lr_probability'];
            echo "Regresion extracap: " . $lr_probability . "<br>";
            <
            img src = "images/extracap.jpg" alt = "Texto alternativo de la imagen" width = "300" height = "200" >

        } else {
            $rf_probability = $_POST['rf_probability'];
        }
    } else if ($variable == 'margen') {
        if ($algoritmo == 'regresion') {
            $lr_probability = $_POST['lr_probability'];
        } else {
            $rf_probability = $_POST['rf_probability'];
        }
    } else if ($variable == 'tnm2') {
        if ($algoritmo == 'regresion') {
            $lr_probability = $_POST['lr_probability'];
        } else {
            $rf_probability = $_POST['rf_probability'];
        }
    } else if ($variable == 'vvss') {
        if ($algoritmo == 'regresion') {
            $lr_probability = $_POST['lr_probability'];
        } else {
            $rf_probability = $_POST['rf_probability'];
        }
    }

}


require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/patient.php';
require_once __DIR__ . '/includes/usuarios.php';

$tituloPagina = 'Nhis-Prediction';

$contenidoPrincipal = "";

$conn = mysqli_connect("localhost", "root", "", "bbdd");

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$algoritmo = $_POST['algoritmo'];
$variable = $_POST['variable'];

if ($algoritmo == 'cox') {
    if ($variable == 'rbqPre') {
        $rbq_5_years_pre = $_POST['rbq_5_years_pre'];
        $rbq_10_years_pre = $_POST['rbq_10_years_pre'];
    } else if ($variable == 'rbqPost') {
        $rbq_5_years_post = $_POST['rbq_5_years_post'];
        $rbq_10_years_post = $_POST['rbq_10_years_post'];
    }
} else {
    if ($variable == 'extracap') {
        if ($algoritmo == 'regresion') {
            $lr_probability = $_POST['lr_probability'];
            echo "Regresion extracap: " . $lr_probability . "<br>";
            <
            img src = "images/extracap.jpg" alt = "Texto alternativo de la imagen" width = "300" height = "200" >

        } else {
            $rf_probability = $_POST['rf_probability'];
        }
    } else if ($variable == 'margen') {
        if ($algoritmo == 'regresion') {
            $lr_probability = $_POST['lr_probability'];
        } else {
            $rf_probability = $_POST['rf_probability'];
        }
    } else if ($variable == 'tnm2') {
        if ($algoritmo == 'regresion') {
            $lr_probability = $_POST['lr_probability'];
        } else {
            $rf_probability = $_POST['rf_probability'];
        }
    } else if ($variable == 'vvss') {
        if ($algoritmo == 'regresion') {
            $lr_probability = $_POST['lr_probability'];
        } else {
            $rf_probability = $_POST['rf_probability'];
        }
    }

}







