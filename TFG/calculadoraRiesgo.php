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
<div class="screen-1">

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
            <option value="regresion">Regresión logística</option>
            <option value="cox">Regresión de Cox</option>
          </select>
          <select name="variables" id="variables" required style="margin-top: 10px; " disabled>
            <option value="" disabled selected>Selecciona una variable</option>
            <option value="extracap" class="algoritmo1 algoritmo2">Extracap</option>
            <option value="margen" class="algoritmo1 algoritmo2">Margen</option>
            <option value="tnm2" class="algoritmo1 algoritmo2">Tnm2</option>
            <option value="vvss" class="algoritmo1 algoritmo2">Vvss</option>
            <option value="rbqPre" class="cox">Rbq pre</option>
            <option value="rbqPost" class="cox">Rbq post</option>
          </select>
          <button class="buttonExotic"  id="botonBuscarNhis">Calcular</button>
       </form>
    </div>
</div>


<div id="divDatos" style="display:none">
<div class="center-div">
<h3>Inserta los datos del paciente</h3>
</div>
<form method= "post" action="procesarNhisCalc.php">
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
        <select name="algoritmos1" id="algoritmos1" required style="margin-top: 10px;" >
            <option value="" disabled selected>Selecciona un algoritmo</option>
            <option value="algoritmo1">Arboles aleatorios</option>
            <option value="regresion">Regresión logística</option>
            <option value="cox">Regresión de Cox</option>
          </select>
          <select name="variables1" id="variables1" required style="margin-top: 10px;margin-bottom: 10px;" disabled>
            <option value="" disabled selected>Selecciona una variable</option>
            <option value="extracap" class="algoritmo1 regresion">Extracap</option>
            <option value="margen" class="algoritmo1 regresion">Margen</option>
            <option value="tnm2" class="algoritmo1 regresion">Tnm2</option>
            <option value="vvss" class="algoritmo1 regresion">Vvss</option>
            <option value="rbqPre" class="cox">Rbq pre</option>
            <option value="rbqPost" class="cox">Rbq post</option>
          </select>
        </div>
      <input type="submit" name="Calcular" class="buttonExotic" style="width: 140px; margin-left:42%;" value= "Calcular"/>
    </form>
</div>


</div>
</div>

<div style="position: relative; margin-left: 25%; font-weight: bolder;">
    <p style="font-weight: bolder;">Información:</p>
</div>

<div class="cuadro-texto">
    <h4 style="font-size: medium; text-align: left ;" id="welcome-msg"><span id="username"><span id="cursor"></span></span></h4>
</div>
<div class="invisible-div"></div>
<script>
  const botonNhis = document.getElementById("botonNhis");
  const botonDatos = document.getElementById("botonDatos");
  const divNhis = document.getElementById("divNhis");
  const divDatos = document.getElementById("divDatos");
  const botonBuscarNhis = document.getElementById("botonBuscarNhis");
  const algoritmosSelect = document.querySelector("#algoritmos");
  const variablesSelect = document.querySelector("#variables");
  const algoritmosSelect2 = document.querySelector("#algoritmos1");
  const variablesSelect2 = document.querySelector("#variables1");
  
  botonNhis.addEventListener("click", mostrarDivNhis);
  botonDatos.addEventListener("click", mostrarDivDatos);
  botonBuscarNhis.addEventListener("click", mostrarDivNhis);
  
  algoritmosSelect.addEventListener("change", (event) => {
    const algoritmoSeleccionado = event.target.value;
    
    if (algoritmoSeleccionado === "algoritmo1" || algoritmoSeleccionado === "regresion") {
      variablesSelect.removeAttribute("disabled");
    } else {
      variablesSelect.setAttribute("disabled", true);
    }
  });
  
    algoritmosSelect2.addEventListener("change", (event) => {
    const algoritmoSeleccionado = event.target.value;
    
    if (algoritmoSeleccionado === "algoritmo1" || algoritmoSeleccionado === "regresion") {
      variablesSelect2.removeAttribute("disabled");
    } else {
      variablesSelect2.setAttribute("disabled", true);
    }
  });
  
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
  
  algoritmosSelect.addEventListener("change", function() {
    const selectedValue = this.value;
    const variablesOptions = variablesSelect.options;
    
 // Ocultar todas las opciones de variables
  for (let i = 0; i < variablesOptions.length; i++) {
    variablesOptions[i].classList.add("hidden");
    if (selectedValue === "cox") {
      variablesSelect.removeAttribute("disabled");
    } else {
      variablesSelect.removeAttribute("disabled");
    }
  }
  
  if (selectedValue === "algoritmo1" || selectedValue === "regresion") {
    document.querySelectorAll(".algoritmo1, .regresion").forEach(option => {
      option.classList.remove("hidden");
    });
    variablesSelect.value = "extracap";
  } else if (selectedValue === "cox") {
    document.querySelectorAll(".cox").forEach(option => {
      option.classList.remove("hidden");
    });
    variablesSelect.value = "rbqPre";
  }
  

});

algoritmosSelect2.addEventListener("change", function() {
    const selectedValue2 = this.value;
    const variablesOptions2 = variablesSelect2.options;
    
 // Ocultar todas las opciones de variables
  for (let i = 0; i < variablesOptions2.length; i++) {
    variablesOptions2[i].classList.add("hidden");
    if (selectedValue2 === "cox") {
      variablesSelect2.removeAttribute("disabled");
    } else {
      variablesSelect2.removeAttribute("disabled");
    }
  }
  
  if (selectedValue2 === "algoritmo1" || selectedValue2 === "regresion") {
    document.querySelectorAll(".algoritmo1, .regresion").forEach(option => {
      option.classList.remove("hidden");
    });
    variablesSelect.value = "extracap";
  } else if (selectedValue2 === "cox") {
    document.querySelectorAll(".cox").forEach(option => {
      option.classList.remove("hidden");
    });
    variablesSelect2.value = "rbqPre";
  }
});
</script>

<script>
    const welcomeMsg = document.querySelector("#welcome-msg");
    const usernameEl = document.querySelector("#username");

    let i = 0;
    let txt = `Esta calculadora está configurada a partir de modelos de machine learning, siguiendo procesos de limpieza de datos, entrenamiento y exposición de resultados. En primer lugar, puedes elegir entre dos maneras de proporcionar la entrada: seleccionar un paciente ya existente en la base de datos o introducir los datos a mano. A continuación, podrás escoger entre los tres algoritmos disponibles: Árboles aleatorios y Regresión logística (aplicables a las variables objetivo de Extensión extracapsular, Márgenes quirúrgicos positivos, Estadios localizados e Invasión de vesículas seminales) y el algoritmo de Regresión de Cox (aplicable a la Recidiva Bioquímica pre y post-operatoria a 5 y 10 años). Finalmente, al pulsar en "Calcular", se redirijirá a la página de resultados, donde se podrá observar la predicción así como las métricas del algoritmo escogido, todo ello descargable en formato PDF. `;
    let speed = 20;

    function typeWriter() {
        if (i < txt.length) {
            usernameEl.textContent += txt.charAt(i);
            i++;
            setTimeout(typeWriter, speed);
        }
    }

    setTimeout(() => {
        welcomeMsg.classList.add("show");
        typeWriter();
    }, 1000);
</script>
<style>
  .hidden {
    display: none;
  }
</style>

EOS;

require __DIR__.'/includes/layout.php';