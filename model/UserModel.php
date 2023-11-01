<?php

class UserModel {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function login($usuario,$contraseña){
        $sql = "Select * from Usuario where usuario = '$usuario' AND contraseña = '$contraseña'";
        Logger::info($sql);
        $result=$this->database->query($sql);
        return sizeof($result) == 1;
    }

    public function register($nombre, $apellido, $fechaNac, $genero, $email, $usuario,$contraseña, $fotoPerfil){
        $sql = "Select * from Usuario where usuario = '$usuario' OR email = '$email'";
        Logger::info($sql);
        $result=$this->database->query($sql);
           if(sizeof($result) == 1){
            return false;
           }else{
               $fotoGuardada = $this->guardarFoto($fotoPerfil);
               $sql = "INSERT INTO `Usuario`( `nombre`, `apellido`, `fechaNac`, `genero`, `email`, `usuario`, `contraseña`, `fotoPerfil`) 
                VALUES ( '" . $nombre . "', '" . $apellido . "', '" . $fechaNac . "', '" . $genero . "', '" . $email . "','" . $usuario . "', '" . $contraseña .  "', '" . $fotoGuardada . "' )";
               $this->database->execute($sql);
               return true;
        }
    }

    public function datosUsuario(){
        $user = $_SESSION["usuario"];
        $sql = "Select * from Usuario where usuario = '$user' ";
        Logger::info($sql);
        return $this->database->query($sql);
    }

    public function perfil($usuario){
        $sql = "Select * from Usuario where usuario = '$usuario' ";
        return $this->database->query($sql);
    }

    private function guardarFoto($fotoPerfil){
        $fotoPerfil["name"] = "imagen_" . rand(1,200) . "." . pathinfo($fotoPerfil["name"], PATHINFO_EXTENSION);

        move_uploaded_file($fotoPerfil["tmp_name"], "public/fotosPerfil/" . $fotoPerfil["name"]);
        return "public/fotosPerfil/" . $fotoPerfil["name"];
    }
}