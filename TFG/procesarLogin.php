<?php

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/usuarios.php';

$tituloPagina = 'Calculadora de riesgo';
$log = false;

$contenidoPrincipal = "";

if (!checkLogin() && !checkSession()) {
    header("Location: login.php?log=$log");
    $contenidoPrincipal= <<<EOS
        <h1>Error</h1>
        <p>El email o contraseña introducidos no son válidos.</p>
        <p><a href="login.php"><button>Volver</button></a></p>
    EOS;
} else {
    $nameUser=$_SESSION['name'];
    $contenidoPrincipal .= <<<EOS
        <body class="fondo">
            <link rel='stylesheet' href="css/style.css">
            <link rel="stylesheet" href="css/font-awesome.min.css">
            <h2 id="welcome-msg"><span id="username"><span id="cursor">|</span></span></h2>
            
    <div class="card-container">
    <div class="card">
    <div class="card-icon"><i class="fa fa-eye" aria-hidden="true"></i></div>
    <div class="card-text">Conexión a base de datos MySQL. Visualiza todos tus pacientes, filtralos por sus datos clínicos y ordénalos en función de la característica deseada.</div>
    </div>
    <div class="card">
    <div class="card-icon"><i class="fa fa-calculator" aria-hidden="true"></i></div>
    <div class="card-text">Calculadora basada en machine learning. Obtén predicciones con múltiples algortimos acerca de variables objetivo de interés sobre tus pacientes o a partir de nuevos datos introducidos.</div>
    </div>
    <div class="card">
    <div class="card-icon"><i class="fa fa-plus-circle" aria-hidden="true"></i></div>
    <div class="card-text">Explora otras funcionalidades como la modificación y eliminación de pacientes o la exportación de historia clínica y de resultados pronosticados.</div>
     </div>
    </div>
            
    <script>       
      const nameUser = "$nameUser";
      const welcomeMsg = document.querySelector("#welcome-msg");
      const usernameEl = document.querySelector("#username");
      const cursor = document.querySelector("#cursor");
    
      let i = 0;
      let txt1 = `Bienvenido Dr. ${nameUser}`;
      let txt2 = "Calculadora de Riesgo";
      let speed = 60;
      let showingTxt1 = true;
    
      function typeWriter() {
        if (i < txt1.length) {
          usernameEl.textContent = usernameEl.textContent.slice(0, -1);
          usernameEl.textContent += txt1.charAt(i) + "|";
          i++;
          setTimeout(blinkCursor, 0);
          setTimeout(typeWriter, speed);
          
        } else {
          i = txt1.length - 1;
          setTimeout(typeEraser, 3000);
        }
      }
    
      function typeEraser() {
        if (i >= 0) {
          usernameEl.textContent = txt1.substring(0, i) + "|";
          i--;
          setTimeout(typeEraser, speed);
          setTimeout(blinkCursor, 400);
        } else {
          i = 0;
          if (showingTxt1) {
            showingTxt1 = false;
            setTimeout(typeWriter2, 500);
          } else {
            showingTxt1 = true;
            setTimeout(typeWriter, 500);
          }
        }
      }
    
      function typeWriter2() {
        if (i < txt2.length) {
          usernameEl.textContent = usernameEl.textContent.slice(0, -1);
          usernameEl.textContent += txt2.charAt(i) + "|";
          i++;
          setTimeout(typeWriter2, speed);
          setTimeout(blinkCursor, 400);
        } else {
          i = txt2.length - 1;
          setTimeout(typeEraser2, 3000);
        }
      }
    
      function typeEraser2() {
        if (i >= 0) {
          usernameEl.textContent = txt2.substring(0, i) + "|";
          i--;
          setTimeout(typeEraser2, speed);
          setTimeout(blinkCursor, 400);
        } else {
          i = 0;
          if (showingTxt1) {
            showingTxt1 = false;
            setTimeout(typeWriter2, 500);
          } else {
            showingTxt1 = true;
            setTimeout(typeWriter, 500);
          }
        }
      }
    
      function blinkCursor() {
        cursor.classList.toggle("hidden");
      }
    
      setTimeout(() => {
        welcomeMsg.classList.add("show");
        typeWriter();
        setInterval(blinkCursor, 400);
      }, 1000);
    </script>


    </body>

    EOS;
}

require __DIR__ . '/includes/layout.php';