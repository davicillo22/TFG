<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Login';

$contenidoPrincipal= <<<EOS

<div class="login">
<form method="post" action="procesarLogin.php">
    <p><input type="text" name="email" placeholder="E-mail" required="required"/></p>
    <p><input type="password" name="password" placeholder="Contraseña" required="required"/></p>
    <p><input type="submit" name="Login" value="Login" class="btn btn-primary btn-block btn-large"/></p>

</form>
</div>
EOS;

require __DIR__.'/includes/layout.php';