<!DOCTYPE html>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <title><?= $tituloPagina ?></title>
    <link rel="icon" type="image/png" href="includes/faico.png"/>
</head>
<?php
$fondito="";
$estilo = " linear-gradient(to bottom, #d8e9ff ,#ffffff, #d8e9ff)";
if($tituloPagina=="Calculadora de riesgo"){
    $fondito="fondo";
    $estilo="";
}

?>

<body style=" background: <?= $estilo ?>">

<div id="contenedor" class=<?= $fondito ?>>
    <?php

    require(__DIR__.'/header.php');

    ?>
    <main>
        <article>
            <?= $contenidoPrincipal?>
        </article>
    </main>
</div>
</body>
</html>