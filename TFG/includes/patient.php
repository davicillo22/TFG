<?php

require_once __DIR__.'/config.php';


class Patient
{

    /*
     * funcion que entra en la base de datos para dar de alta un nuevo usuario, dados todos los campos necesarios
     */
    public static function registrarUsuario($name, $surname, $email, $password, $privileges): bool
    {
        $conn = getConexionBD();
        if(!self::buscaUsuario($email)){
            //$passwordhash = password_hash($password, PASSWORD_DEFAULT);
            $query = sprintf("INSERT INTO `users` (`name`, `surname`, `email`, `password`, `privileges`)
                VALUES ('%s', '%s', '%s', '%s', '%s')", $conn->real_escape_string($name),
                $conn->real_escape_string($surname), $conn->real_escape_string($email), $conn->real_escape_string($password), $conn->real_escape_string($privileges));
            if ($conn->query($query) === TRUE) {
                return true;
            }
        }
        return false;
    }

    /*
     * funcion que retorna un objeto de tipo Usuario si existe usuario con el $username dado, false en caso contrario
     */
    public static function buscaUsuario($email)
    {
        $conn = getConexionBD();
        $query = sprintf("SELECT * FROM users WHERE email='%s'", $conn->real_escape_string($email));

        $rs = $conn->query($query);
        if ($rs && $rs->num_rows == 1) {
            $fila = $rs->fetch_assoc();
            $user = new Usuario($fila['id'], $fila['name'], $fila['surname'], $fila['email'], $fila['password'], $fila['privileges']);

            $rs->free();
            return $user;
        }
        $rs->free();
        return false;
    }

    /*
     * funcion que retorna un objeto de tipo Usuario si existe usuario con el $userID dado, false en caso contrario
     */
    public static function buscaPorId($userID)
    {
        $conn = getConexionBD();
        $query = sprintf("SELECT * FROM users WHERE userID=%d", $conn->real_escape_string($userID));
        $rs = $conn->query($query);
        if ($rs && $rs->num_rows == 1) {
            $fila = $rs->fetch_assoc();
            $user = new Usuario($fila['userID'], $fila['username'], $fila['password'], $fila['given_name'], $fila['last_name'], $fila['date_of_birth'], $fila['date_of_registration'],$fila['favorite_game'], $fila['e-mail'], $fila['description']);

            $rs->free();
            $user->obtenerCompras();
            return $user;
        }
        return false;
    }

    private $id;
    private $name;
    private $surname;
    private $email;
    private $password;
    private $privileges;

    public function __construct($id, $name, $surname, $email, $password, $privileges)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
        $this->privileges = $privileges;
    }


    //GETTERS, SETTERS (que mantienen la BD actualizada) y METODOS AUXILIARES

    public function id()
    {
        return $this->id;
    }


    public function compruebaPassword($password): bool
    {
        if ($this->password == $password){
            return true;
        }else{
            return false;
        }
    }


    public function email()
    {
        return $this->email;
    }
    public function name()
    {
        return $this->name;
    }

    public function surname()
    {
        return $this->surname;
    }

    public function privileges()
    {
        return $this->privileges;
    }

    public function password()
    {
        return $this->password;
    }

    public function cambiaPassword($nuevoPassword): bool
    {
        $conn = getConexionBD();
        // $passwordhash = password_hash($nuevoPassword, PASSWORD_DEFAULT);
        $query = sprintf("UPDATE `users` SET `password` = '%s' WHERE `users`.`id` = '%s'", $conn->real_escape_string($nuevoPassword), $conn->real_escape_string($this->id));
        if ($conn->query($query) === TRUE) {
            $this->password = $nuevoPassword;
            return true;
        }
        return false;
    }


    public function cambiaName($nuevoName): bool
    {
        $conn = getConexionBD();
        $query = sprintf("UPDATE `users` SET `name` = '%s' WHERE `users`.`id` = '%s'", $conn->real_escape_string($nuevoName), $conn->real_escape_string($this->id));
        if ($conn->query($query) === TRUE) {
            $this->name = $nuevoName;

            return true;
        }
        return false;
    }

    public function cambiaSurname($nuevoSurname): bool
    {
        $conn = getConexionBD();
        $query = sprintf("UPDATE `users` SET `surname` = '%s' WHERE `users`.`id` = '%s'", $conn->real_escape_string($nuevoSurname), $conn->real_escape_string($this->id));
        if ($conn->query($query) === TRUE) {
            $this->surname = $nuevoSurname;

            return true;
        }
        return false;
    }

    public function actualizarSesion(){
        $_SESSION["name"] = $this->name();
        $_SESSION["surname"] = $this->surname();
        $_SESSION["email"] = $this->email();
        $_SESSION["privileges"] = $this->privileges();
        $_SESSION["password"] = $this->password();
    }

    /*
     * funcion que entra en la base de datos para obtener las compras que el usuario ha realizado
     * y rellena el array de cursos que pertenecen al usuario
     */
    public function obtenerCompras(){
        $this->cursos = [];
        $conn = getConexionBD();
        $query = sprintf("SELECT `courseID` FROM `purchases` WHERE `userID` = '%s'", $conn->real_escape_string($this->id));

        $rs = $conn->query($query);

        while ($registro = $rs->fetch_assoc()) {
            $id = $registro['courseID'];
            array_push($this->cursos, Curso::buscarCursoPorID($id));
        }

        $rs->free();
    }

    /*
     * funcion que mustra informacion acerca de los cursos que el usuario dispone, para mostrar en la seccion del perfil correspondiente
     */
    public function obtenerMisCursos(){
        $html="<h1>Mis cursos:</h1>";
        foreach ($this->cursos as $item) {
            $html.=$item->obtenerMiCursoDisplay();
        }
        return $html;
    }
}