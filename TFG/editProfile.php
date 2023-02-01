<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/usuarios.php';

$tituloPagina = 'Mi perfil 3338';
$contenidoPrincipal=datosUsuario($_SESSION["email"]);
$contenidoPrincipal.= <<<EOS

<div class = "containerModif2">


<form method= "post" enctype="application/x-www-form-urlencoded" action="procesarProfile.php">
<h2>Modifica tus datos</h2>
<h3>(Los campos que dejes en blanco no se modificarán)</h3>
           <div class = "containerModif3"> <p>
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
            <td><input type="submit" name="enviar" value= "Enviar" class="btn btn-primary btn-block btn-large"/></td>
            <td><a href = "profile.php"> <button class="btn btn-primary btn-large"> Cancelar </button></a></td>
            </tr>
            
            </table>
			</p></div>
</form>
</div>
EOS;

require __DIR__.'/includes/layout.php';