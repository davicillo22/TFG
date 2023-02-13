<?php

/*
 * funcion que recopila los datos del formulario de añadir Paciente.
 * Procesa la solicitud; si esta es correcta devuelve true o false en caso contrario.
 */
function registerPatient(){

    $fechacir = $_POST['fechacir'];
    if (!isset($fechacir) || $fechacir === "") $fechacir = "NULL";

   $edad = $_POST['edad'];
    if (!isset($edad) || $edad === "") $edad = "NULL";


    $etnia = $_POST['etnia'];
    if (!isset($etnia) || $etnia === "") $etnia = "NULL";

    $obeso = $_POST['obeso'];
    if (!isset($obeso) || $obeso === "") $obeso = "NULL";

    $hta = $_POST['hta'];
    if (!isset($hta) || $hta === "") $hta = "NULL";

    $dm = $_POST['dm'];
    if (!isset($dm) || $dm === "") $dm = "NULL";

    $tabaco = $_POST['tabaco'];
    if (!isset($tabaco) || $tabaco === "") $tabaco = "NULL";

    $hereda = $_POST['hereda'];
    if (!isset($hereda) || $hereda === "") $hereda = "NULL";

    $tactor = $_POST['tactor'];
    if (!isset($tactor) || $tactor === "") $tactor = "NULL";

    $psapre = $_POST['psapre'];
    if (!isset($psapre) || $psapre === "") $psapre = "NULL";

    $psalt = $_POST['psalt'];
    if (!isset($psalt) || $psalt === "") $psalt = "NULL";

    $tduppre = $_POST['tduppre'];
    if (!isset($tduppre) || $tduppre === "") $tduppre = "NULL";

    $ecotr = $_POST['ecotr'];
    if (!isset($ecotr) || $ecotr === "") $ecotr = "NULL";

    $nbiopsia = $_POST['nbiopsia'];
    if (!isset($nbiopsia) || $nbiopsia === "") $nbiopsia = "NULL";

    $histo = $_POST['histo'];
    if (!isset($histo) || $histo === "") $histo = "NULL";

    $gleason1 = $_POST['gleason1'];
    if (!isset($gleason1) || $gleason1 === "") $gleason1 = "NULL";

    $ncilpos = $_POST['ncilpos'];
    if (!isset($ncilpos) || $ncilpos === "") $ncilpos = "NULL";

    $bilat = $_POST['bilat'];
    if (!isset($bilat) || $bilat === "") $bilat = "NULL";

    $porcent = $_POST['porcent'];
    if (!isset($porcent) || $porcent === "") $porcent = "NULL";

    $iperin = $_POST['iperin'];
    if (!isset($iperin) || $iperin === "") $iperin = "NULL";

    $ilinf = $_POST['ilinf'];
    if (!isset($ilinf) || $ilinf === "") $ilinf = "NULL";

    $ivascu = $_POST['ivascu'];
    if (!isset($ivascu) || $ivascu === "") $ivascu = "NULL";

    $tnm1 = $_POST['tnm1'];
    if (!isset($tnm1) || $tnm1 === "") $tnm1 = "NULL";

    $histo2 = $_POST['histo2'];
    if (!isset($histo2) || $histo2 === "") $histo2 = "NULL";

    $gleason2 = $_POST['gleason2'];
    if (!isset($gleason2) || $gleason2 === "") $gleason2 = "NULL";

    $bilat2 = $_POST['bilat2'];
    if (!isset($bilat2) || $bilat2 === "") $bilat2 = "NULL";

    $localiz = $_POST['localiz'];
    if (!isset($localiz) || $localiz === "") $localiz = "NULL";

    $multifoc = $_POST['multifoc'];
    if (!isset($multifoc) || $multifoc === "") $multifoc = "NULL";

    $volumen = $_POST['volumen'];
    if (!isset($volumen) || $volumen === "") $volumen = "NULL";

    $extracap = $_POST['extracap'];
    if (!isset($extracap) || $extracap === "") $extracap = "NULL";

    $vvss = $_POST['vvss'];
    if (!isset($vvss) || $vvss === "") $vvss = "NULL";

    $iperin2 = $_POST['iperin2'];
    if (!isset($iperin2) || $iperin2 === "") $iperin2 = "NULL";

    $ilinf2 = $_POST['ilinf2'];
    if (!isset($ilinf2) || $ilinf2 === "") $ilinf2 = "NULL";

    $ivascu2 = $_POST['ivascu2'];
    if (!isset($ivascu2) || $ivascu2 === "") $ivascu2 = "NULL";

    $pinag = $_POST['pinag'];
    if (!isset($pinag) || $pinag === "") $pinag = "NULL";

    $margen = $_POST['margen'];
    if (!isset($margen) || $margen === "") $margen = "NULL";

    $tnm2 = $_POST['tnm2'];
    if (!isset($tnm2) || $tnm2 === "") $tnm2 = "NULL";

    $psapos = $_POST['psapos'];
    if (!isset($psapos) || $psapos === "") $psapos = "NULL";

    $rtpadyu = $_POST['rtpadyu'];
    if (!isset($rtpadyu) || $rtpadyu === "") $rtpadyu = "NULL";

    $rtpmes = $_POST['rtpmes'];
    if (!isset($rtpmes) || $rtpmes === "") $rtpmes = "NULL";

    $rbq = $_POST['rbq'];
    if (!isset($rbq) || $rbq === "") $rbq = "NULL";

    $trbq = $_POST['trbq'];
    if (!isset($trbq) || $trbq === "") $trbq = "NULL";

    $tdupli = $_POST['tdupli'];
    if (!isset($tdupli) || $tdupli === "") $tdupli = "NULL";

    $t1mtx = $_POST['t1mtx'];
    if (!isset($t1mtx) || $t1mtx === "") $t1mtx = "NULL";

    $fechafin = $_POST['fechafin'];
    if (!isset($fechafin) || $fechafin === "") $fechafin = "NULL";

    $fallec = $_POST['fallec'];
    if (!isset($fallec) || $fallec === "") $fallec = "NULL";

    $tsuperv = $_POST['tsuperv'];
    if (!isset($tsuperv) || $tsuperv === "") $tsuperv = "NULL";

    $psafin = $_POST['psafin'];
    if (!isset($psafin) || $psafin === "") $psafin = "NULL";

    $tsegui = $_POST['tsegui'];
    if (!isset($tsegui) || $tsegui === "") $tsegui = "NULL";

    $notas = $_POST['notas'];
    if (!isset($notas) || $notas === "") $notas = "NULL";

    $capras = $_POST['capras'];
    if (!isset($capras) || $capras === "") $capras = "NULL";

    $ra = $_POST['ra'];
    if (!isset($ra) || $ra === "") $ra = "NULL";

    $pten = $_POST['pten'];
    if (!isset($pten) || $pten === "") $pten = "NULL";

    $erg = $_POST['erg'];
    if (!isset($erg) || $erg === "") $erg = "NULL";

    $ki67 = $_POST['ki67'];
    if (!isset($ki67) || $ki67 === "") $ki67 = "NULL";

    $spink1 = $_POST['spink1'];
    if (!isset($spink1) || $spink1 === "") $spink1 = "NULL";

    $cmyc = $_POST['cmyc'];
    if (!isset($cmyc) || $cmyc === "") $cmyc = "NULL";

    if (Patient::registrarPatient($fechacir, $edad, $etnia, $obeso, $hta, $dm, $tabaco, $hereda, $tactor, $psapre, $psalt, $tduppre, $ecotr, $nbiopsia, $histo, $gleason1,
        $ncilpos, $bilat, $porcent, $iperin, $ilinf, $ivascu, $tnm1, $histo2, $gleason2, $bilat2, $localiz, $multifoc, $volumen, $extracap, $vvss, $iperin2, $ilinf2, $ivascu2,
        $pinag, $margen, $tnm2, $psapos, $rtpadyu, $rtpmes, $rbq, $trbq, $tdupli, $t1mtx, $fechafin, $fallec, $tsuperv, $psafin, $tsegui, $notas, $capras, $ra, $pten, $erg, $ki67, $spink1, $cmyc  )){
        return true;
    }else{
        return false;
    }
}




