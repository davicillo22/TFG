<?php

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/patient.php';
require_once __DIR__ . '/includes/patientFunctions.php';

$tituloPagina = 'Search-Patient';

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "bbdd");

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$id=$_GET["id"];
//$sql = "UPDATE `patients` SET `FECHACIR` = '%s' WHERE `patients`.`NHIS` = '%s', $conn->real_escape_string('nuevoName'), $conn->real_escape_string($this->id));";

// Recibe los valores del formulario
$fechacir = isset($_POST["fechacir"]) ? $_POST["fechacir"] : null;
$edad = isset($_POST["edad"]) ? $_POST["edad"] : null;
$etnia = isset($_POST["etnia"]) ? $_POST["etnia"] : null;
$obeso = isset($_POST["obeso"]) ? $_POST["obeso"] : null;
$hta = isset($_POST["hta"]) ? $_POST["hta"] : null;
$dm = isset($_POST["dm"]) ? $_POST["dm"] : null;
$tabaco = isset($_POST["tabaco"]) ? $_POST["tabaco"] : null;
$hereda = isset($_POST["hereda"]) ? $_POST["hereda"] : null;
$tactor = isset($_POST["tactor"]) ? $_POST["tactor"] : null;
$psapre = isset($_POST["psapre"]) ? $_POST["psapre"] : null;
$psalt = isset($_POST["psalt"]) ? $_POST["psalt"] : null;
$tduppre = isset($_POST["tduppre"]) ? $_POST["tduppre"] : null;
$ecotr = isset($_POST["ecotr"]) ? $_POST["ecotr"] : null;
$nbiopsia = isset($_POST["nbiopsia"]) ? $_POST["nbiopsia"] : null;
$histo = isset($_POST["histo"]) ? $_POST["histo"] : null;
$gleason1 = isset($_POST["gleason1"]) ? $_POST["gleason1"] : null;
$ncilpos = isset($_POST["ncilpos"]) ? $_POST["ncilpos"] : null;
$bilat = isset($_POST["bilat"]) ? $_POST["bilat"] : null;
$porcent = isset($_POST["porcent"]) ? $_POST["porcent"] : null;
$iperin = isset($_POST["iperin"]) ? $_POST["iperin"] : null;
$ilinf = isset($_POST["ilinf"]) ? $_POST["ilinf"] : null;
$ivascu = isset($_POST["ivascu"]) ? $_POST["ivascu"] : null;
$tnm1 = isset($_POST["tnm1"]) ? $_POST["tnm1"] : null;
$histo2 = isset($_POST["histo2"]) ? $_POST["histo2"] : null;
$gleason2 = isset($_POST["gleason2"]) ? $_POST["gleason2"] : null;
$bilat2 = isset($_POST["bilat2"]) ? $_POST["bilat2"] : null;
$localiz = isset($_POST["localiz"]) ? $_POST["localiz"] : null;
$multifoc = isset($_POST["multifoc"]) ? $_POST["multifoc"] : null;

$volumen = isset($_POST["volumen"]) ? $_POST["volumen"] : null;
$extracap = isset($_POST["extracap"]) ? $_POST["extracap"] : null;
$vvss = isset($_POST["vvss"]) ? $_POST["vvss"] : null;
$iperin2 = isset($_POST["iperin2"]) ? $_POST["iperin2"] : null;
$ilinf2 = isset($_POST["ilinf2"]) ? $_POST["ilinf2"] : null;
$ivascu2 = isset($_POST["ivascu2"]) ? $_POST["ivascu2"] : null;
$pinag = isset($_POST["pinag"]) ? $_POST["pinag"] : null;
$margen = isset($_POST["margen"]) ? $_POST["margen"] : null;
$tnm2 = isset($_POST["tnm2"]) ? $_POST["tnm2"] : null;
$psapos = isset($_POST["psapos"]) ? $_POST["psapos"] : null;
$rtpadyu = isset($_POST["rtpadyu"]) ? $_POST["rtpadyu"] : null;
$rtpmes = isset($_POST["rtpmes"]) ? $_POST["rtpmes"] : null;
$rbq = isset($_POST["rbq"]) ? $_POST["rbq"] : null;
$trbq = isset($_POST["trbq"]) ? $_POST["trbq"] : null;

