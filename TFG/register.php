<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Crear cuenta';

$contenidoPrincipal= <<<EOS

<form method="post" action="procesarRegister.php">
    <p>Nombre:</p>
    <p><input type="text" name="name" required/></p>
    <p>Apellido:</p>
    <p><input type="text" name="surname" required/></p>
    <p>E-mail:</p>
    <p><input type="email" name="email" required/></p>
    <p>Contraseña:</p>
    <p><input type="password" name="password" required/></p>
    <p>Privilegios:</p>
    <p><select id="privileges" name="privileges">
        <option value=0>Administrador</option>
        <option value=1>Usuario</option>
    </select></p>
    <p><input type="submit" name="Registro"/></p>

</form>

EOS;

require __DIR__.'/includes/layout.php';
