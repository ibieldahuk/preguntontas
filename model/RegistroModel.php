<?php

class RegistroModel{

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function registrarUsuario($nombre,$pass,$edad,$email,$apellido){
        if( !$this->emailExistente($email)){
            $passMd5= md5($pass);
            $sql = "INSERT INTO usuario (nombre, apellido, edad, email, pass) VALUE ('$nombre','$apellido','$edad','$email','$passMD5');";
            $this->database->query($sql);
            $confirmation = $this->sendConfirmationMail($email);
            if($confirmation){
                $status = "registrado";
                return $status;
            }else{
                $status = "noregistrado";
                return $status;
            }

        }else{
            $status = "email=".$email;
            return $status;
        }


    }

    private function emailExistente($email){
        $sql= "SELECT 1 FROM usuarios where email ='".$email."'";
        $result = $this->database->query($sql);
        $result = mysqli_fetch_assoc($result);
        return (isset($result["1"]))? true : false;

    }

}