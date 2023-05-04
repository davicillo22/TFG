<?php

require_once __DIR__.'/includes/config.php';

$logued = false;
$tituloPagina = 'Login';
if (empty($_GET)) {
    $log=true;
}
else
    $log=$_GET["log"];


$contenidoPrincipal= <<<EOS

<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Finance Mobile Application-UX/UI Design Screen One</title>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

<link rel='stylesheet' href="css/loginstyle.css">
</head>
<body class="articulo">
<!-- partial:index.partial.html -->
<div class="screen-1">
  <svg class="logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="300" height="300" viewbox="0 0 640 480" xml:space="preserve">
    <g transform="matrix(3.31 0 0 3.31 320.4 240.4)">
      <circle style="stroke: rgb(0,0,0); stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(61,71,133); fill-rule: nonzero; opacity: 1;" cx="0" cy="0" r="40"></circle>
    </g>
    <g transform="matrix(0.98 0 0 0.98 268.7 213.7)">
      <circle style="stroke: rgb(0,0,0); stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" cx="0" cy="0" r="40"></circle>
    </g>
    <g transform="matrix(1.01 0 0 1.01 362.9 210.9)">
      <circle style="stroke: rgb(0,0,0); stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" cx="0" cy="0" r="40"></circle>
    </g>
    <g transform="matrix(0.92 0 0 0.92 318.5 286.5)">
      <circle style="stroke: rgb(0,0,0); stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" cx="0" cy="0" r="40"></circle>
    </g>
    <g transform="matrix(0.16 -0.12 0.49 0.66 290.57 243.57)">
      <polygon style="stroke: rgb(0,0,0); stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" points="-50,-50 -50,50 50,50 50,-50 "></polygon>
    </g>
    <g transform="matrix(0.16 0.1 -0.44 0.69 342.03 248.34)">
      <polygon style="stroke: rgb(0,0,0); stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" vector-effect="non-scaling-stroke" points="-50,-50 -50,50 50,50 50,-50 "></polygon>
    </g>
  </svg>
  <form 
id="login_form" 
name="login_form" 
autocomplete="off"
method="post"
enctype="application/x-www-form-urlencoded" 
action="procesarLogin.php"

>
        
  
  
  
<input type="text"  
id="username" 
class="username"
name="username" 
autocapitalize="off"
autocorrect="off" 
autocomplete="on"  
autofocus="on"
required />


<label for="username">Usuario</label> <small>ejemplo@mail.com</small>  <svg viewbox="0 0 10 10" ><use xlink:href="#user" /> <use xlink:href="#fed" class="fedora" /> <use xlink:href="#burst" class="flash"  /></svg>


<input 
   id="password" 
 type="password" 
 name="password"
autocorrect="off" 
autocomplete="off"  
autocomplete="new-password"
value=""  
required>
 
<label for="password">Contraseña</label> <small>*****</small> <svg viewbox="0 0 10 10"><use xlink:href="#pad" /><use class="flash" xlink:href="#burst" /><use class="lock" xlink:href="#lock" />
</svg>

  <input id="submit" type="submit" name="submit"  value="Iniciar Sesión">
 
  <svg xmlns="http://www.w3.org/2000/svg" 
       class="hbox" viewBox="0 0 200 40">
      <rect  x=".5" y=".5" ry="3" rx="3" width="199" height="42" />
  </svg>
</form>



<svg class="hide">
  
    <defs>
   
   
 
      

  <g id="padlock"> <path id="pad" d="m 3,5.5 5,0 0,4 -5,0 z" /> <path id="lock" d="m 3,5.5 0,-2 c 0,-3 4,-3 4,-0.25 L 7,4 "/>  </g>
    
  <path id="fed" d="M7.8 3.8c-.7.6-3.5.6-4.4-.1-.3-.2 4.8-.2 4.4.1zM7 3.5c-.4-.7-.3-2-1.5-1.5-1-.5-1 .7-1.5 1.5"  />
      
  <path id="user" d="M5.5 5.8c-2 0-2-3 0-3 2.3 0 2 3 0 3zm.8-.3c1.2 0 2.2 1 2.2 2.3v1.7h-6V7.7c0-1.2 1-2.2 2.3-2.2"  />
  <path id="burst" d="m 5.47,0 v 2.19 m 4.38,2.19 h -2.2 m -6.55,0 H 3.28 M 2.38,1.28 3.92,2.83 M 8.56,1.28 7.02,2.83" />
    

  </defs>
</svg>
</div>
<!-- partial -->
  
</body>
</html>

EOS;

if(!$log)
    $contenidoPrincipal.= "<h3 style='color: #4d33d9;' class='erroneo'>Email o contraseña incorrectos</h3>";

$contenidoPrincipal.= "</body></html>";

require __DIR__.'/includes/layoutLogin.php';