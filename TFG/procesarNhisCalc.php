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
            $modoNhis=true;

        } else if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        //metricas
        $recallRF=0.0;
        $f1RF=0.0;
        $accuracyRF=0.0;
        $precisionRF=0.0;
        $recallLR=0.0;
        $f1LR=0.0;
        $accuracyLR=0.0;
        $precisionLR=0.0;
        $partialAIC=0.0;
        $concordance=0.0;
        $logRatio=0.0;

        $sqlEncabezado = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='patients'";
        $result2 = mysqli_query($conn, $sqlEncabezado);
        // Create an empty array to store column names
        $column_names = array();

        // Fetch the column names and add them to the array
        while ($row2 = mysqli_fetch_assoc($result2)) {
            $column_names[] = $row2['COLUMN_NAME'];

        }
        //Esta region de codigo es solo para MODO NHIS
    if($modoNhis){
        if (ctype_digit($id)) {
            $sql = "SELECT * FROM patients WHERE NHIS = $id";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $nhisFound = "true";


                $row = mysqli_fetch_assoc($result);
                $pacienteNHIS = array_values($row);
            }else {
                header("Location: calculadoraRiesgo.php?nhisFound=$nhisFound");
            }
        }
        else{
            header("Location: calculadoraRiesgo.php?nhisFound=$nhisFound");
        }
    }


        $archivo = fopen('dataPatientPREV.csv', 'w');
        fputcsv($archivo, $column_names);

        if ($modoNhis){
            fputcsv($archivo, $pacienteNHIS);
            $algoritmo = $_POST['algoritmos'];
            $variable = $_POST['variables'];
        } else{
            $pacientePOST = generaArray();

            fputcsv($archivo, $pacientePOST);

            $algoritmo = $_POST['algoritmos1'];
            $variable = $_POST['variables1'];
        }
        fclose($archivo);
        // Llamada al script de Python que limpia el CSV y genera un nuevo CSV limpio
        set_time_limit(300);
        shell_exec("python globalClean.py");

        if($algoritmo == 'cox'){
            if($variable == 'rbqPre'){
                //llamada al script correspondiente: script.py con parámetros: csv, algoritmo y variable
                //llamada al php de muestra de resutlados con el output de script.py
                // Ejecutar el script de Python y obtener el resultado en formato JSON
                $json_result = shell_exec("python TRBQPREprob.py");
                // Decodificar el resultado JSON a un objeto de PHP
                $result = json_decode($json_result);
                // Asignar las probabilidades a variables de PHP
                $prob1 = $result->rbq_5_years_pre;
                $prob2 = $result->rbq_10_years_pre;

                $concordance = $result->concordance;
                $partialAIC = $result->partialAIC;
                $logRatio = $result->logRatio;

            }else if($variable == 'rbqPost'){
                //llamada al script correspondiente: script.py con parámetros: csv, algoritmo y variable
                //llamada al php de muestra de resutlados con el output de script.py
                // Ejecutar el script de Python y obtener el resultado en formato JSON
                $json_result = shell_exec("python TRBQPOSTprob.py");
                // Decodificar el resultado JSON a un objeto de PHP
                $result = json_decode($json_result);
                // Asignar las probabilidades a variables de PHP
                $prob1 = $result->rbq_5_years_post;
                $prob2 = $result->rbq_10_years_post;

                $concordance = $result->concordance;
                $partialAIC = $result->partialAIC;
                $logRatio = $result->logRatio;
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

                    $recallLR=$result->recallLR;
                    $f1LR=$result->f1LR;
                    $accuracyLR=$result->accuracyLR;
                    $precisionLR=$result->precisionLR;
                } else {
                    $prob1 = $result->rf_probability;
                    $prob2 = null;

                    $recallRF=$result->recallRF;
                    $f1RF=$result->f1RF;
                    $accuracyRF=$result->accuracyRF;
                    $precisionRF=$result->precisionRF;
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

                    $recallLR=$result->recallLR;
                    $f1LR=$result->f1LR;
                    $accuracyLR=$result->accuracyLR;
                    $precisionLR=$result->precisionLR;
                } else {
                    $prob1 = $result->rf_probability;
                    $prob2 = null;

                    $recallRF=$result->recallRF;
                    $f1RF=$result->f1RF;
                    $accuracyRF=$result->accuracyRF;
                    $precisionRF=$result->precisionRF;
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

                    $recallLR=$result->recallLR;
                    $f1LR=$result->f1LR;
                    $accuracyLR=$result->accuracyLR;
                    $precisionLR=$result->precisionLR;
                } else {
                    $prob1 = $result->rf_probability;
                    $prob2 = null;

                    $recallRF=$result->recallRF;
                    $f1RF=$result->f1RF;
                    $accuracyRF=$result->accuracyRF;
                    $precisionRF=$result->precisionRF;
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

                    $recallLR=$result->recallLR;
                    $f1LR=$result->f1LR;
                    $accuracyLR=$result->accuracyLR;
                    $precisionLR=$result->precisionLR;
                } else {
                    $prob1 = $result->rf_probability;
                    $prob2 = null;

                    $recallRF=$result->recallRF;
                    $f1RF=$result->f1RF;
                    $accuracyRF=$result->accuracyRF;
                    $precisionRF=$result->precisionRF;
                }
            }
        }



        function generaArray (){
            $nhis = 111000;
            $fechacir = $_POST['fechacir'];
            $edad = $_POST['edad'];
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

            return array($nhis,$fechacir, $edad, $etnia, $obeso, $hta, $dm, $tabaco, $hereda, $tactor, $psapre, $psalt, $tduppre, $ecotr, $nbiopsia, $histo, $gleason1,
                $ncilpos, $bilat, $porcent, $iperin, $ilinf, $ivascu, $tnm1, $histo2, $gleason2, $bilat2, $localiz, $multifoc, $volumen, $extracap, $vvss, $iperin2, $ilinf2, $ivascu2,
                $pinag, $margen, $tnm2, $psapos, $rtpadyu, $rtpmes, $rbq, $trbq, $tdupli, $t1mtx, $fechafin, $fallec, $tsuperv, $psafin, $tsegui, $notas, $capras, $ra, $pten, $erg, $ki67, $spink1, $cmyc);

        }

