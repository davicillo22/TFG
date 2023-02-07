<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/patient.php';
require_once __DIR__ . '/includes/usuarios.php';

$tituloPagina = 'Add Patient';
//datos paciente en vez de datos usuario
// $contenidoPrincipal=datosUsuario($_SESSION["email"]);
$contenidoPrincipal= <<<EOS
<link rel="stylesheet" href="css/style.css">
<div class="screen-1">


<form method= "post" enctype="application/x-www-form-urlencoded" action="procesarAddPatient.php">

<h2>Añade los datos del nuevo paciente</h2>
      
            <table class="formula">
            
            <tr>
            <td>FECHACIR:</td>
            <td><input type="date" name="fechacir" /></td>
            </tr>
             
            
            <tr>
            <td>EDAD:</td>
            <td><input type="number" min="0" name="edad" /></td>
            </tr>
            
            <tr>
            <td>ETNIA:</td>
            <td><input type="number" min="1" max="4" name="etnia" /></td>
            </tr>
            
            <tr>
            <td>OBESO:</td>
            <td><input type="number" min="0" max="3" name="obeso" /></td>
            </tr>
            
            <tr>
            <td>HTA:</td>
            <td><input type="number" min="1" max="3" name="hta" /></td>
            </tr>
            
            <tr>
            <td>DM:</td>
            <td><input type="number" min="1" max="3" name="dm" /></td>
            </tr>
            
            <tr>
            <td>TABACO:</td>
            <td><input type="number" min="0" max="5" name="tabaco" /></td>
            </tr>
            
            <tr>
            <td>HEREDA:</td>
            <td><input type="number" min="1" max="2" name="hereda" /></td>
            </tr>
            
            <tr>
            <td>TACTOR:</td>
            <td><input type="number" min="1" max="3" name="tactor" /></td>
            </tr>
            
            
            <tr>
            <td>PSAPRE:</td>
            <td><input type="number" min="0" step="any" name="psapre" /></td>
            </tr>
            
            <tr>
            <td>PSALT:</td>
            <td><input type="number" min="0" max="1" step="any" name="psalt" /></td>
            </tr>
            
            <tr>
            <td>TDUPPRE:</td>
            <td><input type="number" min="0" step="any" name="tduppre" /></td>
            </tr>
            
            <tr>
            <td>ECOTR:</td>
            <td><input type="number" min="1" max="2" name="ecotr" /></td>
            </tr>
            
            <tr>
            <td>NBIOPSIA:</td>
            <td><input type="number" min="0" name="nbiopsia" /></td>
            </tr>
            
            <tr>
            <td>HISTO:</td>
            <td><input type="number" min="1" max="2" name="histo" /></td>
            </tr>
            
            <tr>
            <td>GLEASON1:</td>
            <td><input type="number" min="0" max="5" name="gleason1" /></td>
            </tr>
            
            <tr>
            <td>NCILPOS:</td>
            <td><input type="number" min="1" max="3" name="ncilpos" /></td>
            </tr>
            
            <tr>
            <td>BILAT:</td>
            <td><input type="number" min="1" max="2" name="bilat" /></td>
            </tr>
            
            <tr>
            <td>PORCENT:</td>
            <td><input type="number" min="0" max="100" name="porcent" /></td>
            </tr>
            
            <tr>
            <td>IPERIN:</td>
            <td><input type="number" min="1" max="3" name="iperin" /></td>
            </tr>
            
            <tr>
            <td>ILINF:</td>
            <td><input type="number" min="1" max="3" name="ilinf" /></td>
            </tr>
            
            <tr>
            <td>IVASCU:</td>
            <td><input type="number" min="1" max="3" name="ivascu" /></td>
            </tr>
            
            <tr>
            <td>TNM1:</td>
            <td><input type="number" min="1" max="3" name="tnm1" /></td>
            </tr>
            
            <tr>
            <td>HISTO2:</td>
            <td><input type="number" min="1" max="2" name="histo2" /></td>
            </tr>
            
            <tr>
            <td>GLEASON2:</td>
            <td><input type="number" min="0" max="5" name="gleason2" /></td>
            </tr>
            
            <tr>
            <td>BILAT2:</td>
            <td><input type="number" min="1" max="2" name="bilat2" /></td>
            </tr>
            
            <tr>
            <td>LOCALIZ:</td>
            <td><input type="number" min="1" max="4" name="localiz" /></td>
            </tr>
            
            <tr>
            <td>MULTIFOC:</td>
            <td><input type="number" min="1" max="2" name="multifoc" /></td>
            </tr>
            
            <tr>
            <td>VOLUMEN:</td>
            <td><input type="number" min="1" max="100" name="volumen" /></td>
            </tr>
            
            <tr>
            <td>EXTRACAP:</td>
            <td><input type="number" min="1" max="2" name="extracap" /></td>
            </tr>
            
            <tr>
            <td>VVSS:</td>
            <td><input type="number" min="1" max="3" name="vvss" /></td>
            </tr>
            
            <tr>
            <td>IPERIN2:</td>
            <td><input type="number" min="1" max="3" name="iperin2" /></td>
            </tr>
            
            <tr>
            <td>ILINF2:</td>
            <td><input type="number" min="1" max="3" name="ilinf2" /></td>
            </tr>
            
            <tr>
            <td>IVASCU2:</td>
            <td><input type="number" min="1" max="3" name="ivascu2" /></td>
            </tr>
            
            <tr>
            <td>PINAG:</td>
            <td><input type="number" min="1" max="3" name="pinag" /></td>
            </tr>
            
            <tr>
            <td>MARGEN:</td>
            <td><input type="number" min="1" max="3" name="margen" /></td>
            </tr>
            
            <tr>
            <td>TNM2:</td>
            <td><input type="number" min="1" max="5" name="tnm2" /></td>
            </tr>
            
            <tr>
            <td>PSAPOS:</td>
            <td><input type="number" min="0" step="any" name="psapos" /></td>
            </tr>
            
            <tr>
            <td>RTPADYU:</td>
            <td><input type="number" min="1" max="2" name="rtpadyu" /></td>
            </tr>
            
            <tr>
            <td>RTPMES:</td>
            <td><input type="number" min="0" name="rtpmes" /></td>
            </tr>
            
            <tr>
            <td>RBQ:</td>
            <td><input type="number" min="1" max="3" name="rbq" /></td>
            </tr>
            
            <tr>
            <td>TRBQ:</td>
            <td><input type="number" min="0" name="trbq" /></td>
            </tr>
            
            <tr>
            <td>TDUPLI:</td>
            <td><input type="number" min="0" name="tdupli" /></td>
            </tr>
            
            <tr>
            <td>TIMTX:</td>
            <td><input type="number" min="0" name="timtx" /></td>
            </tr>
            
            <tr>
            <td>FECHAFIN:</td>
            <td><input type="date" name="fechafin" /></td>
            </tr>
            
            <tr>
            <td>FALLEC:</td>
            <td><input type="number" min="1" max="2" name="fallec" /></td>
            </tr>
            
            <tr>
            <td>TSUPERV:</td>
            <td><input type="number" min="0" name="tsuperv" /></td>
            </tr>
            
            <tr>
            <td>PSAFIN:</td>
            <td><input type="number" min="0" step="any" name="psafin" /></td>
            </tr>
            
            <tr>
            <td>TSEGUI:</td>
            <td><input type="number" min="0" name="tsegui" /></td>
            </tr>
            
            <tr>
            <td>NOTAS:</td>
            <td><input type="text" name="notas"/></td>
            </tr>
            
            <tr>
            <td>CAPRA-S:</td>
            <td><input type="number" min="0" name="capras" /></td>
            </tr>
            
            <tr>
            <td>RA:</td>
            <td><input type="number" min="0" max="1" name="ra" /></td>
            </tr>
            
            <tr>
            <td>PTEN:</td>
            <td><input type="number" min="0" max="2" name="pten" /></td>
            </tr>
            
            <tr>
            <td>ERG:</td>
            <td><input type="number" min="0" max="1" name="erg" /></td>
            </tr>
            
            <tr>
            <td>Ki67:</td>
            <td><input type="number" min="0" max="2" name="ki67" /></td>
            </tr>
            
            <tr>
            <td>SPINK1:</td>
            <td><input type="number" min="0" max="1" name="spink1" /></td>
            </tr>
            
            <tr>
            <td>C-myc:</td>
            <td><input type="number" min="0" max="1" name="cmyc" /></td>
            </tr>
            
            <tr>
            <td><input type="submit" name="enviar" value= "Enviar" class="btn btn-primary btn-block btn-large"/></td>
            <td><a href = "addPatient.php"> <button class="cancel"> Cancelar </button></a></td>
            </tr>
            
            </table>
			
</form>
</div>
EOS;

require __DIR__.'/includes/layout.php';