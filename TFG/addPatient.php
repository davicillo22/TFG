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




<h2>Añade los datos del nuevo paciente</h2>
      
            <table class="formula">
 <form method= "post" enctype="application/x-www-form-urlencoded" action="procesarAddPatient.php">           
            <tr>
            <td>FECHACIR:</td>
            <td><input type="date"  min="1950-01-01" max="2023-02-13" name="fechacir" value="2000-01-01" /></td>
            </tr>
             
            
            <tr>
            <td>EDAD:</td>
            <td><input type="number" min="0" max="120" name="edad" value="18" /></td>
            </tr>
            
            <tr>
            <td>ETNIA:</td>
            <td><input type="number" min="1" max="4" value="1" name="etnia" /></td>
            </tr>
            
            <tr>
            <td>OBESO:</td>
            <td><input type="number" min="0" max="3" name="obeso" /></td>
            </tr>
            
            <tr>
            <td>HTA:</td>
            <td><input type="number" min="1" max="3" name="hta" value="1" /></td>
            </tr>
            
            <tr>
            <td>DM:</td>
            <td><input type="number" min="1" max="3" name="dm" value="1" /></td>
            </tr>
            
            <tr>
            <td>TABACO:</td>
            <td><input type="number" min="0" max="5" name="tabaco" /></td>
            </tr>
            
            <tr>
            <td>HEREDA:</td>
            <td><input type="number" min="1" max="2" name="hereda" value="1" /></td>
            </tr>
            
            <tr>
            <td>TACTOR:</td>
            <td><input type="number" min="1" max="3" name="tactor" value="1" /></td>
            </tr>
            
            
            <tr>
            <td>PSAPRE:</td>
            <td><input type="number" min="0" max="999" step="any" name="psapre" /></td>
            </tr>
            
            <tr>
            <td>PSALT:</td>
            <td><input type="number" min="0" max="1" step="any" name="psalt" /></td>
            </tr>
            
            <tr>
            <td>TDUPPRE:</td>
            <td><input type="number" min="0" max="999" step="any" name="tduppre" /></td>
            </tr>
            
            <tr>
            <td>ECOTR:</td>
            <td><input type="number" min="1" max="2" name="ecotr" value="1" /></td>
            </tr>
            
            <tr>
            <td>NBIOPSIA:</td>
            <td><input type="number" min="0" max="999" name="nbiopsia" /></td>
            </tr>
            
            <tr>
            <td>HISTO:</td>
            <td><input type="number" min="1" max="2" name="histo" value="1" /></td>
            </tr>
            
            <tr>
            <td>GLEASON1:</td>
            <td><input type="number" min="0" max="5" name="gleason1" /></td>
            </tr>
            
            <tr>
            <td>NCILPOS:</td>
            <td><input type="number" min="1" max="3" name="ncilpos" value="1" /></td>
            </tr>
            
            <tr>
            <td>BILAT:</td>
            <td><input type="number" min="1" max="2" name="bilat" value="1" /></td>
            </tr>
            
            <tr>
            <td>PORCENT:</td>
            <td><input type="number" min="0" max="100" name="porcent" /></td>
            </tr>
            
            <tr>
            <td>IPERIN:</td>
            <td><input type="number" min="1" max="3" name="iperin" value="1" /></td>
            </tr>
            
            <tr>
            <td>ILINF:</td>
            <td><input type="number" min="1" max="3" name="ilinf" value="1" /></td>
            </tr>
            
            <tr>
            <td>IVASCU:</td>
            <td><input type="number" min="1" max="3" name="ivascu" value="1" /></td>
            </tr>
            
            <tr>
            <td>TNM1:</td>
            <td><input type="number" min="1" max="3" name="tnm1" value="1" /></td>
            </tr>
            
            <tr>
            <td>HISTO2:</td>
            <td><input type="number" min="1" max="2" name="histo2" value="1" /></td>
            </tr>
            
            <tr>
            <td>GLEASON2:</td>
            <td><input type="number" min="0" max="5" name="gleason2" /></td>
            </tr>
            
            <tr>
            <td>BILAT2:</td>
            <td><input type="number" min="1" max="2" name="bilat2" value="1" /></td>
            </tr>
            
            <tr>
            <td>LOCALIZ:</td>
            <td><input type="number" min="1" max="4" name="localiz" value="1" /></td>
            </tr>
            
            <tr>
            <td>MULTIFOC:</td>
            <td><input type="number" min="1" max="2" name="multifoc" value="1" /></td>
            </tr>
            
            <tr>
            <td>VOLUMEN:</td>
            <td><input type="number" min="1" max="100" name="volumen" value="1" /></td>
            </tr>
            
            <tr>
            <td>EXTRACAP:</td>
            <td><input type="number" min="1" max="2" name="extracap" value="1" /></td>
            </tr>
            
            <tr>
            <td>VVSS:</td>
            <td><input type="number" min="1" max="3" name="vvss" value="1" /></td>
            </tr>
            
            <tr>
            <td>IPERIN2:</td>
            <td><input type="number" min="1" max="3" name="iperin2" value="1" /></td>
            </tr>
            
            <tr>
            <td>ILINF2:</td>
            <td><input type="number" min="1" max="3" name="ilinf2" value="1" /></td>
            </tr>
            
            <tr>
            <td>IVASCU2:</td>
            <td><input type="number" min="1" max="3" name="ivascu2" value="1" /></td>
            </tr>
            
            <tr>
            <td>PINAG:</td>
            <td><input type="number" min="1" max="3" name="pinag" value="1" /></td>
            </tr>
            
            <tr>
            <td>MARGEN:</td>
            <td><input type="number" min="1" max="3" name="margen" value="1" /></td>
            </tr>
            
            <tr>
            <td>TNM2:</td>
            <td><input type="number" min="1" max="5" name="tnm2" value="1" /></td>
            </tr>
            
            <tr>
            <td>PSAPOS:</td>
            <td><input type="number" min="0" max="999" step="any" name="psapos" /></td>
            </tr>
            
            <tr>
            <td>RTPADYU:</td>
            <td><input type="number" min="1" max="2" name="rtpadyu" value="1" /></td>
            </tr>
            
            <tr>
            <td>RTPMES:</td>
            <td><input type="number" min="0" max="999" name="rtpmes" /></td>
            </tr>
            
            <tr>
            <td>RBQ:</td>
            <td><input type="number" min="1" max="3" name="rbq" value="1" /></td>
            </tr>
            
            <tr>
            <td>TRBQ:</td>
            <td><input type="number" min="0" max="999" name="trbq" /></td>
            </tr>
            
            <tr>
            <td>TDUPLI:</td>
            <td><input type="number" min="0" max="999" name="tdupli" step="any" /></td>
            </tr>
            
            <tr>
            <td>T1MTX:</td>
            <td><input type="number" min="0" max="999" name="t1mtx" /></td>
            </tr>
            
            <tr>
            <td>FECHAFIN:</td>
            <td><input type="date" name="fechafin" min="1910-01-01" max="2023-02-13" value="2023-02-13" /></td>
            </tr>
            
            <tr>
            <td>FALLEC:</td>
            <td><input type="number" min="1" max="2" name="fallec" value="1" /></td>
            </tr>
            
            <tr>
            <td>TSUPERV:</td>
            <td><input type="number" min="0" max="999" name="tsuperv" /></td>
            </tr>
            
            <tr>
            <td>PSAFIN:</td>
            <td><input type="number" min="0" max="999" step="any" name="psafin" /></td>
            </tr>
            
            <tr>
            <td>TSEGUI:</td>
            <td><input type="number" min="0" max="999" name="tsegui" /></td>
            </tr>
            
            <tr>
            <td>NOTAS:</td>
            <td><input type="text" name="notas"/></td>
            </tr>
                 
            <tr>
            <td>CAPRA-S:</td>
            <td><input type="number" min="0" max="999" name="capras" /></td>
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

            
            
			
</form>
            <td><a href = "tablaPacientes.php"> <button class="cancel"> Cancelar </button></a></td>
            </tr>
</table>
</div>
EOS;

require __DIR__.'/includes/layout.php';