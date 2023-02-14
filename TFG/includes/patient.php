<?php

require_once __DIR__.'/config.php';


class Patient
{

private $fechacir, $nhis, $edad, $etnia, $obeso, $hta, $dm, $tabaco, $hereda, $tactor, $psapre, $psalt, $tduppre, $ecotr, $nbiopsia, $histo, $gleason1,
$ncilpos, $bilat, $porcent, $iperin, $ilinf, $ivascu, $tnm1, $histo2, $gleason2, $bilat2, $localiz, $multifoc, $volumen, $extracap, $vvss, $iperin2, $ilinf2, $ivascu2,
$pinag, $margen, $tnm2, $psapos, $rtpadyu, $rtpmes, $rbq, $trbq, $tdupli, $t1mtx, $fechafin, $fallec, $tsuperv, $psafin, $tsegui, $notas, $capras, $ra, $pten, $erg, $ki67, $spink1, $cmyc;


    public function __construct($nhis, $fechacir, $edad, $etnia, $obeso, $hta, $dm, $tabaco, $hereda, $tactor, $psapre, $psalt, $tduppre, $ecotr, $nbiopsia, $histo, $gleason1, $ncilpos, $bilat, $porcent, $iperin,
                                $ilinf, $ivascu, $tnm1, $histo2, $gleason2, $bilat2, $localiz, $multifoc, $volumen, $extracap, $vvss, $iperin2, $ilinf2, $ivascu2, $pinag, $margen, $tnm2, $psapos, $rtpadyu,
                                $rtpmes, $rbq, $trbq, $tdupli, $t1mtx, $fechafin, $fallec, $tsuperv, $psafin, $tsegui, $notas, $capras, $ra, $pten, $erg, $ki67, $spink1, $cmyc)
    {
        $this->nhis = $nhis;
        $this->fechacir = $fechacir;
        $this->edad = $edad;
        $this->etnia = $etnia;
        $this->obeso = $obeso;
        $this->hta = $hta;
        $this->dm = $dm;
        $this->tabaco = $tabaco;
        $this->hereda = $hereda;
        $this->tactor = $tactor;
        $this->psapre = $psapre;
        $this->psalt = $psalt;
        $this->tduppre = $tduppre;
        $this->ecotr = $ecotr;
        $this->nbiopsia = $nbiopsia;
        $this->histo = $histo;
        $this->gleason1 = $gleason1;
        $this->ncilpos = $ncilpos;
        $this->bilat = $bilat;
        $this->porcent = $porcent;
        $this->iperin = $iperin;
        $this->ilinf = $ilinf;
        $this->ivascu = $ivascu;
        $this->tnm1 = $tnm1;
        $this->histo2 = $histo2;
        $this->gleason2 = $gleason2;
        $this->bilat2 = $bilat2;
        $this->localiz = $localiz;
        $this->multifoc = $multifoc;
        $this->volumen = $volumen;
        $this->extracap = $extracap;
        $this->vvss = $vvss;
        $this->iperin2 = $iperin2;
        $this->ilinf2 = $ilinf2;
        $this->ivascu2 = $ivascu2;
        $this->pinag = $pinag;
        $this->margen = $margen;
        $this->tnm2 = $tnm2;
        $this->psapos = $psapos;
        $this->rtpadyu = $rtpadyu;
        $this->rtpmes = $rtpmes;
        $this->rbq = $rbq;
        $this->trbq = $trbq;
        $this->tdupli = $tdupli;
        $this->t1mtx = $t1mtx;
        $this->fechafin = $fechafin;
        $this->fallec = $fallec;
        $this->tsuperv = $tsuperv;
        $this->psafin = $psafin;
        $this->tsegui = $tsegui;
        $this->notas = $notas;
        $this->capras = $capras;
        $this->ra = $ra;
        $this->pten = $pten;
        $this->erg = $erg;
        $this->ki67 = $ki67;
        $this->spink1 = $spink1;
        $this->cmyc = $cmyc;
    }

