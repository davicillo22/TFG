<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../../css/estilos.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>

<!--<img class="centerBanner" src="images/recursos/banner_logo.png" height="133" width="970" alt=""/>-->
<?php
if (isset($_SESSION["login"]) && $_SESSION["login"]){
?>
<div class="navbar">
    <div class="dropdown">
        <button class="dropbtn"><?php
            if (isset($_SESSION["login"]) && $_SESSION["login"]){
                echo "Hola, ";
                echo $_SESSION["name"];
            }
            ?>
        </button>
        <div class="dropdown-content">
            <?php
            if (isset($_SESSION["login"]) && $_SESSION["login"]){
                ?>
                <a href="profile.php">Mi perfil</a>
                <a href="logout.php">Cerrar sesión</a>
                <?php
                if ($_SESSION["privileges"] == 0){
                    echo '<a href="register.php">Crear cuenta</a>';
                }
                ?>
                <?php
            }

            ?>

        </div>
    </div>
</div>
 <?php
}
?>
</body>
</html>