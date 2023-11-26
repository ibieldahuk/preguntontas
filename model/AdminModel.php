<?php


class AdminModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function cantidadJugadores(){
        $sql = "SELECT *  FROM `usuario` WHERE id > 2";
        return sizeof($this->database->query($sql));
    }

    public function cantidadPreguntas(){
        $sql = "SELECT * FROM `preguntas`";
        return sizeof($this->database->query($sql));
    }

    public function cantidadJugadoresPorSexo(){
        $sql = "SELECT genero, COUNT(*) AS cantidad FROM `usuario` group by genero";
        return $this->database->query($sql);
    }

    public function cantidadJugadoresPorEdad(){
        $sql = "SELECT COUNT(*) AS cantidad, CONCAT(IF(YEAR(CURDATE()) - YEAR(fechaNac) < 18, 'Menor de 18', ''),
            IF(YEAR(CURDATE()) - YEAR(fechaNac) BETWEEN 18 AND 59, '18-59', ''),
            IF(YEAR(CURDATE()) - YEAR(fechaNac) >= 60, '60 o más', '')
        ) AS grupo_edad
        FROM `usuario`
        GROUP BY grupo_edad";
        return $this->database->query($sql);
    }

    public function cantidadPreguntasPorUsuario(){
        $sql = "SELECT nombre, puntosTotales, qtyPreguntas FROM `usuario` ORDER BY id";
        return $this->database->query($sql);
    }

    public function cantidadJugadoresNuevos(){
        $sql = "SELECT * FROM `usuario` WHERE id > 2 AND fecha_creacion >= DATE_SUB(CURDATE(), INTERVAL 15 DAY)";
        return sizeof($this->database->query($sql));
    }

    public function cantidadJugadoresPorPais(){
        $sql = "SELECT pais, COUNT(*) as cantidad FROM `usuario` GROUP BY pais";
        return $this->database->query($sql);
    }

    public function cantidadDePartidasJugadas(){
        $sql = "SELECT SUM(qtyPartidas) as contPartidas FROM usuario";
        return $this->database->query($sql);
    }

}