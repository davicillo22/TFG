<?php

/*
 * funcion que recopila los datos del formulario de añadir Paciente.
 * Procesa la solicitud; si esta es correcta devuelve true o false en caso contrario.
 */
function registerPatient(){
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
    $timtx = isset($_POST["timtx"]) ? $_POST["timtx"] : null;
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


    if (Patient::registrarPatient($fechacir, $edad, $etnia, $obeso, $hta, $dm, $tabaco, $hereda, $tactor, $psapre, $psalt, $tduppre, $ecotr, $nbiopsia, $histo, $gleason1,
        $ncilpos, $bilat, $porcent, $iperin, $ilinf, $ivascu, $tnm1, $histo2, $gleason2, $bilat2, $localiz, $multifoc, $volumen, $extracap, $vvss, $iperin2, $ilinf2, $ivascu2,
        $pinag, $margen, $tnm2, $psapos, $rtpadyu, $rtpmes, $rbq, $trbq, $tdupli, $timtx, $fechafin, $fallec, $tsuperv, $psafin, $tsegui, $notas, $capras, $ra, $pten, $erg, $ki67, $spink1, $cmyc  )){
        return true;
    }else{
        return false;
    }
}


/*
 * funcion que muestra al usuario sus datos personales en formato tabla
 */
function datosUsuario($email): string
{
    $html = '<link rel="stylesheet" href="css/style.css"><div class="screen-1"><p><table class="formula">';
    $perfil = Usuario::buscaUsuario($email);
    $html .='<thead><td colspan="2"> Datos del usuario</td></thead>';

    $html .= '<tr><td>';
    $html .= 'Nombre: ';
    $html .= '</td><td>';
    $html .= $perfil->name();
    $html .= '</td></tr>';

    $html .= '<tr><td>';
    $html .= 'Apellido: ';
    $html .= '</td><td>';
    $html .= $perfil->surname();
    $html .= '</td></tr>';

    $html .= '<tr><td>';
    $html .= 'Email: ';
    $html .= '</td><td>';
    $html .= $perfil->email();
    $html .= '</td></tr>';

    $html .= '<tr><td>';
    $html .= 'Privilegios: ';
    $html .= '</td><td>';
    if ($perfil->privileges() == 0){
        $html.= 'Administrador';
    }else{
        $html.= 'Usuario';
    }
    $html .= '</td></tr>';

    $html .= '</table><a href = "editProfile.php"> <button class="btnprof"> Modifica tus datos </button></a></p></div>';

    return $html;
}

/*
 * funcion que procesa las peticiones de cambio de datos proporcionadas por el usuario.
 * Devuelve true si todos se realizan de manera correcta, false en caso contrario.
 */
function cambiarDatos($email): bool
{

    $bool = true;

    $perfil = Usuario::buscaUsuario($email);


    $password = isset($_POST["password"]) ? $_POST["password"] : null;
    $password2 = isset($_POST["password2"]) ? $_POST["password2"] : null;
    if($password!=null){
        if($password==$password2){
            $bool = $perfil->cambiaPassword($password);
        }else{
            return false;
        }
    }

    $username = isset($_POST["name"]) ? $_POST["name"] : null;
    if($username!=null){
        $bool = $perfil->cambiaName($username);
    }

    $last = isset($_POST["surname"]) ? $_POST["surname"] : null;
    if($last!=null){
        $bool = $perfil->cambiaSurname($last);
    }

    if($bool==true)
        $perfil->actualizarSesion();


    return $bool;
}