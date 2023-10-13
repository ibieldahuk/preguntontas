<?php

class UserController {
    private $userModel;
    private $renderer;

    public function __construct($userModel, $renderer) {
        $this->userModel = $userModel;
        $this->renderer = $renderer;
    }

    public function home() {
        $this->renderer->render("home");
    }

    public function RenderLogin() {
        if(isset($_GET["estado"])){
            $data['error'] = true;
        }
        $this->renderer->render("login",$data);
    }


    public function RenderRegister() {
        if(isset($_GET["error"])){
            $data['error'] = true;
        }
        $this->renderer->render("register",$data);
    }

    public function renderJuego() {
        $this->renderer->render("juego");
    }

    public function Login() {
        $usuario= isset($_POST["usuario"]) ? $_POST["usuario"] : "";
        $contraseña= isset($_POST["contraseña"]) ? $_POST["contraseña"] : "";
        
        if($this->userModel->login($usuario,$contraseña)){
            header("location:home");
            exit();
        } else {
            header("location:RenderLogin?estado=INVALID");
            exit();
        }
    }

    public function Register() {
        $usuario= isset($_POST["usuario"]) ? $_POST["usuario"] : "";
        $contraseña= isset($_POST["contraseña"]) ? $_POST["contraseña"] : "";
        
        if($this->userModel->register($usuario,$contraseña)){
            header("location:RenderLogin");
            exit();
        } else {
            header("location:RenderRegister?error=INVALID");
            exit();
        }
}
}