    /*
 * funcion que entra en la base de datos para dar de alta un nuevo usuario, dados todos los campos necesarios
 */
    public static function registrarPatient($nhis, $fechacir, $edad, $etnia, $obeso, $hta, $dm, $tabaco, $hereda, $tactor, $psapre, $psalt, $tduppre, $ecotr, $nbiopsia, $histo, $gleason1,
                                            $ncilpos, $bilat, $porcent, $iperin, $ilinf, $ivascu, $tnm1, $histo2, $gleason2, $bilat2, $localiz, $multifoc, $volumen, $extracap, $vvss, $iperin2, $ilinf2, $ivascu2,
                                            $pinag, $margen, $tnm2, $psapos, $rtpadyu, $rtpmes, $rbq, $trbq, $tdupli, $t1mtx, $fechafin, $fallec, $tsuperv, $psafin, $tsegui, $notas, $capras, $ra, $pten, $erg, $ki67, $spink1, $cmyc): bool
    {

        $conn = getConexionBD();//corregir %s %d cuando se arregle tema fechas y varchars, añadir otro %d al final para NHIS


            $query = sprintf("INSERT INTO `patients` (`nhis`,`fechacir`, `edad`, `etnia`, `obeso`, `hta`, `dm`, `tabaco`, `hereda`, `tactor`, `psapre`, `psalt`, `tduppre`, `ecotr`, `nbiopsia`, `histo`
                            ,`gleason1`, `ncilpos`, `bilat`, `porcent`, `iperin`, `ilinf`, `ivascu`, `tnm1`, `histo2`, `gleason2`, `bilat2`, `localiz`, `multifoc`, `volumen`, `extracap`, `vvss`, `iperin2`, `ilinf2`, `ivascu2`, `pinag`, `margen`,
                       `tnm2`, `psapos`, `rtpadyu`, `rtpmes`, `rbq`, `trbq`, `tdupli`, `t1mtx`, `fechafin`, `fallec`, `tsuperv`, `psafin`, `tsegui`, `notas`, `capra_s`, `ra`, `pten`, `erg`, `ki_67`, `spink1`, `c_myc`)
                VALUES (%s,'%s', %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s,
                        %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s,
                        %s, %s, %s, %s, %s, %s, %s, '%s', %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $nhis, $conn->real_escape_string($fechacir),
               $edad, $etnia, $obeso, $hta, $dm, $tabaco, $hereda, $tactor, $conn->real_escape_string($psapre), $conn->real_escape_string($psalt), $conn->real_escape_string($tduppre), $ecotr, $nbiopsia, $histo, $gleason1,
                $ncilpos, $bilat, $conn->real_escape_string($porcent), $iperin, $ilinf, $ivascu, $tnm1, $histo2, $gleason2, $bilat2, $localiz, $multifoc, $conn->real_escape_string($volumen), $extracap, $vvss, $iperin2, $ilinf2, $ivascu2,
                $pinag, $margen, $tnm2, $conn->real_escape_string($psapos), $rtpadyu, $rtpmes, $rbq, $trbq, $conn->real_escape_string($tdupli), $t1mtx, $conn->real_escape_string($fechafin), $fallec, $tsuperv, $conn->real_escape_string($psafin), $tsegui, $conn->real_escape_string($notas), $capras, $ra, $pten, $erg, $ki67, $spink1, $cmyc);
           //var_dump($query);

     //   $sql = "UPDATE patients SET fechacir = '$fechacir', edad = $edad, etnia = '$etnia', obeso = '$obeso', hta = '$hta', dm = '$dm', tabaco = '$tabaco', hereda = '$hereda', tactor = '$tactor', psapre = '$psapre', psalt = '$psalt',
     //               tduppre = '$tduppre', ecotr = '$ecotr', nbiopsia = '$nbiopsia', histo = '$histo', gleason1 = '$gleason1', ncilpos = '$ncilpos', bilat = '$bilat',
      //              porcent = '$porcent', iperin = '$iperin', ilinf = '$ilinf', ivascu = '$ivascu', tnm1 = '$tnm1', histo2 = '$histo2', gleason2 = '$gleason2', bilat2 = '$bilat2',
       //             localiz = '$localiz', multifoc = '$multifoc', volumen = '$volumen', extracap = '$extracap', vvss = '$vvss', iperin2 = '$iperin2', ilinf2 = '$ilinf2',
        //            ivascu2 = '$ivascu2', pinag = '$pinag', margen = '$margen', tnm2 = '$tnm2', psapos = '$psapos', rtpadyu = '$rtpadyu', rtpmes = '$rtpmes', rbq = '$rbq', trbq = '$trbq', tdupli = '$tdupli'
         //           ,tdupli = '$tdupli',t1mtx = '$t1mtx',fechafin = '$fechafin',fallec = '$fallec',tsuperv = '$tsuperv',psafin = '$psafin',tsegui = '$tsegui',notas = '$notas',capra_s = '$capras',
          //           ra = '$ra',pten = '$pten',erg = '$erg',ki_67 = '$ki67', spink1 = '$spink1' ,c_myc = '$cmyc'
           //     WHERE `patients`.`NHIS`=$id";

            if ($conn->query($query) === TRUE) {
                return true;
            }

        return false;
    }

