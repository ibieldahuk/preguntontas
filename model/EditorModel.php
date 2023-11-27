<?php

class EditorModel
{

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function obtenerPreguntas()
    {
        $sql = "SELECT `id`, `pregunta` FROM `preguntas`;";
        return $this->database->query($sql);
    }

    public function obtenerPreguntasOficiales()
    {
        $sql = "SELECT `id`, `pregunta` FROM `preguntas` WHERE `esSugerida` = FALSE AND `estaReportada` = FALSE;";
        return $this->database->query($sql);
    }

    public function obtenerPreguntasSugeridas()
    {
        $sql = "SELECT `id`, `pregunta` FROM `preguntas` WHERE `esSugerida` = TRUE;";
        return $this->database->query($sql);
    }

    public function obtenerPreguntasReportadas()
    {
        $sql = "SELECT `id`, `pregunta` FROM `preguntas` WHERE `estaReportada` = TRUE;";
        return $this->database->query($sql);
    }

    public function obtenerPreguntaPorId($idPregunta)
    {
        $sql = "SELECT `id`, `pregunta` FROM `preguntas` WHERE `id` = $idPregunta;";
        $resultado = $this->database->query($sql);
        return $resultado;
    }

    public function obtenerRespuestasIncorrectas($idPregunta)
    {
        $sql = "SELECT `id`, `opcion`, `id_preguntas` FROM `respuestas` WHERE `id_preguntas` = $idPregunta AND opcioncorrecta = 'NO';";
        return $this->database->query($sql);
    }

    public function obtenerRespuestaCorrecta($idPregunta)
    {
        $sql = "SELECT `id`, `opcion`, `id_preguntas` FROM `respuestas` WHERE `id_preguntas` = $idPregunta AND opcioncorrecta = 'SI';";
        return $this->database->query($sql);
    }

    public function altaPregunta($pregunta, $respuestaCorrecta, $respuestaIncorrecta1, $respuestaIncorrecta2, $respuestaIncorrecta3)
    {
        $sqlPregunta = "INSERT INTO `preguntas` (`pregunta`) VALUES ('$pregunta');";
        $idPregunta = $this->database->insertMasId($sqlPregunta);
        $sqlRespuestaC = "INSERT INTO `respuestas` (`id_preguntas`, `opcion`, `opcioncorrecta`) VALUES ($idPregunta, '$respuestaCorrecta', 'SI');";
        $sqlRespuestaI1 = "INSERT INTO `respuestas` (`id_preguntas`, `opcion`, `opcioncorrecta`) VALUES ($idPregunta, '$respuestaIncorrecta1', 'NO');";
        $sqlRespuestaI2 = "INSERT INTO `respuestas` (`id_preguntas`, `opcion`, `opcioncorrecta`) VALUES ($idPregunta, '$respuestaIncorrecta2', 'NO');";
        $sqlRespuestaI3 = "INSERT INTO `respuestas` (`id_preguntas`, `opcion`, `opcioncorrecta`) VALUES ($idPregunta, '$respuestaIncorrecta3', 'NO');";
        return  $this->database->execute($sqlRespuestaC) &&
            $this->database->execute($sqlRespuestaI1) &&
            $this->database->execute($sqlRespuestaI2) &&
            $this->database->execute($sqlRespuestaI3);
    }

    public function borrarPregunta($idPregunta)
    {
        $this->database->execute("DELETE FROM `respuestas` WHERE `id_preguntas` = $idPregunta");
        $this->database->execute("DELETE FROM `preguntas` WHERE `id` = $idPregunta");
    }

    public function editarPregunta($idPregunta, $pregunta)
    {
        $sql = "UPDATE `preguntas` SET `pregunta` = '$pregunta' WHERE `id` = $idPregunta;";
        return $this->database->execute($sql);
    }

    public function editarRespuesta($idRespuesta, $opcion, $opcionCorrecta)
    {
        $sql = "UPDATE `respuestas` SET `opcion` = '$opcion', `opcioncorrecta` = '$opcionCorrecta' WHERE `id` = $idRespuesta";
        return $this->database->execute($sql);
    }

    public function oficializarPregunta($idPregunta)
    {
        $sql = "UPDATE `preguntas` SET `esSugerida` = FALSE, `estaReportada` = FALSE WHERE `id` = $idPregunta;";
        return $this->database->execute($sql);
    }

}