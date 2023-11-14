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

    public function renderBorrarPregunta()
    {
        $datos["preguntas"] = $this->editorModel->obtenerPreguntasOficiales();
        $datos["metodos"] = [
            array("metodo" => "renderEditarPregunta", "texto" => "Editar"),
            array("metodo" => "borrarPregunta", "texto" => "Borrar")
            ];
        $this->renderer->render("gestor_preguntas", $datos);
    }

    public function verPreguntasSugeridas()
    {
        $datos["preguntas"] = $this->editorModel->obtenerPreguntasSugeridas();
        $datos["metodos"] = [
            array("metodo" => "borrarPregunta", "texto" => "Descartar"),
            array("metodo" => "renderEditarPregunta", "texto" => "Modificar"),
            array("metodo" => "oficializarPregunta", "texto" => "Aceptar")
        ];
        $this->renderer->render("gestor_preguntas", $datos);
    }

    public function verPreguntasReportadas()
    {
        $datos["preguntas"] = $this->editorModel->obtenerPreguntasReportadas();
        $datos["metodos"] = [
            array("metodo" => "renderEditarPregunta", "texto" => "Descartar"),
            array("metodo" => "renderEditarPregunta", "texto" => "Modificar"),
            array("metodo" => "borrarPregunta", "texto" => "Borrar")
        ];
        $this->renderer->render("gestor_preguntas", $datos);
        $datos["preguntas"] = $this->editorModel->obtenerPreguntas();
        $this->renderer->render("borrar_pregunta", $datos);
    }

    public function borrarPregunta()
    {
        $idPregunta = $_GET["id"];
        $this->editorModel->borrarPregunta($idPregunta);
        header("location:/editor/renderGestionarPreguntas");
        exit();
    }

    public function renderEditarPregunta()
    {
        $idPregunta = $_GET["id"];
        $datos["pregunta"] = $this->editorModel->obtenerPreguntaPorId($idPregunta);
        $this->renderer->render("editar_pregunta", $datos);
    }

    public function editarPregunta()
    {
        $idPregunta = $_POST["id"];
        $pregunta = $_POST["pregunta"] ?? "";
        $this->editorModel->editarPregunta($idPregunta, $pregunta);
        header("location:/editor/renderGestionarPreguntas");
        exit();
    }

    public function oficializarPregunta()
    {
        $idPregunta = $_GET["id"];
        $this->editorModel->oficializarPregunta($idPregunta);
        header("location:/editor/verPreguntasSugeridas");
    }

}