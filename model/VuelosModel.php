<?php

class VuelosModel {
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getVuelos(){
        return $this->database->query('SELECT * FROM vuelos');
    }

    public function buscarVuelos($nombre){
        return $this->database->query("SELECT * FROM vuelosdisponibles WHERE circuito = '$nombre' OR dia = '$nombre' OR equipo = '$nombre' OR partida = '$nombre'");
    }

    public function mostrarVuelo($variable){

    }

}