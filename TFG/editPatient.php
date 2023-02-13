<?php

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/patient.php';
require_once __DIR__ . '/includes/usuarios.php';

$tituloPagina = 'Search-Patient';

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "bbdd");

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$hayResultado=true;
$contenidoPrincipal="";


$id = $_GET["id"];
if($id==null){
    header('location: tablaPacientes.php');

}
$sql = "SELECT * FROM patients WHERE NHIS = $id";


$result = mysqli_query($conn, $sql);


$tabla = "";

if (mysqli_num_rows($result) > 0) {
    $tabla .= "<table>";
    $tabla .= "<tr>";

    // Get the column names
    $column_names = mysqli_fetch_fields($result);
    foreach ($column_names as $column_name) {
        $tabla .= "<th>" . $column_name->name . "</th>";
    }

    $tabla .= "</tr>";

    // Loop through the results and print each row
    while ($rowT = mysqli_fetch_assoc($result)) {
        $tabla .= "<tr>";
        foreach ($column_names as $column_name) {
            $tabla .= "<td>" . $rowT[$column_name->name] . "</td>";
        }
        $tabla .= "</tr>";
    }

    $sql = "SELECT * FROM patients WHERE NHIS = $id";



    $result = mysqli_query($conn, $sql);
    //inputs para modificar cada campo
    while ($rowT = mysqli_fetch_assoc($result)) {
        $fechacirAnterior=isset($rowT['FECHACIR']) ? $rowT['FECHACIR']:null;
        $edadAnterior=isset($rowT['EDAD']) ? $rowT['EDAD']:null;
        $etniaAnterior=isset($rowT['ETNIA']) ? $rowT['ETNIA']:null;
        $obesoAnterior=isset($rowT['OBESO']) ? $rowT['OBESO']:null;
        $htaAnterior=isset($rowT['HTA']) ? $rowT['HTA']:null;
        $dmAnterior=isset($rowT['DM']) ? $rowT['DM']:null;
        $tabacoAnterior=isset($rowT['TABACO']) ? $rowT['TABACO']:null;
        $heredaAnterior=isset($rowT['HEREDA']) ? $rowT['HEREDA']:null;
        $tactorAnterior=isset($rowT['TACTOR']) ? $rowT['TACTOR']:null;
        $psapreAnterior=isset($rowT['PSAPRE']) ? $rowT['PSAPRE']:null;
        $psaltAnterior=isset($rowT['PSALT']) ? $rowT['PSALT']:null;
        $tduppreAnterior=isset($rowT['TDUPPRE']) ? $rowT['TDUPPRE']:null;
        $ecotrAnterior=isset($rowT['ECOTR']) ? $rowT['ECOTR']:null;
        $nbiopsiaAnterior=isset($rowT['NBIOPSIA']) ? $rowT['NBIOPSIA']:null;
        $histoAnterior=isset($rowT['HISTO']) ? $rowT['HISTO']:null;
        $gleason1Anterior=isset($rowT['GLEASON1']) ? $rowT['GLEASON1']:null;
        $ncilposAnterior=isset($rowT['NCILPOS']) ? $rowT['NCILPOS']:null;
        $bilatAnterior=isset($rowT['BILAT']) ? $rowT['BILAT']:null;
        $porcentAnterior=isset($rowT['PORCENT']) ? $rowT['PORCENT']:null;
        $iperinAnterior=isset($rowT['IPERIN']) ? $rowT['IPERIN']:null;
        $ilinfAnterior=isset($rowT['ILINF']) ? $rowT['ILINF']:null;
        $ivascuAnterior=isset($rowT['IVASCU']) ? $rowT['IVASCU']:null;
        $tnm1Anterior=isset($rowT['TNM1']) ? $rowT['TNM1']:null;
        $histo2Anterior=isset($rowT['HISTO2']) ? $rowT['HISTO2']:null;
        $gleason2Anterior=isset($rowT['GLEASON2']) ? $rowT['GLEASON2']:null;
        $bilat2Anterior=isset($rowT['BILAT2']) ? $rowT['BILAT2']:null;
        $localizAnterior=isset($rowT['LOCALIZ']) ? $rowT['LOCALIZ']:null;
        $multifocAnterior=isset($rowT['MULTIFOC']) ? $rowT['MULTIFOC']:null;
        $volumenAnterior=isset($rowT['VOLUMEN']) ? $rowT['VOLUMEN']:null;
        $extracapAnterior=isset($rowT['EXTRACAP']) ? $rowT['EXTRACAP']:null;
        $vvssAnterior=isset($rowT['VVSS']) ? $rowT['VVSS']:null;
        $iperin2Anterior=isset($rowT['IPERIN2']) ? $rowT['IPERIN2']:null;
        $ilinf2Anterior=isset($rowT['ILINF2']) ? $rowT['ILINF2']:null;
        $ivascu2Anterior=isset($rowT['IVASCU2']) ? $rowT['IVASCU2']:null;
        $pinagAnterior=isset($rowT['PINAG']) ? $rowT['PINAG']:null;
        $margenAnterior=isset($rowT['MARGEN']) ? $rowT['MARGEN']:null;
        $tnm2Anterior=isset($rowT['TNM2']) ? $rowT['TNM2']:null;
        $psaposAnterior=isset($rowT['PSAPOS']) ? $rowT['PSAPOS']:null;
        $rtpadyuAnterior=isset($rowT['RTPADYU']) ? $rowT['RTPADYU']:null;
        $rtpmesAnterior=isset($rowT['RTPMES']) ? $rowT['RTPMES']:null;
        $rbqAnterior=isset($rowT['RBQ']) ? $rowT['RBQ']:null;
        $trbqAnterior=isset($rowT['TRBQ']) ? $rowT['TRBQ']:null;
        $tdupliAnterior=isset($rowT['TDUPLI']) ? $rowT['TDUPLI']:null;
        $t1mtxAnterior=isset($rowT['T1MTX']) ? $rowT['T1MTX']:null;
        $fechafinAnterior=isset($rowT['FECHAFIN']) ? $rowT['FECHAFIN']:null;
        $fallecAnterior=isset($rowT['FALLEC']) ? $rowT['FALLEC']:null;
        $tsupervAnterior=isset($rowT['TSUPERV']) ? $rowT['TSUPERV']:null;
        $psafinAnterior=isset($rowT['PSAFIN']) ? $rowT['PSAFIN']:null;
        $tseguiAnterior=isset($rowT['TSEGUI']) ? $rowT['TSEGUI']:null;
        $notasAnterior=isset($rowT['NOTAS']) ? $rowT['NOTAS']:null;
        $capra_sAnterior=isset($rowT['CAPRA_S']) ? $rowT['CAPRA_S']:null;
        $raAnterior=isset($rowT['RA']) ? $rowT['RA']:null;
        $ptenAnterior=isset($rowT['PTEN']) ? $rowT['PTEN']:null;
        $ergAnterior=isset($rowT['ERG']) ? $rowT['ERG']:null;
        $ki_67Anterior=isset($rowT['KI_67']) ? $rowT['KI_67']:null;
        $spink1Anterior=isset($rowT['SPINK1']) ? $rowT['SPINK1']:null;
        $c_mycAnterior=isset($rowT['C_MYC']) ? $rowT['C_MYC']:null;


            $tabla .=<<<EOS

<form method= "post" enctype="application/x-www-form-urlencoded" action="procesarEditPatient.php?id=$id"><tr>
            <td>$id</td>
            <td><input type="date" min="1950-01-01" max="2023-02-13" name="fechacir" value=$fechacirAnterior /></td>
            <td><input type="number" min="0" max="120" name="edad" value=$edadAnterior /></td>
            <td><input type="number" min="1" max="4" name="etnia" value=$etniaAnterior /></td>
            <td><input type="number" min="0" max="3" name="obeso" value=$obesoAnterior /></td>
            <td><input type="number" min="1" max="3" name="hta" value=$htaAnterior /></td>
            <td><input type="number" min="1" max="3" name="dm" value=$dmAnterior /></td>
            <td><input type="number" min="0" max="5" name="tabaco" value=$tabacoAnterior /></td>
            <td><input type="number" min="1" max="2" name="hereda" value=$heredaAnterior /></td>
            <td><input type="number" min="1" max="3" name="tactor" value=$tactorAnterior /></td>
            <td><input type="number" min="0" max="999" step="any" name="psapre" value=$psapreAnterior /></td>
            <td><input type="number" min="0" max="1" step="any" name="psalt" value=$psaltAnterior /></td>
            <td><input type="number" min="0" max="999" step="any" name="tduppre" value=$tduppreAnterior /></td>
            <td><input type="number" min="1" max="2" name="ecotr" value=$ecotrAnterior /></td>
            <td><input type="number" min="0" max="999" name="nbiopsia" value=$nbiopsiaAnterior /></td>
            <td><input type="number" min="1" max="2" name="histo" value=$histoAnterior /></td>
            <td><input type="number" min="0" max="5" name="gleason1" value=$gleason1Anterior /></td>
            <td><input type="number" min="1" max="3" name="ncilpos" value=$ncilposAnterior /></td>
            <td><input type="number" min="1" max="2" name="bilat" value=$bilatAnterior /></td>
            <td><input type="number" min="0" max="100" name="porcent" value=$porcentAnterior /></td>
            <td><input type="number" min="1" max="3" name="iperin" value=$iperinAnterior /></td>
            <td><input type="number" min="1" max="3" name="ilinf" value=$ilinfAnterior /></td>
            <td><input type="number" min="1" max="3" name="ivascu" value=$ivascuAnterior /></td>
            <td><input type="number" min="1" max="3" name="tnm1" value=$tnm1Anterior /></td>
            <td><input type="number" min="1" max="2" name="histo2" value=$histo2Anterior /></td>
            <td><input type="number" min="0" max="5" name="gleason2" value=$gleason2Anterior /></td>
            <td><input type="number" min="1" max="2" name="bilat2" value=$bilat2Anterior /></td>
            <td><input type="number" min="1" max="4" name="localiz" value=$localizAnterior /></td>
            <td><input type="number" min="1" max="2" name="multifoc" value=$multifocAnterior /></td>
            <td><input type="number" min="1" max="100" name="volumen" value=$volumenAnterior /></td>
            <td><input type="number" min="1" max="2" name="extracap" value=$extracapAnterior /></td>
            <td><input type="number" min="1" max="3" name="vvss" value=$vvssAnterior /></td>
            <td><input type="number" min="1" max="3" name="iperin2" value=$iperin2Anterior /></td>
            <td><input type="number" min="1" max="3" name="ilinf2" value=$ilinf2Anterior /></td>
            <td><input type="number" min="1" max="3" name="ivascu2" value=$ivascu2Anterior /></td>
            <td><input type="number" min="1" max="3" name="pinag" value=$pinagAnterior /></td>
            <td><input type="number" min="1" max="3" name="margen" value=$margenAnterior /></td>
            <td><input type="number" min="1" max="5" name="tnm2" value=$tnm2Anterior /></td>
            <td><input type="number" min="0" max="999" step="any" name="psapos" value=$psaposAnterior /></td>
            <td><input type="number" min="1" max="2" name="rtpadyu" value=$rtpadyuAnterior /></td>
            <td><input type="number" min="0" max="999" name="rtpmes" value=$rtpmesAnterior /></td>
            <td><input type="number" min="1" max="3" name="rbq" value=$rbqAnterior /></td>
            <td><input type="number" min="0" max="999" name="trbq" value=$trbqAnterior /></td>
            <td><input type="number" min="0" max="999" name="tdupli" step="any" value=$tdupliAnterior /></td>
            <td><input type="number" min="0" max="999" name="t1mtx" value=$t1mtxAnterior /></td>
            <td><input type="date" name="fechafin" min="1910-01-01" max="2023-02-13" value=$fechafinAnterior /></td>
            <td><input type="number" min="1" max="2" name="fallec" value=$fallecAnterior /></td>
            <td><input type="number" min="0" max="999" name="tsuperv" value=$tsupervAnterior /></td>
            <td><input type="number" min="0" max="999" step="any" name="psafin" value=$psafinAnterior /></td>
            <td><input type="number" min="0" max="999" name="tsegui" value=$tseguiAnterior /></td>
            <td><input type="text" name="notas" value=$notasAnterior /></td>
            <td><input type="number" min="0" max="999" name="capras" value=$capra_sAnterior /></td>
            <td><input type="number" min="0" max="1" name="ra" value=$raAnterior /></td>
            <td><input type="number" min="0" max="2" name="pten" value=$ptenAnterior /></td>
            <td><input type="number" min="0" max="1" name="erg" value=$ergAnterior /></td>
            <td><input type="number" min="0" max="2" name="ki67" value=$ki_67Anterior /></td>
            <td><input type="number" min="0" max="1" name="spink1" value=$spink1Anterior /></td>
            <td><input type="number" min="0" max="1" name="cmyc" value=$c_mycAnterior /></td>
         
</tr>
<tr >
<td class="fin"><input class="btn btn-success btn-lg" type="submit" name="Editado" value="Guardar Datos" /></td>
<td class="fin"><a href='searchPatient.php?id=$id' class='btn btn-success btn-lg'>Volver</a></td>
</tr>
</form>
<link rel="stylesheet" href="css/tableStyle.css">
EOS;
    }

    $tabla .= "</table>";
} else {
    $tabla .= "<h1>0 results</h1>";
    $tabla .= "<a href='tablaPacientes.php' class='btn btn-success btn-lg'>Volver</a>";
    $hayResultado=false;
}

// Close the connection
mysqli_close($conn);
if($hayResultado){
    $contenidoPrincipal.= <<<EOS


<div style="width: 1500px; height: 200px; overflow: auto; margin: 0 auto; margin-top: 30px; outline: 0px solid black;">
EOS;
}
$contenidoPrincipal .= $tabla;
$contenidoPrincipal .= "</div>";

require __DIR__.'/includes/layout.php';