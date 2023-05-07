<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/patientFunctions.php';
require_once __DIR__ . '/includes/patient.php';

$tituloPagina = 'AddPatient';
$done="true";

if(!registerPatient("registrar", NULL)){
    $contenidoPrincipal= "<p>Ha ocurrido un error. <a href='addPatient.php'>Inténtalo de nuevo</a></p>";
    $done="false";

}else{
    $contenidoPrincipal = "<div style='display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100vh; text-align: center;'>";
    $contenidoPrincipal .= "<h1 style='margin-bottom: 20px;'>Paciente añadido con éxito</h1>";
    $contenidoPrincipal .= "<a href='addPatient.php' class='btn btn-success btn-lg'>Volver</a>";
    $contenidoPrincipal .= "</div>";

    // Connect to the database
    $conn = mysqli_connect("localhost", "root", "", "bbdd");

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sqlEncabezado = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='patients'";
    $result2 = mysqli_query($conn, $sqlEncabezado);
    // Create an empty array to store column names
    $column_names = array();

    // Fetch the column names and add them to the array
    while ($row2 = mysqli_fetch_assoc($result2)) {
        $column_names[] = $row2['COLUMN_NAME'];

    }

    $archivoAdd = fopen('dataPatientAdd.csv', 'w');
    fputcsv($archivoAdd, $column_names);

    $pacientePOST = generaArray();

    fputcsv($archivoAdd, $pacientePOST);
    fclose($archivoAdd);
    // Llamada al script de Python que limpia el CSV y genera un nuevo CSV limpio
    set_time_limit(300);
    shell_exec("python globalCleanAdd.py");
    shell_exec("python empaquetador.py");

// Close the connection
    mysqli_close($conn);
    header("Location: addPatient.php?done=$done");
}

function generaArray (){
    $nhis=1111;
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

    return array($nhis, $fechacir, $edad, $etnia, $obeso, $hta, $dm, $tabaco, $hereda, $tactor, $psapre, $psalt, $tduppre, $ecotr, $nbiopsia, $histo, $gleason1,
        $ncilpos, $bilat, $porcent, $iperin, $ilinf, $ivascu, $tnm1, $histo2, $gleason2, $bilat2, $localiz, $multifoc, $volumen, $extracap, $vvss, $iperin2, $ilinf2, $ivascu2,
        $pinag, $margen, $tnm2, $psapos, $rtpadyu, $rtpmes, $rbq, $trbq, $tdupli, $t1mtx, $fechafin, $fallec, $tsuperv, $psafin, $tsegui, $notas, $capras, $ra, $pten, $erg, $ki67, $spink1, $cmyc);

}

require __DIR__ . '/includes/layout.php';
?>