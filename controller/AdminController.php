<?php
/*require_once ('third-party/jpgraph/src/jpgraph.php');
require_once ('third-party/jpgraph/src/jpgraph_pie.php');*/
class AdminController
{
    private $adminModel;
    private $renderer;

    public function __construct($adminModel, $renderer)
    {
        $this->adminModel = $adminModel;
        $this->renderer = $renderer;
    }

    public function renderCantidadJugadores(){
        $datos["totalJugadores"] = $this->adminModel->cantidadJugadores();
        $this->renderer->render("cantidad_jugadores", $datos);
    }

    public function renderCantidadPreguntas(){
        $datos["cantidadPreguntas"] = $this->adminModel->cantidadPreguntas();
        $this->renderer->render("cantidad_preguntas", $datos);
    }

    public function  renderCantidadJugadoresSexo(){
        $datos["cantidadJugadoresPorSexo"] = $this->adminModel->cantidadJugadoresPorSexo();
        $datos["jsonCantidadJugadoresPorSexo"] = json_encode($datos["cantidadJugadoresPorSexo"]);
        $this->renderer->render("cantidad_jugadores_sexo", $datos);
    }

    public function renderCantidadJugadoresEdad(){
        $datos["cantidadJugadoresPorEdad"] = $this->adminModel->cantidadJugadoresPorEdad();
        $datos["jsonCantidadJugadoresPorEdad"] = json_encode($datos["cantidadJugadoresPorEdad"]);
        $this->renderer->render("cantidad_jugadores_edad", $datos);
    }


    public function renderCantidadPartidasJugadas(){
        if(!isset($_SESSION["contPartida"])){
            $_SESSION["contPartida"]=0;
        }
        $datos["contPartida"] = $_SESSION["contPartida"];
        $this->renderer->render("cantidad_partidas_jugadas", $datos);
    }

    public function renderCantidadPreguntasCorrectasPorUsuario(){
        $usuarios = $this->adminModel->cantidadPreguntasPorUsuario();

        $datos = [];

        // Procesar datos para el gráfico
        foreach ($usuarios as $usuario) {
            $usuarioId = $usuario['id'];
            $puntosTotales = $usuario['puntosTotales'];
            $qtyPreguntas = $usuario['qtyPreguntas'];

            if ($qtyPreguntas > 0) {
                $porcentaje = ($puntosTotales / $qtyPreguntas) * 100;
            } else {
                $porcentaje = 0;
            }

            $datos[] = [$usuarioId, $porcentaje];
        }

        // Pasar datos a la vista Mustache
        return $this->renderer->render("cantidad_preguntas_correctas_usuario", [
            'datos' => $datos,
            'dataForChart' => json_encode($datos)
        ]);
    }

    public function renderCantidadJugadoresNuevos(){
        $datos["cantidadJugadoresNuevos"] = $this->adminModel->cantidadJugadoresNuevos();
        Logger::info($datos["cantidadJugadoresNuevos"]);
        return $this->renderer->render("cantidad_jugadores_nuevos", $datos);
    }

    public function generarPDF(){
        $img = $_POST['img'];
        $pdfController = new PDFController();
        $pdfController->generarPDF($img);
    }
}