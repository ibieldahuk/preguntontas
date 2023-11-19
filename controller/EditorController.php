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

    public function renderGestionarPreguntas()
    {
        $datos["preguntas"] = $this->editorModel->obtenerPreguntasOficiales();
        $datos["metodos"] = [
            array("metodo" => "renderEditarPregunta", "texto" => "Editar"),
            array("metodo" => "borrarPregunta", "texto" => "Borrar"),
            array("metodo" => "verDetalles", "texto" => "Ver respuestas")
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

    public function verDetalles()
    {
        $idPregunta = $_GET["id"];
        $datos["pregunta"] = $this->editorModel->obtenerPreguntaPorId($idPregunta);
        $datos["respuesta_correcta"] = $this->editorModel->obtenerRespuestaCorrecta($idPregunta);

        $rtasIncorr = $this->editorModel->obtenerRespuestasIncorrectas($idPregunta);
        $orden = 1;
        $respuestasIncorrectas = [];
        foreach ($rtasIncorr as $respuesta)
        {
            $respuesta["2"] = "$orden";
            $respuesta["orden"] = "$orden";
            $respuestasIncorrectas[] = $respuesta;
            $orden++;
        }
        $datos["respuestas_incorrectas"] = $respuestasIncorrectas;

        $this->renderer->render("detalles_pregunta", $datos);
    }

    public function editarRespuestas()
    {
        $this->editorModel->editarRespuesta($_POST["id-correcta"], $_POST["opcion-correcta"], "SI");
        $this->editorModel->editarRespuesta($_POST["id-incorrecta-1"], $_POST["opcion-incorrecta-1"], "NO");
        $this->editorModel->editarRespuesta($_POST["id-incorrecta-2"], $_POST["opcion-incorrecta-2"], "NO");
        $this->editorModel->editarRespuesta($_POST["id-incorrecta-3"], $_POST["opcion-incorrecta-3"], "NO");
        header("location:/editor/renderGestionarPreguntas");
    }

}