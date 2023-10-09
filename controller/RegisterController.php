<?php

class RegisterController {
    private $printer;
    private $usuarioModel;

    public function __construct($printer) {
        $this->printer = $printer;
    }

    public function execute($data = []) {
        $this->printer->generateView('RegisterView.html');

        if(isset($_SESSION["logueado"]) && $_SESSION["logueado"]==1){
            $menu ="<p>Hola, ".$_SESSION['user']."</p>
                    <a href='/logIn/exit'>Cerrar Sesion</a>";
        }else{
            $menu ="<a href='/registro'>Registrarse</a>
                <a href='/logIn'>Ingresar</a>";
        }

        if(isset($data["turno"])){
            $data["display"] = "d-none";
        }else{
            $data["display"] = "d-block";
        }
        $data += ["menu"=>$menu];
        $this->printer->generateView('registroView.html',$data);
    }

    public function registrarUsuario(){
        if(((   ValidatorHelper::validacionDeTexto($_POST["nombre"],11)&&
                    ValidatorHelper::validacionDeTexto($_POST["apellido"],11))&&
                (       ValidatorHelper::validacionDeNumeros($_POST['dni'],11)&&
                    ValidatorHelper::validacionDeTexto($_POST['email'],50)))&&
            (       ValidatorHelper::validacionDeTexto($_POST['user'],21)&&
                ValidatorHelper::validacionDeTexto($_POST['clave'],21))){
            $nombre = $_POST["nombre"];
            $pass = $_POST["pass"];
            $edad = $_POST["edad"];
            $email = $_POST["email"];
            $apellido = $_POST["apellido"];

            $status = $this->registroModel->registrarUsuario($nombre,$pass,$edad,$email,$apellido);
            if( $status == "registrado"){
                header("Location:/logIn/".$status);
                exit();}
            else if($status == "noregistrado"){
                header("Location:/logIn/".$status);
                exit();
            }if($status== "email=".$email){
                header("Location:/registro/duplicate/".$status);
                exit();
            }
        }else{
            header("Location: /registro");
            exit();
        }
    }

    public function duplicate(){
        $email = $_GET['email'];
        $title="Email ya registrado";
        $message="<a class='recovery' href='/login/recuperar/email=$email'>Olvidé mi clave</a>";
        $display = "d-block";
        $data = ["popUp" => true,"title"=> $title,"message"=>$message,"display"=>$display];
        $this->execute($data);
    }

}