    /**
     * @return mixed
     */
    public function getNhis()
    {
        return $this->nhis;
    }

    /**
     * @param mixed $nhis
     */
    public function setNhis($nhis): void
    {
        $this->nhis = $nhis;
    }

    /**
     * @return mixed
     */
    public function getFechacir()
    {
        return $this->fechacir;
    }

    /**
     * @param mixed $fechacir
     */
    public function setFechacir($fechacir): void
    {
        $this->fechacir = $fechacir;
    }

    /**
     * @return mixed
     */
    public function getEdad()
    {
        return $this->edad;
    }

    /**
     * @param mixed $edad
     */
    public function setEdad($edad): void
    {
        $this->edad = $edad;
    }

    /**
     * @return mixed
     */
    public function getEtnia()
    {
        return $this->etnia;
    }

    /**
     * @param mixed $etnia
     */
    public function setEtnia($etnia): void
    {
        $this->etnia = $etnia;
    }

    /**
     * @return mixed
     */
    public function getObeso()
    {
        return $this->obeso;
    }

    /**
     * @param mixed $obeso
     */
    public function setObeso($obeso): void
    {
        $this->obeso = $obeso;
    }

    /**
     * @return mixed
     */
    public function getHta()
    {
        return $this->hta;
    }

    /**
     * @param mixed $hta
     */
    public function setHta($hta): void
    {
        $this->hta = $hta;
    }

    /**
     * @return mixed
     */
    public function getDm()
    {
        return $this->dm;
    }

    /**
     * @param mixed $dm
     */
    public function setDm($dm): void
    {
        $this->dm = $dm;
    }

    /**
     * @return mixed
     */
    public function getTabaco()
    {
        return $this->tabaco;
    }

    /**
     * @param mixed $tabaco
     */
    public function setTabaco($tabaco): void
    {
        $this->tabaco = $tabaco;
    }

    /**
     * @return mixed
     */
    public function getHereda()
    {
        return $this->hereda;
    }

    /**
     * @param mixed $hereda
     */
    public function setHereda($hereda): void
    {
        $this->hereda = $hereda;
    }

    /**
     * @return mixed
     */
    public function getTactor()
    {
        return $this->tactor;
    }

    /**
     * @param mixed $tactor
     */
    public function setTactor($tactor): void
    {
        $this->tactor = $tactor;
    }

    /**
     * @return mixed
     */
    public function getPsapre()
    {
        return $this->psapre;
    }

    /**
     * @param mixed $psapre
     */
    public function setPsapre($psapre): void
    {
        $this->psapre = $psapre;
    }

    /**
     * @return mixed
     */
    public function getPsalt()
    {
        return $this->psalt;
    }

    /**
     * @param mixed $psalt
     */
    public function setPsalt($psalt): void
    {
        $this->psalt = $psalt;
    }

    /**
     * @return mixed
     */
    public function getTduppre()
    {
        return $this->tduppre;
    }

