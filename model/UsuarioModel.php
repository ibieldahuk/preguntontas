<?php

class UsuarioModel{
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getUsuario(){
        return $this->database->query('SELECT * FROM usuario');
    }

    public function registrarUsuario($nombre,$pass,$edad,$email,$apellido){
        $comprobarMail=$this->database->query("SELECT email from usuario WHERE usuario.email LIKE '$email'");

        while($comprobarMail) {
            if ($comprobarMail["email"] == $email) {
                $_SESSION["error"] = "Este mail de usuario ya se encuentra registrado";
                exit();
            }
        }

        $passMD5= md5($pass);

        $this->database->query("INSERT INTO usuario (nombre, apellido, edad, email, pass) VALUE ('$nombre','$apellido','$edad','$email','$passMD5');");

        $_SESSION["usuario"]=$nombre;
        exit();
    }
}