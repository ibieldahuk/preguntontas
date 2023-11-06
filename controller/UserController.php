<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'third-party/PHPMailer-master/src/Exception.php';
require 'third-party/PHPMailer-master/src/PHPMailer.php';
require 'third-party/PHPMailer-master/src/SMTP.php';
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
        $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
        $apellido = isset($_POST["apellido"]) ? $_POST["apellido"] : "";
        $fechaNac = isset($_POST["fechaNacimiento"]) ? $_POST["fechaNacimiento"] : "";
        $genero = isset($_POST["sexo"]) ? $_POST["sexo"] : "";
        $fotoPerfil = isset($_FILES["file"]) ? $_FILES["file"] : "";
        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        $usuario= isset($_POST["usuario"]) ? $_POST["usuario"] : "";
        $contraseña= isset($_POST["contraseña"]) ? $_POST["contraseña"] : "";
        
        if($this->userModel->register($nombre, $apellido, $fechaNac, $genero, $email, $usuario,$contraseña, $fotoPerfil)){
            $this->enviarMailConfirmacion($nombre, $email);
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

    private function enviarMailConfirmacion($nombre, $correo){
        $mail = new PHPMailer(true);
        $mail->setLanguage('es', '/optional/path/to/language/directory/');

        try {
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer'=> false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'preguntontasweb@gmail.com';                     //SMTP username
            $mail->Password   = 'dkbo nymd jiuy inzc';                               //SMTP password
            $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('preguntontasweb@gmail.com', 'Preguntontas');
            $mail->addAddress($correo, $nombre);     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Registro exitoso';
            $mail->Body    = '<h1>¡Hola '. $nombre . ' !</h1>
                              <p>Gracias por registrarte en Preguntontas. Tu cuenta ha sido creada con éxito. 
                                Ahora puedes iniciar sesión y empezar a jugar.</p>';

            $mail->send();
            echo 'Mensaje enviado con exito';
        } catch (Exception $e) {
            echo "Hubo un error: {$mail->ErrorInfo}";
        }
    }
}