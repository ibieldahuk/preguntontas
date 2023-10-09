<?php

class LoginController {
    private $logInModel;
    private $printer;

    public function __construct($logInModel,$printer){
        $this->logInModel = $logInModel;
        $this->printer = $printer;
    }

    public function execute($data = []) {

        $menu ="<a href='/registro'>Registrarse</a>
                <a href='/logIn'>Ingresar</a>";


        if(isset($data["recovery"])){
            $data["display"] = "d-none";
        }else{
            $data["display"] = "d-block";
        }
        $data["menu"] = $menu;

        $this->printer->generateView("loginView.html",$data);
    }

    public function registrado(){
        $title = "Registro exitoso!";
        $message = "Verifique su correo electrónico para activar la cuenta  </br> <a class='recovery' href='https://mail.google.com' target='blank'>Ir a mi correo</a>";
        $display = "d-block";
        $data = ["popUp" => true,"title"=> $title,"message"=>$message,"display"=>$display];
        $this->execute($data);

    }

    public function autentificado(){
        $correo = $_GET["correo"];
        $this->logInModel->autentificar($correo);
    }

    public function validarSesion(){
        if(ValidatorHelper::validarSeteadoYNoVacio($_POST["usuario"]) &&
            ValidatorHelper::validarSeteadoYNoVacio($_POST["password"])){
            $usuario = $_POST["usuario"];
            $password = $_POST["password"];
            $this->logInModel->iniciarSesion($usuario,$password);
        }else{
            header("Location: /login");
        }
    }

    public function unauthenticated(){
        $title = "Registro incompleto";
        $message = "Verifique su correo electrónico para activar la cuenta  </br> <a class='recovery' href='https://mail.google.com' target='blank'>Ir a mi correo</a>";
        $display = "d-block";
        $data = ["popUp" => true,"title"=> $title,"message"=>$message,"display"=>$display];
        $this->execute($data);
    }

    public function notRegistered(){
        $email=$_GET["email"];
        $title = "Usuario o clave incorrecta";
        $message = "<p>intente nuevamente</p> </br> <a class='recovery' href='/login/recuperar/email=$email&dni=1'>Olvidé mi clave</a><a class='recovery' href='/registro'>Aún no estoy registrado</a>";
        $display = "d-block";
        $data = ["popUp" => true,"title"=> $title,"message"=>$message,"display"=>$display];
        $this->execute($data);
    }

    public function exit(){
        session_unset();
        session_destroy();
        header("Location: /incio");
    }
}