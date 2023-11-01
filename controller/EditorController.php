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
            header("location:renderCrearPregunta");
            exit();
        } else {
            header("location:renderCrearPregunta?error=INVALID");
            exit();
        }
    }

}