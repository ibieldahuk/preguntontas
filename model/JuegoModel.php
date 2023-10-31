<?php

class JuegoModel
{
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function idPregunta(){
        $usuario = $_SESSION["usuario"];
        $sql = "Select *
                from usuario
                where usuario = '$usuario'";


        $consulta=$this->database->query($sql);

        foreach ($consulta as $var){

            if($var["qtyPreguntas"]<10){

                $pregunta = $this->database->query("Select * from Preguntas where shareCorrecta BETWEEN 0.3 and 0.6");

                foreach ($pregunta as $toArray){
                    $array[]=$toArray["ID"];
                }
                return $array[array_rand($array,1)];
            }else{
                if($var["shareCorrecta"]<0.3){

                    $pregunta = $this->database->query("Select * from Preguntas where shareCorrecta > 0.6 ");
                    foreach ($pregunta as $toArray){
                        $array[]=$toArray["ID"];
                    }
                    return $array[array_rand($array,1)];
                }else if($var["shareCorrecta"]>0.6){

                    $pregunta = $this->database->query("Select * from Preguntas where shareCorrecta < 0.3 ");
                    foreach ($pregunta as $toArray){
                        $array[]=$toArray["ID"];
                    }
                    return $array[array_rand($array,1)];
                }else{
                    $pregunta = $this->database->query("Select * from Preguntas where shareCorrecta BETWEEN 0.3 and 0.6 ");
                    var_dump($pregunta);
                    die();
                    foreach ($pregunta as $toArray){
                        $array[]=$toArray["ID"];
                    }
                    return $array[array_rand($array,1)];
                }
            }
        }
    }

    public function elegirPregunta($id){
        $sql = "Select pregunta as Pregunta
                from Preguntas
                where id = $id";
        return $this->database->query($sql);
    }

    public function contarPregunta($id){
        $qty=0;
        $sql = "Select qty
                from Preguntas
                where id = $id";
        $consulta = $this->database->query($sql);
        foreach ($consulta as $var){
            $qty=$var["qty"];
        }
        $qty++;
        $sql = "Update preguntas
                Set qty=$qty
                where id = $id";
        $this->database->execute($sql);
    }

    public function contarPreguntaUsuario($id){
        $qty=0;
        $sql = "Select qtyPreguntas
                from usuario
                where usuario = '$id'";
        $consulta = $this->database->query($sql);
        foreach ($consulta as $var){
            $qty=$var["qtyPreguntas"];
        }
        $qty++;
        $sql = "Update usuario
                Set qtyPreguntas=$qty
                where usuario = '$id'";
        $this->database->execute($sql);
    }

    public function contarCorrectaUsuario($id){
        $qty=0;
        $sql = "Select qtyCorrectas
                from usuario
                where usuario = '$id'";
        $consulta = $this->database->query($sql);
        foreach ($consulta as $var){
            $qty=$var["qtyCorrectas"];
        }
        $qty++;
        $sql = "Update usuario
                Set qtyCorrectas=$qty
                where usuario = '$id'";
        $this->database->execute($sql);
    }

    public function contarCorrecta($id){
        $qty=0;

        $sql = "Select correctas
                from Preguntas
                where id = $id";

        $consulta = $this->database->query($sql);

        foreach ($consulta as $var){
            $qty=$var["correctas"];
        }

        $qty++;

        $sql = "Update preguntas
                Set correctas=$qty
                where id = $id";

        $this->database->execute($sql);
    }

    public function actualizarDificultad($id){
        $share=0;

        $sql = "Select *
                from Preguntas
                where id = $id";

        $consulta = $this->database->query($sql);

        foreach ($consulta as $var) {
                $share = ($var["correctas"]/$var["qty"]);
        }

        $sql = "Update preguntas
                Set shareCorrecta=$share
                where id = $id";

        $this->database->execute($sql);
    }

    public function actualizarDificultadUsuario($id){
        $share=0;
        $sql = "Select *
                from usuario
                where usuario = '$id'";
        $consulta = $this->database->query($sql);
        foreach ($consulta as $var) {
            $share = ($var["qtyCorrectas"]/$var["qtyPreguntas"]);
        }
        var_dump($share);
        $sql = "Update usuario
                Set shareCorrecta=$share
                where usuario = '$id'";
        $this->database->execute($sql);
    }

    public function elegirRespuestas($id){
        $sql = "Select * from Respuestas where ID_preguntas = $id";
        return $this->database->query($sql);
    }

    public function cargarRecord(){
        $racha = $_SESSION["RACHA"];
        $usuario = $_SESSION["usuario"];
        $sql = "Select record from usuario where usuario = '$usuario'";
        $consulta=$this->database->query($sql);

        foreach ($consulta as $array){
            if($array["record"]<$racha){
                $sql = "UPDATE USUARIO SET record = $racha where usuario = '$usuario' ";
                $this->database->execute($sql);
                }
            }
        }

    public function cargarPuntaje(){
        $racha = $_SESSION["RACHA"];
        $usuario = $_SESSION["usuario"];

        $sql = "Select puntosTotales from usuario where usuario = '$usuario'";
        $consulta=$this->database->query($sql);

        foreach ($consulta as $puntos){
            $racha+=$puntos["puntosTotales"];
        }

        $sql = "UPDATE USUARIO SET puntosTotales = $racha where usuario = '$usuario' ";
        $this->database->execute($sql);
    }

    public function listarRanking(){
        $sql = "SELECT * FROM usuario order by record desc";
        return $this->database->query($sql);
    }


}