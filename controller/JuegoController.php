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
        $this->juegoModel->incrementarPartidasJugadas();
        $this->generarPregunta();
    }

    public function generarPregunta(){
        $_SESSION["IdPregunta"] = $this->juegoModel->idPregunta();
        if($_SESSION["IdPregunta"] == NULL){
            $datos["completo"] = "Completaste todas las preguntas!";
            $this->renderer->render("home",$datos);
        }else{
        $this->juegoModel->preguntaRepetida($_SESSION["IdPregunta"]);
        $_SESSION["pregunta"] = $this->juegoModel->elegirPregunta($_SESSION["IdPregunta"]);
        $this->juegoModel->contarPregunta($_SESSION["IdPregunta"]);
        $this->juegoModel->contarPreguntaUsuario($_SESSION["usuario"]);
        $_SESSION["respuestas"] = $this->juegoModel->elegirRespuestas($_SESSION["IdPregunta"]);

        $datos["racha"] = $_SESSION["RACHA"];
        $datos["idPregunta"] = $_SESSION["IdPregunta"];
        $datos["pregunta"] = $_SESSION["pregunta"];
        $datos["respuestas"] = $_SESSION["respuestas"];
        $this->renderer->render("partida",$datos);
        }
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

    public function reportarPregunta() {
        $id = $_GET['id'];
        $this->juegoModel->reportarPregunta($id);
        $_SESSION["reportar"]=TRUE;
        $datos["reportar"] = $_SESSION["reportar"];

        $datos["racha"] = $_SESSION["RACHA"];
        $datos["idPregunta"] = $_SESSION["IdPregunta"];
        $datos["pregunta"] = $_SESSION["pregunta"];
        $datos["respuestas"] = $_SESSION["respuestas"];
        $this->renderer->render("partida",$datos);
    }

    public function sugerir(){
        $this->renderer->render("sugerirPregunta");
    }

    public function sugerirPregunta(){
        $pregunta=$_POST["pregunta"];
        $respuesta=$_POST["respuesta_correcta"];
        $opcion1=$_POST["Opcion1"];
        $opcion2= isset($_POST["Opcion2"]) ? $_POST["Opcion2"] : "";
        $opcion3= isset($_POST["Opcion3"]) ? $_POST["Opcion3"] : "";
        $categoria=$_POST["categoria"];

        $this->juegoModel->sugerirPregunta($pregunta, $respuesta, $opcion1, $opcion2, $opcion3, $categoria);
        header("location:/user/home");
    }
}