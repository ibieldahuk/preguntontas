<?php
session_start();
error_reporting(0);
?>
<div id="header">
<div id="botones_header" class="row">
    <div class="col-12">
        <?php
        if($_SESSION["admin"])
            echo "<a id='sec' href='botones_header.php'>Administrar viajes</a>";
        ?>
        <a id="sec" href="#">Mis viajes</a>
        <a id="sec" href="#">Novedades</a>
        <a id="sec" href="#">Quienes somos</a>
        <a id="sec" href="#">Nuestros viajes</a>
        <?php
        if(isset($_SESSION["usuarioNombre"])){
            echo "
            <a id='cerrarSesion'>Bienvenido $_SESSION[usuarioNombre] " . " $_SESSION[usuarioApellido]</a>
            <a href='../helper/CerrarSesion.php'><button class='btn btn-dark'>Cerrar sesion</button></a>";
        }else{
            echo "
        <a href='LoginView.html'><button class='btn btn-dark'>Iniciar sesion</button></a>
        <a href='RegisterView.html'><button class='btn btn-dark'>Registrarme</button></a>
        ";
        }
        ?>
        <img src="../public/logo.png" alt="">
    </div>
</div>
</div>
