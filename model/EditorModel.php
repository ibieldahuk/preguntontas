<?php

class EditorModel
{

    private $database;

    public function __construct($database) {
        $this->database = $database;
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

    public function obtenerPreguntas()
    {
        $sql = "SELECT `id`, `pregunta` FROM `preguntas`;";
        return $this->database->query($sql);
    }

    public function borrarPregunta($idPregunta)
    {
        $sql = "DELETE FROM `preguntas` WHERE `id` = $idPregunta";
        $this->database->execute($sql);
    }

}