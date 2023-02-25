<?php

/*
 * funcion que recopila los datos del formulario de registro y comprueba la igualdad de las contraseñas.
 * Procesa la solicitud de registro; si esta es correcta devuelve true, devuelve false en caso contrario.
 */
function registerUser(){
    $name = isset($_POST["name"]) ? $_POST["name"] : null;
    $surname = isset($_POST["surname"]) ? $_POST["surname"] : null;
    $email = isset($_POST["email"]) ? $_POST["email"] : null;
    $password = isset($_POST["password"]) ? $_POST["password"] : null;
    $privileges = isset($_POST["privileges"]) ? $_POST["privileges"] : null;


    if (Usuario::registrarUsuario($name, $surname, $email, $password, $privileges)) {
            checkLogin();
            return true;
    }else{
        return false;
    }
}

/*
 * funcion que recopila los datos del formulario de login. Procesa la solicitud de login;
 * si esta es correcta devuelve true y rellena las cookies necesarias, devuelve false en caso contrario.
 */
function checkLogin() {
    $email = isset($_POST["email"]) ? $_POST["email"] : null;
    $password = isset($_POST["password"]) ? $_POST["password"] : null;

    $user = Usuario::buscaUsuario($email);

    if ($user && $user->compruebaPassword($password)) {
        $_SESSION["login"] = true;
        $_SESSION["id"]=$user->id();
        $_SESSION["email"] = $user->email();
        $_SESSION["name"] = $user->name();
        $_SESSION["surname"] = $user->surname();
        $_SESSION["privileges"] = $user->privileges();
        $_SESSION["password"] = $user->password();
        return true;

    }else{
        return false;
    }
}

function checkSession() {
return $_SESSION["login"];
}

/*
 * funcion que destruye la sesion
 */
function logout() {
    //Doble seguridad: unset + destroy
    unset($_SESSION["login"]);
    unset($_SESSION["id"]);
    unset($_SESSION["email"]);
    unset($_SESSION["name"]);
    unset($_SESSION["privileges"]);
    unset($_SESSION["surname"]);
    unset($_SESSION["password"]);


    session_destroy();
    session_start();
}

/*
 * funcion que muestra al usuario sus datos personales en formato tabla
 */
function datosUsuario($email): string
{
    $html = '<link rel="stylesheet" href="css/style.css"><div class="screen-1"><table class="formula">';
    $perfil = Usuario::buscaUsuario($email);
    $html .='<thead><td colspan="2"> Datos del usuario</td></thead>';

    $html .= '<tr><td>';
    $html .= 'Nombre: ';
    $html .= '</td><td>';
    $html .= $perfil->name();
    $html .= '</td></tr>';

    $html .= '<tr><td>';
    $html .= 'Apellido: ';
    $html .= '</td><td>';
    $html .= $perfil->surname();
    $html .= '</td></tr>';

    $html .= '<tr><td>';
    $html .= 'Email: ';
    $html .= '</td><td>';
    $html .= $perfil->email();
    $html .= '</td></tr>';

    $html .= '<tr><td>';
    $html .= 'Privilegios: ';
    $html .= '</td><td>';
    if ($perfil->privileges() == 0){
        $html.= 'Administrador';
    }else{
        $html.= 'Usuario';
    }
    $html .= '</td></tr>';

    $html .= '</table><a href = "editProfile.php"> <button class="btnprof"> Modifica tus datos </button></a></div>';

    return $html;
}

/*
 * funcion que procesa las peticiones de cambio de datos proporcionadas por el usuario.
 * Devuelve true si todos se realizan de manera correcta, false en caso contrario.
 */
function cambiarDatos($email): bool
{

    $bool = true;

    $perfil = Usuario::buscaUsuario($email);


    $password = isset($_POST["password"]) ? $_POST["password"] : null;
    $password2 = isset($_POST["password2"]) ? $_POST["password2"] : null;
    if($password!=null){
        if($password==$password2){
            $bool = $perfil->cambiaPassword($password);
        }else{
            return false;
        }
    }

    $username = isset($_POST["name"]) ? $_POST["name"] : null;
    if($username!=null){
        $bool = $perfil->cambiaName($username);
    }

    $last = isset($_POST["surname"]) ? $_POST["surname"] : null;
    if($last!=null){
        $bool = $perfil->cambiaSurname($last);
    }

    if($bool==true)
         $perfil->actualizarSesion();


    return $bool;
}