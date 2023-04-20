<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/usuarios.php';

$tituloPagina = 'Calculadora';


//Check NHIS



if (empty($_GET)) {
    $nhisFound="true";
}
else {
    $nhisFound = isset($_GET["nhisFound"]) ? $_GET["nhisFound"] : "true";
}
$textoBusqueda = "Introduce el NHIS";
$displayDiv="none";
$colorSearch = "gray";
if ($nhisFound=="false") {
    $textoBusqueda = "NHIS no encontrado";
    $colorSearch = "red";
    $displayDiv="block";
}

$textoFecha= date('Y-m-d');
$contenidoPrincipal = <<<EOS
<link rel="stylesheet" href="css/style.css">


<div class="center-div">
<h2 style="color: black">Selecciona cómo quieres insertar los datos:</h2>

 <div style="display: flex; flex-direction: row;">
<a class="btn btn-success btn-lg" id="botonNhis" style="margin-right: 10px;" >Introducir Nhis</a>
<a class="btn btn-success btn-lg" id="botonDatos">Introducir Datos</a>
</div>

<div id="divNhis" style="display:$displayDiv">
<style>
		/* Estilo para el placeholder del input text */
		::-webkit-input-placeholder { /* Para navegadores basados en Webkit */
			color: $colorSearch;
		}
		:-moz-placeholder { /* Para navegadores basados en Mozilla Firefox */
			color: $colorSearch;
		}
		::-moz-placeholder { /* Para navegadores basados en Mozilla Firefox */
			color: $colorSearch;
		}
		:-ms-input-placeholder { /* Para navegadores basados en Microsoft Edge */
			color:  $colorSearch;
		}
	</style>
	
    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
      <form class="search-container" action="procesarNhisCalc.php" method="post" style="display: flex; flex-direction: column; align-items: center;">
          <input style="width:100%; margin-top: 10%" type="text" name="nhis" id="idInput" placeholder='$textoBusqueda' required>
          <select name="algoritmos" id="algoritmos" required style="margin-top: 10px;">
            <option value="" disabled selected>Selecciona un algoritmo</option>
            <option value="algoritmo1">Arboles aleatorios</option>
            <option value="algoritmo2">Regresión logística</option>
            <option value="algoritmo3">Regresión de Cox</option>
          </select>
          <select name="variables" id="variables" required style="margin-top: 10px;">
            <option value="" disabled selected>Selecciona una variable</option>
            <option value="variable1" class="algoritmo1 algoritmo2">Extracap</option>
            <option value="variable2" class="algoritmo1 algoritmo2">Margen</option>
            <option value="variable3" class="algoritmo1 algoritmo2">Tnm2</option>
            <option value="variable4" class="algoritmo1 algoritmo2">Vvss</option>
            <option value="variable5" class="algoritmo3">Rbq pre</option>
            <option value="variable6" class="algoritmo3">Rbq post</option>
          </select>
          <button class="buttonExotic" id="botonBuscarNhis">Calcular</button>
       </form>
    </div>
</div>


