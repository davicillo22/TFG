<?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
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

        $modoNhis=false;

        $nhisFound="false";
        if (isset($_POST['nhis'])) {
            $id = $_POST['nhis'];

        } else if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        $sqlEncabezado = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='patients'";
        $result2 = mysqli_query($conn, $sqlEncabezado);
        // Create an empty array to store column names
        $column_names = array();

        // Fetch the column names and add them to the array
        while ($row2 = mysqli_fetch_assoc($result2)) {
            $column_names[] = $row2['COLUMN_NAME'];

        }
        //Esta region de codigo es solo para MODO NHIS
        if (ctype_digit($id)) {
            $sql = "SELECT * FROM patients WHERE NHIS = $id";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $nhisFound = "true";
                $modoNhis=true;

                $row = mysqli_fetch_assoc($result);
                $pacienteNHIS = array_values($row);
            }else {
                header("Location: calculadoraRiesgo.php?nhisFound=$nhisFound");
            }
                header("Location: calculadoraRiesgo.php?nhisFound=$nhisFound");
        }

        $archivo = fopen('dataPatientPREV.csv', 'w');
        fputcsv($archivo, $column_names);

        if ($modoNhis){
            fputcsv($archivo, $pacienteNHIS);
            $algoritmo = $_POST['algoritmos'];
            $variable = $_POST['variables'];
        } else{
            $pacientePOST[] = generaArray();

            fputcsv($archivo, $pacientePOST);

            $algoritmo = $_POST['algoritmos1'];
            $variable = $_POST['variables1'];
        }
        fclose($archivo);
        // Llamada al script de Python que limpia el CSV y genera un nuevo CSV limpio
        set_time_limit(300);
        $hola = shell_exec("python globalClean.py");
        var_dump($hola);

        if($algoritmo == 'cox'){
            if($variable == 'rbqPre'){
                //llamada al script correspondiente: script.py con parámetros: csv, algoritmo y variable
                //llamada al php de muestra de resutlados con el output de script.py
                // Ejecutar el script de Python y obtener el resultado en formato JSON
                $json_result = shell_exec("python RBQPREprob.py");
                // Decodificar el resultado JSON a un objeto de PHP
                $result = json_decode($json_result);
                // Asignar las probabilidades a variables de PHP
                $prob1 = $result->rbq_5_years_pre;
                $prob2 = $result->rbq_10_years_pre;

            }else if($variable == 'rbqPost'){
                //llamada al script correspondiente: script.py con parámetros: csv, algoritmo y variable
                //llamada al php de muestra de resutlados con el output de script.py
                // Ejecutar el script de Python y obtener el resultado en formato JSON
                $json_result = shell_exec("python RBQPOSTprob.py");
                // Decodificar el resultado JSON a un objeto de PHP
                $result = json_decode($json_result);
                // Asignar las probabilidades a variables de PHP
                $prob1 = $result->rbq_5_years_post;
                $prob2 = $result->rbq_10_years_post;
            }
        }else{
            if ($variable == 'extracap') {
                // Ejecutar el script de Python y obtener el resultado en formato JSON
                $json_result = shell_exec("python EXTRACAPprob.py");
                // Decodificar el resultado JSON a un objeto de PHP
                $result = json_decode($json_result);
                // Asignar las probabilidades a variables de PHP

                if ($algoritmo == 'regresion') {
                    $prob1 = $result->lr_probability;
                    $prob2 = null;
                } else {
                    $prob1 = $result->rf_probability;
                    $prob2 = null;
                }
            } else if ($variable == 'margen') {
                // Ejecutar el script de Python y obtener el resultado en formato JSON
                $json_result = shell_exec("python MARGENprob.py");
                // Decodificar el resultado JSON a un objeto de PHP
                $result = json_decode($json_result);
                // Asignar las probabilidades a variables de PHP

                if ($algoritmo == 'regresion') {
                    $prob1 = $result->lr_probability;
                    $prob2 = null;
                } else {
                    $prob1 = $result->rf_probability;
                    $prob2 = null;
                }
            } else if ($variable == 'tnm2') {
                // Ejecutar el script de Python y obtener el resultado en formato JSON
                $json_result = shell_exec("python TNM2prob.py");
                // Decodificar el resultado JSON a un objeto de PHP
                $result = json_decode($json_result);
                // Asignar las probabilidades a variables de PHP

                if ($algoritmo == 'regresion') {
                    $prob1 = $result->lr_probability;
                    $prob2 = null;
                } else {
                    $prob1 = $result->rf_probability;
                    $prob2 = null;
                }
            } else if ($variable == 'vvss') {
                // Ejecutar el script de Python y obtener el resultado en formato JSON
                $json_result = shell_exec("python VVSSprob.py");
                // Decodificar el resultado JSON a un objeto de PHP
                $result = json_decode($json_result);
                // Asignar las probabilidades a variables de PHP

                if ($algoritmo == 'regresion') {
                    $prob1 = $result->lr_probability;
                    $prob2 = null;
                } else {
                    $prob1 = $result->rf_probability;
                    $prob2 = null;
                }
            }
        }



        function generaArray (){
            $fechacir = $_POST['fechacir'];
            $edad = $_POST['edad'];
            var_dump($edad);
            $etnia = $_POST['etnia'];
            $obeso = $_POST['obeso'];
            $hta = $_POST['hta'];
            $dm = $_POST['dm'];
            $tabaco = $_POST['tabaco'];
            $hereda = $_POST['hereda'];
            $tactor = $_POST['tactor'];
            $psapre = $_POST['psapre'];
            $psalt = $_POST['psalt'];
            $tduppre = $_POST['tduppre'];
            $ecotr = $_POST['ecotr'];
            $nbiopsia = $_POST['nbiopsia'];
            $histo = $_POST['histo'];
            $gleason1 = $_POST['gleason1'];
            $ncilpos = $_POST['ncilpos'];
            $bilat = $_POST['bilat'];
            $porcent = $_POST['porcent'];
            $iperin = $_POST['iperin'];
            $ilinf = $_POST['ilinf'];
            $ivascu = $_POST['ivascu'];
            $tnm1 = $_POST['tnm1'];
            $histo2 = $_POST['histo2'];
            $gleason2 = $_POST['gleason2'];
            $bilat2 = $_POST['bilat2'];
            $localiz = $_POST['localiz'];
            $multifoc = $_POST['multifoc'];
            $volumen = $_POST['volumen'];
            $extracap = $_POST['extracap'];
            $vvss = $_POST['vvss'];
            $iperin2 = $_POST['iperin2'];
            $ilinf2 = $_POST['ilinf2'];
            $ivascu2 = $_POST['ivascu2'];
            $pinag = $_POST['pinag'];
            $margen = $_POST['margen'];
            $tnm2 = $_POST['tnm2'];
            $psapos = $_POST['psapos'];
            $rtpadyu = $_POST['rtpadyu'];
            $rtpmes = $_POST['rtpmes'];
            $rbq = $_POST['rbq'];
            $trbq = $_POST['trbq'];
            $tdupli = $_POST['tdupli'];
            $t1mtx = $_POST['t1mtx'];
            $fechafin = $_POST['fechafin'];
            $fallec = $_POST['fallec'];
            $tsuperv = $_POST['tsuperv'];
            $psafin = $_POST['psafin'];
            $tsegui = $_POST['tsegui'];
            $notas = $_POST['notas'];
            $capras = $_POST['capras'];
            $ra = $_POST['ra'];
            $pten = $_POST['pten'];
            $erg = $_POST['erg'];
            $ki67 = $_POST['ki67'];
            $spink1 = $_POST['spink1'];
            $cmyc = $_POST['cmyc'];

            return array($fechacir, $edad, $etnia, $obeso, $hta, $dm, $tabaco, $hereda, $tactor, $psapre, $psalt, $tduppre, $ecotr, $nbiopsia, $histo, $gleason1,
                $ncilpos, $bilat, $porcent, $iperin, $ilinf, $ivascu, $tnm1, $histo2, $gleason2, $bilat2, $localiz, $multifoc, $volumen, $extracap, $vvss, $iperin2, $ilinf2, $ivascu2,
                $pinag, $margen, $tnm2, $psapos, $rtpadyu, $rtpmes, $rbq, $trbq, $tdupli, $t1mtx, $fechafin, $fallec, $tsuperv, $psafin, $tsegui, $notas, $capras, $ra, $pten, $erg, $ki67, $spink1, $cmyc);

        }

// Construir la cadena de consulta con los parámetros
if ($prob2 === null) {
    $params = array(
        'algoritmo' => $algoritmo,
        'variable' => $variable,
        'prob1' => strval($prob1)
    );
} else {
    $params = array(
        'algoritmo' => $algoritmo,
        'variable' => $variable,
        'prob1' => strval($prob1),
        'prob2' => strval($prob2)
    );
}

$query_string = http_build_query($params);

//header("Location: resultados.php?$query_string");

// Close the connection
mysqli_close($conn);

require __DIR__.'/includes/layout.php';