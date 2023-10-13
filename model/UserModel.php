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

    public function register($usuario,$contraseña){
        $sql = "Select * from Usuario where usuario = '$usuario' ";
        Logger::info($sql);
        $result=$this->database->query($sql);   
           if(sizeof($result) == 1){
            return false;
           }else{
            $sql = "INSERT INTO `Usuario`( `usuario`, `contraseña`) 
            VALUES ( '" . $usuario . "', '" . $contraseña .  "' )";
            $this->database->execute($sql);
            return true;
        }
    }

    public function getPreguntaYOpciones() {
        return array(
            "pregunta" => "¿En qué año ocurrió la Revolución de Mayo?",
            "opciones" => array("1816", "1810", "1917", "2003"));
    }
}