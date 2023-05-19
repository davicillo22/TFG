<!DOCTYPE html>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <title><?= $tituloPagina ?></title>
    <link rel="icon" type="image/png" href="includes/faico.png"/>
</head>
<?php
$fondo="";
$estilo = " linear-gradient(to bottom, #e7f1ff ,#ffffff, #e7f1ff)";
$claseFooter = "footer";
$esIndex=false;
if($tituloPagina=="Calculadora de riesgo"){
    $fondo="fondo";
    $estilo="";
    $claseFooter = "footerLogin";
    $esIndex=true;
}

?>

<body style=" background: <?= $estilo ?>">

<div id="contenedor" class=<?= $fondo ?>>
    <?php

    require(__DIR__.'/header.php');

    ?>
    <main>
        <article style="    height: auto;">
            <?= $contenidoPrincipal?>
        </article>
    </main>
</div>
</body>
</html>


<?php

if($esIndex){

?>
<footer class=<?= $claseFooter ?>>


    <p class="footer-text">
        <a class="footer-text" href="mailto:ofroiz@ucm.es">Contacto</a> |
        <a class="footer-text" href="https://www.cancer.gov/es">Recursos sobre el cáncer</a>

    </p>
    <p class="footer-text">
        <a class="footer-text" href="#">Política de privacidad</a> |
        <a class="footer-text" href="#">Términos y condiciones</a>
    </p>
    <p class="footer-text">&copy; 2023 Calculadora de Riesgo para pacientes oncológicos.</p>

    <p class="footer-title">Todos los derechos reservados a Exotic Company.
</footer>
<?php }?>
</html>