$tdupli = isset($_POST["tdupli"]) ? $_POST["tdupli"] : null;
$t1mtx = isset($_POST["t1mtx"]) ? $_POST["t1mtx"] : null;
$fechafin = isset($_POST["fechafin"]) ? $_POST["fechafin"] : null;
$fallec = isset($_POST["fallec"]) ? $_POST["fallec"] : null;
$tsuperv = isset($_POST["tsuperv"]) ? $_POST["tsuperv"] : null;
$psafin = isset($_POST["psafin"]) ? $_POST["psafin"] : null;
$tsegui = isset($_POST["tsegui"]) ? $_POST["tsegui"] : null;
$notas = isset($_POST["notas"]) ? $_POST["notas"] : null;
$capras = isset($_POST["capras"]) ? $_POST["capras"] : null;
$ra = isset($_POST["ra"]) ? $_POST["ra"] : null;
$pten = isset($_POST["pten"]) ? $_POST["pten"] : null;
$erg = isset($_POST["erg"]) ? $_POST["erg"] : null;
$ki67 = isset($_POST["ki67"]) ? $_POST["ki67"] : null;
$spink1 = isset($_POST["spink1"]) ? $_POST["spink1"] : null;
$cmyc = isset($_POST["cmyc"]) ? $_POST["cmyc"] : null;


// Construye la consulta SQL
//$sql = "UPDATE table_name SET FECHACIR='$field1', field2='$field2', field3='$field3' WHERE `patients`.`NHIS`=$id";

$sql = "UPDATE patients SET fechacir = '$fechacir', edad = '$edad', etnia = '$etnia', obeso = '$obeso', hta = '$hta', dm = '$dm', tabaco = '$tabaco', hereda = '$hereda', tactor = '$tactor', psapre = '$psapre', psalt = '$psalt',
                    tduppre = '$tduppre', ecotr = '$ecotr', nbiopsia = '$nbiopsia', histo = '$histo', gleason1 = '$gleason1', ncilpos = '$ncilpos', bilat = '$bilat',
                    porcent = '$porcent', iperin = '$iperin', ilinf = '$ilinf', ivascu = '$ivascu', tnm1 = '$tnm1', histo2 = '$histo2', gleason2 = '$gleason2', bilat2 = '$bilat2',
                    localiz = '$localiz', multifoc = '$multifoc', volumen = '$volumen', extracap = '$extracap', vvss = '$vvss', iperin2 = '$iperin2', ilinf2 = '$ilinf2', 
                    ivascu2 = '$ivascu2', pinag = '$pinag', margen = '$margen', tnm2 = '$tnm2', psapos = '$psapos', rtpadyu = '$rtpadyu', rtpmes = '$rtpmes', rbq = '$rbq', trbq = '$trbq', tdupli = '$tdupli'
                    ,tdupli = '$tdupli',t1mtx = '$t1mtx',fechafin = '$fechafin',fallec = '$fallec',tsuperv = '$tsuperv',psafin = '$psafin',tsegui = '$tsegui',notas = '$notas',capra_s = '$capras',
                     ra = '$ra',pten = '$pten',erg = '$erg',ki_67 = '$ki67', spink1 = '$spink1' ,c_myc = '$cmyc'
                WHERE `patients`.`NHIS`=$id";

if (mysqli_query($conn, $sql)) {
    echo "Modificación de paciente exitosa";
} else {
    echo "Error actualizando registro: " . mysqli_error($conn);
}


$tabla = "";


$tabla = "<h1>Paciente Modificado con éxito</h1>";
$tabla .= "<a href='tablaPacientes.php' class='btn btn-success btn-lg'>Volver</a>";

// Close the connection
mysqli_close($conn);

$contenidoPrincipal = $tabla;
$contenidoPrincipal .= "</div>";

require __DIR__.'/includes/layout.php';
