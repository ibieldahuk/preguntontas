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
        if($_SESSION["IdPregunta"] == NULL) {
            $datos["completo"] = "Completaste todas las preguntas!";
            $this->renderer->render("home",$datos);
        } else {
            $this->juegoModel->preguntaRepetida($_SESSION["IdPregunta"]);
            $_SESSION["pregunta"] = $this->juegoModel->elegirPregunta($_SESSION["IdPregunta"]);
            $this->juegoModel->contarPregunta($_SESSION["IdPregunta"]);
            $this->juegoModel->contarPreguntaUsuario($_SESSION["usuario"]);
            $_SESSION["respuestas"] = $this->juegoModel->elegirRespuestas($_SESSION["IdPregunta"]);
            $categoria = $this->juegoModel->obtenerCategoria($_SESSION["IdPregunta"]);

            $datos["categoria"] = $categoria;
            $datos["racha"] = $_SESSION["RACHA"];
            $datos["idPregunta"] = $_SESSION["IdPregunta"];
            $datos["pregunta"] = $_SESSION["pregunta"];
            $datos["respuestas"] = $_SESSION["respuestas"];

            $_SESSION["temporizador-comienzo"] = time();

            $this->renderer->render("partida",$datos);
        }
    }

    public function respuesta() {
        $id = $_GET['id'];

        $temporizadorFin = time();
        $tiempo = $temporizadorFin - $_SESSION["temporizador-comienzo"];

        if($id==NULL){
            $datos["check"] = "Contactar con el desarrollador";
        }else if($id=="SI" && $tiempo < 10){
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
            if ($id == "SI") {
                $datos["check"] = "Se acabó el tiempo";
            } else {
                $datos["check"] = "Respuesta incorrecta";
            }
        }
        $this->renderer->render("partida",$datos);
    }

    /*
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
    */

    public function reportarPregunta()
    {
        $json_data = file_get_contents("php://input");
        $data = json_decode($json_data);

        if ($data && isset($data->id_pregunta)) {
            $idPregunta = $data->id_pregunta;

            $this->juegoModel->reportarPregunta($idPregunta);

            $response = ["success" => true, "message" => "Pregunta reportada correctamente"];
            echo json_encode($response);
        } else {
            $response = ["success" => false, "message" => "Error"];
            echo json_encode($response);
        }
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