    /**
     * @param mixed $tduppre
     */
    public function setTduppre($tduppre): void
    {
        $this->tduppre = $tduppre;
    }

    /**
     * @return mixed
     */
    public function getEcotr()
    {
        return $this->ecotr;
    }

    /**
     * @param mixed $ecotr
     */
    public function setEcotr($ecotr): void
    {
        $this->ecotr = $ecotr;
    }

    /**
     * @return mixed
     */
    public function getNbiopsia()
    {
        return $this->nbiopsia;
    }

    /**
     * @param mixed $nbiopsia
     */
    public function setNbiopsia($nbiopsia): void
    {
        $this->nbiopsia = $nbiopsia;
    }

    /**
     * @return mixed
     */
    public function getHisto()
    {
        return $this->histo;
    }

    /**
     * @param mixed $histo
     */
    public function setHisto($histo): void
    {
        $this->histo = $histo;
    }

    /**
     * @return mixed
     */
    public function getGleason1()
    {
        return $this->gleason1;
    }

    /**
     * @param mixed $gleason1
     */
    public function setGleason1($gleason1): void
    {
        $this->gleason1 = $gleason1;
    }

    /**
     * @return mixed
     */
    public function getNcilpos()
    {
        return $this->ncilpos;
    }

    /**
     * @param mixed $ncilpos
     */
    public function setNcilpos($ncilpos): void
    {
        $this->ncilpos = $ncilpos;
    }

    /**
     * @return mixed
     */
    public function getBilat()
    {
        return $this->bilat;
    }

    /**
     * @param mixed $bilat
     */
    public function setBilat($bilat): void
    {
        $this->bilat = $bilat;
    }

    /**
     * @return mixed
     */
    public function getPorcent()
    {
        return $this->porcent;
    }

    /**
     * @param mixed $porcent
     */
    public function setPorcent($porcent): void
    {
        $this->porcent = $porcent;
    }

    /**
     * @return mixed
     */
    public function getIperin()
    {
        return $this->iperin;
    }

    /**
     * @param mixed $iperin
     */
    public function setIperin($iperin): void
    {
        $this->iperin = $iperin;
    }

    /**
     * @return mixed
     */
    public function getIlinf()
    {
        return $this->ilinf;
    }

    /**
     * @param mixed $ilinf
     */
    public function setIlinf($ilinf): void
    {
        $this->ilinf = $ilinf;
    }

    /**
     * @return mixed
     */
    public function getIvascu()
    {
        return $this->ivascu;
    }

    /**
     * @param mixed $ivascu
     */
    public function setIvascu($ivascu): void
    {
        $this->ivascu = $ivascu;
    }

    /**
     * @return mixed
     */
    public function getTnm1()
    {
        return $this->tnm1;
    }

    /**
     * @param mixed $tnm1
     */
    public function setTnm1($tnm1): void
    {
        $this->tnm1 = $tnm1;
    }

    /**
     * @return mixed
     */
    public function getHisto2()
    {
        return $this->histo2;
    }

    /**
     * @param mixed $histo2
     */
    public function setHisto2($histo2): void
    {
        $this->histo2 = $histo2;
    }

    /**
     * @return mixed
     */
    public function getGleason2()
    {
        return $this->gleason2;
    }

    /**
     * @param mixed $gleason2
     */
    public function setGleason2($gleason2): void
    {
        $this->gleason2 = $gleason2;
    }

    /**
     * @return mixed
     */
    public function getBilat2()
    {
        return $this->bilat2;
    }

    /**
     * @param mixed $bilat2
     */
    public function setBilat2($bilat2): void
    {
        $this->bilat2 = $bilat2;
    }

    /**
     * @return mixed
     */
    public function getLocaliz()
    {
        return $this->localiz;
    }

    /**
     * @param mixed $localiz
     */
    public function setLocaliz($localiz): void
    {
        $this->localiz = $localiz;
    }

    /**
     * @return mixed
     */
    public function getMultifoc()
    {
        return $this->multifoc;
    }

