<?php

class LogInModel{
    private $database;

    public function __construct($database){
        $this->database = $database;
    }

    public function iniciarSesion($email,$password){
        $pass = md5($password);
        $sqlUser = "SELECT autentificado,user,tipo FROM usuarios WHERE email = '" . $email. "' AND pass = '" . $pass. "'";
        $qry = $this->database->query($sqlUser);
        $obj = mysqli_fetch_assoc($qry);

        if(isset($obj['autentificado'])){
            if($obj['autentificado']==1){
                session_start();
                $_SESSION["logueado"]=1;
                $_SESSION["usuario"]=$email;
                $_SESSION["user"]=$obj['user'];
                $_SESSION["nivel"]=$obj['tipo'];

                header("Location: index.php?module=inicio");
            }else{
                //SI ESTA REGISTRADO PERO NO HIZO LA AUTENTIFICACION --> NO LOGUEA
                header("Location: /login/unauthenticated");

            }
        }else{
            header("Location: /login/notRegistered/email=$email");
        }
    }
}