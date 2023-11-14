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


}