<?php
include_once('helper/MySqlDatabase.php');
include_once('helper/Router.php');
require_once('helper/MustachePrinter.php');
include_once('controller/HomeController.php');
include_once('controller/VuelosController.php');
include_once('controller/LoginController.php');
include_once('controller/RegisterController.php');
include_once('model/VuelosModel.php');


require_once('third-party/mustache/src/Mustache/Autoloader.php');

class Configuration {

    public function getHomeController() {
        $VuelosModel = new VuelosModel($this->getDatabase());
        return new HomeController($VuelosModel, $this->getPrinter());
    }

    public function getLoginController() {
        return new LoginController($this->getPrinter());
    }

    public function getRegisterController() {
        return new RegisterController($this->getPrinter());
    }

    public function getVuelosController() {
        $VuelosModel = new VuelosModel($this->getDatabase());
        return new VuelosController($VuelosModel, $this->getPrinter());
    }

    private function getVuelosModel(): VuelosModel{
        return new VuelosModel($this->getDatabase());
    }

    private function getDatabase() {
       return new MySqlDatabase(
        "localhost",
        "root",
        "",
        "gauchorocket");
    }

    private function getPrinter() {
        return new MustachePrinter("view");
    }


    public function getRouter() {
        return new Router($this, "getHomeController", "execute");
    }

}