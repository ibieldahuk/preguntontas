<?php

class AdminController
{
    private $adminModel;
    private $renderer;

    public function __construct($adminModel, $renderer)
    {
        $this->adminModel = $adminModel;
        $this->renderer = $renderer;
    }

    public function renderCantidadJugadores(){
        $datos["totalJugadores"] = $this->adminModel->cantidadJugadores();
        $this->renderer->render("cantidad_jugadores", $datos);
    }

    public function renderCantidadPreguntas(){
        $datos["cantidadPreguntas"] = $this->adminModel->cantidadPreguntas();
        $this->renderer->render("cantidad_preguntas", $datos);
    }

    public function  renderCantidadJugadoresSexo(){
        $datos["cantidadJugadoresPorSexo"] = $this->adminModel->cantidadJugadoresPorSexo();
        Logger::info($datos["cantidadJugadoresPorSexo"]);
        $this->renderer->render("cantidad_jugadores_sexo", $datos);
    }

    public function renderCantidadJugadoresEdad(){
        $datos["cantidadJugadoresPorEdad"] = $this->adminModel->cantidadJugadoresPorEdad();
        $this->renderer->render("cantidad_jugadores_edad", $datos);
    }


}