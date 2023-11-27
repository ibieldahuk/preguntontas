<?php

class JuegoModel
{
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function preguntaRepetida($id){
        $usuario = $_SESSION["usuario"];
        $sql = "Select id
                from usuario
                where usuario = '$usuario'";

        $consulta=$this->database->query($sql);

        foreach ($consulta as $user) {
            $idUser = $user["id"];
        }

        $sql = "INSERT INTO repetida (id_usuario,id_preguntaRepetida) VALUES ($idUser,$id)";

        $this->database->execute($sql);
    }

    public function idPregunta(){
        $usuario = $_SESSION["usuario"];
        $sql = "Select *
                from usuario
                where usuario = '$usuario'";

        $consulta=$this->database->query($sql);


        foreach ($consulta as $user){

            if($user["qtyPreguntas"]<10){

                return $array[] = $this->elegirPreguntaConDificultad(0.3,0.6,$user["id"]);

            }else{

                if($this->todasRespondidas($user["id"])){
                    return NULL;
                }
                if($user["shareCorrecta"]<0.3){

                    return $array[] = $this->elegirPreguntaConDificultad(0.6,1,$user["id"]);

                }else if($user["shareCorrecta"]>0.6){

                    return $array[] = $this->elegirPreguntaConDificultad(0,0.3,$user["id"]);

                }else{

                    return $array[] = $this->elegirPreguntaConDificultad(0.3,0.6,$user["id"]);

                }
            }
        }
    }

    public function elegirPreguntaConDificultad($min,$max,$user)
    {
        $pregunta = $this->database->query("
            Select * 
            from Preguntas 
            where shareCorrecta BETWEEN $min and $max 
            and id not in ( Select id_preguntaRepetida from repetida where id_usuario = $user)
            ");
        foreach ($pregunta as $toArray) {
            $array[] = $toArray["ID"];
        }
        if($array == NULL){
            $array[] = $this->elegirPreguntaConDificultad(0,1,$user);
            return $array[array_rand($array, 1)];
        }else {
            return $array[array_rand($array, 1)];
        }
    }

    public function todasRespondidas($idUser){
        $consulta = "Select id 
                from Preguntas";
        $preguntas = $this->database->query($consulta);

        $consulta = "Select id_usuario 
                from Repetida
                where id_usuario = $idUser";
        $respondidas = $this->database->query($consulta);

        if(sizeof($preguntas)==sizeof($respondidas)){
            return TRUE;
        }else
            return FALSE;
    }

    public function elegirPregunta($id){
        $sql = "Select pregunta as Pregunta
                from Preguntas
                where id = $id";
        return $this->database->query($sql);
    }

    public function reportarPregunta($id){
        $sql = "UPDATE preguntas
                SET `estaReportada` = TRUE
                where `ID`=$id";
        $this->database->execute($sql);
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

    public function sugerirPregunta($pregunta, $respuesta, $opcion1, $opcion2, $opcion3, $categoria){
        /*
        if($opcion2 == ""){
            if($opcion3 == "") {
                $sql = "INSERT INTO preguntas_sugerida (`pregunta`, `respuesta`, `opcion1`, `categoria`) VALUES ('$pregunta', '$respuesta', '$opcion1', '$categoria')";
                $this->database->execute($sql);
            }
        }else{
            $sql = "INSERT INTO preguntas_sugerida (`pregunta`, `respuesta`, `opcion1`, `opcion2`, `opcion3`, `categoria`) VALUES ('$pregunta', '$respuesta', '$opcion1', '$opcion2', '$opcion3', '$categoria')";
            $this->database->execute($sql);
        }
        */
        $idPregunta = $this->database->insertMasId("INSERT INTO preguntas (`pregunta`, `categoria`, `esSugerida`) VALUES ('$pregunta', '$categoria', TRUE);");
        $this->database->execute("INSERT INTO respuestas (`id_preguntas`, `opcion`, `opcioncorrecta`) VALUES ($idPregunta, '$respuesta', 'SI');");
        $this->database->execute("INSERT INTO respuestas (`id_preguntas`, `opcion`, `opcioncorrecta`) VALUES ($idPregunta, '$opcion1', 'NO');");
        $this->database->execute("INSERT INTO respuestas (`id_preguntas`, `opcion`, `opcioncorrecta`) VALUES ($idPregunta, '$opcion2', 'NO');");
        $this->database->execute("INSERT INTO respuestas (`id_preguntas`, `opcion`, `opcioncorrecta`) VALUES ($idPregunta, '$opcion3', 'NO');");
    }

    public function incrementarPartidasJugadas(){
        $usuario = $_SESSION["usuario"];
        $sql = "UPDATE usuario SET qtyPartidas = qtyPartidas + 1 WHERE usuario = '$usuario'";
        $this->database->execute($sql);
    }

    public function obtenerCategoria($id){
        $sql = "SELECT categoria FROM `preguntas` where ID = '$id'";
        return $this->database->query($sql);
    }
}