    /**
     * @param mixed $multifoc
     */
    public function setMultifoc($multifoc): void
    {
        $this->multifoc = $multifoc;
    }

    /**
     * @return mixed
     */
    public function getVolumen()
    {
        return $this->volumen;
    }

    /**
     * @param mixed $volumen
     */
    public function setVolumen($volumen): void
    {
        $this->volumen = $volumen;
    }

    /**
     * @return mixed
     */
    public function getExtracap()
    {
        return $this->extracap;
    }

    /**
     * @param mixed $extracap
     */
    public function setExtracap($extracap): void
    {
        $this->extracap = $extracap;
    }

    /**
     * @return mixed
     */
    public function getVvss()
    {
        return $this->vvss;
    }

    /**
     * @param mixed $vvss
     */
    public function setVvss($vvss): void
    {
        $this->vvss = $vvss;
    }

    /**
     * @return mixed
     */
    public function getIperin2()
    {
        return $this->iperin2;
    }

    /**
     * @param mixed $iperin2
     */
    public function setIperin2($iperin2): void
    {
        $this->iperin2 = $iperin2;
    }

    /**
     * @return mixed
     */
    public function getIlinf2()
    {
        return $this->ilinf2;
    }

    /**
     * @param mixed $ilinf2
     */
    public function setIlinf2($ilinf2): void
    {
        $this->ilinf2 = $ilinf2;
    }

    /**
     * @return mixed
     */
    public function getIvascu2()
    {
        return $this->ivascu2;
    }

    /**
     * @param mixed $ivascu2
     */
    public function setIvascu2($ivascu2): void
    {
        $this->ivascu2 = $ivascu2;
    }

    /**
     * @return mixed
     */
    public function getPinag()
    {
        return $this->pinag;
    }

    /**
     * @param mixed $pinag
     */
    public function setPinag($pinag): void
    {
        $this->pinag = $pinag;
    }

    /**
     * @return mixed
     */
    public function getMargen()
    {
        return $this->margen;
    }

    /**
     * @param mixed $margen
     */
    public function setMargen($margen): void
    {
        $this->margen = $margen;
    }

    /**
     * @return mixed
     */
    public function getTnm2()
    {
        return $this->tnm2;
    }

    /**
     * @param mixed $tnm2
     */
    public function setTnm2($tnm2): void
    {
        $this->tnm2 = $tnm2;
    }

    /**
     * @return mixed
     */
    public function getPsapos()
    {
        return $this->psapos;
    }

    /**
     * @param mixed $psapos
     */
    public function setPsapos($psapos): void
    {
        $this->psapos = $psapos;
    }

    /**
     * @return mixed
     */
    public function getRtpadyu()
    {
        return $this->rtpadyu;
    }

    /**
     * @param mixed $rtpadyu
     */
    public function setRtpadyu($rtpadyu): void
    {
        $this->rtpadyu = $rtpadyu;
    }

    /**
     * @return mixed
     */
    public function getRtpmes()
    {
        return $this->rtpmes;
    }

    /**
     * @param mixed $rtpmes
     */
    public function setRtpmes($rtpmes): void
    {
        $this->rtpmes = $rtpmes;
    }

    /**
     * @return mixed
     */
    public function getRbq()
    {
        return $this->rbq;
    }

    /**
     * @param mixed $rbq
     */
    public function setRbq($rbq): void
    {
        $this->rbq = $rbq;
    }

    /**
     * @return mixed
     */
    public function getTrbq()
    {
        return $this->trbq;
    }

    /**
     * @param mixed $trbq
     */
    public function setTrbq($trbq): void
    {
        $this->trbq = $trbq;
    }

    /**
     * @return mixed
     */
    public function getTdupli()
    {
        return $this->tdupli;
    }

    /**
     * @param mixed $tdupli
     */
    public function setTdupli($tdupli): void
    {
        $this->tdupli = $tdupli;
    }

    /**
     * @return mixed
     */
    public function getT1mtx()
    {
        return $this->t1mtx;
    }

    /**
     * @param mixed $timtx
     */
    public function setT1mtx($t1mtx): void
    {
        $this->t1mtx = $t1mtx;
    }

