<?php
session_start();


include_once ("ConexionBdd.php");


if(isset($_GET['cerrar_sesion'])){
    session_unset();

    session_destroy();
}

if(isset($_SESSION['rol'])){
    switch ($_SESSION){
        case 2:
            header('location: AdminView.php');
            break;

        case 3:
            header('location: HomeView.php');
            break;

        default: echo "Interesado";
    }
}

$email = isset( $_POST["email"])?$_POST["email"] : "";
$pass = isset( $_POST["pass"])?$_POST["pass"] : "";

$passMD5=md5($pass);

$comprobarMail=mysqli_query($conn,"SELECT * from usuario Where usuario.email LIKE '$email' AND usuario.pass LIKE '$passMD5'");

while($mailComprobado=mysqli_fetch_assoc($comprobarMail)){
    if($mailComprobado["nombre"]=="gauchoAdmin"){
        $_SESSION["usuarioNombre"]=$mailComprobado["nombre"];
        $_SESSION["admin"]=TRUE;
        header("location:view/HomeView.html");
        exit();
    }
    $_SESSION["usuarioNombre"]=$mailComprobado["nombre"];
    $_SESSION["usuarioApellido"]=$mailComprobado["apellido"];
    $_SESSION["email"]=$mailComprobado["email"];
    $_SESSION["admin"]=FALSE;
    header("location:view/HomeView.html");
    exit();
};

$_SESSION["error"]="UsuarioModel o contraseña incorrectos";
header("location:view/login.php");




