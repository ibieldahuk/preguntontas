<?php

class EditorController
{
    private $editorModel;
    private $renderer;

    public function __construct($editorModel, $renderer)
    {
        $this->editorModel = $editorModel;
        $this->renderer = $renderer;
    }

    public function renderCrearPregunta()
    {
        $this->renderer->render("crear_pregunta");
    }

    public function crearPregunta()
    {
        $pregunta = $_POST["pregunta"] ?? "";
        $respuestaCorrecta = $_POST["respuestaCorrecta"] ?? "";
        $respuestaIncorrecta1 = $_POST["respuestaIncorrecta1"] ?? "";
        $respuestaIncorrecta2 = $_POST["respuestaIncorrecta2"] ?? "";
        $respuestaIncorrecta3 = $_POST["respuestaIncorrecta3"] ?? "";

        if ($this->editorModel->altaPregunta($pregunta, $respuestaCorrecta, $respuestaIncorrecta1, $respuestaIncorrecta2, $respuestaIncorrecta3))
        {
            header("location:/user/home");
            exit();
        } else {
            header("location:renderCrearPregunta?error=INVALID");
            exit();
        }
    }

    public function renderBorrarPregunta()
    {
        $datos["preguntas"] = $this->editorModel->obtenerPreguntas();
        $this->renderer->render("borrar_pregunta", $datos);
    }

    public function borrarPregunta()
    {
        $idPregunta = $_GET["id"];
        $this->editorModel->borrarPregunta($idPregunta);
        header("location:/user/home");
        exit();
    }

}