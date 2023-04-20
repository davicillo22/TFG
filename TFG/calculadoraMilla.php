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
$textoBusqueda = "Introduzca el NHIS a buscar";
$displayDiv="none";
$colorSearch = "gray";
if ($nhisFound=="false") {
    $textoBusqueda = "NHIS no encontrado";
    $colorSearch = "red";
    $displayDiv="block";
}

var_dump($nhisFound);




$contenidoPrincipal="";
$contenidoPrincipal.=<<<EOS
<link rel="stylesheet" href="css/style.css">


<div class="center-div">
<h2 style="color: black">Selecciona cómo quieres insertar los datos:</h2>

<div style="flex-direction: row; width: 100%; margin-left: 85%">
<a class="btn btn-success btn-lg" id="botonNhis" class="">Introducir Nhis</a>
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
	
    <form class="search-container"  action="procesarNhisCalc.php" method="post">
        <input style="width:100%; margin-top: 10%"  type="text" name="nhis" id="idInput" placeholder='$textoBusqueda'>
        <button class="buttonExotic" id="botonBuscarNhis">Búsqueda</button>
    </form>
</div>


<div id="divDatos" style="display:none">Este es el divDatos</div>

<button class="buttonExotic" id="botonCancelar" style="display:$displayDiv; width: 8%">Cancelar</button>


</div>
<script>
    // Obtener los botones y los divs
    const botonNhis = document.getElementById("botonNhis");
    const botonDatos = document.getElementById("botonDatos");
    const divNhis = document.getElementById("divNhis");
    const divDatos = document.getElementById("divDatos");
    const botonCancelar = document.getElementById("botonCancelar");
    const botonBuscarNhis = document.getElementById("botonBuscarNhis");

    // Agregar event listeners a los botones
    botonNhis.addEventListener("click", mostrarDivNhis);
    botonDatos.addEventListener("click", mostrarDivDatos);
    botonBuscarNhis.addEventListener("click", mostrarDivNhis);
    botonCancelar.addEventListener("click", ocultarDivs);

    // Funciones que muestran u ocultan los divs
    function mostrarDivNhis() {
        divNhis.style.display = "block";
        divDatos.style.display = "none";
        botonCancelar.style.display = "inline-block";
        botonDatos.disabled = true;
    }

    function mostrarDivDatos() {
        divNhis.style.display = "none";
        divDatos.style.display = "block";
        botonCancelar.style.display = "inline-block";
        botonNhis.disabled = true;
        
    }

    function ocultarDivs() {
        divNhis.style.display = "none";
        divDatos.style.display = "none";
        botonCancelar.style.display = "none";
        botonNhis.disabled = false;
        botonDatos.disabled = false;
    }
</script>

EOS;

require __DIR__.'/includes/layout.php';