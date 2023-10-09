<?php
session_start();

include_once ("ConexionBdd.php");

$nombre = isset( $_POST["nombre"])?$_POST["nombre"] : "";
$pass = isset( $_POST["pass"])?$_POST["pass"] : "";
$edad = isset( $_POST["edad"])?$_POST["edad"] : "";
$email = isset( $_POST["email"])?$_POST["email"] : "";
$apellido = isset( $_POST["apellido"])?$_POST["apellido"] : "";

    $comprobarMail=mysqli_query($conn,"SELECT email from usuario WHERE usuario.email LIKE '$email'");

while($mailComprobado=mysqli_fetch_assoc($comprobarMail)) {
    if ($mailComprobado["email"] == $email) {
        $_SESSION["error"] = "Este mail de usuario ya se encuentra registrado";
        header("location:view/register.php");
        exit();
    }
}

$passMD5= md5($pass);

$insertarMail=mysqli_query($conn,"INSERT INTO usuario (nombre, apellido, edad, email, pass) VALUE ('$nombre','$apellido','$edad','$email','$passMD5');");
$_SESSION["usuario"]=$nombre;
echo var_dump($mailComprobado["email"]);
header("location:view/login.php");
exit();


