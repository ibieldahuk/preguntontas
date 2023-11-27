<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
include_once("third-party/phpqrcode/qrlib.php");
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
        $pais = isset($_POST["selec-pais"]) ? $_POST["selec-pais"] : "";
        $ciudad = isset($_POST["selec-ciudad"]) ? $_POST["selec-ciudad"] : "";
        $genero = isset($_POST["sexo"]) ? $_POST["sexo"] : "";
        $fotoPerfil = isset($_FILES["file"]) ? $_FILES["file"] : "";
        $latitud = isset($_POST["latitud"]) ? $_POST["latitud"] : "";
        $longitud = isset($_POST["longitud"]) ? $_POST["longitud"] : "";
        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        $usuario= isset($_POST["usuario"]) ? $_POST["usuario"] : "";
        $contraseña= isset($_POST["contraseña"]) ? $_POST["contraseña"] : "";
        $repiteContraseña = isset($_POST["repiteContraseña"]) ? $_POST["repiteContraseña"] : "";

        if ($contraseña == $repiteContraseña) {
            if ($this->userModel->register($nombre, $apellido, $fechaNac, $pais, $ciudad, $genero, $email, $usuario, $contraseña, $fotoPerfil, $latitud, $longitud)) {
                $this->enviarMailConfirmacion($nombre, $email);
                header("location:RenderLogin");
                exit();
            }else {
                $error = "El usuario ya existe";
            }
        } else {
            $error = "Las contraseñas no coinciden";
        }
        $this->renderer->render("register", ['error' => $error]);
}

    public function cerrarSesion(){
        session_destroy();
        header("location:RenderLogin");
        exit();
    }

    public function perfil(){
        $usuario=$_GET["usuario"];
        $data["perfil"]=$this->userModel->perfil($usuario);
        Logger::info($data["perfil"]);

        $imgQR = "localhost/user/perfil/usuario=".$usuario;
        $carpeta_destino = "public/images/profile_qrs/";

        QRcode::png($imgQR,$carpeta_destino.$usuario."_qr.png",QR_ECLEVEL_L,4);

        $this->renderer->render("perfil",$data);
    }

    private function enviarMailConfirmacion($nombre, $correo){
        $mail = new PHPMailer(true);
        $mail->setLanguage('es', 'third-party/PHPMailer-master/language/');

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