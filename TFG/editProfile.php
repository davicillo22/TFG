<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/usuarios.php';

$tituloPagina = 'Mi perfil';
$contenidoPrincipal=datosUsuario($_SESSION["email"]);
$contenidoPrincipal.= <<<EOS

<div class="screen-1" style="padding-bottom: 50px; padding-top: 1px">


<form method= "post" enctype="application/x-www-form-urlencoded" action="procesarProfile.php">
<h2>Modifica tus datos</h2>
           
            <table class="editProfileTable">
            
            <tr>
            <td>Nombre:</td>
            <td><input type="text" name="name" /></td>
            </tr>
            
            <tr>
            <td>Apellido:</td>
            <td><input type="text" name="surname" /></td>
            </tr>
            
            <tr>
            <td>Nueva contraseña:</td>
            <td><input type="password" name="password" /></td>
            </tr>
            
            <tr>
            <td>Repite contraseña:</td>
            <td><input type="password" name="password2" /></td>
            </tr>
            
            <tr>
            <td><input type="submit" name="enviar" value= "Enviar"/></td>
            <td><a href = "profile.php"> <button class="cancel" style="margin-left: 100px;"> Cancelar </button></a></td>
            </tr>
            
            </table>
			
</form>
</div>
EOS;

require __DIR__.'/includes/layout.php';