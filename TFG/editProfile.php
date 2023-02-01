<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/usuarios.php';

$tituloPagina = 'Mi perfil';
$contenidoPrincipal=datosUsuario($_SESSION["email"]);
$contenidoPrincipal.= <<<EOS


<h2>Modifica tus datos.</h2>
<h3>Los campos que dejes en blanco no se modificarán.</h3>

<form method= "post" enctype="application/x-www-form-urlencoded" action="procesarProfile.php">

            <p>
            <table>
            
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

            </table>

			<input type="submit" name="enviar" value= "Enviar" />
			<input type="reset" name="borrar" value="Borrar" />
			
			</p>
</form>

EOS;

require __DIR__.'/includes/layout.php';