<?php

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/patient.php';
require_once __DIR__ . '/includes/usuarios.php';

$tituloPagina = 'Nhis-Prediction';

$contenidoPrincipal="";

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "bbdd");

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$nhisFound="false";
if (isset($_POST['nhis'])) {
    $id = $_POST['nhis'];
} else if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

if (ctype_digit($id)) {
    $sql = "SELECT * FROM patients WHERE NHIS = $id";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $nhisFound = "true";


        //creacion csv
        $row = mysqli_fetch_assoc($result);
        $encabezados = array_keys($row);
        $paciente = array_values($row);

        $archivo = fopen("pacienteNuevo2.csv", "w");
        fputcsv($archivo, $encabezados);
        fputcsv($archivo, $paciente);
        fclose($archivo);

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
        }


        echo "";
    } else {
        header("Location: calculadoraMilla.php?nhisFound=$nhisFound");
    }
}else{
    header("Location: calculadoraMilla.php?nhisFound=$nhisFound");
}

// Close the connection
mysqli_close($conn);

require __DIR__.'/includes/layout.php';