<?php

class UserController {
    private $userModel;
    private $renderer;

    public function __construct($userModel, $renderer) {
        $this->userModel = $userModel;
        $this->renderer = $renderer;
    }

    public function home() {
        if($_SESSION["usuario"]=="admin"){
            $datos["admin"]=TRUE;
            $this->renderer->render("home",$datos);
        }else if ($_SESSION["usuario"]=="editor")
        {
            $datos["editor"]=TRUE;
            $this->renderer->render("home",$datos);
        }else{
            $datos["usuario"]= $this->userModel->datosUsuario();
            $this->renderer->render("home",$datos);
        }

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

    public function Login() {
        $usuario= isset($_POST["usuario"]) ? $_POST["usuario"] : "";
        $contraseña= isset($_POST["contraseña"]) ? $_POST["contraseña"] : "";
        
        if($this->userModel->login($usuario,$contraseña)){
            $_SESSION["usuario"]=$usuario;
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

    public function cerrarSesion(){
        session_destroy();
        header("location:RenderLogin");
        exit();
    }

    public function perfil(){
        $usuario=$_GET["usuario"];
        $data["perfil"]=$this->userModel->perfil($usuario);
        $this->renderer->render("perfil",$data);
    }
}