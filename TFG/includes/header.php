<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../../css/estilos.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Tooplate">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="css/tooplate-style.css">
</head>

<body>

<!--<img class="centerBanner" src="images/recursos/banner_logo.png" height="133" width="970" alt=""/>-->

    <!-- MENU -->
    <section class="navbar navbar-default navbar-static-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                </button>

                <!-- lOGO TEXT HERE al index, no al procesarLogin-->
                <a href="procesarLogin.html" class="navbar-brand"><i class="fa fa-h-square"></i>Risk Calculator</a>
            </div>

            <!-- MENU LINKS -->
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <?php
                    if (isset($_SESSION["login"]) && $_SESSION["login"]){
                    ?>
                        <li><a href="addPatient.php" class="smoothScroll">Pacientes</a></li>
                        <li><a href="calculator.php" class="smoothScroll">Calculadora</a></li>
                        <li><a href="profile.php" class="smoothScroll">Mi perfil</a></li>
                        <li><a href="logout.php" class="smoothScroll">Cerrar Sesión</a></li>
                    <?php
                    if ($_SESSION["privileges"] == 0){
                        echo '<li><a href="register.php" class="smoothScroll">Crear cuenta</a></li>';
                    }
                    }
                    ?>
                </ul>
            </div>

        </div>
    </section>
</body>
</html>