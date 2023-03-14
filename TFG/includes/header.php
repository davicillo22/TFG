<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
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
    <link rel="stylesheet" href="https://kit.fontawesome.com/9575b918a2.css" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/demo.css">
    <link rel="stylesheet" type="text/css" href="css/component.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="css/tooplate-style.css">
    <link rel="icon" type="image/png" href="favicon.png">
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

                <!-- lOGO TEXT HERE al index, <i class="fa-sharp fa-regular fa-staff-snake"></i>  <i class="fa fa-heartbeat" aria-hidden="true"></i>-->
                <a href="procesarLogin.php" class="navbar-brand"> <i class="fa fa-heartbeat" aria-hidden="true"></i>  Risk Calculator</a>

            </div>

            <!-- MENU LINKS -->
            <div class="cl-effect-1">
                <ul class="nav navbar-nav navbar-right">
                    <?php
                    if (isset($_SESSION["login"]) && $_SESSION["login"]){
                    ?>
                        <li class="appointment-btn"><a href="tablaPacientes.php">Pacientes</a></li>
                        <li class="appointment-btn"><a href="calculator.php">Calculadora</a></li>
                        <li class="appointment-btn"><a href="profile.php">Mi perfil</a></li>

                    <?php
                    if ($_SESSION["privileges"] == 0){
                        echo '<li class="appointment-btn"><a href="register.php" class="smoothScroll">Crear cuenta</a></li>';
                    }
                    }
                    ?>
                    <li class="appointment-btn"><a href="logout.php" class="smoothScroll">Cerrar Sesión</a></li>
                </ul>
            </div>

        </div>
    </section>
</body>
</html>