<div id="divDatos" style="display:$displayDiv">
<div class="center-div">
<h3>Inserta los datos del paciente</h3>
</div>
<form method= "post" action="procesarFormCalc.php">
   <table class="formula">
    <tr>
        <td>FECHACIR:</td>
        <td><input type="date" min="1990-01-01" max='$textoFecha' name="fechacir" /></td>
        <td>EDAD:</td>
        <td><input type="number" min="0" max="120" name="edad" /></td>
    </tr>
    <tr>
        <td>ETNIA:</td>
        <td><input type="number" min="1" max="4" name="etnia" /></td>
        <td>OBESO:</td>
        <td><input type="number" min="0" max="3" name="obeso" /></td>
    </tr>
    <tr>
        <td>HTA:</td>
        <td><input type="number" min="1" max="3" name="hta" /></td>
        <td>DM:</td>
        <td><input type="number" min="1" max="3" name="dm" /></td>
    </tr>
    <tr>
        <td>TABACO:</td>
        <td><input type="number" min="0" max="5" name="tabaco" /></td>
        <td>HEREDA:</td>
        <td><input type="number" min="1" max="2" name="hereda" /></td>
    </tr>
    <tr>
        <td>TACTOR:</td>
        <td><input type="number" min="1" max="3" name="tactor" /></td>
        <td>PSAPRE:</td>
        <td><input type="number" min="0" max="999" step="any" name="psapre" /></td>
    </tr>
    <tr>
        <td>PSALT:</td>
        <td><input type="number" min="0" max="1" step="any" name="psalt" /></td>
        <td>TDUPPRE:</td>
        <td><input type="number" min="0" max="999" step="any" name="tduppre" /></td>
    </tr>
    <tr>
        <td>ECOTR:</td>
        <td><input type="number" min="1" max="2" name="ecotr" /></td>
        <td>NBIOPSIA:</td>
        <td><input type="number" min="0" max="999" name="nbiopsia" /></td>
    </tr>
    <tr>
        <td>HISTO:</td>
        <td><input type="number" min="1" max="2" name="histo" /></td>
        <td>GLEASON1:</td>
        <td><input type="number" min="0" max="5" name="gleason1" /></td>
    </tr>
     <tr>
        <td>NCILPOS:</td>
        <td><input type="number" min="1" max="3" name="ncilpos" /></td>
        <td>BILAT:</td>
        <td><input type="number" min="1" max="2" name="bilat" /></td>
    </tr>
    <tr>
        <td>PORCENT:</td>
        <td><input type="number" min="0" max="100" name="porcent" /></td>
        <td>IPERIN:</td>
        <td><input type="number" min="1" max="3" name="iperin"  /></td>
    </tr>
    <tr>
        <td>ILINF:</td>
        <td><input type="number" min="1" max="3" name="ilinf"  /></td>
        <td>IVASCU:</td>
        <td><input type="number" min="1" max="3" name="ivascu"  /></td>
    </tr>
    <tr>
        <td>TNM1:</td>
        <td><input type="number" min="1" max="3" name="tnm1"  /></td>
        <td>HISTO2:</td>
        <td><input type="number" min="1" max="2" name="histo2"  /></td>
    </tr>
    <tr>
        <td>GLEASON2:</td>
        <td><input type="number" min="0" max="5" name="gleason2" /></td>
        <td>BILAT2:</td>
        <td><input type="number" min="1" max="2" name="bilat2"  /></td>
    </tr>
    <tr>
        <td>LOCALIZ:</td>
        <td><input type="number" min="1" max="4" name="localiz"  /></td>
        <td>MULTIFOC:</td>
        <td><input type="number" min="1" max="2" name="multifoc"  /></td>
    </tr>
    <tr>
        <td>VOLUMEN:</td>
        <td><input type="number" min="1" max="100" name="volumen"  /></td>
        <td>EXTRACAP:</td>
        <td><input type="number" min="1" max="2" name="extracap" /></td>
    </tr>
    <tr>
        <td>VVSS:</td>
        <td><input type="number" min="1" max="3" name="vvss"  /></td>
        <td>IPERIN2:</td>
        <td><input type="number" min="1" max="3" name="iperin2"  /></td>
    </tr>
    <tr>
        <td>ILINF2:</td>
        <td><input type="number" min="1" max="3" name="ilinf2"  /></td>
        <td>IVASCU2:</td>
        <td><input type="number" min="1" max="3" name="ivascu2"  /></td>
    </tr>
    <tr>
 <tr>
        <td>PINAG:</td>
        <td><input type="number" min="1" max="3" name="pinag" /></td>
        <td>MARGEN:</td>
        <td><input type="number" min="1" max="3" name="margen" /></td>
    </tr>
    <tr>
        <td>TNM2:</td>
        <td><input type="number" min="1" max="5" name="tnm2" /></td>
        <td>PSAPOS:</td>
        <td><input type="number" min="0" max="999" step="any" name="psapos" /></td>
    </tr>
    <tr>
        <td>RTPADYU:</td>
        <td><input type="number" min="1" max="2" name="rtpadyu" /></td>
        <td>RTPMES:</td>
        <td><input type="number" min="0" max="999" name="rtpmes" /></td>
    </tr>
    <tr>
        <td>RBQ:</td>
        <td><input type="number" min="1" max="3" name="rbq" /></td>
        <td>TRBQ:</td>
        <td><input type="number" min="0" max="999" name="trbq" /></td>
    </tr>
    <tr>
        <td>TDUPLI:</td>
        <td><input type="number" min="0" max="999" name="tdupli" step="any" /></td>
        <td>T1MTX:</td>
        <td><input type="number" min="0" max="999" name="t1mtx" /></td>
    </tr>
    <tr>
        <td>FECHAFIN:</td>
        <td><input type="date" name="fechafin" min="1990-01-01" max='$textoFecha' /></td>
        <td>FALLEC:</td>
        <td><input type="number" min="1" max="2" name="fallec"  /></td>
    </tr>
    <tr>
        <td>TSUPERV:</td>
        <td><input type="number" min="0" max="999" name="tsuperv" /></td>
        <td>PSAFIN:</td>
        <td><input type="number" min="0" max="999" step="any" name="psafin" /></td>
    </tr>
    <tr>
        <td>TSEGUI:</td>
        <td><input type="number" min="0" max="999" name="tsegui" /></td>
        <td>NOTAS:</td>
        <td><input type="text" name="notas" value=""/></td>
    </tr>
    <tr>
        <td>CAPRA-S:</td>
        <td><input type="number" min="0" max="999" name="capras" /></td>
        <td>RA:</td>
        <td><input type="number" min="0" max="1" name="ra" /></td>
    </tr>
    <tr>
        <td>PTEN:</td>
        <td><input type="number" min="0" max="2" name="pten" /></td>
        <td>ERG:</td>
        <td><input type="number" min="0" max="1" name="erg" /></td>
    </tr>
    <tr>
        <td>Ki67:</td>
        <td><input type="number" min="0" max="2" name="ki67" /></td>
        <td>SPINK1:</td>
        <td><input type="number" min="0" max="1" name="spink1" /></td>
    </tr>
    <tr>
        <td>C-myc:</td>
        <td><input type="number" min="0" max="1" name="cmyc" /></td>
        <td></td>
        <td></td>
        
    </tr>