    /**
     * @return mixed
     */
    public function getFechafin()
    {
        return $this->fechafin;
    }

    /**
     * @param mixed $fechafin
     */
    public function setFechafin($fechafin): void
    {
        $this->fechafin = $fechafin;
    }

    /**
     * @return mixed
     */
    public function getFallec()
    {
        return $this->fallec;
    }

    /**
     * @param mixed $fallec
     */
    public function setFallec($fallec): void
    {
        $this->fallec = $fallec;
    }

    /**
     * @return mixed
     */
    public function getTsuperv()
    {
        return $this->tsuperv;
    }

    /**
     * @param mixed $tsuperv
     */
    public function setTsuperv($tsuperv): void
    {
        $this->tsuperv = $tsuperv;
    }

    /**
     * @return mixed
     */
    public function getPsafin()
    {
        return $this->psafin;
    }

    /**
     * @param mixed $psafin
     */
    public function setPsafin($psafin): void
    {
        $this->psafin = $psafin;
    }

    /**
     * @return mixed
     */
    public function getTsegui()
    {
        return $this->tsegui;
    }

    /**
     * @param mixed $tsegui
     */
    public function setTsegui($tsegui): void
    {
        $this->tsegui = $tsegui;
    }

    /**
     * @return mixed
     */
    public function getNotas()
    {
        return $this->notas;
    }

    /**
     * @param mixed $notas
     */
    public function setNotas($notas): void
    {
        $this->notas = $notas;
    }


    /**
     * @return mixed
     */
    public function getCapras()
    {
        return $this->capras;
    }

    /**
     * @param mixed $capras
     */
    public function setCapras($capras): void
    {
        $this->capras = $capras;
    }

    /**
     * @return mixed
     */
    public function getRa()
    {
        return $this->ra;
    }

    /**
     * @param mixed $ra
     */
    public function setRa($ra): void
    {
        $this->ra = $ra;
    }

    /**
     * @return mixed
     */
    public function getPten()
    {
        return $this->pten;
    }

    /**
     * @param mixed $pten
     */
    public function setPten($pten): void
    {
        $this->pten = $pten;
    }

    /**
     * @return mixed
     */
    public function getErg()
    {
        return $this->erg;
    }

    /**
     * @param mixed $erg
     */
    public function setErg($erg): void
    {
        $this->erg = $erg;
    }

    /**
     * @return mixed
     */
    public function getKi67()
    {
        return $this->ki67;
    }

    /**
     * @param mixed $ki67
     */
    public function setKi67($ki67): void
    {
        $this->ki67 = $ki67;
    }

    /**
     * @return mixed
     */
    public function getSpink1()
    {
        return $this->spink1;
    }

    /**
     * @param mixed $spink1
     */
    public function setSpink1($spink1): void
    {
        $this->spink1 = $spink1;
    }

    /**
     * @return mixed
     */
    public function getCmyc()
    {
        return $this->cmyc;
    }

    /**
     * @param mixed $cmyc
     */
    public function setCmyc($cmyc): void
    {
        $this->cmyc = $cmyc;
    }


    //GETTERS, SETTERS (que mantienen la BD actualizada) y METODOS AUXILIARES

    public function cambiaName($nuevoName): bool
    {
        $conn = getConexionBD();
        $query = sprintf("UPDATE `users` SET `name` = '%s' WHERE `users`.`id` = '%s'", $conn->real_escape_string($nuevoName), $conn->real_escape_string($this->id));
        if ($conn->query($query) === TRUE) {
            $this->name = $nuevoName;

            return true;
        }
        return false;
    }

    public function cambiaSurname($nuevoSurname): bool
    {
        $conn = getConexionBD();
        $query = sprintf("UPDATE `users` SET `surname` = '%s' WHERE `users`.`id` = '%s'", $conn->real_escape_string($nuevoSurname), $conn->real_escape_string($this->id));
        if ($conn->query($query) === TRUE) {
            $this->surname = $nuevoSurname;

            return true;
        }
        return false;
    }

}