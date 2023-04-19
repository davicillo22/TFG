<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/usuarios.php';

$tituloPagina = 'Calculadora';

$contenidoPrincipal="";
$contenidoPrincipal.=<<<EOS
<link rel="stylesheet" href="css/style.css">

<style>
    select, input {
        display: block;
        margin: 0 auto;
        max-width: 300px;
        margin-top: 1em;
        margin-bottom: 1em;
    }
    h2 {
      color: #000000;
      text-align: center; 
      opacity: 1; 
    }
</style>

<h2>Selecciona cómo quieres insertar los datos:</h2>

<select id="selector1">
    <option value="">Selecciona una opción</option>
    <option value="nhis">Introducir NHIS</option>
    <option value="datos">Introducir datos paciente</option>
</select>

<div id="caja-texto"></div>

<h2>Selecciona el algoritmo:</h2>

<select id="selector2">
    <option value="">Selecciona una opción</option>
    <option value="Arboles aleatorios">Arboles aleatorios</option>
    <option value="Regresión logística">Regresión logística</option>
    <option value="Regresión de Cox (modelo de los riesgos proporcionales)">Regresión de Cox (modelo de los riesgos proporcionales)</option>
</select>

<div id="caja-opciones"></div>

<div id ="boton" style="text-align:center;">
  <button type="submit">Enviar formulario</button>
</div>

<script>
    const selector1 = document.getElementById("selector1");
    const selector2 = document.getElementById("selector2");
    const cajaTexto = document.getElementById("caja-texto");
    const cajaOpciones = document.getElementById("caja-opciones");
    const boton = document.getElementById("boton");
    
    selector1.addEventListener("change", () => {
        if (selector1.value === "nhis") {
            cajaTexto.innerHTML = '<input type="number"  min="1" max="9999999" name="nhis" required />';
        } else if (selector1.value === "datos") {
            cajaTexto.innerHTML = '<input type="text" name="nombre"> <input type="text" name="apellido">';
        } else {
            cajaTexto.innerHTML = '';
        }
    });
    
    selector2.addEventListener("change", () => {
        if (selector2.value === "Arboles aleatorios") {
            cajaOpciones.innerHTML = `
                <h2>Selecciona la variable a estudiar:</h2>
                <select>
                    <option value="">Selecciona una opción</option>
                    <option value="op3">Fallec</option>
                    <option value="op4">TSegui</option>
                    <option value="op5">Tabaco</option>
                </select>
            `;
        } else if (selector2.value === "Regresión logística") {
            cajaOpciones.innerHTML = `
                <h2>Selecciona la variable a estudiar:</h2>
                <select>
                    <option value="">Selecciona una opción</option>
                    <option value="op6">VVSS</option>
                    <option value="op7">TRBQ</option>
                    <option value="op8">Etnia</option>
                </select>
            `;
        }else if (selector2.value === "Regresión de Cox (modelo de los riesgos proporcionales)") {
            cajaOpciones.innerHTML = `
                <h2>Selecciona la variable a estudiar:</h2>
                <select>
                    <option value="">Selecciona una opción</option>
                    <option value="op6">TSuperv</option>
                    <option value="op7">Tmuertos</option>
                    <option value="op8">Obeso</option>
                </select>
            `; 
        } else {
            cajaOpciones.innerHTML = '';
        }
    });
</script>

EOS;

require __DIR__.'/includes/layout.php';