</table>
        <div class="center-div">
        <select name="algoritmos" id="algoritmos" required style="margin-top: 10px;">
            <option value="" disabled selected>Selecciona un algoritmo</option>
            <option value="algoritmo1">Arboles aleatorios</option>
            <option value="algoritmo2">Regresión logística</option>
            <option value="algoritmo3">Regresión de Cox</option>
          </select>
          <select name="variables" id="variables" required style="margin-top: 10px;">
            <option value="" disabled selected>Selecciona una variable</option>
            <option value="variable1" class="algoritmo1 algoritmo2">Extracap</option>
            <option value="variable2" class="algoritmo1 algoritmo2">Margen</option>
            <option value="variable3" class="algoritmo1 algoritmo2">Tnm2</option>
            <option value="variable4" class="algoritmo1 algoritmo2">Vvss</option>
            <option value="variable5" class="algoritmo3">Rbq pre</option>
            <option value="variable6" class="algoritmo3">Rbq post</option>
          </select>
        </div>
      <input type="submit" name="Calcular" value= "Calcular" class="btn btn-primary btn-block btn-large"/>
    </form>
</div>


</div>
<script>
    // Obtener los botones y los divs
    const botonNhis = document.getElementById("botonNhis");
    const botonDatos = document.getElementById("botonDatos");
    const divNhis = document.getElementById("divNhis");
    const divDatos = document.getElementById("divDatos");
    const botonBuscarNhis = document.getElementById("botonBuscarNhis");

    // Agregar event listeners a los botones
    botonNhis.addEventListener("click", mostrarDivNhis);
    botonDatos.addEventListener("click", mostrarDivDatos);
    botonBuscarNhis.addEventListener("click", mostrarDivNhis);

    // Funciones que muestran u ocultan los divs
    function mostrarDivNhis() {
        divNhis.style.display = "block";
        divDatos.style.display = "none";
        botonDatos.disabled = true;
    }

    function mostrarDivDatos() {
        divNhis.style.display = "none";
        divDatos.style.display = "block";
        botonNhis.disabled = true;
        
    }

    function ocultarDivs() {
        divNhis.style.display = "none";
        divDatos.style.display = "none";
        botonNhis.disabled = false;
        botonDatos.disabled = false;
    }
    const algoritmosSelect = document.querySelector("#algoritmos");
    const variablesSelect = document.querySelector("#variables");

      algoritmosSelect.addEventListener("change", function() {
        // Obtener el valor seleccionado en el primer select
        const selectedValue = this.value;
    
        // Obtener todos los options del segundo select
        const variablesOptions = variablesSelect.options;
    
        // Recorrer todos los options del segundo select y ocultarlos
        for (let i = 0; i < variablesOptions.length; i++) {
          variablesOptions[i].classList.add("hidden");
        }
    
        // Mostrar las opciones correspondientes al valor seleccionado en el primer select
        if (selectedValue === "algoritmo1" || selectedValue === "algoritmo2") {
          document.querySelectorAll(".algoritmo1, .algoritmo2").forEach(option => {
            option.classList.remove("hidden");
          });
        } else if (selectedValue === "algoritmo3") {
          document.querySelectorAll(".algoritmo3").forEach(option => {
            option.classList.remove("hidden");
          });
        }
      });
</script>
<style>
  .hidden {
    display: none;
  }
</style>

EOS;

require __DIR__.'/includes/layout.php';