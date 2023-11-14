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
        /*$graph = new PieGraph(350,250);

        $theme_class="DefaultTheme";
        $graph->SetTheme(new $theme_class());
        $graph->title->Set("A Simple Pie Plot");
        $graph->SetBox(true);

        $p1 = new PiePlot($datos["cantidadJugadoresPorSexo"]);
        $graph->Add($p1);

        $p1->ShowBorder();
        $p1->SetColor('black');
        $p1->SetSliceColors(array('#1E90FF','#2E8B57','#ADFF2F','#DC143C','#BA55D3'));
        $graph->Stroke();*/




        $this->renderer->render("cantidad_jugadores_sexo", $datos);
    }

    public function renderCantidadJugadoresEdad(){
        $datos["cantidadJugadoresPorEdad"] = $this->adminModel->cantidadJugadoresPorEdad();
        $this->renderer->render("cantidad_jugadores_edad", $datos);
    }


    public function renderCantidadPartidasJugadas(){
        if(!isset($_SESSION["contPartida"])){
            $_SESSION["contPartida"]=0;
        }
        $datos["contPartida"] = $_SESSION["contPartida"];
        $this->renderer->render("cantidad_partidas_jugadas", $datos);
    }
}