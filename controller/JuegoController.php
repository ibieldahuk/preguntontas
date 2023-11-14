<?php

class JuegoController
{
    private $juegoModel;
    private $renderer;

    public function __construct($juegoModel, $renderer) {
        $this->juegoModel = $juegoModel;
        $this->renderer = $renderer;

    }

    public function ranking(){
        $datos["rank"]=$this->juegoModel->listarRanking();
        $this->renderer->render("ranking",$datos);
    }

    public function partida() {
        $_SESSION["RACHA"]=0;
        $_SESSION["REPES"]=0;
        $_SESSION["contPartida"]++;
        $this->generarPregunta();
        $datos["racha"] = $_SESSION["RACHA"];
        $this->renderer->render("partida",$datos);
    }

    public function generarPregunta(){
        $idPregunta = $this->juegoModel->idPregunta();
        $_SESSION["IdPregunta"]=$idPregunta;
        $datos["pregunta"] = $this->juegoModel->elegirPregunta($idPregunta);
        $this->juegoModel->contarPregunta($idPregunta);
        $this->juegoModel->contarPreguntaUsuario($_SESSION["usuario"]);
        $datos["respuestas"] = $this->juegoModel->elegirRespuestas($idPregunta);
        $datos["racha"] = $_SESSION["RACHA"];
        $this->renderer->render("partida",$datos);
    }

    public function respuesta() {
        $id = $_GET['id'];

        if($id==NULL){
            $datos["check"] = "Contactar con el desarrollador";

        }else if($id=="SI"){
            $_SESSION["RACHA"]++;
            $this->juegoModel->contarCorrecta($_SESSION["IdPregunta"]);
            $this->juegoModel->actualizarDificultad($_SESSION["IdPregunta"]);
            $this->juegoModel->contarCorrectaUsuario($_SESSION["usuario"]);
            $this->juegoModel->actualizarDificultadUsuario($_SESSION["usuario"]);
            $this->generarPregunta();
            exit();

        }else{
            $datos["racha"] = $_SESSION["RACHA"];
            $this->juegoModel->cargarRecord();
            $this->juegoModel->cargarPuntaje();
            $this->juegoModel->actualizarDificultad($_SESSION["IdPregunta"]);
            $this->juegoModel->actualizarDificultadUsuario($_SESSION["usuario"]);
            $datos["check"] = "Respuesta incorrecta";
        }
        $this->renderer->render("partida",$datos);
    }
}