<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <title><?= $tituloPagina ?></title>
    <link rel="icon" type="image/png" href="images/favicon.png"/>
</head>
<body class="fondo">
<div id="contenedor">
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