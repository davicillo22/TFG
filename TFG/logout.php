<?php
session_start();
unset($_SESSION["login"]);
unset($_SESSION["id"]);
unset($_SESSION["name"]);
unset($_SESSION["email"]);
unset($_SESSION["privileges"]);
unset($_SESSION["surname"]);
unset($_SESSION["password"]);

session_destroy();
header( 'Location: login.php' );



?>