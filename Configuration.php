<?php
include_once('helpers/MySqlDatabase.php');
include_once("helpers/MustacheRender.php");
include_once('helpers/Router.php');
include_once('helpers/Logger.php');

include_once("model/UserModel.php");
include_once("model/JuegoModel.php");
include_once("model/EditorModel.php");
include_once ("model/AdminModel.php");

include_once('controller/UserController.php');
include_once('controller/JuegoController.php');
include_once('controller/EditorController.php');
include_once ('controller/AdminController.php');
include_once ('controller/PDFController.php');

include_once('third-party/mustache/src/Mustache/Autoloader.php');


class Configuration {
    private $configFile = 'config/config.ini';

    public function __construct() {
    }

    public function getUserController() {
        return new UserController(
            new UserModel($this->getDatabase()),
            $this->getRenderer());
    }

    public function getJuegoController() {
        return new JuegoController(
            new JuegoModel($this->getDatabase()),
            $this->getRenderer());
    }

    public function getEditorController() {
        return new EditorController(
            new EditorModel($this->getDatabase()),
            $this->getRenderer()
        );
    }

    public function getAdminController() {
        return new AdminController(
            new AdminModel($this->getDatabase()),
            $this->getRenderer()
        );
    }

    public function getPDFController() {
        return new PDFController();
    }

    private function getArrayConfig() {
        return parse_ini_file($this->configFile);
    }

    private function getRenderer() {
        return new MustacheRender('view/partial');
    }

    public function getDatabase() {
        $config = $this->getArrayConfig();
        return new MySqlDatabase(
            $config['servername'],
            $config['username'],
            $config['password'],
            $config['database']);
    }

    public function getRouter() {
        return new Router(
            $this,
            "getUserController",
            "list");
    }
}