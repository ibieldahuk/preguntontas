<?php

class HomeController {
    private $printer;
    private $VuelosModel;

    public function __construct($VuelosModel, $printer) {
        $this->VuelosModel = $VuelosModel;
        $this->printer = $printer;
    }

    public function execute() {

        if(isset($_SESSION["logueado"]) && $_SESSION["logueado"]==1){
            $menu ="<p>Hola, ".$_SESSION['user']."</p>
                  <a href='/logIn/exit'>Cerrar Sesion</a>";
            if($_SESSION["nivel"]==1 || $_SESSION["nivel"]==2){
                $filtroNivel = " (id_tipo IN('OR','BA'))";
            }else{
                $filtroNivel = "1";
            }

        }else{
            $menu ="<a href='/registro'>Registrarse</a>
            <a href='/logIn'>Ingresar</a>";
            $filtroNivel = "1";
        }


        $vuelos  = $this->VuelosModel->getVuelos();
        $data = ["vuelos" => $vuelos];
        $this->printer->generateView('homeView.html', $data);
    }

    public function buscarVuelos() {
        $nombre = isset( $_POST["nombre"])?$_POST["nombre"] : "";
        $vuelosBuscados  = $this->VuelosModel->buscarVuelos($nombre);
        $data = ["vuelosBuscados" => $vuelosBuscados];
        $this->printer->generateView('homeView.html', $data);
    }
}