<?php
session_start();
error_reporting(0);
?>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="../public/styles.css" rel="stylesheet">
    <title>GauchoRocket</title>
</head>
<body id="body_index">
<?php include_once("botones_header.php")?>
<div class="container">
    <div id="header" class="row">
        <div id="titulo_header" class="col-7">
            <h1>Al infinito y mas alla</h1>
            <h4>Vivi una nueva experiencia</h4>
        </div>
        <div class="col d-none d-lg-block col-md-4 col-lg-4 col-XL-5">
            <img src="../public/planeta.jpg" >
        </div>
    </div>
</div>
<div id="fotos">
    <div class="container">
        <div class="row">
            <div class="col"><h3>Nuestros vuelos</h3></div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="tarjetas">
                <h4>Titulo</h4>
                <img src="../public/planeta.jpg">
                <p>Duracion</p>
                <p>Costo</p>
                <p>Espacios Disponibles</p>
                <p>Nivel requerido</p>
            </div>
        </div>
        <div class="col">
            <div class="tarjetas">
                <h4>Titulo</h4>
                <img src="../public/planeta.jpg">
                <p>Duracion</p>
                <p>Costo</p>
                <p>Espacios Disponibles</p>
                <p>Nivel requerido</p>
            </div>
        </div>
        <div class="col">
            <div class="tarjetas">
                <h4>Titulo</h4>
                <img src="../public/planeta.jpg">
                <p>Duracion</p>
                <p>Costo</p>
                <p>Espacios Disponibles</p>
                <p>Nivel requerido</p>
            </div>
        </div>
        <div class="col">
            <div class="tarjetas">
                <h4>Titulo</h4>
                <img src="../public/planeta.jpg">
                <p>Duracion</p>
                <p>Costo</p>
                <p>Espacios Disponibles</p>
                <p>Nivel requerido</p>
            </div>
        </div>
    </div>
</div>
<footer>
    <h1>ESTE ES EL FOOTER</h1>
</footer>
</body>
</html>