// Construir la cadena de consulta con los parámetros
if ($prob2 === null) {
    $prob1=round($prob1*100,2);
    if($algoritmo=="regresion"){
        $accuracyLR=round($accuracyLR*100,2);
        $precisionLR=round($precisionLR*100,2);
        $f1LR=round($f1LR*100,2);
        $recallLR=round($recallLR*100,2);

        $params = array(
            'algoritmo' => $algoritmo,
            'variable' => $variable,
            'prob1' => strval($prob1),
            'precisionLR' => strval($precisionLR),
            'accuracyLR' => strval($accuracyLR),
            'f1LR' => strval($f1LR),
            'recallLR' => strval($recallLR)

        );
    }
    else{
        $accuracyRF=round($accuracyRF*100,2);
        $precisionRF=round($precisionRF*100,2);
        $f1RF=round($f1RF*100,2);
        $recallRF=round($recallRF*100,2);

        $params = array(
            'algoritmo' => $algoritmo,
            'variable' => $variable,
            'prob1' => strval($prob1),
            'precisionRF' => strval($precisionRF),
            'accuracyRF' => strval($accuracyRF),
            'f1RF' => strval($f1RF),
            'recallRF' => strval($recallRF)

        );
    }

} else {
    $prob1=round($prob1*100,2);
    $prob2=round($prob2*100,2);
    $concordance=round($concordance*100,2);
    $partialAIC=round($partialAIC*100,2);
    $logRatio=round($logRatio*100,2);

    $params = array(
        'algoritmo' => $algoritmo,
        'variable' => $variable,
        'prob1' => strval($prob1),
        'prob2' => strval($prob2),
        'concordance' => strval($concordance),
        'partialAIC' => strval($partialAIC),
        'logRatio' => strval($logRatio)
    );
}

$query_string = http_build_query($params);

header("Location: resultados.php?$query_string");

// Close the connection
mysqli_close($conn);

require __DIR__.'/includes/layout.php';